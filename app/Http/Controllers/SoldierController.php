<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class
SoldierController extends Controller
{
    private $table = "tbl_sldrs";
    private $module = "soldier";
    private $view_folder = "soldier";

    public function index()
    {
        $data['bde'] = $this->bde;

        $data['module_data'] = $this->get();
        $data['title'] = "List of " . $this->module;

        if (isset($_GET['bde'])) {
            $data['module_data'] = DB::table('tbl_sldrs')->where('flag','1')->where('Bde', $_GET['bde'])->get();
            $data['title'] = "List of " . $this->module . " from Bde " . $_GET['bde'];
        }

        if (isset($_GET['bde']) && isset($_GET['unit'])) {
            $data['module_data'] = DB::table('tbl_sldrs')->where('flag','1')->where('Bde', $_GET['bde'])->where('Unit', $_GET['unit'])->get();
            $data['title'] = "List of " . $this->module . " from Bde " . $_GET['bde'] . " and Unit " . $_GET['unit'];
        }
        $data['headings'] =
            ['Sr', 'Actions'];
        $data['table'] = $this->table;
        $data['module'] = $this->module;
        $data['view_folder'] = $this->view_folder;

        return view($this->view_folder . ".index", $data);
    }

    public function get()
    {
        if(Auth::user()->role == "admin")
        return DB::table($this->table)->orderBy('SldrID', 'desc')->where('flag','1')->get();

        if(Auth::user()->role == "user"){
            if(Auth::user()->unit != null || Auth::user()->unit != "")
            return DB::table($this->table)->orderBy('SldrID', 'desc')->where('flag','1')->where('Bde',Auth::user()->bde)->where('Unit',Auth::user()->unit)->get();
            if(Auth::user()->unit == null || Auth::user()->unit == "")
                return DB::table($this->table)->orderBy('SldrID', 'desc')->where('flag','1')->where('Bde',Auth::user()->bde)->get();
        }
    }

    public function getWhere($id)
    {
        return DB::table($this->table)->where('SldrID', $id)->get();
    }
    public function getWhereArmyNo($ArmyNo)
    {
        return DB::table($this->table)->where('ArmyNo', $ArmyNo)->get();
    }
    public function details($id){
        $data['data'] = $this->getWhere($id);
        $data['details'] = DB::table('tbl_sldrs_details')->where('SldrID', $id)->get();
        $data['acrs'] = DB::table('tbl_acrs')->where('SldrID',$id)->get();
        $data['conduct'] = DB::table('tbl_conduct_sheet')->where('SldrID',$id)->get();

        $data['pet'] = DB::table('tbl_pet')->where('SldrID',$id)->get();
        $data['ret'] = DB::table('tbl_ret')->where('SldrID',$id)->get();
        $data['qual'] = DB::table('tbl_qual')->where('SldrID',$id)->get();
        return view($this->view_folder.".details",$data);
    }

    public function create_edit($id = -1)
    {
        $data['module'] = $this->module;

        $data['id'] = $id;
        $data['title'] = ($id == "-1" ? "Add" : "Update") . " " . $this->module;
        if ($id !== "-1") {
            $data['data'] = DB::table($this->table)->where('SldrID', $id)->get();
            $data['dataDet'] = DB::table("tbl_sldrs_details")->where('SldrID', $id)->get();
            $data['dataConduct'] = DB::table("tbl_conduct_sheet")->where('SldrID', $id)->get();
            $data['dataACRs'] = DB::table("tbl_acrs")->where('SldrID', $id)->get();
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
        foreach ($request->except('_token') as $key => $value) {
            if ($request->has($key) && Schema::hasColumn($this->table, $key))
                $data[$key] = $value;
        }
        if ($request->hasFile('Picture')) {
            $data['Picture'] = $this->uploadImage($request->file('Picture'));
        }


//        print_r($data);
        try {
            // Create Log
            $log = [
                'LogUser' => Auth::user()->email,
                'Module' => "Sldrs Data",
                'Unit' => Auth::user()->unit,
                'Bde' => Auth::user()->bde,
                'Action' => $id==-1 ? "Data Created" : "Data Edited"
            ];
            if ($id == -1) {
                $SldrID = DB::table($this->table)->insertGetId($data);

                DB::table('tbl_logs')->insert($log);

                foreach ($request->except('_token') as $key => $value) {
                    if ($request->has($key) && Schema::hasColumn("tbl_sldrs_details", $key))
                        $dataDet[$key] = $value;
                }
                $dataDet['SldrID'] = $SldrID;

                //$SldrDetID = DB::table("tbl_sldrs_details")->insertGetId($dataDet);

//                if(isset($_POST['OffencePlaceC'])) {
//                    foreach ($_POST['OffencePlaceC'] as $key => $item) {
//                        DB::table('tbl_conduct_sheet')->insert(
//                            [
//                                'SldrID' => $SldrID,
//                                'OffencePlace' => $_POST['OffencePlaceC'][$key],
//                                'OffenceDate' => $_POST['OffenceDateC'][$key],
//                                'OffenceParticulars' => $_POST['OffenceParticularsC'][$key],
//                                'PunishmentAwarded' => $_POST['PunishmentAwardedC'][$key],
//                                'PunishmentDate' => $_POST['PunishmentDateC'][$key],
//                                'Part2No' => $_POST['Part2NoC'][$key],
//                                'Authentications' => $_POST['AuthenticationC'][$key],
//                            ]
//                        );
//                    }
//                }
//
//                if(isset($_POST['GrdA'])) {
//                    foreach ($_POST['GrdA'] as $key => $item) {
//                        DB::table('tbl_acrs')->insert(
//                            [
//                                'SldrID' => $SldrID,
//                                'Yr' => $_POST['YrA'][$key],
//                                'Grd' => $_POST['GrdA'][$key],
//                                'PromRecom' => $_POST['PromRecomA'][$key],
//                                'AdverseRemarks' => $_POST['AdverseRemarksA'][$key],
//                                'Part2No' => $_POST['Part2NoA'][$key],
//                                'Authentication' => $_POST['AuthenticationA'][$key],
//                            ]
//                        );
//                    }
//                }
            }
            else {
                DB::table($this->table)->where('SldrID', $id)->update($data);

                foreach ($request->except('_token') as $key => $value) {
                    if ($request->has($key) && Schema::hasColumn("tbl_sldrs_details", $key))
                        $dataDet[$key] = $value;
                }


                //DB::table("tbl_sldrs_details")->where('SldrID', $id)->update($dataDet);

                //DB::table('tbl_conduct_sheet')->where('SldrID', $id)->delete();
                //DB::table('tbl_acrs')->where('SldrID', $id)->delete();
//                if(isset($_POST['OffencePlaceC'])) {
//                    foreach ($_POST['OffencePlaceC'] as $key => $item) {
//                        DB::table('tbl_conduct_sheet')->insert(
//                            [
//                                'SldrID' => $id,
//                                'OffencePlace' => $_POST['OffencePlaceC'][$key],
//                                'OffenceDate' => $_POST['OffenceDateC'][$key],
//                                'OffenceParticulars' => $_POST['OffenceParticularsC'][$key],
//                                'PunishmentAwarded' => $_POST['PunishmentAwardedC'][$key],
//                                'PunishmentDate' => $_POST['PunishmentDateC'][$key],
//                                'Part2No' => $_POST['Part2NoC'][$key],
//                                'Authentications' => $_POST['AuthenticationC'][$key],
//                            ]
//                        );
//                    }
//                }
//                if(isset($_POST['GrdA'])) {
//                    foreach ($_POST['GrdA'] as $key => $item) {
//                        DB::table('tbl_acrs')->insert(
//                            [
//                                'SldrID' => $id,
//                                'Yr' => $_POST['YrA'][$key],
//                                'Grd' => $_POST['GrdA'][$key],
//                                'PromRecom' => $_POST['PromRecomA'][$key],
//                                'AdverseRemarks' => $_POST['AdverseRemarksA'][$key],
//                                'Part2No' => $_POST['Part2NoA'][$key],
//                                'Authentication' => $_POST['AuthenticationA'][$key],
//                            ]
//                        );
//                    }
//                }
            }
            return redirect(route($this->module))->with('success', $this->module . ' data has been ' . ($id == "-1" ? "Added" : "Updated"));

        } catch (\Illuminate\Database\QueryException $exception) {

            return redirect(route($this->module))->with('warning',$exception);
        }
    }


    public function delete($id)
    {
        DB::table("tbl_sldrs_details")->where('SldrID', $id)->update(array('flag' => 0));
        DB::table($this->table)->where('SldrID', $id)->update(array('flag' => 0));
        // Create Log
        $log = [
            'LogUser' => Auth::user()->email,
            'Module' => "Sldrs Data",
            'Unit' => Auth::user()->unit,
            'Bde' => Auth::user()->bde,
            'Action' => "Data Deleted"
        ];
        DB::table('tbl_logs')->insert($log);
        return back()->with('danger', $this->module . ' data has been Deleted');
    }


    public function getCountByRank()
    {
        return
            DB::table($this->table)->select('Rank', DB::raw('COUNT(SldrID) as Total'))->groupBy('Rank')->get();
    }

    public function getCountByBDE()
    {
        return
            DB::table($this->table)->select('Bde', DB::raw('COUNT(SldrID) as Total'))->groupBy('Bde')->get();
    }

    public function getCountByTrade()
    {
        return
            DB::table($this->table)->select('Trade', DB::raw('COUNT(SldrID) as Total'))->groupBy('Trade')->get();
    }

    public function searchPage()
    {
        $data['names'] = DB::table('tbl_sldrs')->select('Name')->groupBy('Name')->orderBy('Name','asc')->get();
        $data['ranks'] = DB::table('tbl_sldrs')->select('Rank')->groupBy('Rank')->orderBy('Rank','asc')->get();
        $data['trades'] = DB::table('tbl_sldrs')->select('Trade')->groupBy('Trade')->orderBy('Trade','asc')->get();
        $data['coys'] = DB::table('tbl_sldrs')->select('Coy')->groupBy('Coy')->orderBy('Coy','asc')->get();
        $data['units'] = DB::table('tbl_sldrs')->select('Unit')->groupBy('Unit')->orderBy('Unit','asc')->get();
        $data['bdes'] = DB::table('tbl_sldrs')->select('Bde')->groupBy('Bde')->orderBy('Bde','asc')->get();
        $data['cities'] = DB::table('tbl_sldrs')->select('City')->groupBy('City')->orderBy('City','asc')->get();
        return view('search', $data);
    }

    public function search(Request $request)
    {
        $dataR['names'] = DB::table('tbl_sldrs')->select('Name')->groupBy('Name')->orderBy('Name','asc')->get();
        $dataR['ranks'] = DB::table('tbl_sldrs')->select('Rank')->groupBy('Rank')->orderBy('Rank','asc')->get();
        $dataR['trades'] = DB::table('tbl_sldrs')->select('Trade')->groupBy('Trade')->orderBy('Trade','asc')->get();
        $dataR['coys'] = DB::table('tbl_sldrs')->select('Coy')->groupBy('Coy')->orderBy('Coy','asc')->get();
        $dataR['units'] = DB::table('tbl_sldrs')->select('Unit')->groupBy('Unit')->orderBy('Unit','asc')->get();
        $dataR['bdes'] = DB::table('tbl_sldrs')->select('Bde')->groupBy('Bde')->orderBy('Bde','asc')->get();
        $dataR['cities'] = DB::table('tbl_sldrs')->select('City')->groupBy('City')->orderBy('City','asc')->get();


        $data = DB::table($this->table);

        if ($request->get("ArmyNo") != "")
            $data = $data->where('ArmyNo', $request->get('ArmyNo'));

        if ($request->get("Name") != "")
            $data = $data->where('Name', $request->get('Name'));

        if ($request->get("Rank") != "")
            $data = $data->where('Rank', $request->get('Rank'));

        if ($request->get("Trade") != "")
            $data = $data->where('Trade', $request->get('Trade'));

        if ($request->get("Coy") != "")
            $data = $data->where('Coy', $request->get('Coy'));

        if ($request->get("Unit") != "")
            $data = $data->where('Unit', $request->get('Unit'));

        if ($request->get("City") != "")
            $data = $data->where('City', $request->get('City'));

        if ($request->get("SvcFrom") != "")
            $data = $data->where('Svc', '>=', $request->get('SvcFrom'))->where('Svc', '<=', $request->get('SvcTo'));
        if ($request->get("City") != "")
            $data = $data->where('City', $request->get('City'));

        if ($request->get("City") != "")
            $data = $data->where('City', $request->get('City'));

//        $sldr_id = $data->pluck('SldrID');
        $sldr_id = $data->pluck('SldrID')->toArray();

        //print_r($sldr_id);

        echo "<br>";
        $dataPET = DB::table('tbl_pet');

        if($request->get('PETGp') != "")
            $dataPET->where('Gp',$request->get('PETGp'));
        if($request->get('PETHalf') != "")
            $dataPET->where('Half',$request->get('PETHalf'));
        if($request->get('PETFrom') != "")
            $dataPET->whereBetween('TotalPts',[$request->get('PETFrom'),$request->get('PETTo')]);

        $dataPET = $dataPET->whereIn("SldrID",$sldr_id)->pluck("SldrID")->toArray();
        $dataRET = DB::table('tbl_ret');

        if($request->get('RETGp') != "")
            $dataRET->where('Gp',$request->get('RETGp'));
        if($request->get('RETHalf') != "")
            $dataRET->where('Half',$request->get('RETHalf'));
        if($request->get('Wpn') != "")
            $dataRET->where('Wpn',$request->get('Wpn'));
        if($request->get('RETTo') != "")
            $dataRET->whereBetween('TotalPts',[$request->get('RETTo'),$request->get('RETFrom')]);

        $dataRET = $dataRET->whereIn("SldrID",$sldr_id)->pluck('SldrID')->toArray();

        $resultSldrId  = array_merge($dataPET, $dataRET);
        //print_r($dataPET);
        $resultSldrId  =
            array_merge($sldr_id,$dataPET, $dataRET);
        $dataR['result'] = DB::table("tbl_sldrs")->whereIn('SldrID',$resultSldrId)->get();
        return view('search',$dataR );

        if (
            $request->get('PETGp') != ""
            && $request->get('PETHalf') != ""
            && $request->get('PETFrom') != ""
        ) {
            $dataPET = DB::table('tbl_pet');
            if ($request->get('PETGp') != "")
                $dataPET->where('Gp', $request->get('PETGp'));
            if ($request->get('PETHalf') != "")
                $dataPET->where('Half', $request->get('PETHalf'));
            if ($request->get('PETFrom') != "")
                $dataPET->whereBetween('TotalPts', [$request->get('PETFrom'), $request->get('PETTo')]);
            $dataPET = $dataPET->whereIn("SldrID", $sldr_id)->pluck("SldrID")->toArray();
        } else {
            $dataPET = [];
        }
        if (
            $request->get('RETGp') != ""
            && $request->get('RETHalf') != ""
            && $request->get('Wpn') != ""
            && $request->get('RETTo') != ""
        ) {
            $dataRET = DB::table('tbl_ret');

            if ($request->get('RETGp') != "")
                $dataRET->where('Gp', $request->get('RETGp'));
            if ($request->get('RETHalf') != "")
                $dataRET->where('Half', $request->get('RETHalf'));
            if ($request->get('Wpn') != "")
                $dataRET->where('Wpn', $request->get('Wpn'));
            if ($request->get('RETTo') != "")
                $dataRET->whereBetween('TotalPts', [$request->get('RETTo'), $request->get('RETFrom')]);

            $dataRET = $dataRET->whereIn("SldrID", $sldr_id)->pluck('SldrID')->toArray();

        } else {
            $dataRET = [];
        }
        if(sizeof($dataPET) >0){
            $resultSldrId = $dataPET;
        }
        else if(sizeof($dataRET) >0){
            $resultSldrId = $dataRET;
        }
        else if (sizeof($dataPET) > 0 && sizeof($dataRET) > 0) {
            $resultSldrId = array_merge($dataPET, $dataRET);
        } else {
            $resultSldrId = $sldr_id;
        }

        $dataR['result'] = DB::table("tbl_sldrs")->whereIn('SldrID', $resultSldrId)->get();
        return view('search', $dataR);
    }


}
