<aside class="w-64 bg-background-dark border-r border-white/10 flex flex-col fixed inset-y-0 left-0 z-50">
            <div class="p-6 flex items-center gap-3">
                <div
                    class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center shadow-lg shadow-primary/20">
                    <img class="w-10 h-10 rounded-lg" src="https://i.pinimg.com/736x/1f/1f/31/1f1f31ea1bab3e9dc55ec45b3aa877fd.jpg" alt="">
                </div>
                <h1 class="text-white text-xl font-bold tracking-tight">Youco'Done <span class="text-yellow-500">Admin</span></h1>
            </div>
            <nav class="flex-1 px-4 py-4 space-y-1">
                <!-- Dashboard -->
                <a class="flex items-center gap-3 px-3 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'sidebar-active text-primary' : 'text-slate-400 hover:text-white hover:bg-white/5' }} transition-colors"
                    href="/dashboard">
                    <!-- <span class="material-symbols-outlined">dashboard</span> -->
                    <span class="font-medium text-sm">Dashboard</span>
                </a>

                <!-- Restaurants -->
                <a class="flex items-center gap-3 px-3 py-3 rounded-lg {{ request()->routeIs('admin.restaurants') ? 'sidebar-active text-primary' : 'text-slate-400 hover:text-white hover:bg-white/5' }} transition-colors"
                    href="{{ route('admin.restaurants') }}">
                    <!-- <span class="material-symbols-outlined">storefront</span> -->
                    <span class="font-medium text-sm">Restaurants</span>
                </a>

                <!-- Permissions -->
                <a class="flex items-center gap-3 px-3 py-3 rounded-lg {{ request()->routeIs('admin.permissions') ? 'sidebar-active text-primary' : 'text-slate-400 hover:text-white hover:bg-white/5' }} transition-colors"
                    href="{{ route('admin.permissions') }}">
                    <!-- <span class="material-symbols-outlined">shield_person</span> -->
                    <span class="font-medium text-sm">Rôles & Permissions</span>
                </a>
            </nav>
            <div class="p-4 border-t border-white/10">
                <form action="{{ route('logout') }}" method="POST" class="flex items-center gap-3 px-3 py-3 rounded-lg text-red-400 hover:bg-red-500/10 transition-colors">
                    @csrf

                    <span class="material-symbols-outlined">logout</span>
                    <button type="submit" class="font-medium text-sm">Déconnexion</button>
                </form>
            </div>
        </aside>