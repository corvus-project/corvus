<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ route('home') }}">
        Intellect
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <a class="nav-link" href="{{ route('home') }}"><i class="fas fa-home"></i></a>
        </li>

        <li class="nav-item px-3">
            <a class="nav-link" href="{{ route('home') }}">@lang('menus.dashboard')</a>
        </li>

        @if(config('locale.status') && count(config('locale.languages')) > 1)
        <li class="nav-item px-3 dropdown">
            <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="true" aria-expanded="false">
                <span class="d-md-down-none">@lang('menus.language-picker.language')
                    ({{ strtoupper(app()->getLocale()) }})</span>
            </a>

            @include('includes.partials.lang')
        </li>
        @endif
    </ul>

    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown pr-2">
          <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            My Profile
          </a>
          <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="{{ route('user.profile.form') }}">
                <i class="fas fa-user"></i> Profile
            </a>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                <i class="fas fa-lock"></i> @lang('labels.general.logout')
            </a>
          </div>
        </li>
    </ul>
</header>