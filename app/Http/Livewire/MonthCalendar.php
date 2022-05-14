<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Monthtimestamp;

class MonthCalendar extends Component
{

    public $lastMonth;
    public $user;
    public $monthtimestamps;

    public function mount()
    {

    }

    public function getData($month)
    {
        $this->monthtimestamps = Monthtimestamp::where('user_id',$this->user->id)
                                                ->where('m_id',$month)->first(['m_total']);
    }





    public function render()
    {
        return view('livewire.month-calendar');
    }
}
