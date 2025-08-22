<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Événements') }}
            </h2>
            @php
                $userRole = Auth::user()->getRoleNames()->first();
            @endphp
            @if (in_array($userRole, ['admin', 'organisator']))
                <a href="{{ route('events.create') }}"
                   class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    Ajouter un événement
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-4 text-left font-semibold">Titre</th>
                                <th class="py-3 px-4 text-left font-semibold">Date du début</th>
                                <th class="py-3 px-4 text-left font-semibold">Date de fin</th>
                                <th class="py-3 px-4 text-left font-semibold">Lieu</th>
                                <th class="py-3 px-4 text-left font-semibold">Description</th>
                                <th class="py-3 px-4 text-center font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                                @php
                                    $hasParticipated = $participations
                                        ->where('event_id', $event->id)
                                        ->contains('user_id', Auth::id());

                                    $isAdminOrOrganisator = in_array($userRole, ['admin', 'organisator']);

                                    $isAdmin = $userRole === 'admin';

                                    $isEventOwner = $event->creator_id === Auth::id();
                             
                                @endphp
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4">{{ $event->title }}</td>
                                    <td class="py-3 px-4">{{ $event->start_date }}</td>
                                    <td class="py-3 px-4">{{ $event->end_date }}</td>
                                    <td class="py-3 px-4">{{ $event->location }}</td>
                                    <td class="py-3 px-4 overflow-hidden">{{ $event->description }}</td>
                                    <td class="py-3 px-4 text-center space-x-2 flex justify-center">

                                        @if ($hasParticipated && !$isAdminOrOrganisator)
                                            <span>Aucune action possible</span>
                                        @endif

                                        @if (!$hasParticipated && !$isEventOwner)
                                            <form action="{{ route('participe.store', $event->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-blue-500 hover:underline">
                                                    Participer
                                                </button>
                                            </form>
                                        @endif

                                        @if ($isAdmin || $isEventOwner)
                                            <a href="{{ route('events.edit', $event->id) }}" class="text-blue-500 hover:underline">
                                                Modifier
                                            </a>
                                        @endif

                                        @if ($isAdmin || $isEventOwner)
                                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Êtes-vous sûr ?')" class="text-red-500 hover:underline">
                                                    Supprimer
                                                </button>
                                            </form>
                                        @endif


                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-4 px-4 text-center text-gray-500">
                                        Aucun événement trouvé.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Pagination si nécessaire --}}
                    {{-- <div class="mt-4">
                        {{ $events->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
