<x-guest-layout>
   <div class="flex justify-center w-1/2 mx-auto my-12">
       <div class="shadow w-full p-6">

          <h3 class="text-center font-bold text-xl">Bienvenido al centro de solicitudes para egresados</h3>
          <p class="text-center">Antes de comenzar queremos saber si</p>

           <div class="flex flex-col justify-center w-full mt-6">
                <form class="w-1/2 mx-auto" action="">
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="temporary-code" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label for="temporary-code" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Ingresa tu codigo de solicitud temporal</label>
                    </div>
                </form>
                <hr>
                <div class="text-center mt-6">
                  <a href="{{ route('temporary.create') }}" class="w-1/2 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 font-bold uppercase">Crear un nuevo tramite</a>

                </div>
           </div>
       
       </div>

   </div>
</x-guest-layout>
