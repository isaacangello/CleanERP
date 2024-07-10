@extends("layouts.main")
@section('title')
     <title>Customers - main - JJL System 2</title>
@endsection
{{--css links para o head--}}
@section('css-style')
{{--     <!-- Google Fonts -->--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">--}}
{{--    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">--}}

{{--    <!-- Bootstrap Core Css -->--}}
{{--    <link href="web/bootstrap/bootstrap.min.css" rel="stylesheet">--}}
{{--    <!-- Materialize Core Css -->--}}
{{--    <link href="{{asset("web/materialize/css/materialize.css")}}" rel="stylesheet">--}}

{{--    <!-- Waves Effect Css -->--}}
{{--    <link href="web/systheme/plugins/node-waves/waves.css" rel="stylesheet" />--}}

{{--    <!-- Animation Css -->--}}
{{--    <link href="{{asset("web/systheme/plugins/animate-css/animate.css")}}" rel="stylesheet" />--}}
{{--    <!-- Sweet Alert Css -->--}}
{{--    <link href="{{asset("web/systheme/plugins/sweetalert/sweetalert.css")}}" rel="stylesheet" />--}}


{{--    <!-- Custom Css -->--}}
{{--    <link href="{{asset("web/systheme/css/style.css")}}" rel="stylesheet">--}}

{{--    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->--}}
{{--    <link href="{{asset("web/systheme/css/themes/all-themes.css")}}" rel="stylesheet" />--}}
@include('layouts.generic_css')

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
                                    <x-customer-cad :$billings />


                        </div>
                    </div>
                </div>
                                                <!-- tratando variáveis do componentes customer-viewedit -->

                <div class="body">
                    <x-msgs :$msg />
                    <div class="row">
                        <div class="col s12">
                                <ul class="collapsible popout">
                                @foreach($customers as $customer)
                                    <!---#####################colapsable item ####################################################-->
                                    <li>
                                        @php
                                            $count++ ;
                                            if(isset($customer->justify_inactive)){$justify_inactive = $customer->justify_inactive;}else{$justify_inactive = "&nbsp;";}
                                        @endphp
                                          <div class="collapsible-header green @php(altclass($count)) white-text"><i class="material-icons">person</i>{{$customer->name}}</div>
                                            <div class="collapsible-body">

                                                    <x-customer-crud :customer-id="$customer->id"
                                                                     :customer-name="$customer->name"
                                                                     :customer-address="$customer->address"
                                                                     :customer-type="$customer->type"
                                                                     :customer-email="$customer->email"
                                                                     :customer-address-complement="$customer->complement"
                                                                     :customer-phone="$customer->phone"
                                                                     :customer-price-biweekly="$customer->price_biweekly"
                                                                     :customer-price-weekly="$customer->price_weekly"
                                                                     :customer-price-monthly="$customer->price_monthly"
                                                                     :customer-drive-licence="$customer->drive_licence"
                                                                     :customer-gate-code="$customer->gate_code"
                                                                     :customer-keys="$customer->key"
                                                                     :customer-more-girl="$customer->more_girl"
                                                                     :customer-note="$customer->note"
                                                                     :customer-other-services="$customer->other_services"
                                                                     :customer-house-description="$customer->house_description"
                                                                     :customer-justify-inactive="$justify_inactive"
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
    @include("layouts.generic_js")
    <script src="{{ asset('web/custom/customers/modal_cad.js') }}"></script>
    <script>
        $('#id-customer-billing').multiSelect()
    </script>
@endsection

