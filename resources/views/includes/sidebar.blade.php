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

            @endif
            @if (Auth::user()->hasRole('administrator'))
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/dashboard'))
                }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    @lang('menus.dashboard')
                </a>
            </li>


            <li class="nav-item nav-dropdown ">
                <a class="nav-link nav-dropdown-toggle {{
                    active_class(Route::is('admin/products'))
                }}" href="{{ route('admin.products.index') }}">
                    <i class="nav-icon fas fa-list-alt"></i>
                    @lang('menus.catalogue')
                </a>

                <ul class="nav-dropdown-items">

                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Route::is('admin/products'))
                }}" href="{{ route('admin.products.index') }}">
                            <i class="nav-icon fas fa-list"></i>
                            @lang('menus.products')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{
                    active_class(Route::is('admin/pricing-groups'))
                }}" href="{{ route('admin.pricing_groups.index') }}">
                            <i class="nav-icon fas fa-money-bill-wave-alt"></i>
                            @lang('menus.pricing_groups')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{
                    active_class(Route::is('admin/stock-groups'))
                }}" href="{{ route('admin.stock_groups.index') }}">
                            <i class="nav-icon fas fa-sort-numeric-up-alt"></i>
                            @lang('menus.stock_groups')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{
                    active_class(Route::is('admin/categories'))
                }}" href="{{ route('admin.categories.index') }}">
                            <i class="nav-icon fas fa-border-all"></i>
                            @lang('menus.categories')
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/warehouses'))
                }}" href="{{ route('admin.warehouses.index') }}">
                    <i class="nav-icon fas fa-warehouse"></i>
                    @lang('menus.warehouses')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/accounts'))
                }}" href="{{ route('admin.accounts.index') }}">
                    <i class="nav-icon fas fa-users"></i>
                    @lang('menus.accounts')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/orders'))
                }}" href="{{ route('admin.orders.index') }}">
                    <i class="nav-icon fas fa-wallet"></i>
                    @lang('menus.orders')
                </a>
            </li>


            <li class="nav-item nav-dropdown ">
                <a class="nav-link nav-dropdown-toggle {{
                    active_class(Route::is('admin/reports'))
                }}" href="{{ route('admin.reports.index') }}">

                    <i class="nav-icon far fa-chart-bar"></i>
                    @lang('menus.reports')
                </a>


                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{
                    active_class(Route::is('admin/reports/warehouse/stock'))
                }}" href="{{ route('admin.reports.warehouse.stock') }}">
                            @lang('menus.reports_warehouses_stock')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{
                    active_class(Route::is('admin/reports/customer/order'))
                }}" href="{{ route('admin.reports.customer.order') }}">
                            @lang('menus.reports_customers_orders')
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item nav-dropdown ">
                <a class="nav-link nav-dropdown-toggle {{
                    active_class(Route::is('admin/tools'))
                }}" href="{{ route('admin.tools.index') }}">
                    <i class="nav-icon fas fa-tools"></i>
                    @lang('menus.tools')
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{
                    active_class(Route::is('admin/tools/import'))
                }}" href="{{ route('admin.tools.import.index') }}">
                            <i class="nav-icon fas fa-file-import"></i>
                            @lang('menus.imports')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{
                    active_class(Route::is('admin/tools/export'))
                }}" href="{{ route('admin.tools.export.index') }}">
                            <i class="nav-icon fas fa-file-export"></i>
                            @lang('menus.export')
                        </a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
<!--sidebar-->