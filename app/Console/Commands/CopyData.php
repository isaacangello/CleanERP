<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CopyData extends Command
{
    protected $signature = 'copy:data';
    protected $description = 'Copy data from jjsystem_db to jjlsystem_sys2';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Copiar dados da tabela customers
        $sourceCustomers = DB::connection('mysql_source')->table('customers')->get();
        foreach ($sourceCustomers as $customer) {
            DB::connection('mysql_target')->table('customers')->updateOrInsert([
                'id' => $customer->id_customer,
            ],[
                'id' => $customer->id_customer,
                'name' => $customer->nome,
                'address' => $customer->adress,
                'phone' => $customer->phone,
                'email' => $customer->email,
                'type' => $customer->veraneio ? 'HELTALHOUSE' : $customer->tipo,
                'frequency' =>  substr($customer->frequence, 0, 254),
                'note' => $customer->notes,
                'info' => $customer->info,
                'key' => $customer->chavec??false,
                'drive_licence' => $customer->driver??false,
                'gate_code' => $customer->senha??false,
                'status' => $customer->status,
            ]);
        }

        // Copiar dados da tabela employees
        $sourceEmployees = DB::connection('mysql_source')->table('employees')->get();
        foreach ($sourceEmployees as $employee) {
            $func = DB::connection('mysql_source')->table('func')->where('id_user', $employee->id_employee)->first();
            DB::connection('mysql_target')->table('employees')->updateOrInsert([
                'id' => $employee->id_employee,
            ], [
                'id' => $employee->id_employee,
                'name' => $employee->nome,
                'phone' => $employee->phone,
                'email' => $employee->email,
                'address' => $employee->adress,
                'name_ref_one' => $employee->nomerefone,
                'phone_ref_one' => $employee->phonerefone,
                'name_ref_two' => $employee->nomereftwo,
                'phone_ref_two' => $employee->phonereftwo,
                'description' => $employee->notes,
                'type' => $employee->tipo??'RESIDENTIAL',
                'status' => $employee->status??'ACTIVE',
                'username' => $func->user ?? str_replace(' ', '', strtolower(trim($employee->nome))).rand(1, 100),
                'password' => $func->senha??bcrypt('1234'),
                'new_user' => $func->nova??0,
            ]);
        }

        // Copiar dados da tabela services
        $sourceEvents = DB::connection('mysql_source')->table('events')->get();
        foreach ($sourceEvents as $event) {
            $customerExists = DB::connection('mysql_target')->table('customers')->where('id', $event->id_customer)->exists();
            $employeeExists = DB::connection('mysql_target')->table('employees')->where('id', $event->id_employee)->exists();
            if ($customerExists && $employeeExists) {
                $customerPrice = DB::connection('mysql_source')->table('customers')->where('id_customer', $event->id_customer)->value('price');
                $plus = is_numeric($event->price) ? $event->price : 0;
                $minus = is_numeric($event->menos) ? $event->menos : 0;
                $price = is_numeric($customerPrice) ? $customerPrice : 0;
                if(strlen(trim($event->hora)) === 5) {
                    $event->hora = $event->hora . ':00';
                }
                if(strlen(trim($event->hora)) !== 8 and strlen(trim($event->hora)) !== 5) {
                    $event->hora = '00:00:00';
                }

                    if ($event->date === "0000-00-00") {
                        $serviceDate = "2020-01-01 00:00:00";
                    }else{
                        try {
                            $serviceDate = Carbon::create($event->date . ' ' . $event->hora)->format('Y-m-d H:i:s');
                        } catch (\Exception $e) {
                            $serviceDate = "2020-01-01 00:00:00";
                        }
                    }

                DB::connection('mysql_target')->table('services')->updateOrInsert([
                    'id' => $event->id_event,
                ], [
                    'id' => $event->id_event,
                    'employee1_id' => $event->id_employee,
                    'customer_id' => $event->id_customer,
                    'period' => $event->period,
                    'frequency' => substr($event->frequence, 0, 254),
                    'notes' => $event->notas,
                    'plus' => $plus,
                    'minus' => $minus,
                    'confirmed' => $event->confirma === 'S',
                    'who_saved' => $event->salvou,
                    'paid_out' => $event->recebido === 'S',
                    'finance_notes' => $event->finotas,
                    'fee' => $event->fee === 'S',
                    'instructions' => $event->instructions,
                    'justify_minus' => $event->justify_sub,
                    'justify_plus' => $event->justify_plus,
                    'service_date' => $serviceDate,
                    'price' => $price,
                ]);
            }
        }

        $this->info('Data copied successfully!');
    }
}
