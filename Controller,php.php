<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Model\BranchModel;
use App\Http\Requests;
use Session;
use Redirect;
use Crypt;
use Hash;
use DB;

class BranchController extends Controller {


    public function index() {
        $data['branchInfo'] = DB::table('branch_tbl')->where('isDeleted', '=', '0')->orderBy('id', 'desc')->get();
        $data['active_menu'] = 'branch';
        $data['active_sub_menu'] = 'branch-list';
        return view('controlpanel.branch.branch', $data);
    }

    public function getdistrictList(Request $request) {
        $division_id = $request->input('value');
        if (is_int((int) $division_id)):
            $divisionQry = DB::table('district_tbl')->where('dis_division_id', '=', $division_id)->get();
            if ($divisionQry):
                echo '<option value="">Select District</option>';
                foreach ($divisionQry as $value):
                    $id = $value->id;
                    $name = $value->dis_name;
                    echo '<option value=' . $id . '>' . $name . '</option>';
                endforeach;
            else :
                echo '<option value = "">no data found</option>';
            endif;
        else:
            echo '<option value = "">no data found</option>';
        endif;
    }

    public function getupazilaList(Request $request) {
        $district_id = $request->input('value');
        if (is_int((int) $district_id)):
            $districtQry = DB::table('upazila_tbl')->where('upa_district_id', '=', $district_id)->get();
            if ($districtQry):
                echo '<option value="">Select Upazila</option>';
                foreach ($districtQry as $value):
                    $id = $value->id;
                    $name = $value->upa_name;
                    echo '<option value=' . $id . '>' . $name . '</option>';
                endforeach;
            else :
                echo '<option value = "">no data found</option>';
            endif;
        else:
            echo '<option value = "">no data found</option>';
        endif;
    }

    

}
