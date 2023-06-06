<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultiSheetSelectorExport implements WithMultipleSheets
{
    use Exportable;

    protected array $schema = [];

    /**
     * Constructeur de la classe.
     * Initialise le schéma des feuilles à exporter.
     */
    public function __construct()
    {
        $this->schema['Organismes de formation'] = new FormationSheetExporter(); // Feuille pour exporter les organismes de formation
        $this->schema['Stage'] = new StageSheetExporter(); // Feuille pour exporter les informations des stages
        $this->schema['Salariés'] = new SalarieSheetExporter(); // Feuille pour exporter les informations des salariés
    }

    /**
     * Retourne un tableau contenant les feuilles à exporter.
     *
     * @return array
     */
    public function sheets(): array
    {
        return $this->schema;
    }
}
