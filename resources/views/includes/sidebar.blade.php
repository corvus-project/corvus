<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">

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
                    <i class="nav-icon fas fa-list"></i>
                    @lang('menus.products')
                </a>

                <ul class="nav-dropdown-items">
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
                    active_class(Route::is('admin/stock-types'))
                }}" href="{{ route('admin.stock_types.index') }}">
                            <i class="nav-icon fas fa-sort-numeric-up-alt"></i>
                            @lang('menus.stock_types')
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


                    <li class="nav-item">
                        <a class="nav-link {{
                    active_class(Route::is('admin/variants'))
                }}" href="{{ route('admin.variants.index') }}">
                            <i class="nav-icon fas fa-fan"></i>
                            @lang('menus.variants')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{
                    active_class(Route::is('admin/attributes'))
                }}" href="{{ route('admin.attributes.index') }}">
                            <i class="nav-icon fas fa-tags"></i>
                            @lang('menus.attributes')
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
                    active_class(Route::is('admin/customers'))
                }}" href="{{ route('admin.customers.index') }}">
                    <i class="nav-icon fas fa-users"></i>
                    @lang('menus.customers')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/api'))
                }}" href="{{ route('admin.api.index') }}">
                    <i class="nav-icon fas fa-cloud-download-alt"></i>
                    @lang('menus.api')
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

            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/import'))
                }}" href="{{ route('admin.import.index') }}">
                    <i class="nav-icon fas fa-file-import"></i>
                    @lang('menus.imports')
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
                    active_class(Route::is('admin/pricing-groups'))
                }}" href="{{ route('admin.reports.warehouse.stock') }}">
                            @lang('menus.reports_warehouses_stock')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{
                    active_class(Route::is('admin/pricing-groups'))
                }}" href="{{ route('admin.pricing_groups.index') }}">
                            @lang('menus.reports_warehouses_orders')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{
                    active_class(Route::is('admin/pricing-groups'))
                }}" href="{{ route('admin.pricing_groups.index') }}">
                            @lang('menus.reports_product_orders')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{
                    active_class(Route::is('admin/pricing-groups'))
                }}" href="{{ route('admin.pricing_groups.index') }}">
                            @lang('menus.reports_product_stock')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{
                    active_class(Route::is('admin/pricing-groups'))
                }}" href="{{ route('admin.pricing_groups.index') }}">
                            @lang('menus.reports_product_pricing')
                        </a>
                    </li>


            </li>
        </ul>

        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
<!--sidebar-->