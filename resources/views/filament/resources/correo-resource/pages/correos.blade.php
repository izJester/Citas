<x-filament::page>

<form wire:submit.prevent="submit">
    {{ $this->form }}
 
    <button class="bg-blue-400" type="submit">
        Submit
    </button>

</x-filament::page>
