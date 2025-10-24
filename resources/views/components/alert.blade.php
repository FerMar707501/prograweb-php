@if(session('success'))
    <div class="rounded-md bg-green-600 px-4 py-3 mb-4 text-sm text-white">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="rounded-md bg-red-600 px-4 py-3 mb-4 text-sm text-white">
        {{ session('error') }}
    </div>
@endif

@if(session('info'))
    <div class="rounded-md bg-blue-600 px-4 py-3 mb-4 text-sm text-white">
        {{ session('info') }}
    </div>
@endif

@if(session('warning'))
    <div class="rounded-md bg-yellow-600 px-4 py-3 mb-4 text-sm text-white">
        {{ session('warning') }}
    </div>
@endif
