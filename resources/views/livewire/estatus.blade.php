<div>
    <form wire:submit.prevent="search" class="flex justify-center items-center">   
        <label for="simple-search" class="sr-only">Ingresa tu codigo identificador</label>
        <div class="relative w-1/2">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>
            <input wire:model="search" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ingresa tu codigo identificador" required>
            @error('search') <p class="text-red-400">{{ $message }}</p> @enderror
        </div>
        <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></button>
    </form>

    @if(empty($result))
        <div class="flex justify-center p-6">
            <img class="w-1/4 h-1/4" src="/images/noresult.svg" alt="">
        </div>
        <div class="text-center">
            <span class="font-bold text-lg tracking-normal">Whoops! Al parecer no encontramos resultados</span>
        </div>
        
    @elseif($result == 'default')

    @else
        <div class="p-6 text-center">
        <div class="p-4 space-y-4">

<div class="flex flex-col">
      <span class="font-bold text-2xl tracking-wide">{{ $result->nombres }} {{ $result->apellidos }}</span>
      <span>{{ $result->tipo_cedula }}-{{ $result->cedula }}</span>
      <span>Dirección: {{ $result->direccion }}</span>
      <span>Numero Telefonico: {{ $result->telefono }}</span>
      <span>{{ $result->email }}</span>
      <span>Fecha en la que egreso: {{ $result->fecha_egreso }}</span>
      <span class="text-xl">Identificador: {{ $result->identificador }}</span>
      <span class="font-bold tracking-normal">Agregado {{ $result->created_at->diffForHumans() }}</span>
   </div>

   <p class="text-sm block">Documentos solicitados</p>
   <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
 <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
     <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
         <tr>
             <th scope="col" class="px-6 py-3">
                 Tipo de Tramite
             </th>
             <th scope="col" class="px-6 py-3">
                 Costo
             </th>
             <th scope="col" class="px-6 py-3">
                 Cantidad
             </th>
         </tr>
     </thead>
     <tbody>
     @foreach($result->motivos as $motivo)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
               <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                  {{ $motivo['motivo'] }}
               </th>
               <td class="px-6 py-4">
                  {{ $motivo['precio'] }}
               </td>
               <td class="px-6 py-4">
                  {{ $motivo['cantidad'] }}
               </td>
            </tr>
     @endforeach
     </tbody>
 </table>

</div>

<div class="flex flex-col">
    @if(empty($result->cita->estatus))
    
    @else
   <span class="text-lg tracking-normal">Estatus del Tramite: <span>{{ $result->cita->estatus }}</span></span>
   @endif

   @if(empty($result->cita->fecha))

    @else
    <span class="text-lg tracking-normal">Fecha de la Cita: <span>{{ $result->cita->fecha }}</span></span>
    @endif
</div>


</div>
        </div>
    
    @endif
    

</div>
