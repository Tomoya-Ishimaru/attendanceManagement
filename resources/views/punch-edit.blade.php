<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('打刻修正') }}
        </h2>
    </x-slot>

  
    <x-flash-message status="session('status')" />

    <div class="py-4">
      <div class="event-calendar mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            @livewire('calendar')
        </div>
      </div>
   </div>
 
</x-app-layout>