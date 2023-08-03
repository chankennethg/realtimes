<?php 

namespace App\Binders;

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\DefaultValueBinder;

class NullValueBinder extends DefaultValueBinder
{
    public function bindValue(Cell $cell, $value)
    {
        if ($value === '\N') {
            $cell->setValueExplicit(null, DataType::TYPE_NULL);
            return true;
        } 

        return parent::bindValue($cell, $value);
    }
}