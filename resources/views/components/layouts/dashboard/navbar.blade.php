<div class="navbar bg-base-100 rounded-lg shadow-md">
    <div class="flex-none">
        <label for="sidebar" class="btn btn-square btn-ghost lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                class="inline-block w-5 h-5 stroke-current">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </label>
    </div>
    <div class="flex-1">
        <a class="btn btn-ghost normal-case text-xl lg:hidden">K-BERAS</a>
    </div>
    <div class="flex-none">
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                    <img src="https://api.dicebear.com/6.x/fun-emoji/jpg" />
                </div>
            </label>
            <ul tabindex="0"
                class="menu dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-lg w-44">
                {{-- <li>
                    <a>
                        <x-icons.setting class="w-5 h-5 stroke-current" />
                        Settings
                    </a>
                </li> --}}
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button class="flex gap-2">
                            <x-icons.logout class="w-5 h-5 stroke-current" />
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
