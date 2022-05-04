<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Daytimestamp;
use App\Models\Monthtimestamp;
use App\Models\StampCheck;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\TimeCalc;


class TimeController extends Controller
{
    public function index(Request $request){

        $user = Auth::user();
        if($user->login_status == 1){
            $request->session()->put('login_status',  "1");
        }
        return view('dashboard',[
            'message' => '',
            'status' => '',
        ])
        ;
    }

    public function punchIn(Request $request)
    {
        $user = Auth::user();
        $user = User::where('id', $user->id)->latest()->first();
        
        //出勤時の時間取得
        $timestamp = Daytimestamp::create([
            'user_id' => $user->id,
            'stamp_status' => true,
            'punchIn' => Carbon::now(),
        ]);

        $user->login_status =1;
        $user->save();

        $request->session()->put('login_status',  "1");

        return  
         view('dashboard',
         [ 'message' => '出勤しました。',
            'status' => '1'
        ]);

    }
    public function punchOut(Request $request)
    {

        $user = Auth::user();
        $user = User::where('id', $user->id)->latest()->first();
        $timestamp = Daytimestamp::where('user_id', $user->id)->latest()->first();

        $punchInTime = $timestamp->punchIn;
        $punchOutTime = Carbon::now();
        $punchOutTime->addHour(4); // 1時間後
        $punchOutTime->addMinute(10);
       
        $start_carbon = Carbon::parse($punchInTime);
        $end_carbon   = Carbon::parse($punchOutTime);
        if ($start_carbon->gt($end_carbon)) {
            return null;
        }

        $timeCalcService = new TimeCalc();
        $result_string =  $timeCalcService->getDayTotal($start_carbon,$end_carbon);   
        
        $date = date_format($punchOutTime,'Y-m-d');

        $timestamp->update([
            'punchOut' => $punchOutTime,
            'date'=> $date,
            'd_total' => $result_string
        ]);
        
        $monthTimestamp = Monthtimestamp::where('user_id', $user->id)->latest()->first();

     
        if(!$monthTimestamp || 
           date_format($timestamp->created_at,'m') 
           !== date_format($monthTimestamp->created_at,'m')){

         Monthtimestamp::create([
            'user_id' => $user->id,
            'm_id' => date_format($timestamp->created_at,'Ym'),
            'm_total' => $result_string
        ]);

        }else{
            $mSec = $timeCalcService->hour_to_sec($monthTimestamp->m_total);
            $rSec = $timeCalcService->hour_to_sec($result_string);
            $totalSec = $mSec + $rSec;

            $monthTimestamp->update([
                'm_total' => trim($timeCalcService->sec_to_hour($totalSec))
            ]);
        }

        $user->login_status =0;
        $user->save();

        
        $request->session()->remove('login_status');

        return 
        view('dashboard',
        ['message' => '退勤しました。',
        'status' => 'info',
        ],);
    }

    public function punchEdit(){
        $user = Auth::user();
        return view('punch-edit');
    }

    public function punchUpdata(Request $request){

        $user = Auth::user();

        StampCheck::create([
            'daytimestamp_id' => $request->punchId,
            'newPunchIn' =>$request->punchInTime,
            'newPunchOut' =>$request->punchOutTime,
        ]);
        
        return redirect()
        ->route('modify')
        ->with(['message' => '打刻の修正を申請しました。',
        'status' => 'info']);
    }

    public function shift(Request $request){

        return view('shift');
    }

    public function shiftSubmit(Request $request){

        return view('shift-submit');
    }

    
}