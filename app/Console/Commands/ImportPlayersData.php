<?php

namespace App\Console\Commands;

use App\Imports\PlayersImport;
use Illuminate\Console\Command;

class ImportPlayersData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-players-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Players Data';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $csv = resource_path('import/players.csv');
        $this->output->title('Starting import of Players data');
        (new PlayersImport)->withOutput($this->output)->import($csv);
        $this->output->success('Import successful');
    }
}
