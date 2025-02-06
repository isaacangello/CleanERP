<!-- start sidebar -->
<div
        id="leftSideBar"
        x-ref=leftSideBar"
        x-init="$nextTick(() => { sidebarInit() })"
        class="md:w-64 fixed  left-0 z-30 md:z-20  md:h-screen md:shadow-xl  md:block  bg-white border-r border-gray-300 p-6 animated faster"
>


    <!-- sidebar content -->
    <div class="flex flex-col">

        <!-- sidebar toggle -->
        <div class="text-right hidden md:block mb-4">
            <button id="sideBarHideBtn">
                <i class="fad fa-times-circle"></i>
            </button>
        </div>
        <!-- end sidebar toggle -->
        <div x-data="{ expanded: true }">
            <p class="uppercase text-xs text-gray-600 mb-2 tracking-wider">
                <a @click="expanded = ! expanded" class="hover:text-gray-900 transition ease-in-out duration-500 cursor-pointer" >
                    homes
                </a>
            </p>
            <div class="grid grid-cols-1"
                 x-show="expanded"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 transform origin-top scale-90"
                    x-transition:enter-end="opacity-100 transform  scale-100"
                    x-transition:leave="transition ease-out duration-500"
                    x-transition:leave-start="opacity-100 transform origin-bottom scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90"
            >
                <!-- link -->
                <a href="./index.html" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                    <i class="fad fa-chart-pie text-xs mr-2"></i>
                    Analytics dashboard
                </a>
                <!-- end link -->

                <!-- link -->
                <a href="./index-1.html" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                    <i class="fad fa-shopping-cart text-xs mr-2"></i>
                    ecommerce dashboard
                </a>
                <!-- end link -->
            </div>
        </div>
        <div x-data="{ expanded: true }">
            <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider">
                <a @click="expanded = ! expanded" class="hover:text-gray-900 transition ease-in-out duration-500 cursor-pointer">
                    apps
                </a>
            </p>
            <div class="grid grid-cols-1"
                 x-show="expanded"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 transform scale-y-0"
                 x-transition:enter-end="opacity-100 transform scale-y-100"
                 x-transition:leave="transition ease-out duration-500"
                 x-transition:leave-start="opacity-100 transform scale-y-100"
                 x-transition:leave-end="opacity-0 transform scale-y-0"
            >


        <!-- link -->
                <a href="./email.html" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                    <i class="fad fa-envelope-open-text text-xs mr-2"></i>
                    email
                </a>
                <!-- end link -->

                <!-- link -->
                <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                    <i class="fad fa-comments text-xs mr-2"></i>
                    chat
                </a>
                <!-- end link -->

                <!-- link -->
                <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                    <i class="fad fa-shield-check text-xs mr-2"></i>
                    todo
                </a>
                <!-- end link -->

                <!-- link -->
                <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                    <i class="fad fa-calendar-edit text-xs mr-2"></i>
                    calendar
                </a>
                <!-- end link -->

                <!-- link -->
                <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                    <i class="fad fa-file-invoice-dollar text-xs mr-2"></i>
                    invoice
                </a>
                <!-- end link -->

                <!-- link -->
                <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                    <i class="fad fa-folder-open text-xs mr-2"></i>
                    file manager
                </a>
                <!-- end link -->
            </div>
        </div>

        <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider">UI Elements</p>

        <!-- link -->
        <a href="./typography.html" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-text text-xs mr-2"></i>
            typography
        </a>
        <!-- end link -->

        <!-- link -->
        <a href="./alert.html" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-whistle text-xs mr-2"></i>
            alerts
        </a>
        <!-- end link -->


        <!-- link -->
        <a href="./buttons.html" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-cricket text-xs mr-2"></i>
            buttons
        </a>
        <!-- end link -->

        <!-- link -->
        <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-box-open text-xs mr-2"></i>
            Content
        </a>
        <!-- end link -->

        <!-- link -->
        <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-swatchbook text-xs mr-2"></i>
            colors
        </a>
        <!-- end link -->

        <!-- link -->
        <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-atom-alt text-xs mr-2"></i>
            icons
        </a>
        <!-- end link -->

        <!-- link -->
        <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-club text-xs mr-2"></i>
            card
        </a>
        <!-- end link -->

        <!-- link -->
        <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-cheese-swiss text-xs mr-2"></i>
            Widgets
        </a>
        <!-- end link -->

        <!-- link -->
        <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-computer-classic text-xs mr-2"></i>
            Components
        </a>
        <!-- end link -->



    </div>
    <!-- end sidebar content -->

</div>
<!-- end sidbar -->