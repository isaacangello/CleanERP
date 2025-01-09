<div id="component-mobile-left-sidebar">
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
    <ul id="slide-out" class="sidenav">
    <li>
        <div class="user-info" id="userInfoMobile" style="background: url('/img/898_300X135.jpg') no-repeat no-repeat;">
            <div class="image">
                <img src="{{$userImg}}" width="48" height="48" alt="User"/>
            </div>
            <div class="info-container" style="position:relative;top:0">
                <div class="name person-shadow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$userName}}</div>
                <div class="email person-shadow">{{$email}}</div>
            </div>
        </div>
    </li>
    <li>
            @include('components.menu-links')
    </li>

    <li class="header">
        <span>configs</span>
    </li>
    <li class="sidenav-item">
        <a href="{{ route('profile.edit') }}" class="px-2 lg:py-1.5 py-2 w-full flex justify-start content-center rounded-md transition-colors  text-gray-800 hover:bg-gray-50 focus-visible:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
            <i class="material-icons" style="font-size: 20px;position: relative;">person</i><span>Profile</span>
        </a>
        <a href="{{route('config')}}" class="px-2 lg:py-1.5 py-2 w-full flex justify-start content-center rounded-md transition-colors text-left text-gray-800 hover:bg-gray-50 focus-visible:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
            <i class="material-icons" style="font-size: 20px;position: relative;">settings_applications</i><span>Config</span>
        </a>
        <form action="{{ route('logout') }}" method="post" >
            @csrf
            <a type="submit" class="px-2 lg:py-1.5 py-2 w-full flex justify-start content-center rounded-md transition-colors text-left text-gray-800 hover:bg-gray-50 focus-visible:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                <i class="material-icons" style="font-size: 20px;position: relative;">input</i><span>Sign Out</span>
            </a>
        </form>
    </li>


    <li class="center-align sidenav-item">
    &copy; 2023 <span class="green-text text-darken-3">JJL - SYSTEM 2</span><b>Version: </b> {{$systemVersion}}

    </li>

  </ul>
</div>
