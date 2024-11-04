
    <ul class="list">
        <li class="header">MAIN NAVIGATION</li>
        <li >
            <a href="{{route('home')}}" class="waves-effect waves-teal">
                <i class="material-icons">home</i>
                <span>Home</span>
            </a>
        </li>
        <li class="header">
            <span>SERVICES</span>
        </li>
        <li>
            <a href="javascript:void(0);" class="menu-toggle waves-effect waves-teal">
                <i class="material-icons">house</i>
                <span>Residential</span>
            </a>
            <ul class="ml-menu">
                <li>
{{--                    <a href="javascript:void(0);">--}}
{{--                        <i class="material-icons" style="font-size: 20px;">today</i>--}}
{{--                        <span>Services today</span>--}}
{{--                    </a>--}}
                    <a href="{{ route('week') }}" class="waves-effect waves-teal">
                        <i class="material-icons" style="font-size: 20px;">calendar_view_week</i>
                        <span>Services Week</span>
                    </a>
                    <a href="{{ route('week.search') }}" class="waves-effect waves-teal">
                        <i class="material-icons" style="font-size: 20px;">manage_search</i>
                        <span>Search</span>
                    </a>
                    <a href="{{route('customers.index')}}" class="waves-effect waves-teal">
                        <i class="material-icons" style="font-size: 20px;">group_add</i>
                        <span>Customers Registration</span>
                    </a>
                    <a href="{{route('employees.index')}}" class="waves-effect waves-teal">
                        <i class="material-icons" style="font-size: 20px;">badge</i>
                        <span>Employees Registration</span>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="menu-toggle waves-effect waves-teal">
                <i class="material-icons">factory</i>
                <span>Commercial</span>
            </a>

            <ul class="ml-menu">
                <li>
{{--                    <a href="javascript:void(0);">--}}
{{--                        <i class="material-icons" style="font-size: 20px;">today</i>--}}
{{--                        <span>Services today</span>--}}
{{--                    </a>--}}
                    <a href="{{route('commercial.schedule')}}" class="waves-effect waves-teal">
                        <i class="material-icons" style="font-size: 20px;">calendar_view_week</i>
                        <span>Services Schedule</span>
                    </a>
                    <a href="{{route('customers.index')}}/filter/commercial" class="waves-effect waves-teal">
                        <i class="material-icons" style="font-size: 20px;">group_add</i>
                        <span>Customers Registration</span>
                    </a>
                    <a href="{{route('employees.index')}}/filter/commercial" class="waves-effect waves-teal">
                        <i class="material-icons" style="font-size: 20px;">badge</i>
                        <span>Employees Registration</span>
                    </a>
                </li>
            </ul>
        </li>
<!--
        <li class="header">
            <span>REGISTER / VIEW</span>
        </li>
        <li>
            <a href="{{route('customers.index', ['page' => 1])}}">
                <i class="material-icons" style="font-size: 20px;">group_add</i>
                <span>Customers</span>
            </a>
        </li>
        <li>
            <a href="{{route('employees.index')}}">
                <i class="material-icons" style="font-size: 20px;">badge</i>
                <span>Employees</span>
            </a>
        </li>
-->
        <li>
            <a href="javascript:void(0);" class="menu-toggle waves-effect waves-teal">
                <i class="material-icons">point_of_sale</i>
                <span>Finances</span>
            </a>

            <ul class="ml-menu">
                <li>
                    <a href="{{ route('finances') }}" class="waves-effect waves-teal">
                        <i class="material-icons" style="font-size: 20px;">price_change</i>
                        <span>Home</span>
                    </a>
                    <a href="{{ route('finances') }}/billings" class="waves-effect waves-teal">
                        <i class="material-icons" style="font-size: 20px;">payments</i>
                        <span>Billings Registration</span>
                    </a>
                    <a href="{{ route('finances') }}/payments" class="waves-effect waves-teal">
                        <i class="material-icons" style="font-size: 20px;">add_card</i>
                        <span>Payments Registration</span>
                    </a>
                </li>
            </ul>
        </li>
{{--        <li class="header">--}}
{{--            <span>FINANCES</span>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--        </li>--}}
        <li class="header">
            <span>AGENDA CO.</span>
        </li>
        <li>
            <a href="javascript:void(0);">
                <i class="material-icons">free_cancellation</i>
                <span>Tasks</span>
            </a>
        </li>
    </ul>
