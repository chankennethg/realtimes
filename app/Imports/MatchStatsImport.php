<?php

namespace App\Imports;

use App\Models\MatchStat;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;

class MatchStatsImport
implements ToModel, WithBatchInserts, WithChunkReading, WithValidation, SkipsOnFailure, ShouldQueue
{
    use Importable, SkipsFailures;

    /**
    * @param array<int,string> $row
    *
    * @return Model|null
    */
    public function model(array $row)
    {
        Log::info('data', $row);
        return new MatchStat([
            'match_id' => $row[0],
            'team_id' => $row[1],
            'player_id' => $row[2],
            'param_id' => $row[3],
            'param_name' => $row[4],
            'value' => $row[5],
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
            '*.match_id' => 'exists:matches,id',
            '*.team_id' => 'exists:teams,id',
            '*.player_id' => 'exists:players,id'
        ];
    }
}
