<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;


class PdfController extends Controller
{

public int $openCustomerId = 712;

public function countOpenCustomerRecords()
{
    $openCustomer = Customer::where('name', '***OPEN****')->first();
    //dd($openCustomer);
//    if (!$openCustomer) {
//        return [
//            'total_open_records' => 0,
//            'grouped_by_employee' => []
//        ];
//    }

    $totalOpenRecords = Service::where('customer_id', $openCustomer->id)->count();

    $groupedByEmployee = Service::select('employees.name as employee_name', DB::raw('count(services.id) as total'))
        ->join('employees', 'services.employee1_id', '=', 'employees.id')
        ->where('services.customer_id', $openCustomer->id)
        ->groupBy('employees.name')
        ->get();

    return [
        'total_open_records' => $totalOpenRecords,
        'grouped_by_employee' => $groupedByEmployee
    ];
}
    public function index($from = null,$till=null )
    {
        $from = $from ?? now()->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
        $till = $till ?? now()->endOfWeek(Carbon::SUNDAY)->format('Y-m-d');
        $services = Service::select('services.*','customers.name as customer_name','employees.name as employee_name'
        )->with('customer','employee','control')
            ->join('customers','services.customer_id','=','customers.id')
            ->join('employees','services.employee1_id','=','employees.id')
            ->whereBetween('service_date',[$from,$till])
            ->orderBY('service_date','asc')
            ->get();
        $countedAllServices = $services->count();
        //dd($services->countBy('customer_id'));

        $counted = $services->countBy('customer_id');
//        dd($counted->keys()->all());
        if(array_search($this->openCustomerId, $counted->keys()->all())){
            $countedVal = $counted[$this->openCustomerId];
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
//            "Total em aberto => ".$counted[$this->OpenCustomerId],
//            $services->all()[0],
//            $services->groupBy('employee_name'),
//            $services->countBy('employee_name'),
//
//        );
        //dd(public_path('logo.png'));
        $logo = '<img src="data:image/svg+xml;base64,' . base64_encode(public_path('logo.png')) . '" ...>';
        $openCustomerId = $this->openCustomerId;
        return view('livewire.residential.dashpdf',
            compact(
                'openCustomerId',
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
            ->orderBY('service_date','asc')
            ->get();
        $countedAllServices = $services->count();
        $counted = $services->countBy('customer_id');
//        dd($counted->keys()->all());
//        dd(array_search($this->OpenCustomerId, $counted->keys()->all()));
        if(array_search($this->openCustomerId, $counted->keys()->all())){
            $countedVal = $counted[$this->openCustomerId];
        }else{
            $countedVal = 0;
        }
        $countedTotalOpen = $countedVal;
        $allServicesClosed = $countedAllServices - $countedVal;
        $groupedServices = $services->groupBy('employee_name');
        $data = [
            'openCustomerId' => $this->openCustomerId,
            'services' => $services,
            'from' => $from,
            'till' => $till,
            'countedAllServices' => $countedAllServices,
            'allServicesClosed' => $allServicesClosed,
            'countedTotalOpen' => $countedTotalOpen,
            'groupedServices' => $groupedServices,
            'pdf' => true
        ];
        $fileName = 'Weekly_Report_'.'from_'.$from.'_till_'.$till.'.pdf';
        return Pdf::loadView('livewire.residential.dashpdf', $data )
            ->setPaper('a4','portrait')
            ->stream($fileName);
    }
}
