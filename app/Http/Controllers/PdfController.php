<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;


class PdfController extends Controller
{

    public function index($from = null,$till=null )
    {
        $from = $from ?? now()->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
        $till = $till ?? now()->endOfWeek(Carbon::SUNDAY)->format('Y-m-d');

        $services = Service::select('services.*','customers.name as customer_name','employees.name as employee_name'
        )->with('customer','employee','control')
            ->join('customers','services.customer_id','=','customers.id')
            ->join('employees','services.employee1_id','=','employees.id')
            ->whereBetween('service_date',[$from,$till])
            ->get();
        $countedAllServices = $services->count();
        $counted = $services->countBy('customer_id');
        if(array_search(1, $counted->keys()->all())){
            $countedVal = $counted[1];
        }else{
            $countedVal = 0;
        }
        $countedTotalOpen = $countedVal;
        $allServicesClosed = $countedAllServices - $countedVal;
        $groupedServices = $services->groupBy('employee_name');
        $pdf = false;
//        dd(
//            $from,$till,
//            "All services ".$countedAllServices,
//            "All services open ".$allServicesClosed,
//            "Total em aberto => ".$counted[1],
//            $services->all()[0],
//            $services->groupBy('employee_name'),
//            $services->countBy('employee_name'),
//
//        );
        //dd(public_path('logo.png'));
        $logo = '<img src="data:image/svg+xml;base64,' . base64_encode(public_path('logo.png')) . '" ...>';
        return view('livewire.residential.dashpdf',
            compact(
                'services',
                'from',
                'till',
                'countedAllServices',
                'allServicesClosed',
                'countedTotalOpen',
                'groupedServices',
                'pdf',
                'logo'
            ));
    }
    //
    public function generatePDF($from = null,$till=null)
    {
        $from = $from ?? now()->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
        $till = $till ?? now()->endOfWeek(Carbon::SUNDAY)->format('Y-m-d');

        $services = Service::select('services.*','customers.name as customer_name','employees.name as employee_name'
        )->with('customer','employee','control')
            ->join('customers','services.customer_id','=','customers.id')
            ->join('employees','services.employee1_id','=','employees.id')
            ->whereBetween('service_date',[$from,$till])
            ->get();
        $countedAllServices = $services->count();
        $counted = $services->countBy('customer_id');
//        dd(array_search(1, $counted->keys()->all()));
        if(array_search(1, $counted->keys()->all())){
            $countedVal = $counted[1];
        }else{
            $countedVal = 0;
        }
        $countedTotalOpen = $countedVal;
        $allServicesClosed = $countedAllServices - $countedVal;
        $groupedServices = $services->groupBy('employee_name');
        $data = [
            'services' => $services,
            'from' => $from,
            'till' => $till,
            'countedAllServices' => $countedAllServices,
            'allServicesClosed' => $allServicesClosed,
            'countedTotalOpen' => $countedTotalOpen,
            'groupedServices' => $groupedServices,
            'pdf' => true
        ];
        $fileName = 'relatorio_semanal_'.'week-from_'.$from.'_till_'.$till.'.pdf';
        return Pdf::loadView('livewire.residential.dashpdf', $data )
            ->setPaper('a4','portrait')
            ->stream($fileName);
    }
}
