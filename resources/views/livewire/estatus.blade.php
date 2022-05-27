<div>
    <input wire:model="search" type="text">
    @error('search') <span class="error">{{ $message }}</span> @enderror
    <button wire:click="search">Buscar</button>
    <span>{{ $result }}</span>

</div>
