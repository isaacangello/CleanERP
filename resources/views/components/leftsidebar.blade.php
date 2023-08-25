<div>
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="img/users/user.png" width="48" height="48" alt="User"/>
            </div>
            <div class="info-container">
                <div class="name person-shadow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$userName}}</div>
                <div class="email person-shadow">{{$email}}</div>
                <div class="user-helper-dropdown">
                    <a href="#" id="buton-user-dropdown" data-target='dropdown-left-sidebar'><i class="material-icons white-text">keyboard_arrow_down</i></a>
                    <ul id="dropdown-left-sidebar" class='z-depth-4 scale-transition scale-out scale-in'>
                        <li><a href="javascript:void(0);" class="waves-effect"><i class="material-icons">person</i><span>Profile</span></a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="javascript:void(0);" class="waves-effect"><i class="material-icons">settings_applications</i><span>Config</span></a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="waves-effect" style="border:none"><i class="material-icons">input</i><span>Sign Out</span> </button>
                            </form>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- #User Info -->
        <!-- Main Menu -->
        <!--
            material icons
            cleaning_services

        -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="active">
                    <a href="{{route('home')}}">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="header">
                    <span>SERVICES</span>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">house</i>
                        <span>Residencial</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="javascript:void(0);">
                                <i class="material-icons" style="font-size: 20px;">today</i>
                                <span>Services today</span>
                            </a>
                            <a href="javascript:void(0);">
                                <i class="material-icons" style="font-size: 20px;">calendar_view_week</i>
                                <span>Services Week</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">factory</i>
                        <span>Comercial</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="javascript:void(0);">
                                <i class="material-icons" style="font-size: 20px;">today</i>
                                <span>Services today</span>
                            </a>
                            <a href="javascript:void(0);">
                                <i class="material-icons" style="font-size: 20px;">calendar_view_week</i>
                                <span>Services Week</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="header">
                    <span>REGISTER / VIEW</span>
                </li>
                <li>
                    <a href="{{route('customers')}}">
                        <i class="material-icons" style="font-size: 20px;">group_add</i>
                        <span>Customers</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);">
                        <i class="material-icons" style="font-size: 20px;">badge</i>
                        <span>Employees</span>
                    </a>
                </li>

                <li class="header">
                    <span>FINANCES</span>
                </li>
                <li>
                    <a href="javascript:void(0);">
                        <i class="material-icons">price_change</i>
                        <span>Home</span>
                    </a>
                </li>
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
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2023 <a href="javascript:void(0);">JJL - SYSTEM 2</a>.
            </div>
            <div class="version">
                <b>Version: </b> {{$systemVersion}}
            </div>
        </div>
        <!-- #Footer -->
    </aside>

</div>