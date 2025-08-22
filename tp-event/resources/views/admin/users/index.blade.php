<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ __('Liste des utilisateurs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Tous les utilisateurs</h1>
                <a href="{{ route('admin.users.create') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded">
                    + Ajouter un utilisateur
                </a>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 ">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                #</th>
                            <th scope="col"
                                class="px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Nom</th>
                            <th scope="col"
                                class="px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Email</th>
                            <th scope="col"
                                class="px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Rôle</th>
                            <th scope="col"
                                class="px-6 py-3  text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                            @php
                                $isYourself = $user->id === auth()->user()->id;

                            @endphp
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-center">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->getRoleNames()->first() == 'admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($user->getRoleNames()->first()) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                    <a href="{{ route('admin.users.update', $user->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 mr-4">Modifier</a>
                                    @if ($isYourself)
                                        <span class="text-gray-400 cursor-not-allowed">Supprimer</span>
                                    @else
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                                Supprimer
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($users->isEmpty())
                    <p class="p-6 text-gray-500">Aucun utilisateur trouvé.</p>
                @endif
            </div>


            <!-- Pagination -->
            {{-- <div class="mt-4">
                {{ $users->links() }}
            </div> --}}

        </div>
    </div>
</x-app-layout>
