<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Mes favoris - Youco'Done</title>
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
                    <h2 class="text-xl font-bold tracking-tight">Mes favoris</h2>
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
                        <span class="pr-4 text-sm font-semibold group-hover:text-primary">{{ auth()->user()->name }}</span>
                    </button>
                </div>
            </header>
            <div class="p-8 space-y-8 max-w-[1400px] w-full mx-auto">
                @if($restaurants->isEmpty())
                    <div class="text-center py-16">
                        <span class="material-symbols-outlined text-6xl text-slate-300 mb-4 block">favorite_border</span>
                        <h3 class="text-xl font-bold text-slate-600 mb-2">Aucun favori pour le moment</h3>
                        <p class="text-slate-400">Commencez à ajouter des restaurants à vos favoris!</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($restaurants as $restaurant)
                            <div
                                class="bg-white dark:bg-white/5 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden group shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col">
                                <div class="h-48 bg-cover bg-center relative"
                                    style="background-image: url('{{ $restaurant->photos->first() ? asset('storage/'  . $restaurant->photos->first()->contenu) : "https://i.pinimg.com/736x/32/df/98/32df982ae4b0c2c168bf1e7e2986b6e7.jpg" }}')">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                    <button data-restaurant-id="{{ $restaurant->id }}"
                                        class="favoris-btn absolute top-3 right-3 h-9 w-9 bg-white/90 dark:bg-sidebar-dark/90 text-slate-400 hover:text-red-500 rounded-full flex items-center justify-center shadow-md transition-colors">
                                        <span class="material-symbols-outlined text-red-500 text-[20px]"
                                            style="font-variation-settings: 'FILL' 1;">
                                            favorite
                                        </span>
                                    </button>
                                    <div class="absolute bottom-3 left-3 flex gap-2">
                                        <span
                                            class="px-2 py-1 bg-primary text-sidebar-dark text-[10px] font-black rounded uppercase tracking-tighter">{{ $restaurant->typeCuisine->titre ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="p-5 flex flex-col flex-1">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="font-black text-lg group-hover:text-primary transition-colors">
                                            {{ $restaurant->nom }}
                                        </h4>
                                    </div>
                                    <p class="text-sm text-slate-500 mb-6 flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px]">location_on</span>
                                        {{ $restaurant->localisation }}
                                    </p>
                                    <div class="mt-auto">
                                        <a href="{{ route('show.restaurant', $restaurant->id) }}"
                                            class="w-full py-3 bg-primary text-sidebar-dark font-black text-sm rounded-xl hover:brightness-110 transition-all shadow-lg shadow-primary/20">Réserver
                                            une table</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div id="toast-container"></div>

            <script>
                // Use event delegation for dynamically updated content
                document.addEventListener('click', function (e) {
                    let btn = e.target.closest('.favoris-btn');
                    if (!btn) return;


                    let restaurantId = btn.dataset.restaurantId;
                    let userId = {{ auth()->user()->id }};
                    deleteFavoris(restaurantId, userId);
                });

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