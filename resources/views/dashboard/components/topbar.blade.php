<header class="topbar">


    <div class="topbar-right">

        <button class="mobile-sidebar-btn" id="mobileSidebarBtn">

            <i class="fa-solid fa-bars"></i>

        </button>


        <div>

            <h1 class="page-title">

                @yield('page-title','لوحة التحكم')

            </h1>


            <p class="page-subtitle">

                أهلاً بك في لوحة إدارة البورتفوليو

            </p>

        </div>


    </div>



    <div class="topbar-left">


        {{-- Dark Mode --}}

        <button class="icon-btn" id="darkModeBtn">

            <i class="fa-solid fa-moon"></i>

        </button>



        {{-- Notification --}}

        <button class="icon-btn notification-btn">

<i class="fas fa-user-plus ml-2"></i>

            <span></span>

        </button>



        {{-- Profile Dropdown --}}

        <div class="profile-dropdown">


            <button class="profile-trigger" id="profileTrigger">


                <img 
                src="{{ asset('images/profile.png') }}"
                alt="profile">


                <div class="profile-info">

                    <strong>
                        {{ auth()->user()->name ?? 'User' }}
                    </strong>


                    <small>
                        {{ auth()->user()->email ?? '' }}
                    </small>

                </div>


                <i class="fa-solid fa-chevron-down"></i>


            </button>



            <div class="profile-menu" id="profileMenu">


                {{-- <a href="{{ route('dashboard') }}">

                    <i class="fa-solid fa-user"></i>

                    الملف الشخصي

                </a> --}}


{{-- 
                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button>

                        <i class="fa-solid fa-right-from-bracket"></i>

                        تسجيل الخروج

                    </button>

                </form>
 --}}

            </div>


        </div>


    </div>


</header>