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
        input[type="checkbox"]:checked + .checkbox-label {
            background-color: #2beebd;
            color: #0d1b18;
            border-color: #2beebd;
            font-weight: 600;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-[#0d1b18] dark:text-white antialiased">
    @include('layouts.user-sidebar')
    <div class="ml-72">
        <form class="flex flex-col h-screen overflow-hidden" action="{{ route('store.restaurant') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
                    <div id="restaurant-form">

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
                                <p class="text-sm text-[#4c9a86]">Définissez les horaires d'ouverture pour chaque jour
                                    de la semaine, choisir Fermé a votre comforte </p>
                                <div id="horaires-container" class="space-y-3">
                                    @php
                                        $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
                                    @endphp
                                    @foreach($jours as $index => $jour)
                                        <div
                                            class="horaire-row grid grid-cols-1 md:grid-cols-12 gap-3 p-3 bg-background-light dark:bg-[#10221d] rounded-lg">
                                            <div class="md:col-span-3 flex items-center">
                                                <input type="hidden" name="horaires[{{ $index }}][jourSemaine]"
                                                    value="{{ $jour }}">
                                                <span
                                                    class="text-sm font-semibold text-[#0d1b18] dark:text-white">{{ $jour }}</span>
                                            </div>
                                            <div class="md:col-span-3">
                                                <input
                                                    class="horaire-time-input w-full text-sm rounded-lg border-[#cfe7e1] dark:border-[#24423a] bg-white dark:bg-background-dark focus:ring-primary"
                                                    type="time" name="horaires[{{ $index }}][heureOuverture]"
                                                    placeholder="09:00" id="ouverture-{{ $index }}" />
                                            </div>
                                            <div class="md:col-span-1 flex items-center justify-center">
                                                <span class="text-[#4c9a86] font-bold">à</span>
                                            </div>
                                            <div class="md:col-span-3">
                                                <input
                                                    class="horaire-time-input w-full text-sm rounded-lg border-[#cfe7e1] dark:border-[#24423a] bg-white dark:bg-background-dark focus:ring-primary"
                                                    type="time" name="horaires[{{ $index }}][heureFermeture]"
                                                    placeholder="22:00" id="fermeture-{{ $index }}" />
                                            </div>
                                            <div class="md:col-span-2 flex items-center">
                                                <input id="ferme-{{ $index }}" type="checkbox"
                                                    name="horaires[{{ $index }}][ferme]" value="fermé" class="hidden"
                                                    onchange="toggleHoraire({{ $index }})" />
                                                <label for="ferme-{{ $index }}"
                                                    class="checkbox-label cursor-pointer px-4 py-2 rounded-lg border border-[#cfe7e1] dark:border-[#24423a] text-sm text-[#4c9a86] hover:bg-primary/10 transition-all flex items-center justify-center">
                                                    Fermé
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if ($errors->has('horaires.*.heureOuverture') || $errors->has('horaires.*.heureFermeture') || $errors->has('horaires.*.jourSemaine'))
                                    <p class="text-red-500 text-xs mt-2">
                                        {{ $errors->first('horaires.*.heureOuverture') ?: $errors->first('horaires.*.heureFermeture') ?: $errors->first('horaires.*.jourSemaine') }}
                                    </p>
                                @endif
                            </div>
                        </section>
                        <section class="form-card">
                            <div class="section-title">
                                <span
                                    class="material-symbols-outlined text-primary p-2 bg-primary/10 rounded-lg">photo_library</span>
                                <h3 class="text-xl font-bold">4. Médias</h3>
                            </div>
                            <div class="space-y-4">
                                <label class="field-label" for="photo1">Photos de l'établissement (Max 3 photo)
                                    <div
                                        class="border-2 border-dashed border-[#cfe7e1] dark:border-[#24423a] rounded-xl p-12 text-center hover:border-primary transition-colors cursor-pointer group">
                                        <span
                                            class="material-symbols-outlined text-4xl text-[#4c9a86] group-hover:text-primary mb-4 block">cloud_upload</span>
                                        <p class="text-sm font-semibold mb-1">Cliquez pour ajouter des photos</p>
                                        <p class="text-xs text-[#4c9a86]">Format PNG, JPG ou WEBP (Max. 5MB par fichier)
                                        </p>
                                        <input name="photo[0]" type="file" id="photo1" accept="image/*" class="hidden">
                                    </div>
                                </label>
                                <div class="grid grid-cols-2 gap-4 mt-6">
                                    <label
                                        class="cursor-pointer  border-2 hover:border-green-400 duration-300 rounded-lg"
                                        for="photo2">
                                        <div
                                            class="aspect-square bg-background-light dark:bg-[#10221d] rounded-lg flex items-center justify-center border border-[#cfe7e1] dark:border-[#24423a]">

                                            <span class="material-symbols-outlined text-[#4c9a86]">
                                                image
                                            </span>

                                            <input name="photo[1]" type="file" accept="image/*" class=" hidden"
                                                id="photo2">

                                        </div>
                                    </label>
                                    <label
                                        class="cursor-pointer border-2 hover:border-green-400 duration-300 rounded-lg"
                                        for="photo2">
                                        <div
                                            class="aspect-square bg-background-light dark:bg-[#10221d] rounded-lg flex items-center justify-center border border-[#cfe7e1] dark:border-[#24423a]">

                                            <span class="material-symbols-outlined text-[#4c9a86]">
                                                image
                                            </span>

                                            <input name="photo[2]" type="file" accept="image/*" class=" hidden"
                                                id="photo2">

                                        </div>
                                    </label>
                                </div>
                            </div>
                        </section>
                    </div>
            </main>
            <div id="menuModal"
                class="fixed hidden inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">

                <div
                    class="bg-background-light dark:bg-background-dark w-full max-w-4xl max-h-[90vh] overflow-y-auto rounded-2xl shadow-2xl border border-primary/20">

                    <div
                        class="sticky top-0 z-20 bg-white dark:bg-slate-900 px-8 py-4 border-b border-primary/10 flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900 dark:text-white">Créer un nouveau menu</h2>
                            <p class="text-xs text-slate-500">Remplissez les détails et les plats ci-dessous</p>
                        </div>
                        <button onclick="this.closest('#menuModal').classList.add('hidden')"
                            class="p-2 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-full transition-colors text-slate-400">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                    </div>

                    <div class="p-8 space-y-8">

                        <section class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-primary/10 shadow-sm">
                            <label
                                class="block text-sm font-semibold text-slate-500 uppercase tracking-wider mb-3">Titre
                                du Menu</label>
                            <input name="menutitle"
                                class="w-full text-2xl font-bold bg-transparent border-none outline-none px-0 pb-2 transition-all"
                                placeholder="ex: Menu Signature..." type="text" value="{{ old('menutitle') }}" />
                            @error('menutitle')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </section>

                        <div class="space-y-6">
                            <div
                                class="bg-white dark:bg-slate-900 rounded-xl border border-primary/10 shadow-sm overflow-hidden"
                                >
                                <div
                                    class="p-4 border-b border-primary/5 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/50">
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-slate-300 text-lg">restaurant</span>
                                        <h1
                                            class="bg-transparent border-none text-lg font-bold focus:ring-0 p-0 text-slate-800 dark:text-white w-48"
                                            >
                                            Plats
                                        </h1>
                                    </div>
                                </div>

                                <div class="p-6 space-y-4">
                                    <div class="plats-list space-y-4">
                                        <div
                                            class="plat-row relative grid grid-cols-12 gap-4 p-4 rounded-xl bg-background-light dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800">
                                            <div class="col-span-9 space-y-3">
                                                <div class="grid grid-cols-3 gap-4">
                                                    <div class="col-span-2">
                                                        <label
                                                            class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Nom
                                                            du plat</label>
                                                        <input
                                                            class="plat-name w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm font-semibold focus:ring-primary/20 focus:border-primary"
                                                            type="text" name="plats[0][contenu]"
                                                            placeholder="Ex: Carpaccio de Boeuf" />
                                                    </div>
                                                    <div class="col-span-1">
                                                        <label
                                                            class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Prix
                                                            (€)</label>
                                                        <input
                                                            class="plat-price w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm font-semibold focus:ring-primary/20 focus:border-primary"
                                                            type="text" name="plats[0][prix]" placeholder="0.00" />
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-span-3 flex flex-col justify-start items-end">
                                                <button type="button" class="text-slate-300 hover:text-red-400"
                                                    onclick="removePlat(this)"><span
                                                        class="material-symbols-outlined text-lg">close</span></button>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" onclick="addPlat(this)"
                                        class="w-full py-3 border-2 border-dashed border-primary/20 rounded-xl text-primary font-bold flex items-center justify-center gap-2 hover:bg-primary/5 transition-all">
                                        <span class="material-symbols-outlined">add_circle_outline</span> Ajouter un plat
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-primary/10 bg-slate-50 dark:bg-slate-900/50 flex justify-end gap-4">
                        <button type="button" onclick="this.closest('#menuModal').classList.add('hidden')"
                            class="px-6 py-2.5 text-slate-500 font-medium hover:text-slate-700">Annuler</button>
                        <button type="button" onclick="this.closest('#menuModal').classList.add('hidden')"
                            class="bg-primary hover:bg-primary/90 text-white font-bold py-2.5 px-8 rounded-lg shadow-lg shadow-primary/20 flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg">save</span> Enregistrer le menu
                        </button>
                    </div>
                </div>
            </div>
            <footer
                class="sticky bottom-0 bg-white/90 dark:bg-[#152e28]/90 backdrop-blur-md px-10 py-5 border-t border-[#cfe7e1] dark:border-[#24423a] flex justify-end gap-4 shrink-0 shadow-2xl">
                <button type="button" id="clicked" onclick="openMenu()"
                    class="flex items-center gap-2 px-10 py-3 rounded-lg bg-primary text-background-dark font-bold hover:brightness-105 transition-all shadow-lg shadow-primary/20">
                    Remplir le Menu
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <button type="submit"
                    class="flex  items-center gap-2 px-10 py-3 rounded-lg bg-primary text-background-dark font-bold hover:brightness-105 transition-all shadow-lg shadow-primary/20">
                    Creez mon restaurant
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>
            </footer>
        </form>
        <script>
            function openMenu(){
                let menuModal = document.getElementById('menuModal');
                let button = document.getElementById('clicked');
                let originalcontent = button.querySelector('span').innerHTML;
                menuModal.classList.remove('hidden');
            }

            function addPlat(button){
                let list = button.closest('.p-6')?.querySelector('.plats-list');
                if (!list) return;

                let firstRow = list.querySelector('.plat-row');
                if (!firstRow) return;

                let clone = firstRow.cloneNode(true);
                clone.querySelectorAll('input').forEach(function(input){
                    input.value = '';
                });

                list.appendChild(clone);
                refreshPlatNames(list);
            }

            function removePlat(button){
                let row = button.closest('.plat-row');
                if (!row) return;

                let list = row.closest('.plats-list');
                if (!list) return;

                if (list.querySelectorAll('.plat-row').length <= 1) {
                    row.querySelectorAll('input').forEach(function(input){
                        input.value = '';
                    });
                    return;
                }

                row.remove();
                refreshPlatNames(list);
            }

            function refreshPlatNames(list){
                let rows = list.querySelectorAll('.plat-row');

                rows.forEach(function(row, index){
                    let nameInput = row.querySelector('.plat-name');
                    let priceInput = row.querySelector('.plat-price');

                    if (nameInput) nameInput.name = 'plats[' + index + '][contenu]';
                    if (priceInput) priceInput.name = 'plats[' + index + '][prix]';
                });
            }
        </script>
    </div>
    <div class="fixed bottom-32 right-8 z-50">
        <button
            class="bg-primary text-background-dark size-14 rounded-full shadow-xl shadow-primary/30 flex items-center justify-center hover:scale-110 transition-transform">
            <span class="material-symbols-outlined font-bold">chat_bubble</span>
        </button>
    </div>

    <script>
        function toggleHoraire(index) {
            let checkbox = document.getElementById('ferme-' + index);
            let ouvertureInput = document.getElementById('ouverture-' + index);
            let fermetureInput = document.getElementById('fermeture-' + index);

            if (checkbox.checked) {
                ouvertureInput.disabled = true;
                fermetureInput.disabled = true;
                ouvertureInput.value = '';
                fermetureInput.value = '';
                ouvertureInput.classList.add('opacity-50', 'cursor-not-allowed');
                fermetureInput.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                ouvertureInput.disabled = false;
                fermetureInput.disabled = false;
                ouvertureInput.classList.remove('opacity-50', 'cursor-not-allowed');
                fermetureInput.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }
    </script>

</body>

</html>