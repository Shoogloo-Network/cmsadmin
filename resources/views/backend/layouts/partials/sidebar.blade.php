 <!-- sidebar menu area start -->
 @php
     $usr = Auth::guard('admin')->user();
 @endphp
 <div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('admin.dashboard') }}">
                <h2 class="text-white">Admin</h2> 
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">

                    @if ($usr->can('dashboard.view'))
                    <li class="active">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        <ul class="collapse">
                            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        </ul>
                    </li>
                    @endif
                    @if ($usr->can('route.create'))
                    <li class="active">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Routes</span></a>
                        <ul class="collapse {{ Route::is('admin.routes.create') || Route::is('admin.routes.index') || Route::is('admin.routes.edit') || Route::is('admin.routes.show') ? 'in' : '' }}">
                            @if ($usr->can('route.view'))
                                <li class="{{ Route::is('admin.routes.index')  || Route::is('admin.routes.edit') ? 'active' : '' }}"><a href="{{ route('admin.routes.index') }}">All Routes</a></li>
                            @endif
                            @if ($usr->can('route.create'))
                                <li class="{{ Route::is('admin.routes.create')  ? 'active' : '' }}"><a href="{{ route('admin.routes.create') }}">Create Route</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if ($usr->can('operator.create'))
                    <li class="active">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Operators</span></a>
                        <ul class="collapse {{ Route::is('admin.operators.create') || Route::is('admin.operators.index') || Route::is('admin.operators.edit') || Route::is('admin.operators.show') ? 'in' : '' }}">
                            @if ($usr->can('operator.view'))
                                <li class="{{ Route::is('admin.operators.index')  || Route::is('admin.operators.edit') ? 'active' : '' }}"><a href="{{ route('admin.operators.index') }}">All Operators</a></li>
                            @endif
                            @if ($usr->can('operator.create'))
                                <li class="{{ Route::is('admin.operators.create')  ? 'active' : '' }}"><a href="{{ route('admin.operators.create') }}">Create Operator</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if ($usr->can('provider.create'))
                    <li class="active">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Provider</span></a>
                        <ul class="collapse {{ Route::is('admin.providers.create') || Route::is('admin.providers.index') || Route::is('admin.providers.edit') || Route::is('admin.providers.show') ? 'in' : '' }}">
                            @if ($usr->can('provider.view'))
                                <li class="{{ Route::is('admin.providers.index')  || Route::is('admin.providers.edit') ? 'active' : '' }}"><a href="{{ route('admin.providers.index') }}">All Providers</a></li>
                            @endif
                            @if ($usr->can('provider.create'))
                                <li class="{{ Route::is('admin.providers.create')  ? 'active' : '' }}"><a href="{{ route('admin.providers.create') }}">Create Operator</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if ($usr->can('deal.create'))
                    <li class="active">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Deals</span></a>
                        <ul class="collapse {{ Route::is('admin.deals.create') || Route::is('admin.deals.index') || Route::is('admin.deals.edit') || Route::is('admin.deals.show') ? 'in' : '' }}">
                            @if ($usr->can('deal.view'))
                                <li class="{{ Route::is('admin.deals.index')  || Route::is('admin.deals.edit') ? 'active' : '' }}"><a href="{{ route('admin.deals.index') }}">All Deals</a></li>
                            @endif
                            @if ($usr->can('deal.create'))
                                <li class="{{ Route::is('admin.deals.create')  ? 'active' : '' }}"><a href="{{ route('admin.deals.create') }}">Create Deal</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif                    
                    @if ($usr->can('role.create') || $usr->can('role.view') ||  $usr->can('role.edit') ||  $usr->can('role.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            Roles & Permissions
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.roles.create') || Route::is('admin.roles.index') || Route::is('admin.roles.edit') || Route::is('admin.roles.show') ? 'in' : '' }}">
                            @if ($usr->can('role.view'))
                                <li class="{{ Route::is('admin.roles.index')  || Route::is('admin.roles.edit') ? 'active' : '' }}"><a href="{{ route('admin.roles.index') }}">All Roles</a></li>
                            @endif
                            @if ($usr->can('role.create'))
                                <li class="{{ Route::is('admin.roles.create')  ? 'active' : '' }}"><a href="{{ route('admin.roles.create') }}">Create Role</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    
                    @if ($usr->can('admin.create') || $usr->can('admin.view') ||  $usr->can('admin.edit') ||  $usr->can('admin.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>
                            Admins
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.admins.create') || Route::is('admin.admins.index') || Route::is('admin.admins.edit') || Route::is('admin.admins.show') ? 'in' : '' }}">
                            
                            @if ($usr->can('admin.view'))
                                <li class="{{ Route::is('admin.admins.index')  || Route::is('admin.admins.edit') ? 'active' : '' }}"><a href="{{ route('admin.admins.index') }}">All Admins</a></li>
                            @endif

                            @if ($usr->can('admin.create'))
                                <li class="{{ Route::is('admin.admins.create')  ? 'active' : '' }}"><a href="{{ route('admin.admins.create') }}">Create Admin</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->