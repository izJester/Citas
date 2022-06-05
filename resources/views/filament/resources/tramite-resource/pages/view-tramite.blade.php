<x-filament::page>

   <x-filament::card>
   
   <div class="flex flex-col">
      <span class="font-bold text-lg tracking-wide">{{ $record->nombres }} {{ $record->apellidos }}</span>
      <span>{{ $record->tipo_cedula }}-{{ $record->cedula }}</span>
   </div>

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
            </tr>
        </thead>
        <tbody>
        @foreach($record->motivos as $motivo)
               <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                     {{ $motivo->nombre }}
                  </th>
                  <td class="px-6 py-4">
                     {{ $motivo->price }}
                  </td>
               </tr>
        @endforeach
        </tbody>
    </table>
</div>
   </x-filament::card>

</x-filament::page>
