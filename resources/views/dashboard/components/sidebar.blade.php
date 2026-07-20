
<aside id="sidebar" class="sidebar">


    <!-- PROFILE -->
   

<div class="profile-info">

    
    <!-- التأكد أولاً من أن المستخدم قام بتسجيل الدخول لتجنب أي أخطاء -->
    @if(auth()->check())
        <h3 style="color: white">
            {{ auth()->user()->name }}
        </h3>

        <p>
            {{ auth()->user()->email }}
        </p>
    @else
        <h3>زائر</h3>
        <p>يرجى تسجيل الدخول</p>
    @endif
</div>




    <button id="sidebarToggle" class="toggle-btn">

        <i class="fa fa-star"></i>

    </button>




    <!-- MENU -->

    <nav class="sidebar-menu">


        <a href="{{route('dashboard.index')}}" 
        class="sidebar-link {{request()->routeIs('dashboard')?'active':''}}">


            <div class="icon">
                <i class="fa-solid fa-house"></i>
            </div>


            <span>
                الرئيسية
            </span>


        </a>




        <a href="{{route('dashboard.projects')}}"
        class="sidebar-link">


            <div class="icon">
                <i class="fa-solid fa-code"></i>
            </div>


            <span>
                المشاريع
            </span>

        </a>




        <a href="{{route('dashboard.services')}}"
        class="sidebar-link">


            <div class="icon">
                <i class="fa-solid fa-layer-group"></i>
            </div>


            <span>
                الخدمات
            </span>


        </a>





        <a href="{{route('dashboard.poems')}}"
        class="sidebar-link">


            <div class="icon">
                <i class="fa-solid fa-feather"></i>
            </div>


            <span>
                القصائد
            </span>


        </a>

        <a href="{{route('dashboard.contacts')}}"
        class="sidebar-link">


            <div class="icon">
                <i class="fa-solid fa-users"></i>
            </div>


            <span>
                العملاء
            </span>


        </a>



 



    </nav>




    <div class="sidebar-bottom">


     <form action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="logout-btn">
     <i class="fa-solid fa-right-from-bracket"></i>

         تسجيل الخروج
    </button>
</form>


    </div>



</aside>