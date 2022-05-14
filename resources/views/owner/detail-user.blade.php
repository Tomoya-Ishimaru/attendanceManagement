<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      詳細
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">

          <section class="text-gray-600 body-font">
            <div class="container px-5 mx-auto">
              <x-flash-message status="session('status')" />
              <div class="py-4">
                <div class="event-calendar mx-auto sm:px-6 lg:px-8">
                  <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @livewire('month-calendar',['user' => $user])
                  </div>
                </div>
              </div>

            </div>
          </section>

          {{-- エロクアント
                @foreach ($e_all as $e_user)
                  {{ $e_user->name }}
          {{ $e_user->created_at->diffForHumans() }}
          @endforeach
          <br>
          クエリビルダ
          @foreach ($q_get as $q_user)
          {{ $q_user->name }}
          {{ Carbon\Carbon::parse($q_user->created_at)->diffForHumans() }}
          @endforeach --}}
        </div>
      </div>
    </div>
  </div>
  <script>
    function deletePost(e) {
      'use strict';
      if (confirm('本当に削除してもいいですか?')) {
        document.getElementById('delete_' + e.dataset.id).submit();
      }
    }
  </script>
</x-app-layout>