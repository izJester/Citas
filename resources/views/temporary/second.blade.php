<x-guest-layout>
       <div class="flex space-x-2 my-12">
           @livewire('check-sidebar' , ['step' => 2])
                <div class="w-full p-6">
                    <div class="p-6 shadow">
                       @livewire('second-form')
                    </div>
                </div>
            </div>
</x-guest-layout>

