<div id="componet-mobile-left-sidebar">
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
    <ul id="slide-out" class="sidenav ">
    <li>
        <div>
                <div class="user-info" style="background: url('img/898_300X135.jpg') no-repeat no-repeat;">
                    <div class="image">
            <div class="image">
                <img src="{{$userImg}}" width="48" height="48" alt="User"/>
            </div>
            <div class="info-container">
                <div class="name person-shadow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$userName}}</div>
                <div class="email person-shadow">{{$email}}</div>
                        <div class="user-helper-dropdown">
                            <a href="javascript:void(0);" id="" data-target='dropdown-left-sidebar'><i class="material-icons white-text">keyboard_arrow_down</i></a>
                            <ul id="dropdown-left-sidebar1" class='z-depth-4 scale-transition scale-out scale-in'>
                                <li><a href="javascript:void(0);" class="waves-effect"><i class="material-icons">person</i><span>Profile</span></a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="javascript:void(0);" class="waves-effect"><i class="material-icons">settings_applications</i><span>Config</span></a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('index') }}" class="waves-effect"><i class="material-icons">input</i><span>Sign Out</span> </a></li>
                            </ul>
                        </div>

                    </div>
                </div>
        </div>
    </li>
                <li class="header">MAIN NAVIGATION</li>
                <li class="active sidenav-item" style="background-color: #FFFFFF;">
                    <a href="{{route('home')}}" class="waves-effect">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="header">
                    <span>SERVICES</span>
                </li>
                <li class="sidenav-item">
                    <a href="javascript:void(0);" class="menu-toggle waves-effect" >
                        <i class="material-icons">house</i>
                        <span class="">
                        Residencial
                        </span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="javascript:void(0);" >
                                <i class="material-icons">today</i>
                                <span class="waves-effect">Services today</span>
                            </a>
                            <a href="javascript:void(0);" class="waves-effect">
                                <i class="material-icons" style="font-size: 20px;">calendar_view_week</i>
                                <span>Services Week</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidenav-item">
                    <a href="javascript:void(0);" class="menu-toggle waves-effect">
                        <i class="material-icons">factory</i>
                        <span>Comercial</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="javascript:void(0);" class="waves-effect">
                                <i class="material-icons" style="font-size: 20px;">today</i>
                                <span>Services today</span>
                            </a>
                            <a href="javascript:void(0);" class="waves-effect">
                                <i class="material-icons" style="font-size: 20px;">calendar_view_week</i>
                                <span>Services Week</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="header">
                    <span>REGISTER / VIEW</span>
                </li>
                <li class="sidenav-item">
                    <a href="{{route('customers')}}" class="waves-effect">
                        <i class="material-icons" style="font-size: 20px;">group_add</i>
                        <span>Customers</span>
                    </a>
                </li>
                <li class="sidenav-item">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="material-icons" style="font-size: 20px;">badge</i>
                        <span>Employees</span>
                    </a>
                </li>

                <li class="header">
                    <span>FINANCES</span>
                </li>
                <li class="sidenav-item">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="material-icons">price_change</i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="header">
                    <span>AGENDA CO.</span>
                </li>
                <li class="sidenav-item">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="material-icons">free_cancellation</i>
                        <span>Tasks</span>
                    </a>
                </li>
                <li class="center-align sidenav-item">

                    &copy; 2023 <span class="green-text text-darken-3">JJL - SYSTEM 2</span>
                    <br style="">
                    <b>Version: </b> {{$systemVersion}}
                </li>

  </ul>
</div>
