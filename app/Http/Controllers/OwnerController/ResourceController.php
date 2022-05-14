<?php

namespace App\Http\Controllers\OwnerController;

use App\Http\Controllers\Controller;
use App\Models\Daytimestamp;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StampCheck;
use Illuminate\Support\Facades\DB;
use App\Services\TimeCalc;
use App\Models\Monthtimestamp;
use App\Models\Owner;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// use function Symfony\Component\String\s;

class ResourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owner');
    }


    public function index()
    {

        $users = User::select('id', 'name', 'email', 'created_at')
            ->paginate(3);

        return view(
            'owner.dashboard',
            compact('users')
        );
    }

    public function punchChange()
    {
        $stampChecks = StampCheck::with('daytimestamp')->get()->toArray();
        $users = [];
        foreach ($stampChecks as $stampCheck) {
            $user = User::select('id', 'name', 'email', 'created_at')
                ->where('id', "=", $stampCheck['daytimestamp']['user_id'])->first()->toArray();
            $userMaster=$user+ $stampCheck;
            array_push($users, $userMaster);
        }
        return view(
            'owner.punch-change',
            compact('users')
        );
    }

    public function punchUpdata(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $daytimestamp = Daytimestamp::where('id', $request->daytimestamp_id)->first();
                $punchInCarbon = Carbon::parse($daytimestamp->punchIn);
                $punchInDay = $punchInCarbon->format('Y-m-d');
                $newPunchIn = sprintf('%s %s', $punchInDay, $request->newPunchIn);
                $punchOutCarbon = Carbon::parse($daytimestamp->punchOut);
                $punchOutDay = $punchOutCarbon->format('Y-m-d');
                $newPunchOut = sprintf('%s %s', $punchOutDay, $request->newPunchOut);
                $newPunchInCarbon = Carbon::parse($newPunchIn);
                $newPunchOutCarbon = Carbon::parse($newPunchOut);
                $timeCalcService = new TimeCalc();
                $result_string =  $timeCalcService->getDayTotal($newPunchInCarbon, $newPunchOutCarbon);
            

                Daytimestamp::where('id', $request->daytimestamp_id)
                ->update(['stamp_status' => false]);

                Daytimestamp::create([
                    'user_id' => $request->user_id,
                    'stamp_status' => true,
                    'punchIn' => $newPunchIn,
                    'punchOut' => $newPunchOutCarbon,
                    'date' => $daytimestamp->date,
                    'd_total' => $result_string
                ]);

                StampCheck::where('daytimestamp_id',$request->daytimestamp_id)->delete();

                $monthTimestamp = Monthtimestamp::where('user_id', $request->user_id,)->latest()->first();

     
                if(!$monthTimestamp || 
                   date_format($daytimestamp->created_at,'m') 
                   !== date_format($monthTimestamp->created_at,'m')){
        
                 Monthtimestamp::create([
                    'user_id' => $request->user_id,
                    'm_id' => date_format($daytimestamp->created_at,'Ym'),
                    'm_total' => $result_string
                ]);
        
                }else{

                    $daytimestamps = Daytimestamp::where('user_id',$request->user_id)
                    ->where('stamp_status',true)
                    ->get();
                    foreach($daytimestamps as $d_timestamp){
                        $mSec =+ $timeCalcService->hour_to_sec($d_timestamp->d_total);
                    }
                    $monthTimestamp->update([
                        'm_total' => trim($timeCalcService->sec_to_hour($mSec))
                    ]);
                }

            }, 2);
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return redirect()
        ->route('owner.punchChange')
        ->with(['message' => '打刻の変更を承認しました',
        'status' => 'info']);
    
    }

    public function userCreate()
    {
        return view('owner.create');
    }

    public function UserStore(Request $request)
    {
        //$request->name;
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:owners',
            'password' => 'required|string|confirmed|min:8',
        ]);
        

        $owner = auth()->guard()->user();
            
                User::create([
                    'name' => $request->name,
                    'corporation_id' => $owner->corporation_id,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'login_status' => false,
                    // 'created_at' => Carbon::now()
                ]);
    
       
        return redirect()
        ->route('owner.dashboard')
        ->with(['message' => 'オーナー登録を実施しました。',
        'status' => 'info']);
    }

    
    public function userDedail($id)
    {
        $user = User::findOrFail($id);

        return view('owner.detail-user', compact('user'));
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete(); //ソフトデリート

        return redirect()
        ->route('owner.dashboard')
        ->with(['message' => 'オーナー情報を削除しました。',
        'status' => 'alert']);
    }

    public function expiredUserIndex(){
        $expiredUsers = User::onlyTrashed()->get();
        return view('owner.expired-users', compact('expiredUsers'));
    }
    
    public function expiredUserDestroy($id){
        User::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('expired-users.index'); 
    }

}
