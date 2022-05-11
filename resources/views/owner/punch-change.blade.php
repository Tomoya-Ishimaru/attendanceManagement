<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      打刻変更依頼
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="md:p-6 bg-white border-b border-gray-200">

          <section class="text-gray-600 body-font">
            <div class="container md:px-5 mx-auto">

              <x-flash-message status="session('status')" />
              <div class="flex justify-end mb-4">

              </div>

              <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                  <thead>
                    <tr>
                      <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">名前</th>
                      <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">出勤時間(修正前)</th>
                      <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">退勤時間(修正前)</th>
                      <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">出勤時間(修正後)</th>
                      <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">退勤時間(修正後)</th>
                      <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm  rounded-tr rounded-br"></th>
                      <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm  rounded-tr rounded-br"></th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)

                    <tr>
                      <form method="post" action="{{ route('owner.punchUpdata')}}">
                        @csrf
                        <x-jet-input type="hidden" name="daytimestamp_id" value="{{ $user['daytimestamp_id']}}" />
                        <x-jet-input type="hidden" name="user_id" value="{{ $user['id']}}" />
                        <x-jet-input type="hidden" name="newPunchIn" value="{{ $user['newPunchIn']}}" />
                        <x-jet-input type="hidden" name="newPunchOut" value="{{ $user['newPunchOut']}}" />
                        <td class="md:px-4 py-3">{{ $user['name'] }}</td>
                        <td class="md:px-4 py-3">{{ $user['daytimestamp']['punchIn'] }}</td>
                        <td class="md:px-4 py-3">{{ $user['daytimestamp']['punchOut'] }}</td>
                        <td class="md:px-4 py-3">{{ $user['newPunchIn'] }}</td>
                        <td class="md:px-4 py-3">{{ $user['newPunchOut']}}</td>
                        <td class="md:px-4 py-3">
                          <x-jet-button class="text-white bg-indigo-400 border-0 focus:outline-none hover:bg-indigo-500 rounded">
                            承認
                          </x-jet-button>
                        </td>
                      </form>
                      <!-- <form method="post"> -->
                      @csrf
                      <td class="md:px-4 py-3">
                        <x-jet-button href="#" onclick="deletePost(this)" class="text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-500 rounded ">
                          削除
                        </x-jet-button>
                      </td>
                      <!-- </form> -->
                    </tr>
                    @endforeach
                  </tbody>
                </table>
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
          @foreach ($q_get as $q_owner)
          {{ $q_owner->name }}
          {{ Carbon\Carbon::parse($q_owner->created_at)->diffForHumans() }}
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