@extends("layouts.main")
@section('title')
     <title>Customers - main - JJL System 2</title>
@endsection
{{--css links para o head--}}
@section('css-style')
     <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
{{--    <link href="web-resources/bootstrap/bootstrap.min.css" rel="stylesheet">--}}
    <!-- Materialize Core Css -->
    <link href="web-resources/materialize/css/materialize.css" rel="stylesheet">

    <!-- Waves Effect Css -->
{{--    <link href="web-resources/systheme/plugins/node-waves/waves.css" rel="stylesheet" />--}}

    <!-- Animation Css -->
    <link href="web-resources/systheme/plugins/animate-css/animate.css" rel="stylesheet" />
    <!-- Sweet Alert Css -->
    <link href="web-resources/systheme/plugins/sweetalert/sweetalert.css" rel="stylesheet" />


    <!-- Custom Css -->
    <link href="web-resources/systheme/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="web-resources/systheme/css/themes/all-themes.css" rel="stylesheet" />


    <style>
        input.form-control {
            margin-bottom: 0!important;
            border-bottom: none!important;
        }
        textarea.form-control {
            margin-bottom: 0!important;
            border-bottom: none!important;
        }
        input.select-dropdown {
            margin-bottom: 0!important;
            border-bottom: none!important;
        }
        .red:hover{
            background-color: #ef9a9a!important;
        }

    </style>
@endsection

