<div>
    <div class="text-center text-sm">
        日付を選択してください。本日から最大30日先まで選択可能です。
    </div>
      <input id="calendar" class="block mt-1 mb-2 mx-auto" 
      type="text" name="calendar"
      value="{{ $currentDate }}"
      wire:change="getDate($event.target.value)" />
    
      
      </div>
</div>
