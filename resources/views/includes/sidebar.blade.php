<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                 
            </li>
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/dashboard'))
                }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    @lang('menus.dashboard')
                </a>
            </li>
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
                    active_class(Route::is('admin/stock-types'))
                }}" href="{{ route('admin.stock_types.index') }}">
                    <i class="nav-icon fas fa-sort-numeric-up-alt"></i>
                    @lang('menus.stock_types')
                </a>
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
                    active_class(Route::is('admin/categories'))
                }}" href="{{ route('admin.categories.index') }}">
                    <i class="nav-icon fas fa-border-all"></i>
                    @lang('menus.categories')
                </a>
            </li>                           

        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