@section('content')
@php
    if (!isset($customerName)){$customerName='Jhon Doe Pinto Rego';$customerNameCad='&nbsp;';}
    if (!isset($customerType)){$customerType='RESIDENCIAL';$customerTypeCad='&nbsp;';}
    if (!isset($customerEmail)){$customerEmail='jhondoe@email.com';$customerEmailCad='&nbsp;';}
    if (!isset($customerAddress)){$customerAddress='Meu endereço';$customerAddressCad='&nbsp;';}
    if (!isset($customerAddressComplement)){$customerAddressComplement='Complemento';$customerAddressComplementCad="&nbsp;";}
    if (!isset($customerPhone)){$customerPhone='561-124-555';$customerPhoneCad ='&nbsp;';}
    if (!isset($customerPriceWeekly )){$customerPriceWeekly ='200';$customerPriceWeeklyCad='&nbsp;';}
    if (!isset($customerPriceBiweekly )){$customerPriceBiweekly ='200';$customerPriceBiweeklyCad='&nbsp;';}
    if (!isset($customerPriceMonthly)){$customerPriceMonthly='200';$customerPriceMonthlyCad='&nbsp;';}
    if (!isset($costumerOtherServices)){$costumerOtherServices='Lorem ipsun and Busei ipsun';$costumerOtherServicesCad='&nbsp;';}
    if (!isset($customerStatus)){$customerStatus='ACTIVE';$customerStatusCad='&nbsp;';}
    if (!isset($customerJustifyInactive)){$customerJustifyInactive='está inativo por que eu quiz e pronto, mandei !!!!!';$customerJustifyInactiveCad='&nbsp;';}
    if (!isset($customerKeys)){$customerKeys='checked';$customerKeysCad="checked";}
    if (!isset($customerDriveLicence )){$customerDriveLicence ='checked';$customerDriveLicenceCad='checked';}
    if (!isset($customerGateCode )){$customerGateCode ='checked';$customerGateCodeCad='checked';}
    if (!isset($customerPasskey)){$customerPasskey='checked';$customerPasskeyCad='checked';}
    if (!isset($customerMoregirl)){$customerMoregirl='checked';$customerMoregirlCad='checked';}
    if (!isset($customerHouseDescription)){$customerHouseDescription='Lorem ipsun';$customerHouseDescriptionCad='&nbsp;';}
    if (!isset($customerNote )){$customerNote ='Lorem ipsun and Busei ipsun';$customerNoteCad='&nbsp;';}
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
            <small>CUSTOMERS REGISTER AND VIEW</small>
        </h2>
    </div>
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col s12 m12">
            <div class="card">
                <div class="header" style="padding-bottom: 0px;">
                    <div class="row">
                        <div class="col s12 m12">
                            <button class="btn waves-effect waves-classic waves-light  btn-small modal-trigger"  href="#new-customer"  >New Customer</button>
                            <span id="list-of-customer" class="m-l-35">LIST OF CUSTOMERS</span>
                                    <!-- ############  Blade  component customer-cad ###########################################################################################-->
                                    <!-- component register for register new customer-->
                                    <x-customer-cad />


                        </div>
                    </div>
                </div>
                                                <!-- tratando variáveis do componentes customer-viewedit -->

                <div class="body">
                    <div class="row">
                        <div class="col s12">
                                <ul class="collapsible popout">
                                @foreach($customers as $customer)
                                    <!---#####################colapsable item ####################################################-->
                                    <li>
                                        @php($count++)
                                          <div class="collapsible-header green @php(altclass($count)) white-text"><i class="material-icons">person</i>{{$customer->name}}</div>
                                            <div class="collapsible-body">

                                                    <x-customer-crud :customer-name="$customer->name"
                                                                     :customer-address="$customer->address"
                                                                     :customer-type="$customer->type"
                                                                     :customer-email="$customer->email"
                                                                     :customer-address-complement="$customer->complement"
                                                                     :customer-phone="$customer->phone"
                                                                     :customer-price-biweekly="$customer->price_biweekly"
                                                                     :customer-price-weekly="$customer->price_weekly"
                                                                     :customer-price-monthly="$customer->price_monthly"
                                                                     customer-drive-licence="$customer->"
                                                                     :customer-gate-code="$customer->gate_code"
                                                                     :customer-keys="$customer->key"
                                                                     :customer-moregirl="false"
                                                                     :customer-note="$customer->house_description"
                                                                     :customer-other-services="$customer->house_description"
                                                                     :customer-house-description="$customer->house_description"
                                                                     :customer-justify-inactive="$customer->house_description"
                                                                     :count="$count"
                                                    >


                                                    </x-customer-crud>

                                            </div>
                                    </li>
                                @endforeach

                                  </ul>

                        </div>

                    </div>
                    <!---##################### row pagination ####################################################-->
                    <div class="row">
                        <div class="col s1 m2"></div>
                        <div class="col s10 m8 valign-wrapper center-align" style="align-content: center;align-items: center;justify-content: center">
                            <!--
                             <ul class="pagination center valign-wrapper align-center" style="margin: 0 auto">

                                 <li class="disabled valign-wrapper"><a href="#!" ><i class="material-icons ">chevron_left</i></a></li>
                                <li class="active  valign-wrapper"><a href="#!" class="green darken-3 white-text">1</a></li>
                                <li class=" valign-wrapper"><a href="#" class="waves-effect waves-teal">2</a></li>
                                <li class="valign-wrapper" ><a href="#!" class="waves-effect waves-teal ">3</a></li>
                                <li class="valign-wrapper" ><a href="#!" class="waves-effect waves-teal ">4</a></li>
                                <li class="valign-wrapper" ><a href="#!" class="waves-effect waves-teal ">5</a></li>
                                <li class=" valign-wrapper" ><a href="#!" ><i class="material-icons waves-effect waves-teal">chevron_right</i></a></li>
                              </ul>
                              -->
                            {{ $customers->links() }}
                        </div>
                        <div class="col s1 m2"></div>


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
{{--    <script src="web-resources/systheme/plugins/jquery/jquery.min.js"></script>--}}
    <script src="{{asset('web-resources/jquery/jquery-3.7.0.min.js')}}"></script>
    <!-- Bootstrap Core Js -->
{{--    <script src="web-resources/bootstrap/bootstrap.min.js"></script>--}}
    <script src="{{ asset('web-resources/materialize/js/materialize.min.js') }}"></script>

    <!-- Select Plugin Js -->
{{--    <script src="web-resources/systheme/plugins/bootstrap-select/js/bootstrap-select.js"></script>--}}

    <!-- Slimscroll Plugin Js -->
    <script src="{{asset('web-resources/systheme/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('web-resources/systheme/plugins/node-waves/waves.js')}}"></script>
    <!-- Jquery Validation Plugin Css -->
    <script src="{{ asset('web-resources/systheme/plugins/jquery-validation/jquery.validate.js') }}"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="{{asset('web-resources/systheme/plugins/jquery-steps/jquery.steps.js')}}"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="{{asset('web-resources/systheme/plugins/sweetalert/sweetalert.min.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('web-resources/systheme/js/admin.js') }}"></script>
{{--    <script src="web-resources/systheme/js/pages/tables/jquery-datatable.js"></script>--}}
    <script src="{{ asset('web-resources/systheme/js/pages/index.js') }}"></script>
<script src="{{ asset('web-resources/systheme/js/pages/forms/form-validation.js') }}"></script>
    <!-- Demo Js -->
    <script src="{{asset('web-resources/systheme/js/demo.js')}}"></script>
    <script src="{{ asset('web-resources/systheme/js/systheme.js') }}"></script>
@endsection

