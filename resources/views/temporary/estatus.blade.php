<x-guest-layout>
    <div class="flex items-center justify-center mt-8">
        <img class="w-16 h-auto" src="/images/escudo.png" alt="">
        <img class="w-auto h-12 ml-4" src="/images/letras.png" alt="">
    </div>
    <div class="flex justify-center mt-8 px-4">
        <div class="w-full md:w-1/2 md:px-8 px-4 py-4 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 mb-10">
            <p class="mb-8">
                Utilice este formulario para conocer el estatus de su solicitud de documentos ante la Secretaría General de la Universidad Nacional Experimental de la Fuerza Armada Nacional Bolivariana
            </p>
            @livewire('estatus')
        </div>
    </div>
</x-guest-layout>