<?php

namespace App\Exports;

use App\Models\Salarie;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class SalarieSheetExporter implements FromCollection, WithHeadings, WithColumnFormatting, WithTitle
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Salarie::get(['matricule','nom','nom_jeune_fille','prenom','code_etablissement','sexe','naissance','age','numero_secu','domiciliation','iban','bic','email_perso','email_pro',
            'adresse_ligne1','adresse_ligne2','adresse_ligne3','adresse_ligne4','nature_contrat','type_contrat','puissance_fiscal','referent_paie','unite','lib_unite','section_analytique',
            'debut_anciennete_groupe', 'debut_contrat','fin_contrat','filiere','sous_filiere','metier','emploi','statut','rpps','adeli','cpn','taux_emploi','horaire_contrat','montant_aq004','taux_horaire']);
    }

    public function headings(): array {
        return ["MATRICULE","NOM DE FAMIL LE DE L'AGEN","NOM DE JEUNE FILLE AGENT","PRENOM DE L' AGENT","CODE ETABLIS SEMENT","CODE SEXE DE L'AGENT","DATE DE NAISSANCE","AGE SALARIE","NUM SECURITE SOCIALE","DOMICILIATIO N BANCAIRE","CODE IBAN","BIC","E-MAIL PERSO","E-MAIL PRO",
            "LIGNE 1 DE L ADRESSE","LIGNE 2 DE L ADRESSE","LIGNE 3 DE L ADRESSE","LIGNE 4 DE L ADRESSE","NATURE DU CONTRAT","TYPE CONTRAT","PUIS. FISCAL VEHICULE","REFERENT PAI E","UNITE","LIB UNITE","SECTION ANALYTIQUE",
            "DEBUT ANCIEN NETE GROUPE","DATE DEBUT CONTRAT","DATE FIN CONTRAT","FILIERE","SOUS FILIERE","METIER","EMPLOI","STATUT","NUMERO RPPS","N0 ADELI","CODE CPN","TAUX EMPLOI","HORAIRE CONTRACT.HORAIRE CONTRACT.","MONTANT AQ004","TAUX HOR."];
    }

    public function columnFormats(): array
    {
        return [
            'Z' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AA' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AB' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function title(): string
    {
        return "Salariés";
    }
}