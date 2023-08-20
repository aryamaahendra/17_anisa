<div class="w-full max-w-md">
    @if (!is_null($processUuid) && is_null($process->class))
        <div wire:poll.keep-alive class="alert alert-warning shadow-md mb-3">
            <span class="loading loading-spinner loading-sm"></span>
            <span><strong class="font-semibold">Processing</strong>! please wait a minute</span>
        </div>
    @endif

    @if (!is_null($processUuid) && !is_null($process->class))
        <div class="alert alert-success mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6"
                fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Beras tergolong <strong>{{ $process->class }}</strong></span>
        </div>
    @endif

    <div wire:ignore wire:key="image-input" class="card bg-base-100 shadow-md">
        <div class="card-body">
            <h2 class="card-title">Upload gambar!</h2>
            <p class="text-muted mb-4">Proses akan di mulai otomatis saat gambar terupload.</p>

            <div x-data="KNNDashboard">
                <input type="file" name="image" x-ref="input">
            </div>
        </div>
    </div>
</div>
