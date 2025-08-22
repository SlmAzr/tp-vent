<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier un événement') }}
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

                    <form action="{{ route('events.update', $event->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 font-semibold mb-2">Titre</label>
                            <input type="text" name="title" id="title"
                                value="{{ old('title', $event->title) }}"
                                class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200 px-3 py-2"
                                required>
                        </div>

                        <input type="datetime-local" name="start_date" id="start_date"
                            value="{{ old('start_date', \Carbon\Carbon::parse($event->start_date)->format('Y-m-d\TH:i')) }}"
                            class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200 px-3 py-2 mb-5"
                            required>

                        <input type="datetime-local" name="end_date" id="end_date"
                            value="{{ old('end_date', \Carbon\Carbon::parse($event->end_date)->format('Y-m-d\TH:i')) }}"
                            class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200 px-3 py-2"
                            required>

                        <div class="mb-4">
                            <label for="location" class="block text-gray-700 font-semibold mb-2">Lieu</label>
                            <input type="text" name="location" id="location"
                                value="{{ old('location', $event->location) }}"
                                class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200 px-3 py-2"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200 px-3 py-2">{{ old('description', $event->description) }}</textarea>
                        </div>

                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('events.index') }}"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                                Annuler
                            </a>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                Mettre à jour
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
