<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu"> 
    <div class="h-100" data-simplebar> 
        <!-- User box -->
        <div class="user-box text-center">
            <p>{{-- Session::get('role_name'); --}}</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul id="side-menu">
                
                @if(Auth::user()->user_role == 1) 
                    @include('backend/includes/navigation/super_admin');
                @endIf

                @if(Auth::user()->user_role == 2) 
                    @include('backend/includes/navigation/admin');
                @endIf

                @if(Auth::user()->user_role == 3) 
                    @include('backend/includes/navigation/manager');
                @endIf

                @if(Auth::user()->user_role == 4) 
                    @include('backend/includes/navigation/parent');
                @endIf

                @if(Auth::user()->user_role == 5) 
                    @include('backend/includes/navigation/student');
                @endIf

                @if(Auth::user()->user_role == 6)
                    @include('backend/includes/navigation/teacher');
                @endIf

                @if(Auth::user()->user_role == 7) 
                    @include('backend/includes/navigation/staff');
                @endIf

                @if(Auth::user()->user_role == 8) 
                    @include('backend/includes/navigation/operator');
                @endIf

                <li>
                    <!-- logout-->
                    <a class="dropdown-item notify-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fe-log-out"></i>
                        @lang('Logout')
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End