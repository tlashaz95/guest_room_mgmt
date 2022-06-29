<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class BookingController extends Controller
{
    private $table="tbl_booking";
    private $module = "bookings";
    private $view_folder = "bookings";

    public $mod = "Bookings";


    public function index($id = -1)
    {
        $data['module_data'] = $this->get();

        $data['id'] = $id;
        $data['title'] = "List of ".$this->module;
        $data['table'] = $this->table;
        $data['module'] = $this->module;
        $data['view_folder'] = $this->view_folder;

        return view($this->view_folder . ".index", $data);
    }

    public function get(){
        return DB::table($this->table)->orderBy('BookingID', 'desc')->where('flag','1')->get();
    }

    public function create_edit($id = -1)
    {
        $data['module'] = $this->module;

        $data['id'] = $id;
        $data['title'] = ($id == "-1" ? "Add" : "Update")." ".$this->module;
        if ($id !== "-1") {
            $data['data'] = DB::table($this->table)->where('BookingID', $id)->get();
        }
        return view($this->view_folder . '.create_edit', $data);
    }

    public function store_update($id = -1, Request $request)
    {
        $date = date('Y-m-d');
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

        $RoomData = [
            'RoomStatus'    =>  'Occupied',
            'updated_at'    =>  $date
        ];

//        print_r($data);
        try {
            // Create Log
            $log = [
                'LogUser' => Auth::user()->email,
                'Module' => "Bookings / Checkin-Checkout",
                'Unit' => Auth::user()->unit,
                'Bde' => Auth::user()->bde,
                'Action' => $id==-1 ? "Data Created" : "Data Edited"
            ];
            if ($id == -1) {
                $AccnID = DB::table($this->table)->insertGetId($data);
                DB::table('tbl_logs')->insert($log);
                DB::table('tbl_rooms')->where('RoomID', $request->get('RoomID'))->update($RoomData);
            } else {
                DB::table($this->table)->where('BookingID', $id)->update($data);
                DB::table('tbl_logs')->insert($log);
            }

            return redirect(route($this->module))->with('success', $this->module . ' data has been ' . ($id == "-1" ? "Added" : "Updated"));
        }catch (\Illuminate\Database\QueryException $exception){
            return back()->with('exception', "Exception: ".$exception->getMessage());
        }

    }

    public function delete($id)
    {
        DB::table($this->table)->where('BookingID', $id)->update(array('flag' => 0));
        // Create Log
        $log = [
            'LogUser' => Auth::user()->email,
            'Module' => "Bookings / Checkin - Checkouts",
            'Unit' => Auth::user()->unit,
            'Bde' => Auth::user()->bde,
            'Action' => "Data Deleted"
        ];
        DB::table('tbl_logs')->insert($log);
        return back()->with('danger', $this->module . ' data has been Deleted');
    }

    public static function getAccn($AccnType){
        $Accn=0;
        if(Auth::user()->role == "admin")
        {
            if(isset($_GET['bde'])){
                $Accn = DB::table('tbl_accn')->where('Bde', $_GET['bde'])->where('flag', '1')->sum($AccnType);
            }

            if(isset($_GET['bde']) && isset($_GET['unit'])){
                $Accn = DB::table('tbl_accn')->where('Bde', $_GET['bde'])->where('unit', $_GET['unit'])->where('flag', '1')->sum($AccnType);
            }
            if(!isset($_GET['bde']) && !isset($_GET['unit']))
            {
                $Accn = DB::table('tbl_accn')->where('flag', '1')->sum($AccnType);
            }
            return $Accn;
        }

        if(Auth::user()->role == "user"){
            if(Auth::user()->unit != null || Auth::user()->unit != "")
                return DB::table('tbl_accn')->where('Bde',Auth::user()->bde)->where('Unit',Auth::user()->unit)->where('flag', '1')->sum($AccnType);
            if(Auth::user()->unit == null || Auth::user()->unit == "")
                return DB::table('tbl_accn')->where('Bde',Auth::user()->bde)->where('flag', '1')->sum($AccnType);
        }
    }
}
