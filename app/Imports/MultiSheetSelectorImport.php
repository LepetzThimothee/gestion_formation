<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultiSheetSelectorImport implements WithMultipleSheets
{
    use Importable,WithConditionalSheets;

    protected $schema = [];

    public function __construct()
    {
        $this->schema['Organismes de formation'] = new FormationSheetImporter();
        $this->schema['Salariés'] = new SalarieSheetImporter();
        $this->schema['Stage'] = new StageSheetImporter();
    }
    public function conditionalSheets(): array
    {
        return $this->schema;
    }
}
