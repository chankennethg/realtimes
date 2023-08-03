<?php

namespace App\Console\Commands;

use App\Exports\FailuresExport;
use App\Imports\MatchesImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class ImportMatchesData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-matches-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Matches data';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $csv = resource_path('import/matches.csv');
        $this->output->title('Starting import of matches');
        $import = new MatchesImport();
        $import->withOutput($this->output)->import($csv);
        $failures = $import->failures();

        if ($failures->count() === 0) {
            $this->output->success('Import successful');
        } else {
            $this->output->success('Import successful with Failures');
        }
    
        $this->output->title('Starting export of failures');
        $export = new FailuresExport($failures);        
        Excel::store($export, 'exports/matches_failures.xlsx');
        $this->output->success('Exporting Success');
    }
}
