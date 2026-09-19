<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CollegeDepartment;
use App\Models\Department;
use App\Models\DepartmentCondition;
use App\Models\Program;
use App\Models\ProgramCondition;
use Illuminate\Http\Request;

class DepartmentConditionController extends Controller
{

    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('module_department_condition', 1);
        $this->route = 'admin.department.condition';
        $this->view = 'admin.department-condition';
        $this->path = 'department-condition';
        $this->access = 'department-condition';


        $this->middleware('permission:' . $this->access . '-view');
    }


    public function index()
    {
        //

        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;

        $data['row'] = DepartmentCondition::where('status', '1')->first();
        $data['departments'] = CollegeDepartment::where('status', '1')->orderBy('title', 'asc')->get();

        return view($this->view . '.index', $data);
    }


    public function departmentInfo(Request $request)
    {
        $request->validate([
            'inter_id' => 'required',
            'degree_id' => 'required',
            'pharmacy_id' => 'required',
            'nursing_id' => 'required',
            'education_id' => 'required',
            'engineering_id' => 'required',
        ]);


        $id = $request->id;

        // -1 means no data row found
        if ($id == -1) {
            // Insert Data
            $data = new DepartmentCondition();
            $data->inter_id = $request->inter_id;
            $data->degree_id = $request->degree_id;
            $data->pharmacy_id = $request->pharmacy_id;
            $data->nursing_id = $request->nursing_id;
            $data->education_id = $request->education_id;
            $data->engineering_id = $request->engineering_id;


            $data->save();
        } else {
            // Update Data
            $data = DepartmentCondition::find($id);
            $data->inter_id = $request->inter_id;
            $data->degree_id = $request->degree_id;
            $data->pharmacy_id = $request->pharmacy_id;
            $data->nursing_id = $request->nursing_id;
            $data->education_id = $request->education_id;
            $data->engineering_id = $request->engineering_id;

            $data->save();
        }

        $notification = array(
            'message' => __('msg_updated_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->back()->with($notification);
    }

public function programCondition()
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;

        $data['row'] = ProgramCondition::where('status', '1')->first();
        $data['programs'] = Program::where('status', '1')->orderBy('title', 'asc')->get();

        return view($this->view . '.program-condition', $data);
    }

public function programConditionInfo(Request $request)
    {
        $request->validate([

            'ba_id' => 'required',
            'b_com_id' => 'required',
            'bsc_id' => 'required',
            'bsc_nursing_id' => 'required',
            'gnm_id' => 'required',
            'anm_id' => 'required',

        ]);


        $id = $request->id;

        // -1 means no data row found
        if ($id == -1) {
            // Insert Data
            $data = new ProgramCondition();
            $data->ba_id = $request->ba_id;
            $data->b_com_id = $request->b_com_id;
            $data->bsc_id = $request->bsc_id;
            $data->bsc_nursing_id = $request->bsc_nursing_id;
            $data->gnm_id = $request->gnm_id;
            $data->anm_id = $request->anm_id;
            $data->save();
        } else {
            // Update Data
            $data = ProgramCondition::find($id);
            $data->ba_id = $request->ba_id;
            $data->b_com_id = $request->b_com_id;
            $data->bsc_id = $request->bsc_id;
            $data->bsc_nursing_id = $request->bsc_nursing_id;
            $data->gnm_id = $request->gnm_id;
            $data->anm_id = $request->anm_id;
            $data->save();
        }
        $notification = array(
            'message' => __('msg_updated_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->back()->with($notification);
    }
}
