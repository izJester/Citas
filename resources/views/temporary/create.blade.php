<x-guest-layout>
    <div class="flex items-center justify-center mt-8">
        <img class="w-16 h-auto" src="/images/escudo.png" alt="">
        <img class="w-auto h-12 ml-4" src="/images/letras.png" alt="">
    </div>
    <div class="flex justify-center mt-8">
        <div class="md:px-8 md:py-4 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 mb-10">
            @livewire('tramites.crear-tramite')
        </div>
    </div>
</x-guest-layout>