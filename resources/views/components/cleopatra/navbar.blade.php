<!-- start navbar -->
<div    id="navBar"
        x-ref="navBar"
        class="flex flex-row w-full justify-between items-center p-6 bg-white border-b border-gray-300 md:fixed md:w-full md:top-0 md:z-20"
>

    <!-- logo -->
    <div class="flex flex-row items-center flex-none w-56">
        <button @click="toggleLeftSideBar()" id="sliderBtn" class="flex-none block pr-2  text-right text-gray-900">
            <i class="fad fa-list-ul"></i>
        </button>
        <img src="{{asset('img/android-chrome-256x256.png')}}" class="flex-none w-10">
        <strong class="flex-1 ml-1 capitalize">JJL System</strong>

    </div>
    <!-- end logo -->

    <!-- navbar content toggle -->
    <button id="navbarToggle" class="right-0  block  md:hidden ">
        <i class="fad fa-chevron-double-down"></i>
    </button>
    <!-- end navbar content toggle -->

    <!-- navbar content -->
    <div id="navbar" class="  w-full hidden md:flex   items-center justify-between   animated  md:top-0  md:left-0   md:border-gray-200  md:bg-white md:flex-row md:items-center">
        <!-- left -->
        <div class="text-gray-600  hidden  md:w-auto md:hidden  md:flex-row  ">
            <a class="mr-2 transition duration-500 ease-in-out hover:text-gray-900" href="#" title="email"><i class="fad fa-envelope-open-text"></i></a>
            <a class="mr-2 transition duration-500 ease-in-out hover:text-gray-900" href="#" title="email"><i class="fad fa-comments-alt"></i></a>
            <a class="mr-2 transition duration-500 ease-in-out hover:text-gray-900" href="#" title="email"><i class="fad fa-check-circle"></i></a>
            <a class="mr-2 transition duration-500 ease-in-out hover:text-gray-900" href="#" title="email"><i class="fad fa-calendar-exclamation"></i></a>
        </div>
        <div>&nbsp;</div>
        <!-- end left -->

        <!-- right -->
        <div class="flex flex-row-reverse items-center">

            <!-- user -->
            <div class="relative dropdown md:static items-center">

                <button @click="profileDropDown = ! profileDropDown"  class="flex flex-wrap items-center menu-btn focus:outline-none focus:shadow-outline">
                    <div class="w-8 h-8 overflow-hidden rounded-full">
                        <img class="object-cover w-full h-full" src="{{ asset('/img/user.svg') }}" alt="">
                    </div>

                    <div class="flex ml-2 capitalize ">
                        <h1 class="p-0 m-0 text-sm font-semibold leading-none text-gray-800">{{ Auth::user()->name??'moeSaid' }}</h1>

                        <i   class="ml-2 text-xs leading-none fad fa-chevron-down"></i>
                    </div>
                </button>

                <button class="fixed top-0 left-0 z-10 hidden w-full h-full menu-overflow"></button>

                <div
                        x-cloak
                        style="display: none !important;"
                        x-show="profileDropDown"
                        class="absolute right-1 z-20  w-full py-2 mt-10  text-gray-500 bg-white rounded shadow-md menu md:mt-10  md:w-64  animated faster"
                >

                    <!-- item -->
                    <a   href="{{ route('profile.edit') }}"  class="block px-4 py-2 text-sm font-medium tracking-wide capitalize transition-all duration-300 ease-in-out bg-white hover:bg-gray-200 hover:text-gray-900" href="#">
                        <i class="mr-1 text-xs fad fa-user-edit"></i>
                        edit my profile
                    </a>
                    <!-- end item -->

                    <!-- item -->
                    <a class="block px-4 py-2 text-sm font-medium tracking-wide capitalize transition-all duration-300 ease-in-out bg-white hover:bg-gray-200 hover:text-gray-900" href="#">
                        <i class="mr-1 text-xs fad fa-inbox-in"></i>
                        my inbox
                    </a>
                    <!-- end item -->

                    <!-- item -->
                    <a class="block px-4 py-2 text-sm font-medium tracking-wide capitalize transition-all duration-300 ease-in-out bg-white hover:bg-gray-200 hover:text-gray-900" href="#">
                        <i class="mr-1 text-xs fad fa-badge-check"></i>
                        tasks
                    </a>
                    <!-- end item -->

                    <!-- item -->
                    <a class="block px-4 py-2 text-sm font-medium tracking-wide capitalize transition-all duration-300 ease-in-out bg-white hover:bg-gray-200 hover:text-gray-900" href="#">
                        <i class="mr-1 text-xs fad fa-comment-alt-dots"></i>
                        chats
                    </a>
                    <!-- end item -->

                    <hr>

                    <!-- item -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                    <button class="block px-4 py-2 text-sm font-medium tracking-wide capitalize transition-all duration-300 ease-in-out bg-white hover:bg-gray-200 hover:text-gray-900" >
                        <i class="mr-1 text-xs fad fa-user-times"></i>
                        log out
                    </button>
                    </form>
                    <!-- end item -->

                </div>
            </div>
            <!-- end user -->

            <!-- notifcation -->
            <div class="relative mr-5 dropdown md:static">

                <button @click="notifications = !notifications" class="p-0 m-0 text-gray-500 transition-all duration-300 ease-in-out menu-btn hover:text-gray-900 focus:text-gray-900 focus:outline-none">
                    <i class="fad fa-bells"></i>
                </button>

                <button class="fixed top-0 left-0 z-10 hidden w-full h-full menu-overflow"></button>

                <div
                        x-cloak
                        style="display: none !important;"
                        x-show="notifications"
                        class="absolute right-0  z-20  py-2 mt-10 bg-white rounded shadow-md menu  w-84 md:right-44  md:min-w-64 md:mt-10  animated faster"

                >
                    <!-- top -->
                    <div class="flex flex-row items-center justify-between px-4 py-2 text-sm font-semibold capitalize">
                        <h1>notifications</h1>
                        <div class="px-1 text-xs text-teal-500 bg-teal-100 border border-teal-200 rounded">
                            <strong>5</strong>
                        </div>
                    </div>
                    <hr>
                    <!-- end top -->
                    <!-- body -->
                    <!-- item -->
                    <a class="flex flex-row items-center justify-start  px-4 py-4 text-sm font-medium tracking-wide capitalize transition-all duration-300 ease-in-out bg-white hover:bg-gray-200">
                        <div class="px-3 py-2 mr-3 bg-gray-100 border border-gray-300 rounded">
                            <i class="text-sm fad fa-birthday-cake"></i>
                        </div>
                        <div class="flex flex-1 flex-rowbg-green-100">
                            <div class="flex-1">
                                <h1 class="text-sm font-semibold">poll..</h1>
                                <p class="text-xs text-gray-500">text here also</p>
                            </div>
                            <div class="text-xs text-right text-gray-500">
                                <p>4 min ago</p>
                            </div>
                        </div>
                    </a>
                    <hr>
                    <!-- end item -->
                    <!-- item -->
                    <a class="flex flex-row items-center justify-start  px-4 py-4 text-sm font-medium tracking-wide capitalize transition-all duration-300 ease-in-out bg-white hover:bg-gray-200" href="#">
                        <div class="px-3 py-2 mr-3 bg-gray-100 border border-gray-300 rounded">
                            <i class="text-sm fad fa-user-circle"></i>
                        </div>
                        <div class="flex flex-1 flex-rowbg-green-100">
                            <div class="flex-1">
                                <h1 class="text-sm font-semibold">mohamed..</h1>
                                <p class="text-xs text-gray-500">text here also</p>
                            </div>
                            <div class="text-xs text-right text-gray-500">
                                <p>78 min ago</p>
                            </div>
                        </div>
                    </a>
                    <hr>
                    <!-- end item -->

                    <!-- item -->
                    <a class="flex flex-row items-center justify-start  px-4 py-4 text-sm font-medium tracking-wide capitalize transition-all duration-300 ease-in-out bg-white hover:bg-gray-200" href="#">

                        <div class="px-3 py-2 mr-3 bg-gray-100 border border-gray-300 rounded">
                            <i class="text-sm fad fa-images"></i>
                        </div>

                        <div class="flex flex-1 flex-rowbg-green-100">
                            <div class="flex-1">
                                <h1 class="text-sm font-semibold">new imag..</h1>
                                <p class="text-xs text-gray-500">text here also</p>
                            </div>
                            <div class="text-xs text-right text-gray-500">
                                <p>65 min ago</p>
                            </div>
                        </div>

                    </a>
                    <hr>
                    <!-- end item -->

                    <!-- item -->
                    <a class="flex flex-row items-center justify-start block px-4 py-4 text-sm font-medium tracking-wide capitalize transition-all duration-300 ease-in-out bg-white hover:bg-gray-200" href="#">

                        <div class="px-3 py-2 mr-3 bg-gray-100 border border-gray-300 rounded">
                            <i class="text-sm fad fa-alarm-exclamation"></i>
                        </div>

                        <div class="flex flex-1 flex-rowbg-green-100">
                            <div class="flex-1">
                                <h1 class="text-sm font-semibold">time is up..</h1>
                                <p class="text-xs text-gray-500">text here also</p>
                            </div>
                            <div class="text-xs text-right text-gray-500">
                                <p>1 min ago</p>
                            </div>
                        </div>

                    </a>
                    <!-- end item -->


                    <!-- end body -->

                    <!-- bottom -->
                    <hr>
                    <div class="px-4 py-2 mt-2">
                        <a href="#" class="block p-1 text-xs text-center uppercase transition-all duration-500 ease-in-out border border-gray-300 rounded hover:text-teal-500">
                            view all
                        </a>
                    </div>
                    <!-- end bottom -->
                </div>
            </div>
            <!-- end notifcation -->

            <!-- messages -->
            <div class="relative mr-5 dropdown md:static">

                <button @click="messages = ! messages" class="p-0 m-0 text-gray-500 transition-all duration-300 ease-in-out menu-btn hover:text-gray-900 focus:text-gray-900 focus:outline-none">
                    <i class="fad fa-comments"></i>
                </button>

                <button class="fixed top-0 left-0 z-10 hidden w-full h-full menu-overflow"></button>

                <div
                        x-cloak
                        style="display: none !important;"
                        x-show="messages"
                        class="absolute right-0 z-20  py-2  bg-white rounded shadow-md menu md:w-84 md:mt-10 md:right-1/3 mt-10 w-84 animated faster"
                >
                    <!-- top -->
                    <div class="flex flex-row items-center justify-between px-4 py-2 text-sm font-semibold capitalize">
                        <h1>messages</h1>
                        <div class="px-1 text-xs text-teal-500 bg-teal-100 border border-teal-200 rounded">
                            <strong>3</strong>
                        </div>
                    </div>
                    <hr>
                    <!-- end top -->

                    <!-- body -->

                    <!-- item -->
                    <a class="flex flex-row items-center justify-start  px-4 py-4 text-sm font-medium tracking-wide capitalize transition-all duration-300 ease-in-out bg-white hover:bg-gray-200" href="#">

                        <div class="w-10 h-10 mr-3 overflow-hidden bg-gray-100 border border-gray-300 rounded-full">
                            <img class="object-cover w-full h-full" src="/img/user1.jpg" alt="">
                        </div>

                        <div class="flex flex-1 flex-rowbg-green-100">
                            <div class="flex-1">
                                <h1 class="text-sm font-semibold">mohamed said</h1>
                                <p class="text-xs text-gray-500">yeah i know</p>
                            </div>
                            <div class="text-xs text-right text-gray-500">
                                <p>4 min ago</p>
                            </div>
                        </div>

                    </a>
                    <hr>
                    <!-- end item -->

                    <!-- item -->
                    <a class="flex flex-row items-center justify-start block px-4 py-4 text-sm font-medium tracking-wide capitalize transition-all duration-300 ease-in-out bg-white hover:bg-gray-200" href="#">

                        <div class="w-10 h-10 mr-3 overflow-hidden bg-gray-100 border border-gray-300 rounded-full">
                            <img class="object-cover w-full h-full" src="img/user2.jpg" alt="">
                        </div>

                        <div class="flex flex-1 flex-rowbg-green-100">
                            <div class="flex-1">
                                <h1 class="text-sm font-semibold">sull goldmen</h1>
                                <p class="text-xs text-gray-500">for sure</p>
                            </div>
                            <div class="text-xs text-right text-gray-500">
                                <p>1 day ago</p>
                            </div>
                        </div>

                    </a>
                    <hr>
                    <!-- end item -->

                    <!-- item -->
                    <a class="flex flex-row items-center justify-start  px-4 py-4 text-sm font-medium tracking-wide capitalize transition-all duration-300 ease-in-out bg-white hover:bg-gray-200" href="#">

                        <div class="w-10 h-10 mr-3 overflow-hidden bg-gray-100 border border-gray-300 rounded-full">
                            <img class="object-cover w-full h-full" src="/img/user3.jpg" alt="">
                        </div>

                        <div class="flex flex-1 flex-rowbg-green-100">
                            <div class="flex-1">
                                <h1 class="text-sm font-semibold">mick</h1>
                                <p class="text-xs text-gray-500">is typing ....</p>
                            </div>
                            <div class="text-xs text-right text-gray-500">
                                <p>31 feb</p>
                            </div>
                        </div>

                    </a>
                    <!-- end item -->


                    <!-- end body -->

                    <!-- bottom -->
                    <hr>
                    <div class="px-4 py-2 mt-2">
                        <a href="#" class="block p-1 text-xs text-center uppercase transition-all duration-500 ease-in-out border border-gray-300 rounded hover:text-teal-500">
                            view all
                        </a>
                    </div>
                    <!-- end bottom -->
                </div>
            </div>
            <!-- end messages -->


        </div>
        <!-- end right -->
    </div>
    <!-- end navbar content -->

</div>
<!-- end navbar -->