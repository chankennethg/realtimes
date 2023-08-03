<?php
namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Validators\Failure;

class FailuresExport implements FromCollection, WithHeadings
{
    /**
     * @var Collection<int, Failure>
     */
    protected Collection $failures;

    /**
     * @param Collection<int, Failure> $failures
     */
    public function __construct($failures)
    {
        $this->failures = $failures;
    }

    /**
     * @return Collection<int, array{row: mixed, attribute: mixed, errors: string, values: string}>
     */
    public function collection(): Collection
    {
        return $this->failures->map(function ($failure) {
            return [
                'row'       => $failure->row(),
                'attribute' => $failure->attribute(),
                'errors'    => implode(", ", $failure->errors()),
                'values'    => implode(", ", $failure->values()),
            ];
        });
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return ['Row', 'Attribute', 'Errors', 'Values'];
    }
}