<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class RoomController extends Controller
{
    private $table="tbl_rooms";
    private $module = "rooms";
    private $view_folder = "rooms";

    public $mod = "Rooms";


    public function index()
    {
        $data['module_data'] = $this->get();


        $data['totalRooms'] = DB::table('tbl_rooms')->where('flag', '1')->count();
        $data['roomBooking'] = DB::table('tbl_booking')->get();
        $data['title'] = "List of ".$this->module;
        $data['table'] = $this->table;
        $data['module'] = $this->module;
        $data['view_folder'] = $this->view_folder;

        return view($this->view_folder . ".index", $data);
    }

    public function get(){
        return DB::table($this->table)->orderBy('RoomID', 'asc')->get();
    }

    public function create_edit($id = -1)
    {
        $data['module'] = $this->module;

        $data['id'] = $id;
        $data['title'] = ($id == "-1" ? "Add" : "Update")." ".$this->module;
        if ($id !== "-1") {
            $data['data'] = DB::table($this->table)->where('RoomID', $id)->get();
        }
        return view($this->view_folder . '.create_edit', $data);
    }

    public function getRoom($RoomID)
    {
        $RoomNo = DB::table($this->table)->select('RoomNo')->where('RoomID', $RoomID)->first();
        print_r($RoomNo);
        return $RoomNo->RoomNo;
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
                'Module' => "Rooms",
                'Unit' => Auth::user()->unit,
                'Bde' => Auth::user()->bde,
                'Action' => $id==-1 ? "Data Created" : "Data Edited"
            ];
            if ($id == -1) {
                $AccnID = DB::table($this->table)->insertGetId($data);
                DB::table('tbl_logs')->insert($log);
            } else {
                DB::table($this->table)->where('RoomID', $id)->update($data);
                DB::table('tbl_logs')->insert($log);
            }

            return redirect(route($this->module))->with('success', $this->module . ' data has been ' . ($id == "-1" ? "Added" : "Updated"));
        }catch (\Illuminate\Database\QueryException $exception){
            return back()->with('exception', "Exception: ".$exception->getMessage());
        }

    }

    public function delete($id)
    {
        DB::table($this->table)->where('RoomID', $id)->update(array('flag' => 0));
        // Create Log
        $log = [
            'LogUser' => Auth::user()->email,
            'Module' => "Rooms",
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
