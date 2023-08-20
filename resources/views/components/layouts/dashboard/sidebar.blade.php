<div class="drawer-side shadow-md">
    <label for="sidebar" class="drawer-overlay"></label>
    <div class="bg-base-100 pt-4 flex items-center px-8">
        <div class="flex items-center py-2 h-16 w-full font-semibold normal-case text-2xl">
            <div class="">K-BERAS</div>
        </div>
    </div>

    <ul class="menu p-4 w-72 h-full space-y-1 bg-base-100 text-base-content">
        <li>
            <a href="{{ route('dshb.index') }}">
                <x-icons.gauge class="w-5 h-5 stroke-current" />
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('dshb.data.index') }}">
                <x-icons.database class="w-5 h-5 stroke-current" />
                Data
            </a>
        </li>
        <li>
            <a href="{{ route('dshb.history.index') }}">
                <x-icons.clock class="w-5 h-5 stroke-current" />
                History
            </a>
        </li>
        <li>
            <a href="{{ route('dshb.knn.index') }}">
                <x-icons.cpu class="w-5 h-5 stroke-current" />
                KNN
            </a>
        </li>
        <li>
            <a href="{{ route('dshb.test.index') }}">
                <x-icons.file-percentage class="w-5 h-5 stroke-current" />
                Pengujian
            </a>
        </li>
    </ul>
</div>
