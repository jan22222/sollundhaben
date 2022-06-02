<?php

namespace App\Exports;

use App\Models\Tabula;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;

class TablesExport implements FromQuery, WithMapping
{
    use Exportable;

    public function __construct($id)
    {
        // aus Route-Model-Binding
        $this->id = $id;
    }

    public function query()
    {
        return Tabula::query()
            ->select('id', 'soll', 'haben')
            ->where('id', $this->id);
    }

    public function map($tabula): array
    {   
        //unformatieren
        $soll =  $tabula->soll;
        //vom string Randwerte abschneiden: [ und ]
        $soll = substr($soll, 1, -1);
        // in Array umwandeln
        $soll = explode( ',', $soll);
        //das gleiche mit soll
        $haben =  $tabula->haben;
        $haben = substr($haben, 1, -1);
        $haben = explode( ',', $haben);
        // als ersten Wert den Header soll/haben einfügen ins Array
        array_unshift($haben, "haben");
        array_unshift($soll, "soll");

        return [
            $soll, 
            $haben
        ];
    }
}
