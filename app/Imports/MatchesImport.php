<?php

namespace App\Imports;

use App\Models\MatchModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithValidation;

class MatchesImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithProgressBar, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    /**
    * @param array<string,string> $row 
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MatchModel([
            'id' => $row['id'],
            'match_name' => $row['match_name'],
            'match_date' => $row['match_date'],
            'team1_id' => $row['team1_id'],
            'team1_score' => $row['team1_score'],
            'team2_id' => $row['team2_id'],
            'team2_score' => $row['team2_score'],
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

    /**
     * @return array<string,string>
     */
    public function rules(): array
    {
        return [
            '*.match_name' => 'required',
            '*.team1_id' => 'exists:teams,id',
            '*.team2_id' => 'exists:teams,id'
        ];
    }
}