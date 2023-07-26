<!-- Sidebar content here -->

<ul class="menu p-4 w-80 h-full bg-base-200 text-base-content rounded-box">
    <li><a href="{{ route('dashboard') }}" class="{{ route('dashboard') === url()->current() ? 'active' : '' }}">Dashboard</a></li>
    <li><a href="{{ route('transaction') }}" class="{{ route('transaction') === url()->current() ? 'active' : '' }}">Transaction</a></li>
    <li>
        <details
            @if( route('users') === url()->current() || route('roles') === url()->current() ||  route('permissions') === url()->current())
                open
            @endif
        >
            <summary>Settings</summary>
            <ul>
                <li><a href="{{ route('users') }}" class="{{ route('users') === url()->current() ? 'active' : '' }}">Users</a></li>
                <li><a href="{{ route('roles') }}" class="{{ route('roles') === url()->current() ? 'active' : '' }}">Roles</a></li>
                <li><a href="{{ route('permissions') }}" class="{{ route('permissions') === url()->current() ? 'active' : '' }}">Permissions</a></li>
            </ul>
        </details>
    </li>

</ul>

