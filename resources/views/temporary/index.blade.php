<x-guest-layout>
    <div class="flex items-center justify-center mt-8">
        <img class="w-16 h-auto" src="/images/escudo.png" alt="">
        <img class="w-auto h-12 ml-4" src="/images/letras.png" alt="">
    </div>
    <div class="flex justify-center sm:w-full sm:p-2 md:w-2/3 lg:w-1/2 mx-auto my-12">
        <div class=" p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <h3 class="text-center font-bold text-2xl mt-4">Bienvenido al centro de solicitudes para egresados</h3>
            <div class="flex flex-wrap items-center justify-center mt-8 gap-8">
                <img class="h-32" src="/images/copiar.png" alt="">
                <div class="md:w-1/2">
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Antes de empezar</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Se te dara un codigo especial, el cual tienes que guardar para un futuro verificar el estado de tu tramite.</p>
                    <span class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ session('code') }}</span>
                </div>
            </div>
            <div class="text-center mt-12 pb-4">
                <a href="{{ $url }}" class="w-1/2 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 font-bold uppercase">Crear un nuevo tramite</a>
            </div>
        </div>
    </div>
</x-guest-layout>