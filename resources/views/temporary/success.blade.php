<x-guest-layout>
<div>

<div class="p-12">

   <div class="w-full flex justify-center flex-col mx-auto space-y-6">
       <div class="flex justify-center">
           <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_pqnfmone.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  autoplay></lottie-player>

       </div>
       <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center">
        Ha solicitado una cita con éxito
       </h2>

        <p class="text-center text-gray-800 leading-tight">Pronto recibirá un correo para concretar la fecha de la misma.</p>

        <div class="flex justify-center">
        <a href="/" class="text-white bg-gradient-to-r w-auto from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-md border-b-4 border-r-4 border-gray-300 px-3 py-2 text-center mr-2 mb-2 font-bold text-lg tracking-normal focus:outline-none">Volver al Inicio</a>
        </div>
       
       
        </div>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
@endpush
</x-guest-layout>
