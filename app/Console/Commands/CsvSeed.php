<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CsvSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csv:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Wrapper command class for CsvDataSeeder';

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
        Artisan::call('db:seed --class=CsvDataSeeder');

        $this->info('CSV data seeded successfully.');

        return Command::SUCCESS;
    }
}
