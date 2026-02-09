<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Ajouter un restaurant - Youco'Done</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;900&amp;display=swap"
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
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style type="text/tailwindcss">
        body { font-family: 'Work Sans', sans-serif; }
        .form-card { @apply bg-white dark:bg-[#152e28] rounded-xl shadow-sm border border-[#cfe7e1] dark:border-[#24423a] p-8 mb-8; }
        .section-title { @apply flex items-center gap-3 mb-6; }
        .field-label { @apply block text-sm font-semibold text-[#0d1b18] dark:text-white mb-2; }
        .field-input { @apply w-full rounded-lg border-[#cfe7e1] dark:border-[#24423a] bg-background-light dark:bg-[#10221d] focus:border-primary focus:ring-primary h-12 px-4 transition-all; }
        .field-textarea { @apply w-full rounded-lg border-[#cfe7e1] dark:border-[#24423a] bg-background-light dark:bg-[#10221d] focus:border-primary focus:ring-primary p-4 transition-all; }
        .sidebar-item-active { background-color: rgba(43, 238, 189, 0.15); border-left: 4px solid #2beebd; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-[#0d1b18] dark:text-white antialiased">
    @include('layouts.user-sidebar')
    <div class="ml-72">
        <div class="flex flex-col h-screen overflow-hidden">
            <header
                class="bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md px-10 py-6 border-b border-[#cfe7e1] dark:border-[#24423a] flex justify-between items-center shrink-0">
                <div>
                    <h2 class="text-2xl font-black tracking-tight text-[#0d1b18] dark:text-white">Nouveau Restaurant
                    </h2>
                    <p class="text-[#4c9a86] text-sm mt-1">Complétez les informations ci-dessous pour créer votre fiche.
                    </p>
                </div>
                <div
                    class="flex items-center gap-2 text-xs font-medium bg-white dark:bg-[#152e28] px-3 py-1.5 rounded-full border border-[#cfe7e1] dark:border-[#24423a]">
                    <span class="flex h-2 w-2 rounded-full bg-primary animate-pulse"></span>
                    <span class="text-[#4c9a86]">Brouillon enregistré à 14:32</span>
                </div>
            </header>
            <main class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark scroll-smooth pb-32">
                <div class="max-w-4xl mx-auto py-10 px-6">
                    @if(session('success'))
                        <div
                            class="bg-green-500/10 border border-green-500 text-green-700 dark:text-green-400 px-6 py-4 rounded-xl mb-6 flex items-center gap-3">
                            <span class="material-symbols-outlined">check_circle</span>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif


                    <form id="restaurant-form" action="{{ route('store.restaurant') }}" method="POST">
                        @csrf
                        <section class="form-card">
                            <div class="section-title">
                                <span
                                    class="material-symbols-outlined text-primary p-2 bg-primary/10 rounded-lg">info</span>
                                <h3 class="text-xl font-bold">1. Informations générales</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="col-span-2">
                                    <label class="field-label">Nom du restaurant *</label>
                                    <input class="field-input" name="nom" placeholder="Ex: Le Petit Bistro Gourmand"
                                        type="text" required value="{{ old('nom') }}" />
                                    @error('nom')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <label class="field-label">Type de cuisine *</label>
                                    <select class="field-input appearance-none" name="typeCuisine_id" required>
                                        <option value="">Sélectionnez une catégorie</option>
                                        @foreach($typeCuisines as $type)
                                            <option value="{{ $type->id }}" {{ old('typeCuisine_id') == $type->id ? 'selected' : '' }}>
                                                {{ $type->titre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('typeCuisine_id')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <label class="field-label">Capacité (nombre de places) *</label>
                                    <input class="field-input" name="capacite" placeholder="Ex: 50" type="number"
                                        min="1" required value="{{ old('capacite') }}" />
                                    @error('capacite')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-span-2">
                                    <label class="field-label">Statut</label>
                                    <select class="field-input appearance-none" name="status">
                                        <option value="ACTIVE" {{ old('status') == 'ACTIVE' ? 'selected' : '' }}>Actif
                                        </option>
                                        <option value="INACTIVE" {{ old('status') == 'INACTIVE' ? 'selected' : '' }}>
                                            Inactif</option>
                                    </select>
                                </div>
                            </div>
                        </section>
                        <section class="form-card">
                            <div class="section-title">
                                <span
                                    class="material-symbols-outlined text-primary p-2 bg-primary/10 rounded-lg">location_on</span>
                                <h3 class="text-xl font-bold">2. Localisation</h3>
                            </div>
                            <div class="grid grid-cols-1 gap-6">
                                <div class="col-span-1">
                                    <label class="field-label">Adresse complète *</label>
                                    <input class="field-input" name="localisation"
                                        placeholder="123 Rue de la Gastronomie, 75001 Paris" type="text" required
                                        value="{{ old('localisation') }}" />
                                    @error('localisation')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </section>
                        <section class="form-card">
                            <div class="section-title">
                                <span
                                    class="material-symbols-outlined text-primary p-2 bg-primary/10 rounded-lg">schedule</span>
                                <h3 class="text-xl font-bold">3. Horaires d'ouverture</h3>
                            </div>
                            <div class="space-y-4">
                                <p class="text-sm text-[#4c9a86]">Ajoutez les horaires d'ouverture de votre restaurant
                                    (optionnel)</p>
                                <div id="horaires-container" class="space-y-3">
                                    <div
                                        class="horaire-row grid grid-cols-1 md:grid-cols-12 gap-3 p-3 bg-background-light dark:bg-[#10221d] rounded-lg">
                                        <div class="md:col-span-4">
                                            <select
                                                class="w-full text-sm rounded-lg border-[#cfe7e1] dark:border-[#24423a] bg-white dark:bg-background-dark focus:ring-primary"
                                                name="horaires[0][jourSemaine]">
                                                <option value="Lundi">Lundi</option>
                                                <option value="Mardi">Mardi</option>
                                                <option value="Mercredi">Mercredi</option>
                                                <option value="Jeudi">Jeudi</option>
                                                <option value="Vendredi">Vendredi</option>
                                                <option value="Samedi">Samedi</option>
                                                <option value="Dimanche">Dimanche</option>
                                            </select>
                                        </div>
                                        <div class="md:col-span-3">
                                            <input
                                                class="w-full text-sm rounded-lg border-[#cfe7e1] dark:border-[#24423a] bg-white dark:bg-background-dark focus:ring-primary"
                                                type="time" name="horaires[0][heureOuverture]" placeholder="09:00" />
                                        </div>
                                        <div class="md:col-span-1 flex items-center justify-center">
                                            <span class="text-[#4c9a86] font-bold">à</span>
                                        </div>
                                        <div class="md:col-span-3">
                                            <input
                                                class="w-full text-sm rounded-lg border-[#cfe7e1] dark:border-[#24423a] bg-white dark:bg-background-dark focus:ring-primary"
                                                type="time" name="horaires[0][heureFermeture]" placeholder="22:00" />
                                        </div>
                                        <div class="md:col-span-1 flex items-center">
                                            <button type="button" onclick="this.closest('.horaire-row').remove()"
                                                class="text-red-500 hover:text-red-700">
                                                <span class="material-symbols-outlined">delete</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="form-card">
                            <div class="section-title">
                                <span
                                    class="material-symbols-outlined text-primary p-2 bg-primary/10 rounded-lg">photo_library</span>
                                <h3 class="text-xl font-bold">4. Médias</h3>
                            </div>
                            <div class="space-y-4">
                                <label class="field-label">Photos de l'établissement</label>
                                <div
                                    class="border-2 border-dashed border-[#cfe7e1] dark:border-[#24423a] rounded-xl p-12 text-center hover:border-primary transition-colors cursor-pointer group">
                                    <span
                                        class="material-symbols-outlined text-4xl text-[#4c9a86] group-hover:text-primary mb-4 block">cloud_upload</span>
                                    <p class="text-sm font-semibold mb-1">Cliquez pour ajouter des photos</p>
                                    <p class="text-xs text-[#4c9a86]">Format PNG, JPG ou WEBP (Max. 5MB par fichier)</p>
                                </div>
                                <div class="grid grid-cols-4 gap-4 mt-6">
                                    <div
                                        class="aspect-square bg-background-light dark:bg-[#10221d] rounded-lg flex items-center justify-center border border-[#cfe7e1] dark:border-[#24423a]">
                                        <span class="material-symbols-outlined text-[#4c9a86]">image</span>
                                    </div>
                                    <div
                                        class="aspect-square bg-background-light dark:bg-[#10221d] rounded-lg flex items-center justify-center border border-[#cfe7e1] dark:border-[#24423a]">
                                        <span class="material-symbols-outlined text-[#4c9a86]">image</span>
                                    </div>
                                    <div
                                        class="aspect-square bg-background-light dark:bg-[#10221d] rounded-lg flex items-center justify-center border border-[#cfe7e1] dark:border-[#24423a]">
                                        <span class="material-symbols-outlined text-[#4c9a86]">image</span>
                                    </div>
                                    <div
                                        class="aspect-square bg-background-light dark:bg-[#10221d] rounded-lg border-2 border-dashed border-[#cfe7e1] dark:border-[#24423a] flex items-center justify-center text-[#4c9a86] hover:text-primary hover:border-primary cursor-pointer transition-all">
                                        <span class="material-symbols-outlined">add</span>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <footer class="mt-12 py-8 text-center text-sm text-[#4c9a86]">
                            © 2024 Youco'Done. Tous droits réservés. Besoin d'aide ? <a
                                class="text-primary hover:underline" href="#">Contactez le support</a>.
                        </footer>
                </div>
            </main>
            <footer
                class="sticky bottom-0 bg-white/90 dark:bg-[#152e28]/90 backdrop-blur-md px-10 py-5 border-t border-[#cfe7e1] dark:border-[#24423a] flex justify-end gap-4 shrink-0 shadow-2xl">
                <button
                    class="px-8 py-3 rounded-lg border border-[#cfe7e1] dark:border-[#24423a] text-[#4c9a86] font-semibold hover:bg-background-light dark:hover:bg-[#10221d] transition-all">
                    Sauvegarder en brouillon
                </button>
                <button
                    class="flex items-center gap-2 px-10 py-3 rounded-lg bg-primary text-background-dark font-bold hover:brightness-105 transition-all shadow-lg shadow-primary/20">
                    Publier le restaurant
                    <span class="material-symbols-outlined">rocket_launch</span>
                </button>
            </footer>
        </div>
    </div>
    <div class="fixed bottom-32 right-8 z-50">
        <button
            class="bg-primary text-background-dark size-14 rounded-full shadow-xl shadow-primary/30 flex items-center justify-center hover:scale-110 transition-transform">
            <span class="material-symbols-outlined font-bold">chat_bubble</span>
        </button>
    </div>

</body>

</html>