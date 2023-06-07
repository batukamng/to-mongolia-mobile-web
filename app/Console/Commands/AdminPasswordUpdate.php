<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AdminPasswordUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:password {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Override admin password';

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
        $password = $this->argument('password');
        $user = \App\User::where('email', 'admin@bookingcore.test')->first();
        $user->password = bcrypt($password);
        $user->need_update_pw = 0;

        if ($user->save()) {
            $this->info('Admin password updated successfully!');
            return Command::SUCCESS;
        } else {
            $this->error('Admin password update failed!');
            return Command::FAILURE;
        }
    }
}
