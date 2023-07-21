<div class="">

    <div class="navbar bg-neutral text-neutral-content">
        <div class="navbar-start">
            <div class="drawer">
                <input id="my-drawer" type="checkbox" class="drawer-toggle" />
                <div class="drawer-content">
                    <!-- Page content here -->
                    <label for="my-drawer" class="btn btn-ghost btn-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
                    </label>
                </div>
                <div class="drawer-side z-[1]">
                    <label for="my-drawer" class="drawer-overlay"></label>

                        @include('includes.menu')


                </div>
            </div>
        </div>
        <div class="navbar-center">
            <a class="btn btn-ghost normal-case text-xl">LWApp</a>
        </div>
        <div class="navbar-end">
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img src="{{ auth()->user()->avatarUrl() }}" />
                    </div>
                </label>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52 text-neutral">
                    <li>
                        <a class="justify-between" href="{{ route('profile') }}">
                            Profile
                        </a>
                    </li>
                    <li><a>Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container mx-auto px-4 py-8">
        <div class="card w-full h-screen bg-base-100 shadow-xl">
            @yield('content')
        </div>

    </div>
</div>
<footer class="footer footer-center p-4 bg-base-300 text-base-content">
    <div>
        <p>Copyright © 2023 - All right reserved by ACME Industries Ltd</p>
    </div>
</footer>

