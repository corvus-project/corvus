<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            @if (Auth::user()->hasRole('vendor'))
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('portal/dashboard'))
                }}" href="{{ route('portal.dashboard') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    @lang('menus.dashboard')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{
                            active_class(Route::is('portal/products'))
                }}" href="{{ route('portal.products.index') }}">
                    <i class="nav-icon fas fa-list"></i>
                    @lang('menus.catalogue')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{
                            active_class(Route::is('portal/orders'))
                }}" href="{{ route('portal.orders.index') }}">
                    <i class="nav-icon fas fa-wallet"></i>
                    @lang('menus.orders')
                </a>
            </li> 

            <li class="nav-item">
                <a class="nav-link {{
                            active_class(Route::is('portal/orders/upload'))
                }}" href="{{ route('portal.orders.upload') }}">
                    <i class="nav-icon fas fa-upload"></i>
                    @lang('menus.orders.upload')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{
                            active_class(Route::is('portal/account'))
                }}" href="{{ route('portal.account') }}">
                    <i class="nav-icon fas fa-user"></i>
                    @lang('menus.account')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{
                            active_class(Route::is('portal/cart'))
                }}" href="{{ route('portal.cart.view') }}">
                <i class="nav-icon fas fa-shopping-cart"></i>
                    @lang('menus.cart')
                </a>
            </li>            
            @endif
            @if (Auth::user()->hasRoles(['administrator', 'inventory_staff', 'orders_staff']))
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('backoffice/dashboard'))
                }}" href="{{ route('backoffice.dashboard') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    @lang('menus.dashboard')
                </a>
            </li>
         
            <li class="nav-item nav-dropdown ">
                <a class="nav-link nav-dropdown-toggle {{
                    active_class(Route::is('backoffice/products'))
                }}" href="{{ route('backoffice.products.index') }}">
                    <i class="nav-icon fas fa-list-alt"></i>
                    @lang('menus.catalogue')
                </a>

                <ul class="nav-dropdown-items">

                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Route::is('backoffice/products'))
                }}" href="{{ route('backoffice.products.index') }}">
                            <i class="nav-icon fas fa-list"></i>
                            @lang('menus.products')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{
                    active_class(Route::is('backoffice/pricing-groups'))
                }}" href="{{ route('backoffice.pricing_groups.index') }}">
                            <i class="nav-icon fas fa-money-bill-wave-alt"></i>
                            @lang('menus.pricing_groups')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{
                    active_class(Route::is('backoffice/stock-groups'))
                }}" href="{{ route('backoffice.stock_groups.index') }}">
                            <i class="nav-icon fas fa-sort-numeric-up-alt"></i>
                            @lang('menus.stock_groups')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{
                    active_class(Route::is('backoffice/categories'))
                }}" href="{{ route('backoffice.categories.index') }}">
                            <i class="nav-icon fas fa-border-all"></i>
                            @lang('menus.categories')
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('backoffice/warehouses'))
                }}" href="{{ route('backoffice.warehouses.index') }}">
                    <i class="nav-icon fas fa-warehouse"></i>
                    @lang('menus.warehouses')
                </a>
            </li>
            @endif
            @if (Auth::user()->hasRoles(['orders_staff', 'administrator']))
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('backoffice/accounts'))
                }}" href="{{ route('backoffice.accounts.index') }}">
                    <i class="nav-icon fas fa-users"></i>
                    @lang('menus.accounts')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('backoffice/orders'))
                }}" href="{{ route('backoffice.orders.index') }}">
                    <i class="nav-icon fas fa-wallet"></i>
                    @lang('menus.orders')
                </a>
            </li>
            @endif
            @if (Auth::user()->hasRoles(['administrator']))
            <li class="nav-item nav-dropdown ">
                <a class="nav-link nav-dropdown-toggle {{
                    active_class(Route::is('backoffice/reports'))
                }}" href="{{ route('backoffice.reports.index') }}">

                    <i class="nav-icon far fa-chart-bar"></i>
                    @lang('menus.reports')
                </a>


                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{
                    active_class(Route::is('backoffice/reports/warehouse/stock'))
                }}" href="{{ route('backoffice.reports.warehouse.stock') }}">
                            @lang('menus.reports_warehouses_stock')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{
                    active_class(Route::is('backoffice/reports/customer/order'))
                }}" href="{{ route('backoffice.reports.customer.order') }}">
                            @lang('menus.reports_customers_orders')
                        </a>
                    </li>

                </ul>
            </li>
            @endif
            @if (Auth::user()->hasRoles(['administrator']))  
            <li class="nav-item nav-dropdown ">
                <a class="nav-link nav-dropdown-toggle {{
                    active_class(Route::is('backoffice/tools'))
                }}" href="{{ route('backoffice.tools.index') }}">
                    <i class="nav-icon fas fa-tools"></i>
                    @lang('menus.tools')
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{
                    active_class(Route::is('backoffice/tools/import'))
                }}" href="{{ route('backoffice.tools.import.index') }}">
                            <i class="nav-icon fas fa-file-import"></i>
                            @lang('menus.imports')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{
                    active_class(Route::is('backoffice/tools/export'))
                }}" href="{{ route('backoffice.tools.export.index') }}">
                            <i class="nav-icon fas fa-file-export"></i>
                            @lang('menus.export')
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                        <a class="nav-link {{
                    active_class(Route::is('backoffice/users'))
                }}" href="{{ route('backoffice.users.index') }}">
                            <i class="nav-icon fas fa-user"></i>
                            @lang('menus.users')
                        </a>
                    </li>
            @endif
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
<!--sidebar-->