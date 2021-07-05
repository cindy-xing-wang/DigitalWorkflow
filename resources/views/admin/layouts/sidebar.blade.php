<div class="page-wrap">
    <div class="app-sidebar colored">
        <div class="sidebar-header">
            <a class="header-brand" href="{{url('home')}}">
                <span class="text">{{ config('app.name', 'Laravel') }}</span>
            </a>
        </div>
        
        <div class="sidebar-content">
            <div class="nav-container">
                <nav id="main-menu-navigation" class="navigation-main">
                    <div class="nav-item active">
                        <a href="{{url('home')}}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                    </div>
                    <div class="nav-item has-sub">
                        @if (Auth::user()->role_id==1 || Auth::user()->role_id==2)
                            
                            <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Staff</span> 
                                <span class="badge badge-danger">
                                    @if (Auth::user()->role_id==1)
                                        {{count(App\Models\User::get())}}
                                    @else
                                        {{count(App\Models\User::where('airport_id','=', Auth::user()->airport_id)->get())}}
                                    @endif
                                </span>
                            </a>
                            <div class="submenu-content">
                                <a href="{{route('staffs.index')}}" class="menu-item">Staff List</a>
                                <a href="{{route('staffs.create')}}" class="menu-item">New Staff</a>
                            </div>
                        @endif
                    </div>
                        <div class="nav-item active">
                            <a href="{{route('ops.create')}}"><i class="ik ik-edit"></i><span>New Operation</span> </a>
                        </div>
                        @if (Auth::user()->role_id==1)
                            <div class="nav-item active">
                                <a href="{{route('checklists.index')}}"><i class="ik ik-file-text"></i></i><span>Checklist Management</span> </a>
                            </div>
                        @endif
                        <div class="nav-item active">
                            <a href="{{route('ops.index')}}"><i class="ik ik-calendar"></i><span>Calendars</span> </a>
                        </div>
                        <div class="nav-item active">
                            <a href="{{url('reports')}}"><i class="ik ik-file-text"></i><span>Health & Safety</span> </a>
                        </div>
                </nav>
            </div>
        </div>
    </div>