<!-- Sidebar content here -->

<ul class="menu p-4 w-80 h-full bg-base-200 text-base-content rounded-box">
    <li><a href="{{ route('dashboard') }}" class="{{ route('dashboard') === url()->current() ? 'active' : '' }}" wire:navigate>Dashboard</a></li>
    <li><a href="{{ route('transaction') }}" class="{{ route('transaction') === url()->current() ? 'active' : '' }}" wire:navigate>Transaction</a></li>
    @canany(['view_user_list', 'view_role_list', 'view_permission_list'])
        <li>
            <details
                @if( route('users') === url()->current() || route('roles') === url()->current() ||  route('permissions') === url()->current())
                    open
                @endif
            >
                <summary>Settings</summary>
                <ul>
                    @can('view_user_list')
                        <li><a href="{{ route('users') }}" class="{{ route('users') === url()->current() ? 'active' : '' }}" wire:navigate>Users</a></li>
                    @endcan
                    @can('view_role_list')
                        <li><a href="{{ route('roles') }}" class="{{ route('roles') === url()->current() ? 'active' : '' }}" wire:navigate>Roles</a></li>
                    @endcan
                    @can('view_permission_list')
                        <li><a href="{{ route('permissions') }}" class="{{ route('permissions') === url()->current() ? 'active' : '' }}" wire:navigate>Permissions</a></li>
                    @endcan
                </ul>
            </details>
        </li>
    @endcanany

</ul>

