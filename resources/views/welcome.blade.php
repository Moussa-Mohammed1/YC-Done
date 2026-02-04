<!DOCTYPE html>

<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Youco'Done - Réserver une table</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#2bee6c",
                        "background-light": "#f6f8f6",
                        "background-dark": "#102216",
                        "soft-cream": "#fffbf0", // Added for Hero background
                    },
                    fontFamily: {
                        "display": ["Plus Jakarta Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.375rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: "Plus Jakarta Sans", sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        /* Custom scrollbar for better aesthetics */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #dbe6df;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #2bee6c;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-[#111813] dark:text-white overflow-x-hidden w-full">
   @include('layouts.header')
    <!-- Hero Section -->
    <section class="relative w-full bg-soft-cream dark:bg-[#152a1d]">
        <!-- Decorative subtle pattern/gradient -->
        <div
            class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px] pointer-events-none">
        </div>
        <div
            class="absolute inset-0 bg-gradient-to-b from-transparent via-white/50 to-white dark:via-background-dark/50 dark:to-background-dark pointer-events-none">
        </div>
        <div
            class="layout-container relative flex flex-col items-center justify-center py-20 lg:py-32 px-4 sm:px-10 lg:px-40 text-center z-10">
            <div class="max-w-[800px] flex flex-col items-center gap-6">
                <span
                    class="inline-flex items-center gap-2 rounded-full bg-primary/20 px-3 py-1 text-xs font-bold text-[#0e632d] dark:text-[#2bee6c]">
                    <span class="size-2 rounded-full bg-primary"></span>
                    Nouveau sur Youco'Done
                </span>
                <h1
                    class="text-[#111813] dark:text-white text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.15] tracking-tight">
                    Réservez votre table en <span class="text-[#1ca049] dark:text-primary relative inline-block">
                        quelques clics
                        <svg class="absolute w-full h-3 -bottom-1 left-0 text-primary opacity-40" fill="none"
                            viewbox="0 0 200 9" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2.00025 6.99997C2.00025 6.99997 45.4268 4.65463 85.0003 3.99997C124.574 3.34531 198 2.00003 198 2.00003"
                                stroke="currentColor" stroke-linecap="round" stroke-width="3"></path>
                        </svg>
                    </span>
                </h1>
                <p class="text-gray-600 dark:text-gray-300 text-lg sm:text-xl font-normal leading-relaxed max-w-2xl">
                    La plateforme simple pour gourmets et restaurateurs. Trouvez le lieu idéal pour votre prochain repas
                    ou gérez vos réservations en toute simplicité.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-4 mt-4 w-full sm:w-auto">
                    <button
                        class="flex w-full sm:w-auto min-w-[200px] items-center justify-center rounded-xl h-12 px-8 bg-primary hover:bg-[#25d660] text-[#111813] text-base font-bold shadow-lg shadow-primary/20 transition-all transform ">
                        <span class="material-symbols-outlined mr-2 text-xl">search</span>
                        Trouver un restaurant
                    </button>
                    <button
                        class="flex w-full sm:w-auto min-w-[200px] items-center justify-center rounded-xl h-12 px-8 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-700 text-[#111813] dark:text-white text-base font-bold transition-all">
                        <span class="material-symbols-outlined mr-2 text-xl">storefront</span>
                        Devenir restaurateur
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- How it works Section -->
    <section class="py-20 bg-white dark:bg-background-dark">
        <div class="px-4 sm:px-10 lg:px-40">
            <div class="flex flex-col items-center mb-16 text-center">
                <h2 class="text-[#111813] dark:text-white text-3xl font-bold leading-tight tracking-tight mb-4">Comment
                    ça marche ?</h2>
                <p class="text-gray-500 dark:text-gray-400 max-w-lg text-center">Une expérience fluide de la découverte
                    à la dégustation.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-[1200px] mx-auto">
                <!-- Step 1 -->
                <div
                    class="group relative flex flex-col items-center text-center p-8 rounded-2xl bg-background-light dark:bg-[#1a2e23] border border-transparent hover:border-primary/30 transition-all duration-300 hover:shadow-xl hover:shadow-primary/5">
                    <div
                        class="absolute top-4 right-4 text-gray-200 dark:text-gray-700 text-6xl font-black opacity-30 select-none group-hover:text-primary/20 transition-colors">
                        1</div>
                    <div
                        class="size-16 rounded-full bg-white dark:bg-gray-800 shadow-sm flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined text-3xl">person_add</span>
                    </div>
                    <h3 class="text-[#111813] dark:text-white text-xl font-bold mb-3">Je crée un compte</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Inscrivez-vous gratuitement en
                        quelques secondes pour accéder à toutes les fonctionnalités.</p>
                </div>
                <!-- Step 2 -->
                <div
                    class="group relative flex flex-col items-center text-center p-8 rounded-2xl bg-background-light dark:bg-[#1a2e23] border border-transparent hover:border-primary/30 transition-all duration-300 hover:shadow-xl hover:shadow-primary/5">
                    <div
                        class="absolute top-4 right-4 text-gray-200 dark:text-gray-700 text-6xl font-black opacity-30 select-none group-hover:text-primary/20 transition-colors">
                        2</div>
                    <div
                        class="size-16 rounded-full bg-white dark:bg-gray-800 shadow-sm flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined text-3xl">restaurant_menu</span>
                    </div>
                    <h3 class="text-[#111813] dark:text-white text-xl font-bold mb-3">Je trouve un restaurant</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Filtrez par type de cuisine,
                        localisation et avis pour dénicher la perle rare.</p>
                </div>
                <!-- Step 3 -->
                <div
                    class="group relative flex flex-col items-center text-center p-8 rounded-2xl bg-background-light dark:bg-[#1a2e23] border border-transparent hover:border-primary/30 transition-all duration-300 hover:shadow-xl hover:shadow-primary/5">
                    <div
                        class="absolute top-4 right-4 text-gray-200 dark:text-gray-700 text-6xl font-black opacity-30 select-none group-hover:text-primary/20 transition-colors">
                        3</div>
                    <div
                        class="size-16 rounded-full bg-white dark:bg-gray-800 shadow-sm flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined text-3xl">calendar_check</span>
                    </div>
                    <h3 class="text-[#111813] dark:text-white text-xl font-bold mb-3">Je réserve</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Confirmez votre table
                        instantanément sans avoir besoin d'appeler.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Advantages Section -->
    <section class="py-20 bg-background-light dark:bg-[#15241b]">
        <div class="px-4 sm:px-10 lg:px-40 max-w-[1400px] mx-auto">
            <div class="flex flex-col md:flex-row gap-8 lg:gap-16">
                <!-- Left: For Clients -->
                <div
                    class="flex-1 rounded-3xl bg-white dark:bg-background-dark p-8 lg:p-12 shadow-sm border border-gray-100 dark:border-gray-800 relative overflow-hidden group">
                    <div
                        class="absolute top-0 right-0 p-32 bg-primary/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2">
                    </div>
                    <div class="flex items-center gap-3 mb-6">
                        <span
                            class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-full text-xs font-bold uppercase tracking-wider">Pour
                            les Clients</span>
                    </div>
                    <h2 class="text-3xl font-bold text-[#111813] dark:text-white mb-6">Simplicité et Découverte</h2>
                    <ul class="space-y-6 relative z-10">
                        <li class="flex items-start gap-4">
                            <div
                                class="mt-1 size-8 rounded-full bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400 shrink-0">
                                <span class="material-symbols-outlined text-sm font-bold">check</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#111813] dark:text-white mb-1">Réservation 24/7</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Réservez n'importe quand, même quand
                                    le restaurant est fermé.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div
                                class="mt-1 size-8 rounded-full bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400 shrink-0">
                                <span class="material-symbols-outlined text-sm font-bold">check</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#111813] dark:text-white mb-1">Programme de Fidélité</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Cumulez des points à chaque
                                    réservation et gagnez des repas.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div
                                class="mt-1 size-8 rounded-full bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400 shrink-0">
                                <span class="material-symbols-outlined text-sm font-bold">check</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#111813] dark:text-white mb-1">Avis Vérifiés</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Fiez-vous aux retours de la
                                    communauté pour vos choix.</p>
                            </div>
                        </li>
                    </ul>
                    <div class="mt-10">
                        <div class="w-full h-48 rounded-xl bg-gray-100 overflow-hidden"
                            data-alt="Happy friends dining together in a restaurant with warm lighting"
                            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB3Hk-TeHohDanuF_kWOW5dP3HwYZ4Rcf-YlSfifIwM4d8jzlIZ4_RMEjoL52NC2zbQjYrtGdbzqpJn559s5qnxMXznlpqk1jfCuBio_CvGjndGb1G2eV9HYxjUunfhqxdh8tk2rxFv9hWcgBlOYJ2InuTU0YvgE3zTv7OKdgaNv_tobyFUIZGk9Sv4UbJl0Lg3_9asi4V4ozaiZrvKWXXrRbD2Tzc24aIrd4xYjVJHF3lbd3tv9Q80aBvRXzoQ-3leJ3F8o7I3dtbe"); background-size: cover; background-position: center;'>
                        </div>
                    </div>
                </div>
                <!-- Right: For Restaurateurs -->
                <div
                    class="flex-1 rounded-3xl bg-[#111813] text-white p-8 lg:p-12 shadow-xl border border-gray-800 relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 p-32 bg-primary/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2">
                    </div>
                    <div class="flex items-center gap-3 mb-6">
                        <span
                            class="px-3 py-1 bg-primary/20 text-primary rounded-full text-xs font-bold uppercase tracking-wider">Pour
                            les Pros</span>
                    </div>
                    <h2 class="text-3xl font-bold mb-6">Gestion et Visibilité</h2>
                    <ul class="space-y-6 relative z-10">
                        <li class="flex items-start gap-4">
                            <div
                                class="mt-1 size-8 rounded-full bg-primary/20 flex items-center justify-center text-primary shrink-0">
                                <span class="material-symbols-outlined text-sm font-bold">check</span>
                            </div>
                            <div>
                                <h4 class="font-bold mb-1">Réduction des No-Shows</h4>
                                <p class="text-sm text-gray-400">Système de rappel automatique par SMS et email.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div
                                class="mt-1 size-8 rounded-full bg-primary/20 flex items-center justify-center text-primary shrink-0">
                                <span class="material-symbols-outlined text-sm font-bold">check</span>
                            </div>
                            <div>
                                <h4 class="font-bold mb-1">Plan de Salle Digital</h4>
                                <p class="text-sm text-gray-400">Assignez les tables en temps réel et optimisez vos
                                    services.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div
                                class="mt-1 size-8 rounded-full bg-primary/20 flex items-center justify-center text-primary shrink-0">
                                <span class="material-symbols-outlined text-sm font-bold">check</span>
                            </div>
                            <div>
                                <h4 class="font-bold mb-1">Visibilité Accrue</h4>
                                <p class="text-sm text-gray-400">Soyez visible auprès de milliers de gourmets locaux.
                                </p>
                            </div>
                        </li>
                    </ul>
                    <div class="mt-10">
                        <div class="w-full h-48 rounded-xl bg-gray-800 overflow-hidden opacity-80"
                            data-alt="Chef plating a dish in a professional kitchen environment"
                            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC132BOkynaF2YGQ7Fvak7NuVViedBpGK-2ykkmBSAeToyGewh6sLNFPC9nTJO44ND22W0VtPq2fzNuEI5qvntJSz8hVjjFFi-DHnvVukjADpwZVbe85Q84E3QzyuE9R_AicZECuFZx7nzPshqXa1ZcvfCwpdgKoZbjrTHK4WL8DPoQ7GZ7tDNm68r2AzkXNBibk6INGJkJMoIFl2iYaL4ojXqAF9uH07DSbse17KTY8xZ4m6EWQ5dgGT9eaLapt3xiniytj07DVj1T"); background-size: cover; background-position: center;'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>