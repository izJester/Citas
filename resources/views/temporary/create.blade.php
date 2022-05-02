<x-guest-layout>
  @php($second = false)
   <div class="flex justify-center mx-auto space-x-2 my-12">
       <div class="shadow w-1/2 p-6">

         @livewire('first-form')

       </div>
       
       @if($second)
       <div class="shadow w-auto p-6">
         <h3>Aspectos a tomar en cuenta</h3>
       </div>
       @endif

   </div>
</x-guest-layout>
