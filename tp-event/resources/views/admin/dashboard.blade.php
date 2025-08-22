<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ __('Tableau de bord : Administrateur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h1 class="text-2xl font-bold mb-6">Bienvenue Admin 👋</h1>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold mb-2">Utilisateurs</h3>
                    <p class="text-gray-600 mb-4">Nombre total : <span class="font-bold text-indigo-600"> {{ $userCount }} </span></p>
                    <a href="{{ route('admin.users.index') }}" class="text-indigo-500 hover:underline">Voir les
                        utilisateurs →</a>
                </div>


                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold mb-2">Événements</h3>
                    <p class="text-gray-600 mb-4">Événements actifs : <span class="font-bold text-green-600"> {{ $eventCount }} </span>
                    </p>
                    <a href="{{ route('events.index') }}" class="text-green-500 hover:underline">Gérer les événements
                        →</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
