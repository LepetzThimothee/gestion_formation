<?php

namespace App\Exports;

use App\Models\Stage;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

/**
 * Classe d'exportation des stages.
 * Elle permet de générer une collection de données à exporter.
 * Elle prend en charge le formatage des colonnes et le titre du fichier exporté.
 */
class StageSheetExporter implements FromCollection, WithColumnFormatting, WithTitle
{
    use Exportable;

    /**
     * Retourne une collection des données des stages à exporter.
     *
     * @return Collection
     */
    public function collection(): Collection
    {
        return Stage::get(['session','intitule','numero','organisme','formation_obligatoire','intra_inter',
            'cout_pedagogique','debut_formation','fin_formation','duree','opco','convention','convocation','attestation','facture']);
    }

    /**
     * Retourne les en-têtes des colonnes du fichier exporté.
     *
     * @return array
     */
    public function headings(): array
    {
        return ["CESSION","INTITULE DE FORMATION","N° STAGE","Organisme de formation","FORMATION OBLIGATOIRE(O/N)","INTRA/INTER \n a/r","COUT PEDAGOGIQUE STAGE","DATE DE DEBUT DE FORMATION",
            "DATE DE FIN DE FORMATION","DUREE REELLE DE LA FORMATION EN HEURES","PRISE EN CHARGE OPCO SANTE -(O/N)","CONVENTION DE FORMATION -(O/N)","CONVOCATION  ( O/N)","ATTESTATION -O/N)","FACTURE - O/N)"];
    }

    /**
     * Définit le format des colonnes spécifiques du fichier exporté.
     *
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY, // Colonne pour la date de début de formation
            'I' => NumberFormat::FORMAT_DATE_DDMMYYYY, // Colonne pour la date de fin de formation
        ];
    }

    /**
     * Retourne le titre du fichier exporté.
     *
     * @return string
     */
    public function title(): string
    {
        return "Stage";
    }
}
