<aside class="w-72 bg-sidebar-dark text-white flex flex-col fixed h-full z-50">
    <div class="p-6 flex items-center gap-3">
        <div class=" rounded-lg  flex items-center justify-center">
            <img src="https://i.pinimg.com/1200x/34/e3/d7/34e3d7a951e44e3076b68e9011c9a597.jpg"
                class=" rounded-lg w-10 h-10" />
        </div>
        <div>
            <h1 class="text-xl font-extrabold tracking-tight">Youco'Done</h1>
            <p class="text-[10px] uppercase tracking-widest text-primary/80 font-semibold leading-tight">Unified
                Portal</p>
        </div>
    </div>
    <nav class="flex-1 px-4 mt-6 space-y-2 overflow-y-auto custom-scrollbar">
        <a href="/home"
            class=" flex items-center gap-3 px-4 py-3 rounded-lg cursor-pointer transition-all">
            <span class="material-symbols-outlined text-primary">home</span>
            <span class="text-sm font-medium">Home</span>
        </a>
        <a href="/reservations"
            class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-lg cursor-pointer transition-all group">
            <span class="material-symbols-outlined text-slate-400 group-hover:text-primary">calendar_today</span>
            <span class="text-sm font-medium">Mes réservations</span>
        </a>
        <a href="/Restaurants"
            class="flex items-center gap-3 px-4 py-3 rounded-lg cursor-pointer transition-all">
            <span class="material-symbols-outlined text-slate-400">explore</span>
            <span class="text-sm font-medium">Découvrir</span>
        </a>
        <a href="/favoris"
            class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-lg cursor-pointer transition-all group">
            <span class="material-symbols-outlined text-slate-400 group-hover:text-primary">favorite</span>
            <span class="text-sm font-medium">Mes favoris</span>
        </a>
        @if(auth()->user()->hasRole('restaurant_owner'))
            <div class="pt-6 pb-2 px-4">
                <p class="text-[10px] uppercase font-bold text-slate-500 tracking-wider">Zone Restaurateur</p>
            </div>
            <a href="/mesRestaurants"
                class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-lg cursor-pointer transition-all group">
                <span class="material-symbols-outlined text-slate-400 group-hover:text-primary">storefront</span>
                <span class="text-sm font-medium">Mes restaurants</span>
            </a>
            <a href="/done"
                class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-lg cursor-pointer transition-all group">
                <span class="material-symbols-outlined text-slate-400 group-hover:text-primary">analytics</span>
                <span class="text-sm font-medium">Performances</span>
            </a>
        @endif
    </nav>
    <div class="p-4 mt-auto border-t border-white/10 space-y-2">
        <div class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-lg cursor-pointer transition-all group">
            <span class="material-symbols-outlined text-slate-400 group-hover:text-primary">settings</span>
            <span class="text-sm font-medium text-slate-300">Paramètres</span>
        </div>
        <form method="POST" action="/logout"
            class="flex items-center gap-3 px-4 py-3 hover:bg-red-500/10 rounded-lg cursor-pointer transition-all group">
            @csrf

            <span class="material-symbols-outlined text-red-400">logout</span>
            <button type="submit">
                <span class="text-sm font-medium text-red-400">Déconnexion</span>
            </button>
        </form>
    </div>
</aside>