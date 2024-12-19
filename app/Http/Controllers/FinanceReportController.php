<?php

namespace App\Http\Controllers;

use App\Helpers\Finance\FinanceTrait;
use App\Models\Employee;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FinanceReportController extends Controller
{
    //
    use FinanceTrait;
    public function index($id=null,$from = null,$till =null,$message= null)
    {
        if(empty($id)){
            $id = 4;
        }
        $from = $from ?? Carbon::now()->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
        $till = $till ?? Carbon::now()->endOfWeek(Carbon::SUNDAY)->format('Y-m-d');
        return view('livewire.finance.report',[
                'totalServicesPriceEmployee' => $this->totalServicesPricesEmployee($id,$from,$till),
                "ServicesEmployee" => $this->servicesEmployee($id,$from,$till),
                "payments" => Payment::all()->toArray(),
                'message' => $message
            ]
        );
    }
    public function generate_pdf($id,$from,$till,$message= null)
    {
        $data = [
            'totalServicesPriceEmployee' => $this->totalServicesPricesEmployee($id,$from,$till),
            "ServicesEmployee" => $this->servicesEmployee($id,$from,$till),
            "payments" => Payment::all()->toArray(),
            'message' => $message
        ];
        $fileName = 'relatorio_semanal_'.'week-from_'.$from.'_till_'.$till.'.pdf';
        return Pdf::loadView('livewire.finance.report', $data )
            ->setPaper('a4', 'landscape')
            ->stream($fileName);

    }
}
