@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition class="alert bg-emerald-700 text-white shadow-lg mb-6 flex items-center justify-between rounded-xl p-4">
        <div class="flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
        <button @click="show = false" class="btn btn-sm btn-ghost btn-circle text-white">✕</button>
    </div>
@endif

@if (session('error'))
    <div x-data="{ show: true }" x-show="show" x-transition class="alert bg-bimba-strawberry text-white shadow-lg mb-6 flex items-center justify-between rounded-xl p-4">
        <div class="flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span class="font-medium text-sm">{{ session('error') }}</span>
        </div>
        <button @click="show = false" class="btn btn-sm btn-ghost btn-circle text-white">✕</button>
    </div>
@endif

@if (session('warning'))
    <div x-data="{ show: true }" x-show="show" x-transition class="alert bg-bimba-golden text-slate-900 shadow-lg mb-6 flex items-center justify-between rounded-xl p-4">
        <div class="flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            <span class="font-semibold text-sm">{{ session('warning') }}</span>
        </div>
        <button @click="show = false" class="btn btn-sm btn-ghost btn-circle text-slate-900">✕</button>
    </div>
@endif

@if ($errors->any())
    <div x-data="{ show: true }" x-show="show" x-transition class="alert bg-bimba-strawberry text-white shadow-lg mb-6 rounded-xl p-4">
        <div class="flex flex-col gap-1 w-full">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2 font-bold text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    Terdapat kesalahan pengisian data:
                </div>
                <button @click="show = false" class="btn btn-xs btn-ghost btn-circle text-white">✕</button>
            </div>
            <ul class="list-disc list-inside text-xs pl-6 mt-1 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
