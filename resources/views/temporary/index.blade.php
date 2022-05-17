<x-guest-layout>
   <div class="flex justify-center w-1/2 mx-auto my-12">
       <div class="shadow w-full p-6">

          <h3 class="text-center font-bold text-xl">Bienvenido al centro de solicitudes para egresados</h3>

           <div class="flex flex-col justify-center w-full mt-6">
           <div class="p-6 mb-4 mx-auto max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
    <a href="#">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Antes de empezar</h5>
    </a>
    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Se te dara un codigo especial, el cual tienes que guardar para un futuro verificar el estado de tu tramite.</p>
    <span class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ session('code') }}</span>
</div>
                <hr>
                <div class="text-center mt-6">
                  <a href="{{ $url }}" class="w-1/2 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 font-bold uppercase">Crear un nuevo tramite</a>

                </div>
                
                <form class="flex justify-center" method="post" action="{{ route('temporary.continue') }}">
                    @csrf
                  <input class="mt-4" type="text" name="code" placeholder="Ingresa tu codigo">
                </form>
           </div>
       
       </div>

   </div>
</x-guest-layout>
