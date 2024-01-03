@php
    $sessionArr = session('pms_midterms');
    $sessionParsed = json_decode($sessionArr);
@endphp


<header class="main-nav">
    <div class="sidebar-user text-center">
        {{-- <a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a> --}}
        <img 
        src="{{ asset('img/users/' . $sessionParsed[0]->imgPath) }}" 
        onerror="this.onerror=null; this.src=''"
        class="img-100 rounded-circle" alt="Image">
        <a href="#">
            <h6 class="mt-3 f-14 f-w-600" id=''>
             
            </h6>
        </a>
        <p class="mb-0 font-roboto" id=''>
      
        </p>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                   @if($sessionParsed[0]->role == "client")
                        <li class='dropdown'>
                            <a class='nav-link menu-title ' href='javascript:void(0)'><span>Client</span></a>
                            <ul class='nav-submenu menu-content' style='display: none;'>
                                <li><a href='/clientDashboard' class=''><i
                                data-feather='coffee'></i>Dashboard</a></li>
                                <li><a href='/manageVehicles' class=''><i
                                data-feather='users'></i>Manage Vehicles</a></li>
                                <li><a href='/appointment' class=''><i
                                data-feather='home'></i>Request Appointment</a></li>
                                <li><a href='/repairHistory' class=''><i
                                data-feather='user'></i>Repair History</a></li>
                                <li>
                                    <a  href="/logout">
                                        <button id='' class="btn btn-primary-light" type="button"><i
                                             data-feather="log-out"></i>Log out
                                        </button>
                                    </a>
                                 </li>
                            </ul>
                        </li>
                    @endif

                    @if($sessionParsed[0]->role == "admin")
                        <li class='dropdown'>
                            <a class='nav-link menu-title ' href='javascript:void(0)'><span>Admin</span></a>
                            <ul class='nav-submenu menu-content' style='display: none;'>
                                <li><a href='/adminDashboard' class=''><i
                                data-feather='coffee'></i>Dashboard</a></li>
                                <li><a href='/manageAppointments' class=''><i
                                data-feather='paper-plane'></i>Manage Appointments</a></li>
                                <li><a href='/onService' class=''><i
                                data-feather='wrench'></i>Manage Repair</a></li>
                                <li><a href='/repairLogs' class=''><i
                                data-feather='grid'></i>Repair Logs</a></li>
                                <li><a href='/manageServices-Parts' class=''><i
                                data-feather='sliders'></i>Manage Services & Parts</a></li>
                                <li>
                                    <a  href="/logout">
                                        <button id='' class="btn btn-primary-light" type="button"><i
                                             data-feather="log-out"></i>Log out
                                        </button>
                                    </a>
                                 </li>
                            </ul>
                        </li>
                    @endif
                    
                    
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>