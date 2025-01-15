 <!-- sidebar menu area start -->
 @php
     $usr = Auth::guard('admin')->user();
 @endphp
 <div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('admin.dashboard') }}">
                <h2 class="text-white" style="font-size:18px;">Admin</h2>
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">

                    @if ($usr->can('dashboard.view'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        {{-- <ul class="collapse">
                            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        </ul> --}}
                    </li>
                    @endif
                    @if ($usr->can('city.create') || $usr->can('city.view') || $usr->can('city.edit') || $usr->can('citymap.view') || $usr->can('citymap.create'))
                         <li>
                             <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>Cities</span></a>
                             <ul
                                 class="collapse {{ Route::is('admin.cities.create') || Route::is('admin.cities.index') || Route::is('admin.cities.edit') || Route::is('admin.cities.show') ? 'in' : '' }}">

                                 @if ($usr->can('city.view'))
                                     <li class="{{ Route::is('admin.cities.index') || Route::is('admin.cities.edit') ? 'active' : '' }}">
                                         <a href="{{ route('admin.cities.index') }}">All Cities</a>
                                     </li>
                                 @endif

                                 @if ($usr->can('city.create'))
                                     <li class="{{ Route::is('admin.cities.create') ? 'active' : '' }}"><a
                                             href="{{ route('admin.cities.create') }}">Create City</a></li>
                                 @endif

                                 @if ($usr->can('city.view'))
                                     <li class="{{ Route::is('admin.citymap.index') ? 'active' : '' }}"><a
                                             href="{{ route('admin.citymap.index') }}">Popular Routes</a></li>
                                 @endif

                                 @if ($usr->can('city.create'))
                                     <li class="{{ Route::is('admin.citymap.create') ? 'active' : '' }}"><a
                                             href="{{ route('admin.citymap.create') }}">Attractions</a></li>
                                 @endif

                                 {{-- @if ($usr->can('city.getAttractions'))
                                     <li class="{{ Route::is('admin.citymap.attractions') ? 'active' : '' }}"><a
                                             href="{{ route('admin.citymap.attractions') }}">Attractions</a></li>
                                 @endif

                                 @if ($usr->can('city.createAttraction'))
                                     <li class="{{ Route::is('admin.citymap.createattraction') ? 'active' : '' }}"><a
                                             href="{{ route('admin.citymap.createattraction') }}">Attractions</a></li>
                                 @endif --}}
                             </ul>
                         </li>
                    @endif
                    @if ($usr->can('country.create'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Countries</span></a>
                        <ul class="collapse {{ Route::is('admin.countries.create') || Route::is('admin.countries.index') || Route::is('admin.countries.edit') || Route::is('admin.countries.show') ? 'in' : '' }}">
                            @if ($usr->can('country.view'))
                                <li class="{{ Route::is('admin.countries.index')  || Route::is('admin.countries.edit') ? 'active' : '' }}"><a href="{{ route('admin.countries.index') }}">All Countries</a></li>
                            @endif
                            @if ($usr->can('country.create'))
                                <li class="{{ Route::is('admin.countries.create')  ? 'active' : '' }}"><a href="{{ route('admin.countries.create') }}">Create Country</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if ($usr->can('route.create'))
                    <li>
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
                    <li>
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
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Provider</span></a>
                        <ul class="collapse {{ Route::is('admin.providers.create') || Route::is('admin.providers.index') || Route::is('admin.providers.edit') || Route::is('admin.providers.show') ? 'in' : '' }}">
                            @if ($usr->can('provider.view'))
                                <li class="{{ Route::is('admin.providers.index')  || Route::is('admin.providers.edit') ? 'active' : '' }}"><a href="{{ route('admin.providers.index') }}">All Providers</a></li>
                            @endif
                            @if ($usr->can('provider.create'))
                                <li class="{{ Route::is('admin.providers.create')  ? 'active' : '' }}"><a href="{{ route('admin.providers.create') }}">Create Provider</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if ($usr->can('ferry.create'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Ferry</span></a>
                        <ul class="collapse {{ Route::is('admin.ferries.create') || Route::is('admin.ferries.index') || Route::is('admin.ferries.edit') || Route::is('admin.ferries.show') ? 'in' : '' }}">
                            @if ($usr->can('ferry.view'))
                                <li class="{{ Route::is('admin.ferries.index')  || Route::is('admin.ferries.edit') ? 'active' : '' }}"><a href="{{ route('admin.ferries.index') }}">All Ferries</a></li>
                            @endif
                            @if ($usr->can('ferry.create'))
                                <li class="{{ Route::is('admin.ferries.create')  ? 'active' : '' }}"><a href="{{ route('admin.ferries.create') }}">Create Ferry</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if ($usr->can('railcard.create'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Railcard</span></a>
                        <ul class="collapse {{ Route::is('admin.railcards.create') || Route::is('admin.railcards.index') || Route::is('admin.railcards.edit') || Route::is('admin.railcards.show') ? 'in' : '' }}">
                            @if ($usr->can('railcard.view'))
                                <li class="{{ Route::is('admin.railcards.index')  || Route::is('admin.railcards.edit') ? 'active' : '' }}"><a href="{{ route('admin.railcards.index') }}">All Railcards</a></li>
                            @endif
                            @if ($usr->can('railcard.create'))
                                <li class="{{ Route::is('admin.railcards.create')  ? 'active' : '' }}"><a href="{{ route('admin.railcards.create') }}">Create Railcard</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if ($usr->can('deal.create') || $usr->can('deal.view') || $usr->can('deal.edit'))
                    <li>
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
                    @if ($usr->can('faq.create') || $usr->can(abilities: 'faq.view') || $usr->can('faq.edit'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>FAQs</span></a>
                        <ul class="collapse {{ Route::is('admin.faqs.create') || Route::is('admin.faqs.index') || Route::is('admin.faqs.edit') || Route::is('admin.faqs.show') ? 'in' : '' }}">
                            @if ($usr->can('faq.view'))
                                <li class="{{ Route::is('admin.faqs.index')  || Route::is('admin.faqs.edit') ? 'active' : '' }}"><a href="{{ route('admin.faqs.index') }}">All FAQs</a></li>
                            @endif
                            @if ($usr->can('faq.create'))
                                <li class="{{ Route::is('admin.faqs.create')  ? 'active' : '' }}"><a href="{{ route('admin.faqs.create') }}">Create FAQ</a></li>
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
