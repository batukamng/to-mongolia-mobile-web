<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@github.com:gcomm-devs/to-mongolia-web.git');

set('shared_files', []);
set('shared_dirs', []);
// add('writable_dirs', []);

// Hosts

host('124.158.120.244') // Test Server
    ->set('branch', 'main')
    ->set('remote_user', 'tmw')
    ->setIdentityFile('~/.ssh/tmwkey')
    ->setSshMultiplexing(false)
    ->set('deploy_path', '/var/www/to-mongolia-web');

// Tasks
task('env:copy', function () {
    run('cp {{deploy_path}}/current/.env.example {{deploy_path}}/current/.env');
});

task('set:permission', function () {
    run('chmod -R 775 {{deploy_path}}/current/public/uploads/');
});

// task('artisan:db:wipe', artisan('db:wipe'));
task('artisan:remove:installation', artisan('remove:installation'));
// task('artisan:csv:seed', artisan('csv:seed'));
task('artisan:admin:password', artisan('admin:password {{password}}'));

// Hooks

// Migrate database before symlink new release.
// before('deploy:symlink', 'artisan:migrate');

after('deploy:symlink', function () {
    invoke('env:copy');
    invoke('artisan:config:cache');
    invoke('artisan:route:cache');
    invoke('artisan:view:cache');
    invoke('artisan:event:cache');
});

// If failed unlock files
after('deploy:failed', 'deploy:unlock');
after('deploy:success', 'set:permission');
