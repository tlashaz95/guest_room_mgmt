<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class UserController extends Controller
{
    private $table="users";
    private $module = "User";
    private $view_folder = "user";



    public function index()
    {
        $data['module_data'] = DB::table($this->table)->orderBy('id','desc')->where('flag', '1')->get();
        $data['title'] = $this->module;
        $data['headings'] =
            ['Sr','Actions'];
        $data['table'] = $this->table;
        $data['module'] = $this->module;
        $data['view_folder'] = $this->view_folder;

        return view($this->view_folder . ".index", $data);
    }

    public function create_edit($id = -1)
    {
        $data['id'] = $id;
        $data['title'] = ($id == "-1" ? "Add" : "Update")." ".$this->module;
        if ($id !== "-1") {
            $data['data'] = DB::table($this->table)->where('id', $id)->get();
        }
        return view($this->view_folder . '.create_edit', $data);
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

//        print_r($data);
        try {
            if ($id == -1) {
                $data['password'] = bcrypt('abcd$1234');
                DB::table($this->table)->insert($data);
            } else {
                DB::table($this->table)->where('id', $id)->update($data);
            }

            return back()->with('success', $this->module . ' data has been ' . ($id == "-1" ? "New user has been added. Enter the default password to login and change it after logging in." : "Updated"));
        }catch (\Illuminate\Database\QueryException $exception){
            return back()->with('exception', "Exception: ".$exception->getMessage());
        }

    }

    public function delete($id)
    {
        DB::table($this->table)->where('id', $id)->update(array('flag' => 0));
        return back()->with('danger', $this->module . ' data has been Deleted');
    }
}
