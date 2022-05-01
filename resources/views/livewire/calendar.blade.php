<div>
  @if($message)
  {{$message}}
  @endif

  <div class="text-center text-sm mt-4">
    日付を選択してください。
  </div>
  <input id="calendar" class="block mt-1 mb-2 mx-auto" type="text" name="calendar" value="{{ $currentDate }}" wire:change="getDate($event.target.value)" />
  <div class="text-center mt-4">
    @if($punchIn)
    <span>修正前 出勤時刻</span>
    <span class="ml-1">{{$punchInDay}}</span>
    <span class="ml-1">{{$punchInTime}}</span>
    @endif
    <span>
      @if($punchOut)
      <span>退勤時刻</span>
      <span class="ml-1">{{$punchOutDay}}</span>
      <span class="ml-1">{{$punchOutTime}}</span>
      @endif
    </span>
  </div>

  <form method="post" action="{{ route('punchUpdata')}}">
    @csrf
    <input  type="hidden" name="punchId" value="{{ $punchId}}" />
    <div class="flex relative items-center justify-center flex-row mt-4">

      <div class="flex items-center justify-center flex-row ml-1 ">
        <div class="flex flex-row items-center">
          @if($punchIn)
          修正後 出勤時刻{{$punchInDay}}
          <div class=" mb-2 ml-1">
            <x-jet-input id="start_time" class="block mt-1 " type="text" name="punchInTime" value="{{ $punchInTime }}" required />
          </div>
          @endif
        </div>

        <div class="ml-1 flex flex-row items-center">
          @if($punchOut)
          退勤時刻{{$punchOutDay}}

          <div class=" mb-2 ml-1">
            <x-jet-input id="end_time" class="block mt-1 " type="text" name="punchOutTime" value="{{ $punchOutTime }}" required />
          </div>
          <x-jet-button class="ml-4">
          更新する
        </x-jet-button>
          @endif
        </div>
      </div>
    </div>
  </form>

  



</div>