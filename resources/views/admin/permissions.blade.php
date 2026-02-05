<!DOCTYPE html>

<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rôles &amp; Permissions - Admin | Youco'Done</title>
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
    <style>
        body {
            font-family: 'Work Sans', sans-serif;
        }

        .custom-radio-svg {
            --radio-dot-svg: url('data:image/svg+xml,%3csvg viewBox=%270 0 16 16%27 fill=%27%232beebd%27 xmlns=%27http://www.w3.org/2000/svg%27%3e%3ccircle cx=%278%27 cy=%278%27 r=%273%27/%3e%3c/svg%3e');
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-[#0d1b18] dark:text-white transition-colors duration-200">
    <div class="flex min-h-screen">
        <!-- Sidebar Navigation -->
        @include('layouts.admin-sidebar')
        <!-- Main Content Area -->
        <main class="flex-1 ml-64 p-8">
            <div class="max-w-6xl mx-auto space-y-8">
                <!-- Page Header -->
                <div class="flex flex-col gap-2">
                    <h2 class="text-[#0d1b18] dark:text-white text-4xl font-black tracking-tight">Gestion des rôles et
                        permissions</h2>
                    <p class="text-[#4c9a86] dark:text-gray-400">Configurez l'accès à la plateforme pour les différents
                        types d'utilisateurs.</p>
                </div>
                <!-- Two-Column Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <!-- Left Column: Roles Selection -->
                    <section
                        class="lg:col-span-5 bg-white dark:bg-[#1a2e29] rounded-xl shadow-sm border border-[#cfe7e1] dark:border-[#2a3f3a] overflow-hidden">
                        <div class="p-5 border-b border-[#cfe7e1] dark:border-[#2a3f3a] bg-gray-50 dark:bg-[#122420]">
                            <h3 class="text-[#0d1b18] dark:text-white text-xl font-bold">Rôles</h3>
                        </div>
                        <div class="p-4 space-y-3 custom-radio-svg">
                            <label
                                class="flex items-center gap-4 rounded-lg border border-solid border-[#cfe7e1] dark:border-[#2a3f3a] p-4 flex-row-reverse cursor-pointer hover:border-primary transition-all group">
                                <input
                                    class="h-5 w-5 border-2 border-[#cfe7e1] dark:border-[#2a3f3a] bg-transparent text-transparent checked:border-primary checked:bg-[image:--radio-dot-svg] focus:ring-0"
                                    name="role-selection" type="radio" />
                                <div class="flex grow flex-col">
                                    <p class="text-[#0d1b18] dark:text-white text-base font-semibold">Client</p>
                                    <p class="text-[#4c9a86] dark:text-gray-400 text-sm">Utilisateur final de
                                        l'application</p>
                                </div>
                            </label>
                            <label
                                class="flex items-center gap-4 rounded-lg border border-solid border-[#cfe7e1] dark:border-[#2a3f3a] p-4 flex-row-reverse cursor-pointer hover:border-primary transition-all group">
                                <input
                                    class="h-5 w-5 border-2 border-[#cfe7e1] dark:border-[#2a3f3a] bg-transparent text-transparent checked:border-primary checked:bg-[image:--radio-dot-svg] focus:ring-0"
                                    name="role-selection" type="radio" />
                                <div class="flex grow flex-col">
                                    <p class="text-[#0d1b18] dark:text-white text-base font-semibold">Restaurateur</p>
                                    <p class="text-[#4c9a86] dark:text-gray-400 text-sm">Propriétaire d'établissement
                                    </p>
                                </div>
                            </label>
                            <label
                                class="flex items-center gap-4 rounded-lg border-2 border-solid border-primary p-4 flex-row-reverse bg-primary/5 cursor-pointer transition-all">
                                <input checked=""
                                    class="h-5 w-5 border-2 border-primary bg-transparent text-transparent checked:border-primary checked:bg-[image:--radio-dot-svg] focus:ring-0"
                                    name="role-selection" type="radio" />
                                <div class="flex grow flex-col">
                                    <p class="text-[#0d1b18] dark:text-white text-base font-bold">Admin</p>
                                    <p class="text-[#4c9a86] dark:text-gray-400 text-sm font-medium">Gestionnaire de la
                                        plateforme</p>
                                </div>
                            </label>
                        </div>
                    </section>
                    <!-- Right Column: Permissions List -->
                    <section
                        class="lg:col-span-7 bg-white dark:bg-[#1a2e29] rounded-xl shadow-sm border border-[#cfe7e1] dark:border-[#2a3f3a] overflow-hidden">
                        <div
                            class="p-5 border-b border-[#cfe7e1] dark:border-[#2a3f3a] bg-gray-50 dark:bg-[#122420] flex justify-between items-center">
                            <h3 class="text-[#0d1b18] dark:text-white text-xl font-bold">Permissions du rôle : Admin
                            </h3>
                            <span
                                class="bg-primary/20 text-[#0d1b18] dark:text-primary text-xs font-bold px-2 py-1 rounded">5
                                ACTIVÉES</span>
                        </div>
                        <div class="divide-y divide-[#cfe7e1] dark:divide-[#2a3f3a]">
                            <div
                                class="flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-[#122420] transition-colors">
                                <div class="flex flex-col">
                                    <span class="text-[#0d1b18] dark:text-white font-medium">Modifier ses
                                        restaurants</span>
                                    <span class="text-[#4c9a86] text-xs">Accès aux réglages et menu des restaurants
                                        liés</span>
                                </div>
                                <input checked=""
                                    class="w-6 h-6 rounded border-[#cfe7e1] text-primary focus:ring-primary"
                                    type="checkbox" />
                            </div>
                            <div
                                class="flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-[#122420] transition-colors">
                                <div class="flex flex-col">
                                    <span class="text-[#0d1b18] dark:text-white font-medium">Supprimer un
                                        restaurant</span>
                                    <span class="text-[#4c9a86] text-xs">Suppression définitive de la base de
                                        données</span>
                                </div>
                                <input checked=""
                                    class="w-6 h-6 rounded border-[#cfe7e1] text-primary focus:ring-primary"
                                    type="checkbox" />
                            </div>
                            <div
                                class="flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-[#122420] transition-colors">
                                <div class="flex flex-col">
                                    <span class="text-[#0d1b18] dark:text-white font-medium">Gérer les
                                        utilisateurs</span>
                                    <span class="text-[#4c9a86] text-xs">Ajouter, modifier ou bannir des comptes
                                        utilisateurs</span>
                                </div>
                                <input checked=""
                                    class="w-6 h-6 rounded border-[#cfe7e1] text-primary focus:ring-primary"
                                    type="checkbox" />
                            </div>
                            <div
                                class="flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-[#122420] transition-colors">
                                <div class="flex flex-col">
                                    <span class="text-[#0d1b18] dark:text-white font-medium">Voir les
                                        statistiques</span>
                                    <span class="text-[#4c9a86] text-xs">Visualisation des revenus et rapports
                                        d'activité</span>
                                </div>
                                <input checked=""
                                    class="w-6 h-6 rounded border-[#cfe7e1] text-primary focus:ring-primary"
                                    type="checkbox" />
                            </div>
                            <div
                                class="flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-[#122420] transition-colors">
                                <div class="flex flex-col">
                                    <span class="text-[#0d1b18] dark:text-white font-medium">Modifier le profil</span>
                                    <span class="text-[#4c9a86] text-xs">Modification des informations personnelles et
                                        sécurité</span>
                                </div>
                                <input checked=""
                                    class="w-6 h-6 rounded border-[#cfe7e1] text-primary focus:ring-primary"
                                    type="checkbox" />
                            </div>
                        </div>
                        <div class="p-4 bg-gray-50 dark:bg-[#122420] text-right">
                            <button
                                class="px-6 py-2 bg-primary/10 border border-primary/20 text-[#0d1b18] dark:text-primary rounded-lg font-bold text-sm hover:bg-primary hover:text-[#0d1b18] transition-all">
                                Sauvegarder les modifications
                            </button>
                        </div>
                    </section>
                </div>
                <!-- Bottom Section: Role Assignment -->
                <section
                    class="bg-white dark:bg-[#1a2e29] rounded-xl shadow-sm border border-[#cfe7e1] dark:border-[#2a3f3a] p-6">
                    <div class="flex flex-col gap-6">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">person_add</span>
                            <h3 class="text-[#0d1b18] dark:text-white text-xl font-bold">Assignation de rôle à un
                                utilisateur</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                            
                            <div class="md:col-span-5 flex flex-col gap-1.5">
                                <label class="text-sm font-semibold text-[#0d1b18] dark:text-gray-300">Email de
                                    l'utilisateur</label>
                                <p id="vemail"></p>
                                <div class="relative">
                                    <span
                                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">mail</span>
                                    <input name="email"
                                        id="email"
                                        class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-[#cfe7e1] dark:border-[#2a3f3a] bg-gray-50 dark:bg-[#122420] focus:ring-primary focus:border-primary"
                                        placeholder="email@exemple.com" type="email" />
                                </div>
                            </div>
                            <div class="md:col-span-4 flex flex-col gap-1.5">
                                <label class="text-sm font-semibold text-[#0d1b18] dark:text-gray-300">Rôle à
                                    assigner</label>
                                <select name="role"
                                    class="w-full px-4 py-2.5 rounded-lg border border-[#cfe7e1] dark:border-[#2a3f3a] bg-gray-50 dark:bg-[#122420] focus:ring-primary focus:border-primary">
                                    <option value="client">Client</option>
                                    <option value="restaurant_owner">Restaurateur</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="md:col-span-3">
                                <button
                                    onclick="showConfirmation();"
                                    class="w-full bg-primary hover:bg-primary/90 text-[#0d1b18] font-black py-2.5 rounded-lg shadow-md transition-all flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined">how_to_reg</span>
                                    Assigner
                                </button>
                            </div>
                            <script>
                                function showConfirmation() {
                                    let email = document.getElementById('email').value;
                                    let role = document.querySelector('select[name="role"]').value;
                                    let emailError = document.getElementById('vemail');
                                    
                                    emailError.textContent = '';
                                    emailError.className = '';
                                    
                                    if (!email || !email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                                        emailError.textContent = 'Veuillez entrer une adresse email valide';
                                        emailError.className = 'text-red-500 text-sm mt-1';
                                        return;
                                    }
                                    
                                    let button = event.target.closest('button');
                                    let originalContent = button.innerHTML;
                                    button.disabled = true;
                                    button.innerHTML = '<span class="material-symbols-outlined animate-spin">progress_activity</span> Traitement...';
                                    
                                    fetch('/admin/assign-role', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                                        },
                                        body: JSON.stringify({
                                            email: email,
                                            role: role
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        // Reset button
                                        button.disabled = false;
                                        button.innerHTML = originalContent;
                                        
                                        showModal(data);

                                        if (data.success) {
                                            document.getElementById('email').value = '';
                                        }
                                    })
                                    .catch(error => {
                                        button.disabled = false;
                                        button.innerHTML = originalContent;
                                        
                                       
                                        showModal({
                                            success: false,
                                            message: 'Une erreur est survenue lors de la communication avec le serveur.'
                                        });
                                        console.error('Error:', error);
                                    });
                                }
                                
                                function showModal(data) {
                                    let modal = document.getElementById('confirmationModal');
                                    let modalIcon = document.getElementById('modalIcon');
                                    let modalTitle = document.getElementById('modalTitle');
                                    let modalMessage = document.getElementById('modalMessage');
                                    
                                    if (data.success) {
                                        modalIcon.textContent = 'check_circle';
                                        modalIcon.className = 'material-symbols-outlined text-6xl text-green-500';
                                        modalTitle.textContent = 'Rôle assigné avec succès';
                                        modalTitle.className = 'text-2xl font-bold text-green-600 dark:text-green-400';
                                    } else {
                                        modalIcon.textContent = 'error';
                                        modalIcon.className = 'material-symbols-outlined text-6xl text-red-500';
                                        modalTitle.textContent = 'Échec de l\'assignation';
                                        modalTitle.className = 'text-2xl font-bold text-red-600 dark:text-red-400';
                                    }
                                    
                                    modalMessage.textContent = data.success ? 'Le rôle a été assigné avec succès.' : 'Une erreur est survenue.';
                                    modal.classList.remove('hidden');
                                }
                                
                                function closeModal() {
                                    document.getElementById('confirmationModal').classList.add('hidden');
                                }
                            </script>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
    
    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" onclick="if(event.target === this) closeModal()">
        <div class="bg-white dark:bg-[#1a2e29] rounded-2xl shadow-2xl max-w-md w-full mx-4 border border-[#cfe7e1] dark:border-[#2a3f3a] animate-[scale-in_0.2s_ease-out]">
            <div class="p-8 text-center">
                <div class="mb-4">
                    <span id="modalIcon" class="material-symbols-outlined text-6xl text-green-500">check_circle</span>
                </div>
                <h3 id="modalTitle" class="text-2xl font-bold text-green-600 dark:text-green-400 mb-3">Rôle assigné avec succès</h3>
                <p id="modalMessage" class="text-[#4c9a86] dark:text-gray-400 mb-6">Le rôle a été assigné à l'utilisateur avec succès.</p>
                <button onclick="closeModal()" class="w-full bg-primary hover:bg-primary/90 text-[#0d1b18] font-bold py-3 rounded-lg transition-all">
                    Fermer
                </button>
            </div>
        </div>
    </div>
    
    <style>
        @keyframes scale-in {
            from {
                transform: scale(0.9);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</body>

</html>