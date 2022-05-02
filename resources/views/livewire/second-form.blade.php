<div>
<form wire:submit.prevent="save">
<div class="relative z-0 w-full mb-6 group">
        
        <select wire:model="type" class="block py-2.5 px-0 w-1/2 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" name="tipo_cedula" id="">
            <option hidden value="" selected></option>
            <option value="Nacional">Nacional</option>
            <option value="Internacional">Internacional</option>
        </select>
        <label for="type" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tipo de tramite</label>
    </div>
@if(empty($type))
    <span>Por favor selecciona el tipo de tramite</span>
@elseif($type == 'Nacional')
@foreach($nacionales as $nacional)
<fieldset>
<div class="flex justify-between mb-2">
    <div class="flex items-center">
      <input wire:model="motivos" id="{{ $nacional['id'] }}" aria-describedby="checkbox-1" value="{{ json_encode($nacional) }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
      <label for="{{ $nacional['id'] }}" class="ml-3 text-md font-semibold text-gray-900 dark:text-gray-300">{{ $nacional['nombre'] }}</label>
    </div>

    <div class="flex">
      <span>{{ $nacional['price'] }} PTR</span>
    </div>
  </div>
</fieldset>
@endforeach
@elseif($type == 'Internacional')
@foreach($internacionales as $internacional)
<fieldset>
<div class="flex justify-between mb-2">
    <div class="flex items-center">
      <input wire:model="motivos" id="{{ $internacional['id'] }}" aria-describedby="checkbox-1" value="{{ json_encode($internacional) }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
      <label for="{{ $internacional['id'] }}" class="ml-3 text-md font-semibold text-gray-900 dark:text-gray-300">{{ $internacional['nombre'] }}</label>
    </div>

    <div class="flex">
      <span>{{ $internacional['price'] }} PTR</span>
    </div>
  </div>
</fieldset>
@endforeach
@endif


@if($show_enco)
<label for="default-toggle" class="relative inline-flex items-center mb-4 cursor-pointer">
  <input wire:model="encomienda" type="checkbox" value="{{ true }}" id="default-toggle" class="sr-only peer">
  <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
  <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Quieres anadir el arancel de encomienda?</span>
</label>
@endif

<div class="flex justify-end mb-4">

<span class="font-bold text-lg">Total: {{ $this->calculateTotal() }} PTR ({{ number_format($this->calculateTotal() * 256.48 , 2 , ',' , '.') }} Bs)</span>

</div>

<button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold uppercase rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">siguiente</button>
    
</form>    
</div>
