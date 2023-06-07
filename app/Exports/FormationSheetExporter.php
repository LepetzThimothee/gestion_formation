<?php

namespace App\Exports;

use App\Models\Formation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

/**
 * Classe d'exportation des formations.
 * Elle permet de générer une collection de données à exporter.
 * Elle prend en charge les en-têtes de colonnes et le titre du fichier exporté.
 */
class FormationSheetExporter implements FromCollection, WithHeadings, WithTitle
{
    use Exportable;

    /**
     * Retourne une collection des données des organismes de formation à exporter.
     *
     * @return Collection
     */
    public function collection(): Collection
    {
        return Formation::get(['organisme','telephone','email',
            'numero_declaration_existence','siret','adresse','interlocuteur']);
    }

    /**
     * Retourne les en-têtes des colonnes du fichier exporté.
     *
     * @return array
     */
    public function headings(): array {
        return ["organismes de formation","coordonnées téléphoniques","adresses mail","Numéro déclaration existence",
            "Numéro de SIRET","adresse","Interlocuteur"];
    }

    /**
     * Retourne le titre du fichier exporté.
     *
     * @return string
     */
    public function title(): string
    {
        return "Organismes de formation";
    }
}
