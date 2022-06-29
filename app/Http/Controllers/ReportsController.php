<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class ReportsController extends Controller
{
    private $table="tbl_reservations";
    private $module = "reports";
    private $view_folder = "reports";

    public $mod = "Reports";


    public function index()
    {
        $month = date('m');
        $yr = date('y');

        $data['CombData'] = DB::table('tbl_billing')
            ->join('tbl_booking', 'tbl_billing.BookingID', '=', 'tbl_booking.BookingID')
            ->where('tbl_billing.Yr', '=',$yr)->where('tbl_billing.Month', '=', $month)->get();

        $data['revenue'] = DB::table('tbl_billing')->where('Month', $month)->where('Yr', $yr)->sum('Paid');
        $data['occupancy'] = DB::table($this->table)->where('Month', $month)->where('Yr', '20'.$yr)->count();
        $data['totalRooms'] = DB::table('tbl_rooms')->where('flag', '1')->count();
        $data['title'] = "Monthly Report - ".$month." / ".$yr;
        $data['table'] = $this->table;
        $data['module'] = $this->module;
        $data['view_folder'] = $this->view_folder;

        return view($this->view_folder . ".index", $data);
    }

    public function dailyReport()
    {
        $day = date('d');
        $month = date('m');
        $yr = date('y');
        $date = date('Y-m-d');

        $data['CombData'] = DB::table('tbl_billing')
            ->join('tbl_booking', 'tbl_billing.BookingID', '=', 'tbl_booking.BookingID')
            ->where('tbl_billing.created_at', 'like', $date.'%')->get();

        $data['revenue'] = DB::table('tbl_billing')->where('created_at', 'like', $date.'%')->sum('Paid');
        $data['occupancy'] = DB::table($this->table)->where('CheckIn', $date)->count();
        $data['totalRooms'] = DB::table('tbl_rooms')->where('flag', '1')->count();
        $data['title'] = "Daily Report - ".$day."/".$month."/".$yr;
        $data['table'] = $this->table;
        $data['module'] = $this->module;
        $data['view_folder'] = $this->view_folder;

        return view($this->view_folder.".daily", $data);
    }

    public function weeklyReport()
    {
        $currentDate = date('Y-m-d H:i:s');
        $weekDate = date('Y-m-d H:i:s', strtotime('-7 day'));

        $data['CombData'] = DB::table('tbl_billing')
            ->join('tbl_booking', 'tbl_billing.BookingID', '=', 'tbl_booking.BookingID')
            ->whereBetween('tbl_billing.created_at',
                array($weekDate, $currentDate))->get();

        $data['revenue'] = DB::table('tbl_billing')->whereBetween('created_at',
            array($weekDate, $currentDate))->sum('Paid');
        $data['occupancy'] = DB::table($this->table)->whereBetween('created_at',
            array($weekDate, $currentDate))->count();
        $data['totalRooms'] = DB::table('tbl_rooms')->where('flag', '1')->count();
        $data['title'] = "Weekly Report - ".date('d-m-y', strtotime($weekDate))." to ".date('d-m-y',
                strtotime($currentDate));
        $data['table'] = $this->table;
        $data['module'] = $this->module;
        $data['view_folder'] = $this->view_folder;

        return view($this->view_folder.".weekly", $data);
    }

    public function getData(Request $request)
    {
        $Month = $request->get('Month');
        $Yr = $request->get('Yr');
        if($Month == "Select Month")
        {
            $data['CombData'] = DB::table('tbl_billing')
                ->join('tbl_booking', 'tbl_billing.BookingID', '=', 'tbl_booking.BookingID')
                ->where('tbl_billing.Yr', '=',substr($Yr, -2))->get();

            $data['BookingData'] = DB::table('tbl_booking')->where('Yr', $Yr)->get();
            $data['BillingData'] = DB::table('tbl_billing')->where('Yr', $Yr)->get();

            $data['revenue'] = DB::table('tbl_billing')->where('Yr', substr($Yr,-2))->sum('Paid');
            $data['occupancy'] = DB::table($this->table)->where('Yr', $Yr)->count();
            $data['title'] = "Yearly Report - ".$Yr;
        }
        else
        {
            $data['CombData'] = DB::table('tbl_billing')
                ->join('tbl_booking', 'tbl_billing.BookingID', '=', 'tbl_booking.BookingID')
                ->where('tbl_billing.Yr', '=',substr($Yr, -2))->where('tbl_billing.Month', '=', $Month)->get();

            $data['BookingData'] = DB::table('tbl_booking')->where('Month', $Month)->where('Yr', $Yr)->get();
            $data['BillingData'] = DB::table('tbl_billing')->where('Month', $Month)->where('Yr', $Yr)->get();

            $data['revenue'] = DB::table('tbl_billing')->where('Month', $Month)->where('Yr', substr($Yr,-2))->sum('Paid');
            $data['occupancy'] = DB::table($this->table)->where('Month', $Month)->where('Yr', $Yr)->count();

            $data['title'] = "Monthly Report - ".$Month." / ".$Yr;
        }
        $data['totalRooms'] = DB::table('tbl_rooms')->where('flag', '1')->count();

        $data['module'] = $this->module;
        $data['view_folder'] = $this->view_folder;

        return view($this->view_folder . ".index", $data);
    }

    public function get(){
        return DB::table($this->table)->orderBy('ReportID', 'desc')->where('flag','1')->get();
    }

    public function create_edit($id = -1)
    {
        $data['module'] = $this->module;

        $data['id'] = $id;
        $data['title'] = ($id == "-1" ? "Add" : "Update")." ".$this->module;
        if ($id !== "-1") {
            $data['data'] = DB::table($this->table)->where('BillingID', $id)->get();
        }
        return view($this->view_folder . '.create_edit', $data);
    }

    public function show($id)
    {
        $data['module'] = $this->module;
        $data['bookingData'] = DB::table('tbl_booking')->where('BookingID', $id)->get();
        $data['data'] = DB::table($this->table)->where('BookingID', $id)->get();
        return view($this->view_folder . '.show', $data);
    }

    public function store_update($id = -1, Request $request)
    {
//        $data = [
//            'number' => $request->get('customer'),
//            'contact' => $request->get('contact'),
//            'address' => $request->get('address'),
//            'balance' => $request->get('balance'),
//            'added_by' => Auth::user()->getAuthIdentifier()
//        ];
        foreach ($request->except('_token') as $key=>$value){
            if($request->has($key) && Schema::hasColumn($this->table,$key))
                $data[$key] = $value;
        }
        if($request->hasFile('Picture')){
            $data['Picture']=$this->uploadImage($request->file('Picture'));
        }

//        print_r($data);
        try {
            // Create Log
            $log = [
                'LogUser' => Auth::user()->email,
                'Module' => "Billing",
                'Unit' => Auth::user()->unit,
                'Bde' => Auth::user()->bde,
                'Action' => $id==-1 ? "Data Created" : "Data Edited"
            ];
            if ($id == -1) {
                $AccnID = DB::table($this->table)->insertGetId($data);
                DB::table('tbl_logs')->insert($log);
            } else {
                DB::table($this->table)->where('BillingID', $id)->update($data);
                DB::table('tbl_logs')->insert($log);
            }

            return redirect(route($this->module))->with('success', $this->module . ' data has been ' . ($id == "-1" ? "Added" : "Updated"));
        }catch (\Illuminate\Database\QueryException $exception){
            return back()->with('exception', "Exception: ".$exception->getMessage());
        }

    }

    public function delete($id)
    {
        DB::table($this->table)->where('BillingID', $id)->update(array('flag' => 0));
        // Create Log
        $log = [
            'LogUser' => Auth::user()->email,
            'Module' => "Billing",
            'Unit' => Auth::user()->unit,
            'Bde' => Auth::user()->bde,
            'Action' => "Data Deleted"
        ];
        DB::table('tbl_logs')->insert($log);
        return back()->with('danger', $this->module . ' data has been Deleted');
    }

    public static function getMonthlyReport($Type, $Month)
    {
        $yr = date('y');
        $days = cal_days_in_month(CAL_GREGORIAN, $Month, $yr);
        if($Type == "Revenue")
        {
            return DB::table('tbl_billing')->where('Month', $Month)->where('Yr', $yr)->sum('Paid');
        }
        if($Type == "Occupancy")
        {
            $totalRooms = DB::table('tbl_rooms')->where('flag', '1')->count();
            $Occupancy = DB::table('tbl_reservations')->where('Month', $Month)->where('Yr', '20'.$yr)->count();
            $maxOccupancy = $totalRooms * $days;
            $OccupancyStatus = ($Occupancy / $maxOccupancy) * 100;
            return $OccupancyStatus;
        }
    }
}
