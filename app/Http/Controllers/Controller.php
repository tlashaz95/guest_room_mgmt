<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
   public $Trades = ['Clk', 'W/Sigs', 'Tech/Sigs', 'D/Sigs', 'Op/Sigs', 'Gnr', 'Op', 'Dvr', 'DMTN', 'DSP', 'DSV','OCU', 'OGM', 'Obsr', 'OEPM', 'OEPS', 'Svy', 'TA', 'FE'];
    public $Ranks = ['Mr', 'Ms', 'Mrs', '2/Lt','Lt','Capt','Maj','Lt Col','Col','Brig', 'Maj Gen', 'Lt Gen', 'Gen',
        'Midshipman', 'S/Lt', 'Lt Cdr', 'Cdr', 'Cdre', 'RAdm', 'VAdm', 'Adm', 'Pilot Offr', 'Flying Offr', 'Flying Lt',
        'Sqn Ldr', 'Wing Comd', 'Gp Capt', 'Air Commodore', 'Air Vice Marshal', 'Air Marshal', 'Air Chief Marshal'];
    public $Cats = ['Serving(Lve)', 'Serving(Duty)', 'Retd', 'Blood Relative', 'Civ Serving Offr', 'Civ', 'HRA'];
    public $Months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
    public $Yr = ['2016','2017','2018','2019','2020','2021','2022','2023','2024', '2025'];

    private $user;

    public function __construct()
    {


        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if(isset($_GET['bde'])){
                if($this->user->role == "user"){
                    if($this->user->bde != $_GET['bde']){
                        return redirect('error/forbidden');
                    }
                    if(isset($_GET['unit']))
                    if($this->user->unit != null){
                        if($this->user->unit != $_GET['unit']){
                            return redirect('error/forbidden');
                        }
                    }
                }
            }

            return $next($request);
        });
    }

    public static function getTimeDifference($startTimeStamp, $endTimeStamp){
        $start_date = new DateTime($startTimeStamp);
        $since_start = $start_date->diff(new DateTime($endTimeStamp));
//        $days =  $since_start->days.' days total<br>';
        $year =  $since_start->y;
        $months =  $since_start->m;
        $days =  $since_start->d;
        $hours = $since_start->h;
        $minutes = $since_start->i;
        $seconds = $since_start->s;

        $timeDiffereceData =
            [
                [
                    'year'=>$year,
                    'months'=>$months,
                    'day'=>$days,
                    'hours'=>$hours,
                    'minutes'=>$minutes,
                    'seconds'=>$seconds,
                ]
            ];

        $timeString = "";
        if($year > 0 && $months > 0)
            $timeString = "$year Years $months Months";

        if($year == 0 && $months == 0 && $days > 0)
            $timeString = "$days Days";

        if($year == 0 && $months == 0 && $days == 0 && $hours > 0)
            $timeString = "$hours Hours";

        if($year == 0 && $months == 0 && $days == 0 && $hours == 0 && $minutes > 0)
            $timeString = "$minutes Minutes";

        if($year == 0 && $months == 0 && $days == 0 && $hours == 0 && $minutes == 0 && $seconds > 0)
            $timeString = "$seconds Seconds";

        $timeString.=" Ago";

        return $timeString;

    }

    public function uploadImage($imgFile)
    {
        if(isset($imgFile)){
            $image = $imgFile;
            $imgname = time() .rand(1000,9999). "." . $image->getClientOriginalExtension();
            $destinationPath = public_path('../images/');
            $image->move($destinationPath, $imgname);
            return $imgname;
        }
        else{
            return "defaultOption.jpg";
        }
    }


}
