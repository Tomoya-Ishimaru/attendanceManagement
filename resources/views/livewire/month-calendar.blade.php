<div>
<div class="lg:w-2/3 w-full mx-auto overflow-auto">
        <input id="monthCalendar" class="block mt-1 mb-2 mx-auto" type="text" placeholder="月を選択してください" name="monthCalendar"   wire:change="getData($event.target.value)" />
        <table class="table-auto w-full text-left whitespace-no-wrap">
            <thead>
                <tr>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">名前</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メールアドレス</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">労働時間</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
            </thead>
            <tbody>
            
                <tr>
                    <td class="px-4 py-3">{{ $user->name }}</td>
                    <td class="px-4 py-3">{{ $user->email }}</td>
                    @if($monthtimestamps)
                    <td class="px-4 py-3">{{ $monthtimestamps->m_total }}</td>
                    @else
                    <td class="px-4 py-3">
                        該当のデータがありません。
                    </td>
                    @endif
                </tr>

            </tbody>
        </table>
    </div>
</div>
