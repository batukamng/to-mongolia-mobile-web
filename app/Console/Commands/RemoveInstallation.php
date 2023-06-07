<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RemoveInstallation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:installation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes migrations and default installation wizard state';

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
        // $this->call('db:wipe', [
        //     '--database' => config('database.default'),
        //     '--yes' => true
        // ]);

        if (file_exists(storage_path('installed'))) {
            unlink(storage_path('installed'));

            $this->info('Removed installation successfully.');
        }

        \Session::getHandler()->gc(0);
        $this->info('Removed session files successfully.');

        return Command::SUCCESS;
    }
}
