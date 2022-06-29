<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class BillingController extends Controller
{
    private $table = "tbl_billing";
    private $module = "billing";
    private $view_folder = "billing";

    public $mod = "Billing";

    public function index($id = -1)
    {
        $data['module_data'] = $this->get();

        $data['id'] = $id;
        $data['viewBill'] = DB::table($this->table)->where('BillingID', $id)->where('flag', '1')->get();
        $data['title'] = "List of " . $this->module;
        $data['table'] = $this->table;
        $data['module'] = $this->module;
        $data['view_folder'] = $this->view_folder;

        return view($this->view_folder . ".index", $data);
    }

    public function get()
    {
        return DB::table($this->table)->join('tbl_booking', 'tbl_billing.BookingID', '=', 'tbl_booking.BookingID')->
            orderBy('BillingID', 'desc')->get();
    }

    public function create($id)
    {
        $BookingID = DB::table('tbl_billing')->where('BookingID', $id)->First();
        if ($BookingID === null) {
            $data['module'] = $this->module;
            $data['id'] = $id;
            $data['getBookingDetails'] = DB::table('tbl_booking')->where('BookingID', $id)->get();
            $data['title'] = "Create a Bill";
            return view($this->view_folder . '.create', $data);
        } else {
            return redirect(route('bookings'))->with('warning', 'Bill against this Booking has already been gen. Kindly go to Billing Module to edit the Bill.');
        }
    }

    public function edit($id)
    {
        $data['module'] = $this->module;

        $data['id'] = $id;
        $BookingID = DB::table($this->table)->where('BillingID', $id)->pluck('BookingID');
        $data['title'] = "Update" . " " . $this->module;
        $data['data'] = DB::table($this->table)->where('BillingID', $id)->get();
        $data['getBookingDetails'] = DB::table('tbl_booking')->where('BookingID', $BookingID)->get();
        return view($this->view_folder . '.edit', $data);
    }

    public
    function show($id)
    {
        $data['module'] = $this->module;
        $data['bookingData'] = DB::table('tbl_booking')->where('BookingID', $id)->get();
        $data['data'] = DB::table($this->table)->where('BookingID', $id)->get();
        return view($this->view_folder . '.show', $data);
    }

    public
    function update($id, Request $request)
    {
//        $data = [
//            'number' => $request->get('customer'),
//            'contact' => $request->get('contact'),
//            'address' => $request->get('address'),
//            'balance' => $request->get('balance'),
//            'added_by' => Auth::user()->getAuthIdentifier()
//        ];
        foreach ($request->except('_token') as $key => $value) {
            if ($request->has($key) && Schema::hasColumn($this->table, $key))
                $data[$key] = $value;
        }
        if ($request->hasFile('Picture')) {
            $data['Picture'] = $this->uploadImage($request->file('Picture'));
        }

        //print_r($data);
        try {
            // Create Log
            $log = [
                'LogUser' => Auth::user()->email,
                'Module' => "Billing",
                'Unit' => Auth::user()->unit,
                'Bde' => Auth::user()->bde,
                'Action' => "Data Edited"
            ];

            DB::table($this->table)->where('BillingID', $id)->update($data);
            DB::table('tbl_logs')->insert($log);


            return redirect(route($this->module))->with('success', $this->module . ' data has been Updated');
        } catch (\Illuminate\Database\QueryException $exception) {
            return back()->with('exception', "Exception: " . $exception->getMessage());
        }

    }

    public function store($id = -1, Request $request)
    {
        try {
            $CheckInDate = $request->get('CheckIn');
            $CheckOutDate = $request->get('CheckOut');

            $checkIn = date_create($CheckInDate);
            $checkOut = date_create($CheckOutDate);
            $diff = date_diff($checkIn, $checkOut);

            $NoOfDays = $diff->format("%a");
            $Month = date('m');
            $Yr = date('Y');
            $date = date('Y-m-d');

            $RoomData = [
                'RoomStatus'    =>  'Vacant',
                'updated_at'    =>  $date
            ];

            // Add Reservations
            $ResData = [
                'RoomNo' => $request->get('RoomNo'),
                'RoomStatus' => 'Occupied',
                'CheckIn' => $request->get('CheckIn'),
                'CheckOut' => $request->get('CheckOut'),
                'Month' => $Month,
                'Yr' => $Yr
            ];

            for ($i = 1; $i <= $NoOfDays; $i++)
                DB::table('tbl_reservations')->insert($ResData);
        } catch (Exception \Illuminate\Database\QueryException $exception) {
            return back()->with('exception', "Exception: " . $exception->getMessage());
        }

        foreach ($request->except('_token') as $key => $value) {
            if ($request->has($key) && Schema::hasColumn($this->table, $key))
                $data[$key] = $value;
        }
        if ($request->hasFile('Picture')) {
            $data['Picture'] = $this->uploadImage($request->file('Picture'));
        }

        //print_r($data);
        try {
            // Create Log
            $log = [
                'LogUser' => Auth::user()->email,
                'Module' => "Billing",
                'Unit' => Auth::user()->unit,
                'Bde' => Auth::user()->bde,
                'Action' => "Data Created"
            ];

            $BillingID = DB::table($this->table)->insertGetId($data);
            DB::table('tbl_logs')->insert($log);
            DB::table('tbl_rooms')->where('RoomID', $request->get('RoomID'))->update($RoomData);
            DB::table('tbl_booking')->where('RoomID', $request->get('RoomID'))->update($RoomData);
            return redirect(route($this->module))->with('success', $this->module . ' data has been ' . "Added");
        } catch (\Illuminate\Database\QueryException $exception) {
            return back()->with('exception', "Exception: " . $exception->getMessage());
        }

    }

    public
    function delete($id)
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
}
