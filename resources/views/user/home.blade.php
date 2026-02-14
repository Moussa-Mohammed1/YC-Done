<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Tableau de bord Unifié Youco'Done</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;800;900&amp;display=swap"
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

        .sidebar-item-active {
            background-color: rgba(43, 238, 189, 0.15);
            border-left: 4px solid #2beebd;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        #toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        .toast {
            background: #323232;
            color: #fff;
            padding: 12px 18px;
            margin-bottom: 10px;
            border-radius: 6px;
            font-size: 14px;
            min-width: 220px;
            opacity: 0;
            transform: translateX(20px);
            transition: all 0.3s ease;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(0);
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 font-display">
    <div class="flex min-h-screen">
        @include('layouts.user-sidebar')
        <main class="flex-1 ml-72 flex flex-col min-w-0">
            <header
                class="h-20 bg-white dark:bg-background-dark border-b border-slate-200 dark:border-slate-800 px-8 flex items-center justify-between sticky top-0 z-40">
                <div class="flex items-center gap-4">
                    <h2 class="text-lg font-semibold">Bonjour, <span
                            class="text-primary font-bold">{{ auth()->user()->name }}</span>
                    </h2>
                    <span
                        class="px-3 py-1 bg-primary/20 text-primary text-[11px] font-bold rounded-full uppercase tracking-wider">Mode
                        Hybride</span>
                </div>
                <div class="flex items-center gap-6">
                    <div class="relative group">
                        @include('layouts.notification')
                    </div>
                    <button
                        class="flex items-center gap-3 px-1.5 py-1.5 bg-slate-100 dark:bg-white/5 hover:bg-primary/10 rounded-full transition-all group">
                        <div class="h-8 w-8 rounded-full bg-cover bg-center ring-2 ring-primary/30"
                            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAqROC7YrE3MDcAd7g0pkQdnXefYJD5s5RTrVFEkxoMcn2zDeD7Wp-l8G9WCyvugaSMoOzFATppwQKXrNPGZrLOHngOkBuHh_O3VCKaJq72dl8ePeqQLGgs9f8OdxVD93xSbzkNUX8Mgo0sj0hF4A2aa1h5lX-zyD4RUbJi7CZ4cSqIm2L_N0heldRgC1ERKMI7jfMNVbRUFG_kYMBFAIaHhtnvynQPdUeTqvgn7o1YaqiLltaFPuTk_5t0vcWsiv6fHc5vFR16K6A')">
                        </div>
                        <span class="pr-4 text-sm font-semibold group-hover:text-primary">Mon Profil</span>
                    </button>
                </div>
            </header>

            <div class="p-8 space-y-8 max-w-[1400px]">
                <div class="relative bg-sidebar-dark rounded-2xl p-10 overflow-hidden shadow-2xl">
                    <div class="absolute inset-0 opacity-10 pointer-events-none bg-center bg-cover"
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBFAjb3Ds24P8QT9ckwS1wAwQjdR8SoXkeNLkUp6YwOOZ85QhyN67K2A522NRqpfX152j8DvXW55eQnjUt9DU2tNN0EuM9CXIUhWgSgwRkZwGsEOeQxJxaH-Rg1iXait0o22x3QXOFBHfH5of0lm9nlG2ulVJ8pDMxDHzP2gbRdRcWwBiXVgBlSMcEqGAndnxOZtjv14AyKSHENovRde6JWEVTk-levT31upDcY0oQSMPgKa790wbAi4-pYdtEycSpB9qAfVtW9Y4M')">
                    </div>
                    <div class="relative z-10 space-y-6">
                        <div class="flex flex-col gap-2">
                            <h1 class="text-4xl font-black text-white tracking-tight">Où souhaitez-vous manger ?</h1>
                            <p class="text-slate-400 text-lg">Découvrez les meilleures tables et réservez
                                instantanément.</p>
                        </div>
                        <form action="/home" method="GET"
                            class="max-w-3xl flex flex-col gap-3 bg-white/10 p-4 rounded-xl backdrop-blur-md border border-white/20">
                            @csrf
                            <div class="grid grid-cols-1 gap-3">
                                <div class="relative flex items-center">
                                    <span class="material-symbols-outlined absolute left-4 text-slate-400">search</span>
                                    <input id="query" name="query" value="{{ request('query') }}"
                                        class="w-full bg-white/10 border border-white/20 text-white placeholder-slate-400 pl-12 py-3 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                        placeholder="Nom du restaurant, ville, type cuisine..." type="text" />
                                </div>

                            </div>
                            <div class="flex flex-col md:flex-row gap-3 items-stretch md:items-center">
                                <div class="flex-1 relative flex items-center">
                                    <span
                                        class="material-symbols-outlined absolute left-4 text-slate-400">schedule</span>
                                    <select id="horaire" name="horaire"
                                        class="w-full bg-white/10 border border-white/20 text-white pl-12 py-3 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent appearance-none cursor-pointer">
                                        <option value="" class="bg-sidebar-dark">Plage horaire...</option>
                                        <option value="11:00-13:00" {{ request('horaire') == '11:00-13:00' ? 'selected' : '' }} class="bg-sidebar-dark">Déjeuner (11h00 - 13h00)</option>
                                        <option value="13:00-15:00" {{ request('horaire') == '13:00-15:00' ? 'selected' : '' }} class="bg-sidebar-dark">Après-midi (13h00 - 15h00)</option>
                                        <option value="19:00-21:00" {{ request('horaire') == '19:00-21:00' ? 'selected' : '' }} class="bg-sidebar-dark">Dîner (19h00 - 21h00)</option>
                                        <option value="21:00-23:00" {{ request('horaire') == '21:00-23:00' ? 'selected' : '' }} class="bg-sidebar-dark">Soirée (21h00 - 23h00)</option>
                                    </select>
                                </div>
                                <div class="flex gap-2">
                                    <button type="submit"
                                        class="bg-primary text-sidebar-dark font-black px-8 py-3 rounded-lg hover:brightness-110 transition-all flex items-center justify-center gap-2 whitespace-nowrap">
                                        <span class="material-symbols-outlined">search</span>
                                        Explorer
                                    </button>
                                    @if(request()->hasAny(['query', 'ville', 'type_cuisine', 'horaire']))
                                        <a href="/home"
                                            class="bg-white/10 border border-white/20 text-white font-bold px-6 py-3 rounded-lg hover:bg-white/20 transition-all flex items-center justify-center gap-2 whitespace-nowrap">
                                            <span class="material-symbols-outlined">close</span>
                                            Réinitialiser
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="text-[10px] text-slate-500 font-bold uppercase tracking-widest pt-1">Suggestions:</span>
                            <button
                                class="px-3 py-1 bg-white/5 hover:bg-white/10 text-slate-300 text-xs rounded-full border border-white/10 transition-colors">Italien</button>
                            <button
                                class="px-3 py-1 bg-white/5 hover:bg-white/10 text-slate-300 text-xs rounded-full border border-white/10 transition-colors">Sushi</button>
                            <button
                                class="px-3 py-1 bg-white/5 hover:bg-white/10 text-slate-300 text-xs rounded-full border border-white/10 transition-colors">Bistronomie</button>
                            <button
                                class="px-3 py-1 bg-white/5 hover:bg-white/10 text-slate-300 text-xs rounded-full border border-white/10 transition-colors">Terrasse</button>
                        </div>
                    </div>
                </div>
                <section class="space-y-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-black tracking-tight flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">auto_awesome</span>
                                Découvrir des restaurants
                            </h2>
                            <p class="text-slate-500 text-sm">Les pépites du moment sélectionnées pour vous</p>
                        </div>
                        <button class="text-primary font-bold text-sm hover:underline flex items-center gap-1">
                            Voir tout <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </button>
                    </div>
                    <div id="restaurants" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                        @foreach($restaurants as $restaurant)
                            <div
                                class="bg-white dark:bg-white/5 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden group shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                                <div class="h-44 bg-cover bg-center relative"
                                    style="background-image: url('{{ $restaurant->photos->first() ? asset('storage/' . $restaurant->photos->first()->contenu) : 'https://i.pinimg.com/1200x/b8/d9/d6/b8d9d64172e2ecc90fe016692c856c97.jpg' }}')">
                                    <!-- <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div> -->
                                    <button data-restaurant-id="{{ $restaurant->id }}"
                                        data-is-favoris="{{ $restaurant->isFavoris ? 'true' : 'false' }}"
                                        class="favoris-btn absolute top-3 right-3 h-9 w-9 bg-white/90 dark:bg-sidebar-dark/90 text-slate-400 hover:text-red-500 rounded-full flex items-center justify-center shadow-md transition-colors">
                                        <span class="material-symbols-outlined text text-[20px]"
                                            style="{{ $restaurant->isFavoris ? 'font-variation-settings: \'FILL\' 1;' : '' }}">
                                            favorite
                                        </span>
                                    </button>
                                    <span
                                        class="absolute bottom-3 left-3 px-2 py-1 bg-primary text-sidebar-dark text-[10px] font-black rounded uppercase tracking-tighter">{{ $restaurant->typeCuisine->titre ?? 'Restaurant' }}</span>
                                </div>

                                <div class="p-5 flex flex-col flex-1">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="font-black text-lg group-hover:text-primary transition-colors">
                                            {{ $restaurant->nom }}
                                        </h4>
                                        <div
                                            class="flex items-center gap-1 text-amber-500 bg-amber-500/10 px-2 py-0.5 rounded">
                                            <span class="material-symbols-outlined text-[14px] fill-current">star</span>
                                            <span
                                                class="text-[11px] font-bold">{{ number_format($restaurant->note_moyenne ?? 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <p class="text-sm text-slate-500 mb-4 flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px]">location_on</span>
                                        {{ $restaurant->localisation}}
                                    </p>
                                    <div
                                        class="mt-auto pt-4 flex items-center justify-between border-t border-slate-100 dark:border-slate-800">
                                        <span
                                            class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ str_repeat('$', min($restaurant->gamme_prix ?? 2, 3)) }}</span>
                                        <a href="{{ route('show.restaurant', $restaurant->id) }}"
                                            class="px-5 py-2 bg-primary text-sidebar-dark font-black text-xs rounded-lg hover:brightness-110 transition-all">Réserver</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="flex flex-col ">
                            {{ $restaurants->links() }}
                        </div>
                        <div id="toast-container"></div>
                        <script>
                            // Use event delegation for dynamically updated content
                            document.addEventListener('click', function (e) {
                                let btn = e.target.closest('.favoris-btn');
                                if (!btn) return;

                                e.preventDefault();

                                let restaurantId = btn.dataset.restaurantId;
                                let isFavoris = btn.dataset.isFavoris === 'true';
                                let userId = {{ auth()->user()->id }};

                                if (isFavoris) {
                                    deleteFavoris(restaurantId, userId);
                                } else {
                                    addFavoris(restaurantId, userId);
                                }
                            });

                            function addFavoris(idr, idu) {
                                fetch('/favoris/add', {
                                    method: 'POST',
                                    headers: {
                                        'content-type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                                    },
                                    body: JSON.stringify({
                                        user_id: idu,
                                        restaurant_id: idr
                                    })
                                })
                                    .then(res => res.json())
                                    .then(data => {
                                        showToast(data.message);
                                        setTimeout(() => location.reload(), 1000);
                                    })
                                    .catch(err => {
                                        console.error('Error:', err);
                                        showToast('Erreur essayer une autre fois');
                                    });
                            }

                            function deleteFavoris(idr, idu) {
                                fetch('/favoris/delete', {
                                    method: 'DELETE',
                                    headers: {
                                        'content-type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                                    },
                                    body: JSON.stringify({
                                        user_id: idu,
                                        restaurant_id: idr
                                    })
                                })
                                    .then(res => res.json())
                                    .then(data => {
                                        showToast(data.message);
                                        setTimeout(() => location.reload(), 1000);
                                    })
                                    .catch(err => {
                                        console.error('Error:', err);
                                        showToast('Erreur lors de la suppression des favoris');
                                    });
                            }

                            function showToast(message, duration = 3000) {
                                let container = document.getElementById('toast-container');
                                let toast = document.createElement('div');
                                toast.className = 'toast';
                                toast.textContent = message;
                                container.appendChild(toast);
                                setTimeout(() => toast.classList.add('show'), 50);
                                setTimeout(() => {
                                    toast.classList.remove('show');
                                    setTimeout(() => toast.remove(), 300);
                                }, duration);
                            }
                        </script>
                    </div>
                </section>


                @if (auth()->user()->hasRole('restaurant_owner'))
                    <div class="grid grid-cols-12 gap-8">
                        <div class="col-span-12 lg:col-span-8 space-y-8">
                            <div
                                class="bg-white dark:bg-white/5 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
                                <div
                                    class="p-6 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                                    <h2 class="text-xl font-bold flex items-center gap-2">
                                        <span class="material-symbols-outlined text-primary">storefront</span>
                                        Gestion des établissements
                                    </h2>
                                    <a href="{{ route('create.restaurant') }}"
                                        class="px-4 py-2 bg-primary text-sidebar-dark font-bold text-sm rounded-lg hover:brightness-110 transition-all flex items-center gap-2">
                                        <span class="material-symbols-outlined text-[20px]">add</span>
                                        Ajouter un restaurant
                                    </a>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="w-full text-left border-collapse">
                                        <thead>
                                            <tr
                                                class="bg-slate-50/50 dark:bg-white/5 text-[11px] uppercase tracking-wider font-bold text-slate-500">
                                                <th class="px-6 py-4">Nom du Restaurant</th>
                                                <th class="px-6 py-4">Localisation</th>
                                                <th class="px-6 py-4">Statut</th>
                                                <th class="px-6 py-4 text-right">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                            @if ($userRestaurant->count())
                                                @foreach ($userRestaurant as $restaurant)
                                                    <tr class="hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">
                                                        <td class="px-6 py-4">
                                                            <div class="flex items-center gap-3">
                                                                <div class="h-10 w-10 rounded-lg bg-cover bg-center"
                                                                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBFAjb3Ds24P8QT9ckwS1wAwQjdR8SoXkeNLkUp6YwOOZ85QhyN67K2A522NRqpfX152j8DvXW55eQnjUt9DU2tNN0EuM9CXIUhWgSgwRkZwGsEOeQxJxaH-Rg1iXait0o22x3QXOFBHfH5of0lm9nlG2ulVJ8pDMxDHzP2gbRdRcWwBiXVgBlSMcEqGAndnxOZtjv14AyKSHENovRde6JWEVTk-levT31upDcY0oQSMPgKa790wbAi4-pYdtEycSpB9qAfVtW9Y4M')">
                                                                </div>
                                                                <span class="font-bold text-sm"> {{ $restaurant->nom }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 text-sm text-slate-500">{{ $restaurant->localisation }}
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <span
                                                                class="px-2 py-1 bg-green-100 dark:bg-green-500/20 text-green-700 dark:text-green-400 text-[10px] font-bold rounded uppercase tracking-tighter">{{ $restaurant->status }}</span>
                                                        </td>
                                                        <td class="px-6 py-4 text-right">
                                                            <a href="{{  }}"
                                                                class="px-3 py-1.5 border border-slate-200 dark:border-slate-700 text-xs font-bold rounded-lg hover:bg-slate-100 dark:hover:bg-white/10 transition-all">Gérer</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4" class="px-6 py-16">
                                                        <div class="flex flex-col items-center justify-center text-center">
                                                            <div
                                                                class="h-20 w-20 rounded-full bg-slate-100 dark:bg-white/5 flex items-center justify-center mb-4">
                                                                <span
                                                                    class="material-symbols-outlined text-slate-400 text-4xl">restaurant</span>
                                                            </div>
                                                            <h3
                                                                class="font-bold text-lg mb-2 text-slate-700 dark:text-slate-300">
                                                                Aucun restaurant pour le moment</h3>
                                                            <p class="text-sm text-slate-500 mb-6 max-w-md">Commencez votre
                                                                aventure culinaire en ajoutant votre premier établissement à la
                                                                plateforme.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="col-span-12 lg:col-span-4 space-y-8">
                            <div
                                class="bg-white dark:bg-white/5 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                                <div class="p-6 border-b border-slate-100 dark:border-slate-800">
                                    <h2 class="text-lg font-bold">Prochaines réservations</h2>
                                </div>
                                <div class="p-4 space-y-4">
                                    <div
                                        class="flex items-start gap-4 p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-white/5 transition-all group border border-transparent hover:border-slate-200 dark:hover:border-slate-800">
                                        <div
                                            class="h-12 w-12 rounded-lg bg-primary/20 flex flex-col items-center justify-center text-primary font-bold shrink-0">
                                            <span class="text-xs uppercase leading-none">Oct</span>
                                            <span class="text-xl">12</span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-bold text-sm truncate">Jean-Marc Valenti</h4>
                                            <p class="text-xs text-slate-500">20:30 • 4 Personnes</p>
                                            <p class="text-[10px] text-primary font-bold uppercase mt-1">Le Bistrot Gourmand
                                            </p>
                                        </div>
                                        <button
                                            class="h-8 w-8 flex items-center justify-center rounded-full hover:bg-slate-200 dark:hover:bg-slate-700">
                                            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="p-4 pt-0">
                                    <button
                                        class="w-full py-2 text-xs font-bold text-slate-500 dark:text-slate-400 hover:text-primary transition-colors text-center uppercase tracking-widest">Voir
                                        tout le calendrier</button>
                                </div>
                            </div>
                            <div
                                class="bg-white dark:bg-white/5 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                                <div class="p-6 border-b border-slate-100 dark:border-slate-800">
                                    <h2 class="text-lg font-bold">Activité récente</h2>
                                </div>
                                <div
                                    class="p-6 space-y-6 relative before:absolute before:left-[35px] before:top-8 before:bottom-8 before:w-[2px] before:bg-slate-100 dark:before:bg-slate-800">
                                    <div class="relative pl-10">
                                        <div
                                            class="absolute left-0 top-0 h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-4 ring-white dark:ring-background-dark z-10">
                                            <span
                                                class="material-symbols-outlined text-white text-[16px]">check_circle</span>
                                        </div>
                                        <p class="text-xs text-slate-500">Il y a 10 min</p>
                                        <p class="text-sm font-semibold">Réservation confirmée</p>
                                        <p class="text-xs text-slate-400">Pour M. Valenti au Bistrot Gourmand</p>
                                    </div>
                                    <div class="relative pl-10">
                                        <div
                                            class="absolute left-0 top-0 h-8 w-8 rounded-full bg-primary flex items-center justify-center ring-4 ring-white dark:ring-background-dark z-10 text-sidebar-dark">
                                            <span class="material-symbols-outlined text-[16px]">favorite</span>
                                        </div>
                                        <p class="text-xs text-slate-500">Il y a 2 heures</p>
                                        <p class="text-sm font-semibold">Nouveau favori</p>
                                        <p class="text-xs text-slate-400">Un utilisateur a ajouté "L'Escale Verte"</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-span-12 p-8 border-2 border-dashed border-primary/20 rounded-2xl bg-primary/5 flex flex-col items-center justify-center text-center">
                            <span class="material-symbols-outlined text-primary text-4xl mb-4">info</span>
                            <h3 class="font-bold text-lg mb-2">Interface Hybride Connectée</h3>
                            <p class="text-sm text-slate-500 max-w-lg">Cette vue unifiée combine les outils de gestion
                                restaurateur et les fonctionnalités de découverte client. Les accès sont modulables selon
                                vos permissions.</p>
                        </div>
                    </div>
                @endif
            </div>
            <footer
                class="mt-auto py-8 px-8 border-t border-slate-200 dark:border-slate-800 text-slate-400 text-[11px] uppercase tracking-widest flex justify-between">
                <div>© 2024 Youco'Done - Plateforme Unifiée</div>
                <div class="flex gap-4">
                    <a class="hover:text-primary transition-colors" href="#">Support</a>
                    <a class="hover:text-primary transition-colors" href="#">Documentation</a>
                    <a class="hover:text-primary transition-colors" href="#">Confidentialité</a>
                </div>
            </footer>
        </main>
    </div>

</body>

</html>