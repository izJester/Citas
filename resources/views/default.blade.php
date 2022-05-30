<x-guest-layout>
    <div class="h-screen flex justify-center items-center bg-gray-100">
        <div class="grid grid-cols-2 gap-4 lg:max-w-4xl w-full bg-white">
            <div class="bg-cover" style="background-image:url('https://elluchador.info/web/wp-content/uploads/2019/12/unefa.jpg'); background-position:center center"></div>
            <div class="flex flex-col justify-center p-4 space-y-10 lg:col-span-1 sm:col-span-2 text-center">
                <div class="flex items-center justify-center">
                    <img class="w-16 h-20" src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/77/Nuevo_Escudo_de_la_UNEFA_%28Desde_1999%29.svg/1200px-Nuevo_Escudo_de_la_UNEFA_%28Desde_1999%29.svg.png" alt="">
                    <img class="w-auto h-12" src="https://upload.wikimedia.org/wikipedia/commons/6/6a/UNEFA_Letra.png" alt="">          
                </div>
                <div class="text-center">
                         <span class="uppercase font-bold">Solicitud de Tramites para egresados</span>

                     </div>

                     <div class="mt-4 flex justify-center items-center">
                         <a href="{{ route('temporary.index') }}" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-md border-b-4 border-r-4 border-gray-300 px-3 py-2 text-center mr-2 mb-2 font-bold text-lg tracking-normal focus:outline-none">Solicitar un tramite</a>
                         <a href="{{ route('temporary.estatus') }}" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-md border-b-4 border-r-4 border-gray-300 px-3 py-2 text-center mr-2 mb-2 font-bold text-lg tracking-normal focus:outline-none">Estatus de mi tramite</a>

                     </div>

                         <div class="space-y-2 p-6">

                             <p class="text-sm">Av. La Estancia, con Av. Caracas y Calle Holanda, Edif. Unefa, Chuao, Caracas.</p>
                         </div>
            </div>
        </div>
    </div>

</x-guest-layout>

