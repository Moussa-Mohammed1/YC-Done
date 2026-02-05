<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Youco'Done - Gestion des restaurants</title>
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
                        "primary": "#17cfa1",
                        "background-light": "#f8faf9",
                        "background-dark": "#0f172a",
                        "surface": "#ffffff",
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
    <style type="text/tailwindcss">
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        body {
            font-family: "Work Sans", sans-serif;
        }
        .table-striped tbody tr:nth-child(even) {
            background-color: #fcfdfe;
        }
        .table-striped tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }
        .sidebar-active {
            background-color: rgba(23, 207, 161, 0.1);
        }
    </style>
</head>

<body class="bg-background-light text-slate-900 min-h-screen">
    @include('layouts.admin-sidebar')
    <main class="ml-64 flex flex-col bg-background-light min-h-screen overflow-y-auto">
        <header class="p-8 pb-0">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight">Gestion des restaurants</h2>
                    <p class="text-slate-500 mt-1 text-sm font-medium">Gérez les établissements, modifiez les
                        informations et suivez leur statut.</p>
                </div>
                <button
                    class="flex items-center justify-center gap-2 bg-primary hover:bg-[#15bd93] text-white font-bold px-6 py-3 rounded-xl transition-all shadow-md shadow-primary/20">
                    <span class="material-symbols-outlined">add</span>
                    Nouveau Restaurant
                </button>
            </div>
            <div class="mt-8 flex items-center gap-4">
                <div class="relative flex-1 max-w-lg">
                    <span
                        class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                    <input
                        class="w-full bg-white border border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 rounded-xl pl-12 pr-4 py-3 text-sm transition-all shadow-sm outline-none"
                        placeholder="Rechercher par nom, ville ou ID..." type="text" />
                </div>
                <button
                    class="flex items-center gap-2 bg-white border border-slate-200 px-5 py-3 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm">
                    <span class="material-symbols-outlined text-slate-400">filter_list</span>
                    Filtres
                </button>
            </div>
        </header>
        <section class="p-8 pt-6">
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left table-striped">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-200">
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Nom</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Ville
                                </th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Propriétaire</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Statut
                                </th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Création
                                </th>
                                <th
                                    class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 text-right">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @if($restaurants->count())

                                @foreach ($restaurants as $restaurant)

                                    <tr class="hover:bg-primary/5 transition-colors">

                                        <td class="px-6 py-5 text-sm font-bold text-slate-900">{{ $restaurant->nom  }}</td>
                                        <td class="px-6 py-5 text-sm text-slate-600">{{ $restaurant->type_cuisine }}</td>
                                        <td class="px-6 py-5 text-sm text-slate-600">{{ $restaurant->username }}</td>
                                        <td class="px-6 py-5">
                                            <span
                                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold bg-primary/15 text-[#12a681] uppercase">
                                                <span class="size-1.5 rounded-full bg-primary"></span>

                                            </span>
                                        </td>
                                        <td class="px-6 py-5 text-sm text-slate-500">
                                            {{ date('d/m/Y', strtotime($restaurant->created_at)) }}
                                        </td>
                                        <td class="px-6 py-5 text-right">
                                            <div class="flex justify-end gap-3">
                                                <button
                                                    class="px-3 py-1.5 rounded-lg bg-slate-100 text-slate-700 text-xs font-bold hover:bg-primary hover:text-white transition-all">Voir</button>
                                                <button onclick="confirmDelete({{ $restaurant->id }});"
                                                    class="px-3 py-1.5 rounded-lg text-rose-500 hover:bg-rose-50 text-xs font-bold transition-all">

                                                    Supprimer</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center gap-3">
                                            <span
                                                class="material-symbols-outlined text-6xl text-slate-300">restaurant</span>
                                            <p class="text-slate-500 font-semibold">Aucun restaurant trouvé</p>
                                            <p class="text-slate-400 text-sm">Commencez par ajouter votre premier restaurant
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <div id="deleteModal"
                        class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
                        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all">
                            <div class="p-6">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="flex-shrink-0 w-12 h-12 rounded-full bg-rose-100 flex items-center justify-center">
                                        <span
                                            class="material-symbols-outlined text-rose-600 text-2xl">question_mark</span>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-slate-900">Confirmer la suppression</h3>
                                        <p class="text-sm text-slate-500 mt-1">Cette action est irréversible</p>
                                    </div>
                                </div>
                                <div class="mt-4 p-4 bg-slate-50 rounded-xl border border-slate-200">
                                    <p class="text-sm text-slate-700">
                                        Êtes-vous sûr de vouloir supprimer le restaurant <strong id="restaurantName"
                                            class="text-slate-900"></strong> ?
                                        Toutes les données associées (menus, plats, horaires, photos) seront également
                                        supprimées.
                                    </p>
                                </div>
                            </div>
                            <div class="bg-slate-50 px-6 py-4 rounded-b-2xl flex gap-3 justify-end">
                                <button onclick="closeDeleteModal()" type="button"
                                    class="px-5 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-700 font-semibold text-sm hover:bg-slate-100 transition-all">
                                    Annuler
                                </button>
                                <div id="deleteForm" class="inline">
                                    <input type="hidden" id="idresto" value="">
                                    <button onclick="deleted(event)"
                                        class="px-5 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-semibold text-sm transition-all shadow-md shadow-rose-600/20">
                                        Supprimer définitivement
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        let hiddeinput = document.getElementById('idresto');
                        function confirmDelete(restaurantId) {
                            let modal = document.getElementById('deleteModal');
                            let deleteForm = document.getElementById('deleteForm');
                            let restaurantName = document.getElementById('restaurantName');
                            hiddeinput.value = restaurantId;
                            deleteForm.action = `/admin/restaurants/${restaurantId}`;

                            let row = event.target.closest('tr');
                            let name = row.querySelector('td:first-child').textContent.trim();
                            restaurantName.textContent = name;

                            modal.classList.remove('hidden');
                        }

                        function closeDeleteModal() {
                            let modal = document.getElementById('deleteModal');
                            modal.classList.add('hidden');
                            hiddeinput.value = '';
                        }

                        document.getElementById('deleteModal')?.addEventListener('click', function (e) {
                            if (e.target === this) {
                                closeDeleteModal();
                                hiddeinput.value = '';
                            }
                        });

                        document.addEventListener('keydown', function (e) {
                            if (e.key === 'Escape') {
                                closeDeleteModal();
                                hiddeinput.value = '';
                            }
                        });

                        function deleted(e) {
                            let button = e.target.closest('button');
                            button.innerHTML = '<span class="material-symbols-outlined animate-spin">progress_activity</span> Traitement...';
                            button.disabled = true;
                            
                            let restaurantId = hiddeinput.value;
                            let token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
                            
                            fetch(`/admin/restaurants/${restaurantId}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': token,
                                    'Accept': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    window.location.reload();
                                }
                            })
                            ;
                        }
                    </script>

                </div>
                <div class="p-4 bg-slate-50/80 border-t border-slate-200 flex items-center justify-between">
                    <p class="text-xs text-slate-500 font-medium">Affichage de <span
                            class="font-bold text-slate-900">5</span> sur <span
                            class="font-bold text-slate-900">124</span> restaurants</p>
                    <div class="flex items-center gap-1">
                        {{ $restaurants->links() }}
                        <!-- <button
                            class="size-8 flex items-center justify-center rounded-lg border border-slate-200 bg-white hover:bg-slate-50 transition-colors text-slate-400">
                            <span class="material-symbols-outlined text-sm">chevron_left</span>
                        </button>
                        <button
                            class="size-8 flex items-center justify-center rounded-lg bg-primary text-white font-bold text-xs shadow-sm shadow-primary/20">1</button>
                        <button
                            class="size-8 flex items-center justify-center rounded-lg border border-transparent hover:bg-slate-200/50 text-slate-600 text-xs">2</button>
                        <button
                            class="size-8 flex items-center justify-center rounded-lg border border-transparent hover:bg-slate-200/50 text-slate-600 text-xs">3</button>
                        <span class="px-1 text-slate-400 text-xs">...</span>
                        <button
                            class="size-8 flex items-center justify-center rounded-lg border border-transparent hover:bg-slate-200/50 text-slate-600 text-xs">12</button>
                        <button
                            class="size-8 flex items-center justify-center rounded-lg border border-slate-200 bg-white hover:bg-slate-50 transition-colors text-slate-400">
                            <span class="material-symbols-outlined text-sm">chevron_right</span>
                        </button> -->
                    </div>
                </div>
            </div>
        </section>
    </main>

</body>

</html>