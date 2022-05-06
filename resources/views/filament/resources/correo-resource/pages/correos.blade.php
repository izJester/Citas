<x-filament::page>

<form wire:submit.prevent="submit">
    {{ $this->form }}
 
    <x-filament::button class=" mt-4" type="submit">
        Enviar
    </x-filament::button>

</x-filament::page>
