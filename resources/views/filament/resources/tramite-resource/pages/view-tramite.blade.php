<x-filament::page>

   <x-filament::card>
     
   <div class="p-4 space-y-4">

   <div class="flex flex-col">
         <span class="font-bold text-2xl tracking-wide">{{ $record->nombres }} {{ $record->apellidos }}</span>
         <span>{{ $record->tipo_cedula }}-{{ $record->cedula }}</span>
         <span>Dirección: {{ $record->direccion }}</span>
         <span>Numero Telefonico: {{ $record->telefono }}</span>
         <span>{{ $record->email }}</span>
         <span>Fecha en la que egreso: {{ $record->fecha_egreso }}</span>
         <span class="text-xl">Identificador: {{ $record->identificador }}</span>
         <span class="font-bold tracking-normal">Agregado {{ $record->created_at->diffForHumans() }}</span>
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
        @foreach($record->motivos as $motivo)
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
      @if(empty($record->cita->estatus))
      
      @else
      <span class="text-lg tracking-normal">Estatus del Tramite: <span>{{ $record->cita->estatus }}</span></span>
      @endif

      @if(empty($record->cita->fecha))

    @else
    <span class="text-lg tracking-normal">Fecha de la Cita: <span>{{ $record->cita->fecha }}</span></span>
    @endif
   </div>


   </div>
      

   </x-filament::card>

</x-filament::page>
