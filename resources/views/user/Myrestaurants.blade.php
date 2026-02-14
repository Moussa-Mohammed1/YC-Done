<!DOCTYPE html>

<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Mes restaurants - Youco'Done</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;900&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#2beebd",
                        "background-light": "#f6f8f7",
                        "background-dark": "#10221d",
                        "sidebar-dark": "#0d1b18",
                    },
                    fontFamily: {
                        "display": ["Work Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Work Sans', sans-serif;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 transition-colors duration-200">
    <div class="flex min-h-screen">
        <!-- Sidebar Navigation -->
        @include('layouts.user-sidebar')
        <!-- Main Content Area -->
        <main class="flex-1 ml-72 p-8">

            <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Mes restaurants</h2>
                    <p class="text-slate-500 dark:text-slate-400 mt-1">Gérez vos établissements et vos réservations en
                        temps réel.</p>
                </div>
                <a href="{{ route('create.restaurant') }}"
                    class="bg-primary hover:bg-primary/90 text-slate-900 px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition-all shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined">add_circle</span>
                    Ajouter un nouveau restaurant
                </a>
            </div>
            <div
                class="bg-white dark:bg-slate-900 p-4 rounded-2xl border border-slate-200 dark:border-slate-800 mb-8 flex flex-col md:flex-row gap-4 shadow-sm">
                <div class="relative flex-1">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                    <input
                        class="w-full pl-10 pr-4 py-2.5 rounded-lg border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800 focus:ring-primary focus:border-primary text-sm transition-all"
                        placeholder="Rechercher par nom, ville ou cuisine..." type="text" />
                </div>
                <div class="flex gap-2">
                    <select
                        class="rounded-lg border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800 text-sm focus:ring-primary pr-10">
                        <option>Tous les statuts</option>
                        <option>Actif</option>
                        <option>En attente</option>
                        <option>Désactivé</option>
                    </select>
                    <button
                        class="px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 rounded-lg hover:bg-slate-200 transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">filter_list</span>
                        Filtres
                    </button>
                </div>
            </div>
            <!-- Restaurant Grid -->
            <div class="grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-6">
                @forelse($restaurants as $restaurant)
                <!-- Restaurant Card -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden group hover:shadow-xl transition-all duration-300">
                    <div class="relative h-48 overflow-hidden">
                        
                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                            alt="Photo de {{ $restaurant->nom }}"
                            src="{{$restaurant->photos->count() ? asset('storage/'. $restaurant->photos->first()->contenu)  : 'https://i.pinimg.com/736x/29/9a/54/299a5472e41588bb852ffc904b6e7bb4.jpg'}}" />
                        
                        <div class="absolute top-4 left-4">
                            @if($restaurant->status === 'ACTIVE')
                            <span
                                class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1 shadow-sm">
                                <span class="material-symbols-outlined text-xs">check_circle</span>
                                Actif
                            </span>
                            @else
                            <span
                                class="bg-amber-500 text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1 shadow-sm">
                                <span class="material-symbols-outlined text-xs">pending</span>
                                Inactif
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white">{{ $restaurant->nom }}</h3>
                            <button class="text-slate-400 hover:text-slate-900 dark:hover:text-white">
                                <span class="material-symbols-outlined">more_vert</span>
                            </button>
                        </div>
                        <p class="text-slate-500 dark:text-slate-400 text-sm mb-4">
                            @if($restaurant->typeCuisine)
                                {{ $restaurant->typeCuisine->nom }} •
                            @endif
                            {{ $restaurant->localisation }}
                        </p>
                        <div class="space-y-2 pt-2">
                            <a href="{{ route('reservations', $restaurant->id) }}"
                                class="w-full {{ $restaurant->status === 'ACTIVE' ? 'bg-primary hover:bg-primary/90 text-slate-900' : 'bg-primary/20 cursor-not-allowed text-slate-400' }} font-bold py-2.5 rounded-lg text-sm flex items-center justify-center gap-2 transition-colors">
                                <span class="material-symbols-outlined text-lg">event_available</span>
                                Gérer les réservations
</a>
                            <div class="grid grid-cols-2 gap-2">
                                <button
                                    class="bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-semibold py-2 rounded-lg text-xs flex items-center justify-center gap-1 transition-colors">
                                    <span class="material-symbols-outlined text-sm">edit</span>
                                    Modifier
                                </button>
                                <a href="{{ route('show.restaurant', $restaurant->id) }}"
                                    class="bg-transparent border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400 font-semibold py-2 rounded-lg text-xs flex items-center justify-center gap-1 transition-colors">
                                    <span class="material-symbols-outlined text-sm">visibility</span>
                                    Voir site
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <!-- Empty State -->
                <div class="col-span-full">
                    <div
                        class="bg-slate-100/50 dark:bg-slate-800/30 rounded-2xl border-2 border-dashed border-slate-300 dark:border-slate-700 flex flex-col items-center justify-center p-12 text-center">
                        <div
                            class="size-20 rounded-full bg-white dark:bg-slate-800 flex items-center justify-center text-slate-400 mb-4 shadow-sm">
                            <span class="material-symbols-outlined text-5xl">restaurant_menu</span>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Aucun restaurant pour le moment</h3>
                        <p class="text-sm text-slate-500 max-w-md mb-6">Commencez par ajouter votre premier restaurant pour gérer vos réservations et votre menu.</p>
                        <a href="{{ route('create.restaurant') }}"
                            class="bg-primary hover:bg-primary/90 text-slate-900 px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition-all shadow-lg shadow-primary/20">
                            <span class="material-symbols-outlined">add_circle</span>
                            Ajouter mon premier restaurant
                        </a>
                    </div>
                </div>
                @endforelse
                <!-- Empty State Card / Add New Template -->
                @if($restaurants->count() > 0)
                <a href="{{ route('create.restaurant') }}"
                    class="bg-slate-100/50 dark:bg-slate-800/30 rounded-2xl border-2 border-dashed border-slate-300 dark:border-slate-700 flex flex-col items-center justify-center p-8 text-center min-h-[400px] hover:border-primary/50 transition-colors group cursor-pointer">
                    <div
                        class="size-16 rounded-full bg-white dark:bg-slate-800 flex items-center justify-center text-slate-400 group-hover:text-primary transition-colors mb-4 shadow-sm">
                        <span class="material-symbols-outlined text-4xl">add</span>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Nouvel établissement</h3>
                    <p class="text-sm text-slate-500 max-w-[200px] mt-2">Cliquez ici pour configurer un nouveau
                        restaurant sur la plateforme.</p>
                </a>
                @endif
            </div>
        </main>
    </div>
</body>

</html>