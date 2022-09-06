<x-guest-layout>
<div>

    <div class="p-12">

       <div class="w-full mx-auto space-y-6">
           <div class="flex justify-center">
               <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_pqpmxbxp.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  autoplay></lottie-player>

           </div>
           <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center">
            {{ $error }}
        </h2>

         
         <div class="flex justify-center">
             <a class="bg-blue-500 p-4 text-center w-1/4 text-white font-bold text-lg" :href="route('cita.create')">Volver</a>
         </div>
           
       </div>

        

       
       
   </div>

</div>

@push('scripts')
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
@endpush
</x-guest-layout>
