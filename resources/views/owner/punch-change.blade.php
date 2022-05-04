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
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メールアドレス</th>
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">作成日</th>
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th></thead>
                        <tbody>
                          @foreach ($users as $user)
                          <tr>
                            <td class="md:px-4 py-3">{{ $user->name }}</td>
                            <td class="md:px-4 py-3">{{ $user->email }}</td>
                            <td class="md:px-4 py-3">{{ $user->created_at}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      {{ $users->links() }}
                    </div>
                  </div>
                </section>

              {{--  エロクアント
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

</x-app-layout>
