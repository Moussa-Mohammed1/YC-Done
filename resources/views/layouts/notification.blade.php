<div class="relative inline-block text-left">
    @php
        $unreadNotifications = auth()->user()->unreadNotifications;
    @endphp

    <button id="notif-button"
        class="flex items-center gap-2 px-4 py-2 hover:bg-slate-50 dark:hover:bg-white/5 rounded-lg transition-all border border-transparent hover:border-slate-200 dark:hover:border-slate-700">
        <span class="material-symbols-outlined text-slate-500">notifications</span>
        @if ($unreadNotifications->count() > 0)
        <span class="absolute top-2 right-2 h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
        @endif
    </button>

    <div id="notif-dropdown"
        class="hidden absolute right-0 mt-2 w-80 origin-top-right rounded-xl bg-white shadow-2xl ring-1 ring-black ring-opacity-5 z-50 overflow-hidden">

        <div class="px-4 py-3 border-b border-gray-100 flex justify-between items-center">
            <span class="text-sm font-bold text-gray-900">Notifications</span>
            @if ($unreadNotifications->count() > 0)
            <span class="text-[10px] bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full uppercase font-bold">{{ $unreadNotifications->count() }}
                New</span>
            @endif
        </div>

        <div class="max-h-96 overflow-y-auto">
            @forelse ($unreadNotifications as $notification)
                <a href="#" class="flex p-4 hover:bg-gray-50 border-b border-gray-50 transition">
                    
                    <div class="ml-3">
                        <p class="text-sm text-gray-800 leading-snug">
                            <span class="font-semibold">{{ $notification->data['restaurant_nom'] ?? 'System' }}:</span> 
                            {{ $notification->data['message'] ?? 'You have a new notification' }}
                        </p>
                        <p class="text-xs text-gray-400 mt-1">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</p>
                    </div>
                </a>
            @empty
                <div class="p-4 text-center text-sm text-gray-500">
                    No new notifications
                </div>
            @endforelse
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('notif-button');
        const dropdown = document.getElementById('notif-dropdown');

        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!dropdown.contains(e.target) && !btn.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') dropdown.classList.add('hidden');
        });
    });
</script>