<div class="bg-base-200 min-h-full w-80 p-4">
    <h3 class="font-bold mb-3">Navigation</h3>
    <li>
        <a href="{{ route('dashboard.profile.show') }}" class="{{ request()->routeIs('dashboard.profile.*') ? 'active' : '' }}">
            Profile
        </a>
    </li>
    <ul class="menu w-full gap-1">
        @can('dashboard.view')
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') || request()->routeIs('home') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>
        @endcan

        @can('users.view')
            <li>
                <a href="{{ route('dashboard.users.index') }}" class="{{ request()->routeIs('dashboard.users.*') ? 'active' : '' }}">
                    Users
                </a>
            </li>
        @endcan

        @can('roles.view')
            <li>
                <a href="{{ route('dashboard.roles.index') }}" class="{{ request()->routeIs('dashboard.roles.*') ? 'active' : '' }}">
                    Roles
                </a>
            </li>
        @endcan

        @can('permissions.view')
            <li>
                <a href="{{ route('dashboard.permissions.index') }}" class="{{ request()->routeIs('dashboard.permissions.*') ? 'active' : '' }}">
                    Permissions
                </a>
            </li>
        @endcan
    </ul>
</div>
