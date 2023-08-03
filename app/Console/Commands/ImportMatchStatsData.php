<?php

namespace App\Console\Commands;

use App\Imports\MatchStatsImport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ImportMatchStatsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-match-stats-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Match stats data';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $directory = resource_path('import/split-files');
        $files = File::files($directory);

        foreach ($files as $file) {
            if ($file->getExtension() === 'csv') {
                $import = New MatchStatsImport();
                $import->import($file->getPathname());
            }
        }
    }
}
