@props([
    'disabledResidential' => false,
    'disabledCommercial' => false,
    'disabledFinance' => false,
])
<!-- start sidebar -->
<div
        id="leftSideBar"
        x-ref=leftSideBar"
        x-init="$nextTick(() => { sidebarInit() })"
        x-show="leftSideBar"
        x-transition:enter="animate__animated animate__slideInLeft"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="animate__animated animate__slideOutLeft"
        x-transition:leave-end="opacity-0"
        x-transition:leave-start="opacity-100"
        class="md:w-64 fixed  left-0 z-30 md:z-20  md:h-screen md:shadow-xl  md:block  bg-white border-r border-gray-300 p-6 animated faster transition-all sl  pb-4  hover:overflow-auto  scroll-"
>


    <!-- sidebar content -->
    <div class="flex flex-col pb-10">

        <!-- sidebar toggle -->
        <div class="text-right block ">
            <button id="sideBarHideBtn">
                <i class="fad fa-times-circle"></i>
            </button>
        </div>

        <x-cleopatra.title-link href="{{ route('home') }}" title="home" />
        <!-- end sidebar toggle -->
        <x-cleopatra.left-side-bar-links title="Residential">

            <x-cleopatra.menu-link   href="{{!$disabledResidential?route('week'):'JavaScript:void(0);' }}"   icon="fa-calendar-week" text="Services Week" />
            <x-cleopatra.menu-link   href="{{!$disabledResidential? route('week.search'):'JavaScript:void(0);' }}"   icon="fa-magnifying-glass" text="Search" />
            <x-cleopatra.menu-link   href="{{!$disabledResidential?route('customers.index'):'JavaScript:void(0);'}}"   icon="fa-user" text="Customers Reg." />
            <x-cleopatra.menu-link   href="{{!$disabledResidential?route('employees.index'):'JavaScript:void(0);'}}"    icon="fa-address-card" text="Employees Reg." />

        </x-cleopatra.left-side-bar-links>
        <x-cleopatra.left-side-bar-links title="Commercial" >

            <x-cleopatra.menu-link   href="{{!$disabledCommercial?route('commercial.schedule'):'JavaScript:void(0);'}}"   icon="fa-calendar-week" text="Services Schedule"  />
            <x-cleopatra.menu-link  href="{{ !$disabledCommercial?route('commercial.schedule.search'):'JavaScript:void(0);' }}"   icon="fa-magnifying-glass" text="Search" />
            <x-cleopatra.menu-link  href="{{!$disabledCommercial?route('customers.index'):'JavaScript:void(0);'}}"   icon="fa-user" text="Customers Registration" />
            <x-cleopatra.menu-link  href="{{!$disabledCommercial?route('employees.index'):'JavaScript:void(0);'}}"   icon="fa-address-card" text="Employees Reg." />

        </x-cleopatra.left-side-bar-links>

        <x-cleopatra.left-side-bar-links title="finance">

            <x-cleopatra.menu-link  href="{{ !$disabledFinance? route('finances'):'JavaScript:void(0);'}}"   icon="fa-money-bill-wave" text="Home" />
            <x-cleopatra.menu-link  href="{{ !$disabledFinance? route('week.search'):'JavaScript:void(0);' }}"   icon="fa-magnifying-glass" text="Search" />
            <x-cleopatra.menu-link  href="{{ !$disabledFinance? route('finances.billings'):'JavaScript:void(0);' }}"   icon="fa-file-invoice-dollar" text="Billings" />
            <x-cleopatra.menu-link  href="{{ !$disabledFinance? route('finances.payments'):'JavaScript:void(0);' }}"   icon="fa-credit-card" text="Payments" />

        </x-cleopatra.left-side-bar-links>
        <br><br> <br><br>
    </div>
    <!-- end sidebar content -->

</div>
<!-- end sidbar -->