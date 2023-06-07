<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallFresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:fresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install fresh application';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('down');
        $this->call('remove:installation');
        $this->call('migrate:fresh', [
            '--seed' => true,
            '--force' => true,
        ]);

        if (!file_exists(storage_path('installed'))) {
            touch(storage_path('installed'));
            file_put_contents(storage_path('installed'), 'Laravel Installer successfully INSTALLED on ' . date('Y-m-d H:i:s') . '');
        }
        $this->call('admin:password', ['password' => 'admin12345']);
        $this->call('optimize');
        $this->call('up');

        $this->info('Install fresh application successfully!');

        return Command::SUCCESS;
    }
}
