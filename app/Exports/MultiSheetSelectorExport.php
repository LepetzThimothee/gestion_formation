<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultiSheetSelectorExport implements WithMultipleSheets
{
    use Exportable;

    protected $schema = [];

    public function __construct()
    {
        $this->schema['Organismes de formation'] = new FormationSheetExporter();
        $this->schema['Stage'] = new StageSheetExporter();
        $this->schema['Salariés'] = new SalarieSheetExporter();
    }

    public function sheets(): array
    {
        return $this->schema;
    }
}
