@props(['message' => 'このメッセージはデフォルトです。' 
'type' => 'alert'
])


@php
if($type === 'info'){$bgColor = 'bg-blue-300';}
if($type === 'alert'){$bgColor = 'bg-red-500';}
@endphp

@if(!$message)
  <div class="{{ $bgColor }} w-1/2 mx-auto p-2 my-4 text-white">
    {{$message}}aaaaa
  </div>
@endif
