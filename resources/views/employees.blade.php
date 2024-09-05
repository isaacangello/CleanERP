@extends("layouts.main")
@section('title')
     <title>employees - main - JJL System 2</title>
@endsection
{{--css links para o head--}}
@section('css-style')
 @include('layouts.generic_css')
@endsection

@section('content')
@php
    if (!isset($employeeName)){$employeeName='Jane Doe Pinto Rego';$employeeNameCad='&nbsp;';}
    if (!isset($employeeEmail)){$employeeEmail='jhondoe@email.com';$employeeEmailCad='&nbsp;';}
    if (!isset($employeeBirth)){$employeeBirth='DAY';$employeeTypeBirthCad='&nbsp;';}
    if (!isset($employeeAddress)){$employeeAddress='Meu endereço';$employeeAddressCad='&nbsp;';}
    if (!isset($employeeAddressComplement)){$employeeAddressComplement='Complemento';$employeeAddressComplementCad="&nbsp;";}
    if (!isset($employeePhone)){$employeePhone='561-124-555';$employeePhoneCad ='&nbsp;';}
    if (!isset($employeeDocument )){$employeeDocument ='200';$employeeDocumentCad='&nbsp;';}
    if (!isset($employeeRefName1)){$employeeRefName1='Mae Joana';$employeeRefName1Cad='&nbsp;';}
    if (!isset($employeeRefName2)){$employeeRefName2='Katiusia';$employeeRefName2Cad='&nbsp;';}
    if (!isset($employeeRefPhone1)){$employeeRefPhone1='Katiusia';$employeeRefphone1Cad='&nbsp;';}
    if (!isset($employeeRefPhone2)){$employeeRefPhone2='Katiusia';$employeeRefphone2Cad='&nbsp;';}
    if (!isset($employeeStatus)){$employeeStatus='ACTIVE';$employeeStatusCad='&nbsp;';}
    if (!isset($employeeRestricao)){$employeeRestricao='está inativo por que eu quiz e pronto, mandei !!!!!';$employeeRestricaoCad='&nbsp;';}
    if (!isset($employeeKeys)){$employeeKeys='checked';$employeeKeysCad="checked";}
    if (!isset($employeeDriveLicence )){$employeeDriveLicence ='checked';$employeeDriveLicenceCad='checked';}
    if (!isset($employeeGateCode )){$employeeGateCode ='checked';$employeeGateCodeCad='checked';}
    if (!isset($employeePasskey)){$employeePasskey='checked';$employeePasskeyCad='checked';}
    if (!isset($employeeMoregirl)){$employeeMoregirl='checked';$employeeMoregirlCad='checked';}
    if (!isset($employeeHouseDescription)){$employeeHouseDescription='Lorem ipsun';$employeeHouseDescriptionCad='&nbsp;';}
    if (!isset($employeeNote )){$employeeNote ='Lorem ipsun and Busei ipsun';$employeeNoteCad='&nbsp;';}
    if (!isset($count )){$count=0;}
    //<!-- função auxiliar para gerar lista com cores alternadas  -->
            function altclass($nun): void
            {
                if ($nun % 2 > 0 ){
                    echo "darken-3";
                }else{
                    echo "darken-4";
                }
            }
@endphp

<div class="container-fluid">
    @if(!is_null($msg))
        <div id="SavedSwl" class="hide">{{ $msg }}</div>
    @endif
    <div class="block-header">
        <h2>
            <small>EMPLOYEES REGISTER AND VIEW</small>
        </h2>
    </div>
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col s12 m12">
            <div class="card">
                <div class="header" style="padding-bottom: 0;">
                    <div class="row">
                        <div class="col s12 m12">
                            <a class="btn waves-effect waves-classic waves-light  btn-small modal-trigger"  href="#new-employee"  >New Employee</a>
                            <span id="list-of-employees" class="m-l-35">LIST OF EMPLOYEES {{ $type }}</span>
                                    <!-- ############  Blade  component employee-cad ###########################################################################################-->
                                    <!-- component register for register new employee-->
                                    <x-employee-cad :$type />


                        </div>
                    </div>
                </div>
                                                <!-- tratando variáveis do componentes employee-viewedit -->

                <div class="body">
                    <x-msgs :$msg />
                    <div class="row">
                        <div class="col s12">
                                <ul class="collapsible popout">
{{--                                    @php--}}
{{--//                                        extract($employees->items()[0],EXTR_OVERWRITE);--}}
{{--                                        dd($employees->items())--}}
{{--                                    @endphp--}}
                                    @foreach($employees as $employee)
                                        @php($count++)
                                    <!---#####################colapsable item ####################################################-->
                                    <li>
                                        <div class="collapsible-header green @php(altclass($count)) white-text"><i class="material-icons">person</i>{{$employee->name}}</div>
                                        <div class="collapsible-body">


                                                <x-employee-view-edit
                                                        :employee-id="$employee->id"
                                                        :employee-name="$employee->name"
                                                        :employee-phone="$employee->phone"
                                                        :employee-email="$employee->email"
                                                        :employee-address="$employee->address"
                                                        :employee-ref-name1="$employee->name_ref_one"
                                                        :employee-ref-name2="$employee->name_ref_two"
                                                        :employee-ref-phone1="$employee->phone_ref_one"
                                                        :employee-ref-phone2="$employee->phone_ref_two"
                                                        :employee-birth="$employee->birth"
                                                        :employee-document="$employee->document"
                                                        :employee-shift="$employee->shift"
                                                        :employee-restriction="$employee->restriction"
                                                        :employee-description="$employee->description"
                                                        :employee-username="$employee->username"
                                                        :employee-password="$employee->password"
                                                        :employee-status="$employee->status"
                                                        :employee-type="$employee->type"
                                                        :count="$count"
                                                        :type-url="$type"
                                                >
                                                </x-employee-view-edit>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>

                        </div>

                    </div>
                    <!---##################### row pagination ####################################################-->
                    <div class="row">

                        <div class="col s12 m12 valign-wrapper justify-content-center" >
                                {{ $employees->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


{{-- inclusção de scripts  no final no corpo--}}
@section('script-botton')
 @include('layouts.generic_js')
 <script>
     document.addEventListener('DOMContentLoaded',function () {
         let swlConfirmTrigger = document.querySelector("#SavedSwl")
             toastAlert.fire({
                 icon: "success",
                 title: swlConfirmTrigger.innerText
             });

     })

 </script>

@endsection


