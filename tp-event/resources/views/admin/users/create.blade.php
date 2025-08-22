
<x-app-layout>
    <div class="container mx-auto p-6 bg-white rounded shadow-md w-1/4 mt-12">
        <h1 class="text-2xl font-bold mb-6">Créer un utilisateur</h1>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Nom</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>

         
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>

     
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Mot de passe</label>
                <input type="password" name="password" id="password"
                       class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label for="role" class="block text-gray-700 font-semibold mb-2">Rôle</label>
                <select name="role" id="role" class="w-full border-gray-300 rounded px-3 py-2" required>
                    <option value="">-- Choisir un rôle --</option>
                    @foreach(\Spatie\Permission\Models\Role::all() as $role)
                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                    class="bg-blue-600 text-white font-semibold px-4 py-2 rounded hover:bg-blue-700">
                Créer l'utilisateur
            </button>
        </form>
    </div>
</x-app-layout>
