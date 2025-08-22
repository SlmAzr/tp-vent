<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connectez-vous - EventPlann</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="flex flex-col lg:flex-row w-full justify-center max-w-4xl bg-white shadow-lg rounded-xl overflow-hidden">

        <div class="w-2/3  py-16 flex flex-row justify-center items-center">
            <div>
      
                <div class="mb-6">
                    <h1 class="text-4xl font-bold text-blue-500">EventPlann</h1>
                </div>

           
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800">Rejoignez EventPlann dès aujourd'hui</h2>
                    <p class="text-gray-500 mt-2">Connectez-vous pour continuer ou créez un nouveau compte.</p>
                </div>

                <div class="flex flex-col gap-4">
                    <a href="{{ route('register') }}"
                        class="w-full text-center py-3 px-4 bg-blue-500 text-white rounded-lg font-medium hover:bg-blue-600 transition">
                        S’inscrire
                    </a>
                    <a href="{{ route('login') }}"
                        class="w-full text-center py-3 px-4 border border-gray-300 rounded-lg font-medium hover:bg-gray-100 transition">
                        Se connecter
                    </a>
                </div>

                <div class="my-6 flex items-center">
                    <span class="flex-grow border-t border-gray-300"></span>
                    <span class="mx-4 text-gray-400">ou</span>
                    <span class="flex-grow border-t border-gray-300"></span>
                </div>

                <p class="mt-8 text-center text-gray-400 text-sm">
                    En vous inscrivant, vous acceptez nos <a href="#" class="underline">Conditions</a> et <a
                        href="#" class="underline">Politique de confidentialité</a>.
                </p>
            </div>
        </div>
    </div>

</body>

</html>
