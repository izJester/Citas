<div>
    <div class="flex justify-end px-6">
        <span>ID: <span class="font-semibold text-gray-400">{{ session('code') }}</span></span>
    </div>
<form wire:submit.prevent="store">
    <div class="grid gap-6 mb-6 lg:grid-cols-2">
        <div>
            <label for="nombres" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nombres</label>
            <input wire:model="nombres" name="nombres" type="text" id="nombres" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John Paul" required>
        </div>
        <div>
            <label for="apellidos" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Apellidos</label>
            <input wire:model="apellidos" type="text" id="apellidos" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe Malcolm" required>
        </div>
        <div>
            <label for="tipo_cedula" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tipo de Documento</label>
            <select wire:model="tipo_cedula" id="tipo_cedula" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected hidden>Selecciona una opcion</option>
                <option value="V">V</option>
                <option value="E">E</option>
                <option value="E">R</option>

            </select>   
        </div>
        <div>
            <label for="cedula" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Documento de Identidad</label>
            <input wire:model="cedula" type="text" id="cedula" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ej: 24556434" required>
        </div>
        <div>
            <label for="nucleo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nucleo</label>
            <select wire:model="nucleo" id="nucleo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected hidden>Selecciona una opcion</option>
                <option value="chuao">Chuao</option>
                <option value="guatire">Guatire</option>

            </select>   
        </div>
        <div>
            <label for="carrera" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Carrera</label>
            <input wire:model="carrera" type="text" id="carrera" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ej: Ing de Sistemas" required>
        </div>
        <div>
            <label for="correo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Correo</label>
            <input wire:model="email" type="email" id="correo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="example@example.com" required>
        </div>  
        <div>
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Telefono</label>
            <input wire:model="telefono" type="tel" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123-45-678" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required>
        </div>
        <div>
            <label for="pais" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pais</label>
            <select wire:model="pais" id="pais" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected hidden>Selecciona un pais</option>
                @foreach($paises as $pais)
                <option value="{{$pais->name}}">{{ $pais->flag }} {{$pais->name}}</option>
                @endforeach
            </select>   
        </div>
        <div>
            <label for="direccion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Direccion</label>
            <input wire:model="direccion" type="text" id="direccion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
        </div>
    </div>
    <div class="mb-6">
        <label for="fecha" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Fecha de Egreso</label>
        <input type="date" wire:model="fecha_nacimiento" id="fecha" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
    </div>  
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Enviar</button>
</form>
</div>

@push('scripts')
<script src="https://unpkg.com/flowbite@1.4.5/dist/datepicker.js"></script>
<script>

</script>


@endpush
