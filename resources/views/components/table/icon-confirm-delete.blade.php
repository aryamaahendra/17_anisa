@props(['url'])

<form x-data="confirmDeleteModal" action="{{ $url }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="button" x-on:click="showModal"
        class="btn btn-square btn-sm btn-ghost text-error hover:bg-error hover:text-error-content">
        <x-icons.trash class="w-5 h-5 stroke-current" />
    </button>
</form>
