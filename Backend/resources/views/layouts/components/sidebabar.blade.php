
 @if(Auth::user()->hasRole('admin'))
 <div class="h-100" data-simplebar>
     <!--- Sidemenu -->
     <div id="sidebar-menu">

         <ul id="side-menu">

             <li class="menu-title">Menu</li>

             <li>
                 <a href="{{route('dashboard')}}">
                     <i data-feather="home"></i>
                     <span> Dashboard </span>
                 </a>
             </li>

             <li>
                 <a href="{{route('usermanagement.index')}}">
                     <i data-feather="users"></i>
                     @php
                     $countmember = DB::table('users')->count();
                     @endphp
                     <span class="badge badge-success badge-pill float-right">{{ $countmember }}</span>
                     <span> Management Users </span>
                 </a>
             </li>

             <li>
                <a href="#sidebarUPTKediri" data-toggle="collapse">
                    <i data-feather="database"></i>
                    <span class="badge badge-success badge-pill float-right">4</span>
                    <span> Asset </span>
                </a>
                <div class="collapse" id="sidebarUPTKediri">
                    <ul class="nav-second-level">
                        <li>
                            <a href="{{route('soil.index')}}"> Soil </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <a href="#">
                    <i data-feather="filter"></i>
                    <span> Report </span>
                </a>
            </li>



         </ul>
     </div>
     <!-- End Sidebar -->

     <div class="clearfix"></div>

 </div>
 @elseif (Auth::user()->hasRole('upt_psda_kediri')){
<div class="h-100"  data-simplebar>
    <div id="sidebar-menu">
        <ul id="side-menu">
            <li class="menu-title">Menu</li>
            <li>
                <a href="{{route('dashboard')}}">
                    <i data-feather="home"></i>
                    <span> Dashboard </span>
                </a>
            </li>
             <li>
                <a href="#sidebarUPTKediri" data-toggle="collapse">
                    <i data-feather="database"></i>
                    <span class="badge badge-success badge-pill float-right">4</span>
                    <span> Asset </span>
                </a>
                <div class="collapse" id="sidebarUPTKediri">
                    <ul class="nav-second-level">
                        <li>
                            <a href="{{route('kediri.index')}}"> Soil </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
}
 @elseif (Auth::user()->hasRole('upt_psda_lumajang')){
<div class="h-100"  data-simplebar>
    <div id="sidebar-menu">
        <ul id="side-menu">
            <li class="menu-title">Menu</li>
            <li>
                <a href="#">
                    <i data-feather="home"></i>
                    <span> Dashboard </span>
                </a>
            </li>
        </ul>
    </div>
</div>
}
 @elseif (Auth::user()->hasRole('upt_psda_bondowoso')){
<div class="h-100"  data-simplebar>
    <div id="sidebar-menu">
        <ul id="side-menu">
            <li class="menu-title">Menu</li>
            <li>
                <a href="#">
                    <i data-feather="home"></i>
                    <span> Dashboard </span>
                </a>
            </li>
        </ul>
    </div>
</div>
}
 @elseif (Auth::user()->hasRole('upt_psda_pasuruan')){
<div class="h-100"  data-simplebar>
    <div id="sidebar-menu">
        <ul id="side-menu">
            <li class="menu-title">Menu</li>
            <li>
                <a href="#">
                    <i data-feather="home"></i>
                    <span> Dashboard </span>
                </a>
            </li>
        </ul>
    </div>
</div>
}
 @elseif (Auth::user()->hasRole('upt_psda_bojonegoro')){
<div class="h-100"  data-simplebar>
    <div id="sidebar-menu">
        <ul id="side-menu">
            <li class="menu-title">Menu</li>
            <li>
                <a href="#">
                    <i data-feather="home"></i>
                    <span> Dashboard </span>
                </a>
            </li>
        </ul>
    </div>
</div>
}
 @elseif (Auth::user()->hasRole('upt_psda_pamekasan')){
<div class="h-100"  data-simplebar>
    <div id="sidebar-menu">
        <ul id="side-menu">
            <li class="menu-title">Menu</li>
            <li>
                <a href="#">
                    <i data-feather="home"></i>
                    <span> Dashboard </span>
                </a>
            </li>
        </ul>
    </div>
</div>
}
@endif





<!-- Sidebar -left -->





