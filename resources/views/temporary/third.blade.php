<x-guest-layout>
       <div class="flex space-x-2 my-12">
           @livewire('check-sidebar' , ['step' => 3])
                <div class="w-full p-6">
                    <div class="p-6 shadow">
                       @livewire('third-form')
                    </div>
                </div>
            </div>
</x-guest-layout>

