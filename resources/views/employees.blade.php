@extends("layouts.main")
@section('title')
     <title>employees - main - JJL System 2</title>
@endsection
{{--css links para o head--}}
@section('css-style')
     <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
{{--    <link href="web/bootstrap/bootstrap.min.css" rel="stylesheet">--}}
    <!-- Materialize Core Css -->
    <link href="web/materialize/css/materialize.css" rel="stylesheet">

    <!-- Waves Effect Css -->
{{--    <link href="web/systheme/plugins/node-waves/waves.css" rel="stylesheet" />--}}

    <!-- Animation Css -->
    <link href="web/systheme/plugins/animate-css/animate.css" rel="stylesheet" />
    <!-- Sweet Alert Css -->
    <link href="web/systheme/plugins/sweetalert/sweetalert.css" rel="stylesheet" />


    <!-- Custom Css -->
    <link href="web/systheme/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="web/systheme/css/themes/all-themes.css" rel="stylesheet" />


{{--    <style>--}}
{{--        input.form-control {--}}
{{--            margin-bottom: 0!important;--}}
{{--            border-bottom: none!important;--}}
{{--        }--}}
{{--        textarea.form-control {--}}
{{--            margin-bottom: 0!important;--}}
{{--            border-bottom: none!important;--}}
{{--        }--}}
{{--        input.select-dropdown {--}}
{{--            margin-bottom: 0px!important;--}}
{{--            border-bottom: none!important;--}}
{{--        }--}}
{{--        .red:hover{--}}
{{--            background-color: #ef9a9a!important;--}}
{{--        }--}}

{{--    </style>--}}
@endsection
{{--
personal information
name
address
data de nascimento
email
phone
checkbox -> part time -> fulltime

document information

document
radiobox residencial -> comercial
"Name reference first"  phone
"Name reference second" phone
additional information
radio buttons ->active ->inactive
employee notes
--}}
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
            function altclass($nun){
                if ($nun % 2 > 0 ){
                    echo "darken-3";
                }else{
                    echo "darken-4";
                }
            }
@endphp

<div class="container-fluid">
    <div class="block-header">
        <h2>
            <small>EMPLOYEES REGISTER AND VIEW</small>
        </h2>
    </div>
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col s12 m12">
            <div class="card">
                <div class="header" style="padding-bottom: 0px;">
                    <div class="row">
                        <div class="col s12 m12">
                            <button class="btn waves-effect waves-classic waves-light  btn-small modal-trigger"  href="#new-employee"  >New Employee</button>
                            <span id="list-of-employees" class="m-l-35">LIST OF EMPLOYEES</span>
                                    <!-- ############  Blade  component employee-cad ###########################################################################################-->
                                    <!-- component register for register new employee-->
                                    <x-employee-cad />


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
                                                >
                                                </x-employee-view-edit>
                                        </div>
                                    </li>
                                    @endforeach


                                    <!---#####################colapsable item ####################################################-->
{{--                                    <li>--}}
{{--                                          <div class="collapsible-header green darken-4 white-text"><i class="material-icons">person</i>Jane Doe Rego Pinto </div>--}}
{{--                                            <div class="collapsible-body">--}}
{{--                                              Lorem ipsum dolor sit amet.--}}
{{--                                            </div> <!-- end collapsible body -->--}}
{{--                                    </li>--}}
                                </ul>

                        </div>

                    </div>
                    <!---##################### row pagination ####################################################-->
                    <div class="row">

                        <div class="col s12 m12 valign-wrapper justify-content-center" >
{{--                             <ul class="pagination center valign-wrapper align-center" style="margin: 0 auto">--}}
{{--                                <li class="disabled valign-wrapper"><a href="#!" ><i class="material-icons ">chevron_left</i></a></li>--}}
{{--                                <li class="active  valign-wrapper"><a href="#!" class="green darken-3 white-text">1</a></li>--}}
{{--                                <li class=" valign-wrapper"><a href="#" class="waves-effect waves-teal">2</a></li>--}}
{{--                                <li class="valign-wrapper" ><a href="#!" class="waves-effect waves-teal ">3</a></li>--}}
{{--                                <li class="valign-wrapper" ><a href="#!" class="waves-effect waves-teal ">4</a></li>--}}
{{--                                <li class="valign-wrapper" ><a href="#!" class="waves-effect waves-teal ">5</a></li>--}}
{{--                                <li class=" valign-wrapper" ><a href="#!" ><i class="material-icons waves-effect waves-teal">chevron_right</i></a></li>--}}
{{--                              </ul>--}}
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
    <!-- Jquery Core Js -->
{{--    <script src="web/systheme/plugins/jquery/jquery.min.js"></script>--}}
    <script src="{{asset('web/jquery/jquery-3.7.0.min.js')}}"></script>
    <!-- Axios js-->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Bootstrap Core Js -->
{{--    <script src="web/bootstrap/bootstrap.min.js"></script>--}}
    <script src="{{ asset('web/materialize/js/materialize.min.js') }}"></script>

    <!-- Select Plugin Js -->
{{--    <script src="web/systheme/plugins/bootstrap-select/js/bootstrap-select.js"></script>--}}

    <!-- Slimscroll Plugin Js -->
    <script src="{{asset('web/systheme/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('web/systheme/plugins/node-waves/waves.js')}}"></script>
    <!-- Jquery Validation Plugin Css -->
    <script src="{{ asset('web/systheme/plugins/jquery-validation/jquery.validate.js') }}"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="{{asset('web/systheme/plugins/jquery-steps/jquery.steps.js')}}"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="{{asset('web/systheme/plugins/sweetalert/sweetalert.min.js')}}"></script>
      <!-- Input Mask Plugin Js -->
    <script src="{{ asset('web/systheme/plugins/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('web/systheme/js/admin.js') }}"></script>
{{--    <script src="web/systheme/js/pages/tables/jquery-datatable.js"></script>--}}
    <script src="{{ asset('web/systheme/js/pages/index.js') }}"></script>
<script src="{{ asset('web/systheme/js/pages/forms/form-validation.js') }}"></script>
    <!-- Demo Js -->
    <script src="{{asset('web/systheme/js/demo.js')}}"></script>
    <script src="{{ asset('web/systheme/js/systheme.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('web/custom/field_change.js') }}"></script>
@endsection


