<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\CarbonImmutable;
use App\Models\Daytimestamp;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Calendar extends Component
{
    public $currentDate;
    public $currentWeek;
    public $day;
    public $checkDay;
    public $dayOfWeek;
    public $sevenDaysLater;
    public $timestamp;
    public $message;
    public $punchId;
    public $punchInDay;
    public $punchIn;
    public $punchOut;
    public $punchInTime;
    public $punchOutTime;
    public $punchInHour;
    public $punchInMinute;
    public $punchInSecond;
    public $punchOutDay;
    public $punchOutHour;
    public $punchOutMinute;
    public $punchOutSecond;



    public function mount()
    {
        $this->currentDate = CarbonImmutable::today();
        $this->sevenDaysLater = $this->currentDate->addDays(7);
        $this->currentWeek = [];
        

        // $this->events = EventService::getWeekEvents(
        //     $this->currentDate->format('Y-m-d'),
        //     $this->sevenDaysLater->format('Y-m-d'),
        // );

        for($i = 0; $i < 7 ; $i++){
            $this->day = CarbonImmutable::today()->addDays($i)->format('m月d日');
            $this->checkDay = CarbonImmutable::today()->addDays($i)->format('Y-m-d');
            $this->dayOfWeek = CarbonImmutable::today()->addDays($i)->dayName;
            array_push($this->currentWeek, [
                'day' => $this->day,
                'checkDay' => $this->checkDay,
                'dayOfWeek' => $this->dayOfWeek  
            ]);
        }
        // dd($currentDate);
        // dd($this->currentWeek);
    }

    public function getDate($date)
    {
     
        $this->message="";
        $this->punchInTime="";
        $this->punchOutTime="";
        $user = Auth::user();
        if(!$this->timestamp = Daytimestamp::where('user_id', $user->id)
                                 ->where('date', $date)
                                 ->orderBy('created_at', 'desc')
                                 ->first()
                                // ->get()
                                 )
                                 {
                                    $this->message="打刻記録がありません";
                                 }
                                //   dd($this->timestamp->punchIn);
                                // dd($this->timestamp);

        if($this->timestamp)
        {
            $this->punchId = $this->timestamp->id;
            $this->punchIn = new Carbon($this->timestamp->punchIn);
            $this->punchOut = new Carbon($this->timestamp->punchOut); 
       
            $this->punchInDay =$this->punchIn->format('y-m-d');
            $this->punchInTime =$this->punchIn->format('H:i:s');
            // $this->punchInHour =$this->punchInTime->hour;
            // $this->punchInMinute =$this->punchInTime->minute;
            // $this->punchInSecond =$this->punchInTime->second;
            $this->punchOutDay =$this->punchOut->format('y-m-d');
            $this->punchOutTime =$this->punchOut->format('H:i:s');
            
            // $this->punchOutHour =$this->punchOutTime->hour;
            // $this->punchOutMinute =$this->punchOutTime->minute;
            // $this->punchOutSecond =$this->punchOutTime->second;         
        }    
        

        // $this->currentDate = $date;
        // $this->currentWeek = [];
        // $this->sevenDaysLater = CarbonImmutable::parse($this->currentDate)->addDays(7);

        // $this->events = EventService::getWeekEvents(
        //     $this->currentDate,
        //     $this->sevenDaysLater->format('Y-m-d'),
        // );

        // for($i = 0; $i < 7 ; $i++){
        //     $this->day = CarbonImmutable::parse($this->currentDate)->addDays($i)->format('m月d日');
        //     $this->checkDay = CarbonImmutable::parse($this->currentDate)->addDays($i)->format('Y-m-d');
        //     $this->dayOfWeek = CarbonImmutable::parse($this->currentDate)->addDays($i)->dayName;
        //     array_push($this->currentWeek, [
        //         'day' => $this->day,
        //         'checkDay' => $this->checkDay,
        //         'dayOfWeek' => $this->dayOfWeek 
        //     ]);
        // }

    }
    public function render()
    {
        return view('livewire.calendar');
    }
}
