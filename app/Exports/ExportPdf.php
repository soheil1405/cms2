<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Vendor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\FormView;
use Maatwebsite\Excel\Concerns\WithMapping;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportPdf implements FromCollection
{
    use Exportable;

    private $view;

    private $data ;
  
    public function __contstruct($view , $data){

        $this->view = $view ;
        $this->data = $data ;
        
    }
  


  
    public function collection()
    {

        return  view($this->view , compact($this->data));
    }

    
     

}