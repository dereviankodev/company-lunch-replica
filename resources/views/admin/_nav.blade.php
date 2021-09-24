<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a href="{{ route('admin.home') }}"
           class="nav-link{{ request()->routeIs('admin.home') ? ' active' : '' }}">
            {{ __('Dashboard') }}
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.users.index') }}"
           class="nav-link{{ request()->routeIs('admin.users.*') ? ' active' : '' }}">
            {{ __('Users') }}
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.categories.index') }}"
           class="nav-link{{ request()->routeIs('admin.categories.*') ? ' active' : '' }}">
            {{ __('Categories') }}
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.dishes.index') }}"
           class="nav-link{{ request()->routeIs('admin.dishes.*') ? ' active' : '' }}">
            {{ __('Dishes') }}
        </a>
    </li>
</ul>