<div class="drawer-side shadow-md">
    <label for="sidebar" class="drawer-overlay"></label>
    <ul class="menu p-4 w-72 h-full space-y-1 bg-base-100 text-base-content">
        <li>
            <a href="{{ route('dshb.index') }}">
                <x-icons.gauge class="w-5 h-5 stroke-current" />
                Dashboard
            </a>
        </li>
        <li>
            <a>
                <x-icons.database class="w-5 h-5 stroke-current" />
                Data Latih & Uji
            </a>
        </li>
        <li>
            <a>
                <x-icons.cpu class="w-5 h-5 stroke-current" />
                KNN
            </a>
        </li>
    </ul>
</div>
