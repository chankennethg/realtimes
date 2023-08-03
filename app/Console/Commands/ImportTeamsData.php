<?php

namespace App\Console\Commands;

use App\Imports\TeamsImport;
use Illuminate\Console\Command;

class ImportTeamsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-teams-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Teams data';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $csv = resource_path('import/teams.csv');
        $this->output->title('Starting import of Teams data');
        (new TeamsImport)->withOutput($this->output)->import($csv);
        $this->output->success('Import successful');
    }
}
