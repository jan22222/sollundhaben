<?php

namespace App\Imports;

use App\Models\Tabula;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeImport;

class TabulaImport implements ToModel, WithEvents
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public array $catch_soll, $catch_haben;
    public $i, $totalRows;
    public function __construct(){
        $this->i = 0;
        $this->catch_soll = [];
        $this->catch_haben = [];
        $this->totalRows = 0;
    }
    public function registerEvents(): array
    {
        return [
            BeforeImport::class => function (BeforeImport $event) {
                $this->totalRows = $event->getReader()->getTotalRows();
                if (!empty($this->totalRows)) {
                    $this->totalRows = $this->totalRows['Worksheet'];
                }
            }
        ];
    }
    public function model(array $row)
    {
        $this->i +=1;  
        array_push($this->catch_soll, $row[0]);
        array_push($this->catch_haben, $row[1]);
        if ($this->totalRows === $this->i) {
            
            $soll = json_encode($this->catch_soll, JSON_FORCE_OBJECT);
            $haben = json_encode($this->catch_haben, JSON_FORCE_OBJECT);
            //  dd($soll);
            return new Tabula([
                'soll' => $soll,
                'haben' => $haben,
                'enterprise_id' => auth()->user()->enterprise_id
            ]);
         }
    }
}
