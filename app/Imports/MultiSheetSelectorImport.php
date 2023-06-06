<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultiSheetSelectorImport implements WithMultipleSheets
{
    use Importable,WithConditionalSheets;

    protected array $schema = [];

    /**
     * Constructeur de la classe
     * Initialise le schéma des feuilles importées avec leurs importeurs correspondants
     */
    public function __construct()
    {
        // Associe chaque feuille à son importeur correspondant
        $this->schema['Organismes de formation'] = new FormationSheetImporter();
        $this->schema['Salariés'] = new SalarieSheetImporter();
        $this->schema['Stage'] = new StageSheetImporter();
        $this->schema['Plan'] = new PlanSheetImporter();
    }

    /**
     * Retourne les feuilles conditionnelles à importer
     *
     * @return array
     */
    public function conditionalSheets(): array
    {
        return $this->schema;
    }
}
