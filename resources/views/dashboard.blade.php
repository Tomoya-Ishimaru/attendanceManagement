<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('打刻') }}
        </h2>
    </x-slot>

  
    <x-flash-message status="$status" message="$message"/>
    <div class="appear left inview">
        @if($message !== null && $status==='1')
        <div class="item bg-blue-300 w-1/2 mx-auto p-2 my-4 text-white">{{$message}}</div>

        @elseif($message)
        <div class="item bg-red-300 w-1/2 mx-auto p-2 my-4 text-white">{{$message}}</div>
        @endif
    </div>

    <section class="text-gray-600 body-font ">
        <div class="container px-5 py-12 mx-auto ">

            <div class="flex flex-wrap -m-2 ">

                @if (Session::has('login_status'))
                <div class="p-2  md:w-1/2 w-full">
                    <div class="bg-blue-200 text-white flex justify-center items-center font-bold w-full h-20 mx-auto py-2 px-4 rounded">
                        出勤
                    </div>

                </div>
                @else

                <div class="p-2  md:w-1/2 w-full ">
                    <button type="button" onclick="location.href='{{ route('punchIn')}}'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold w-full h-20 mx-auto py-2 px-4 rounded">
                        出勤
                    </button>

                </div>
                @endif

                @if (Session::has('login_status'))
                <div class="p-2  md:w-1/2 w-full ">
                    <button type="button" onclick="location.href='{{ route('punchOut')}}'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold w-full h-20 py-2 px-4 rounded">
                        退勤
                    </button>
                </div>

                @else
                <div class="p-2  md:w-1/2 w-full ">
                    <div class="bg-blue-200  text-white  flex justify-center items-center font-bold w-full h-20 py-2 px-4 rounded">
                        退勤
                    </div>
                </div>
                @endif
                
            </div>

        </div>

    </section>
 

</x-app-layout>