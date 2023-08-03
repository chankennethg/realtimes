<?php

namespace App\Imports;

use App\Models\Team;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class TeamsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithProgressBar
{
    use Importable;

    /**
    * @param array<string,string> $row 
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Team([
            'id' => $row['id'],
            'name' => $row['name'],
            'short_name' => $row['short_name'],
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
