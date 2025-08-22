<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un événement') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if ($errors->any())
                        <div class="mb-4">
                            <ul class="list-disc list-inside text-red-500">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('events.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 font-semibold mb-2">Titre</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                                class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label for="start_date" class="block text-gray-700 font-semibold mb-2">Date de début</label>
                            <input type="datetime-local" name="start_date" id="date" value="{{ old('start_date') }}"
                                class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" required min="{{ now()->format('Y-m-d\TH:i') }}">
                        </div>
                        <div class="mb-4">
                            <label for="end_date" class="block text-gray-700 font-semibold mb-2">Date de fin</label>
                            <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date') }}"
                                class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" required min="{{ now()->format('Y-m-d\TH:i') }}"> 
                        </div>

                        <div class="mb-4">
                            <label for="location" class="block text-gray-700 font-semibold mb-2">Lieu</label>
                            <input type="text" name="location" id="location" value="{{ old('location') }}"
                                class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200 px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">{{ old('description') }}</textarea>
                        </div>

                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('events.index') }}"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                                Annuler
                            </a>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                Enregistrer
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
