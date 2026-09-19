<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Designation;
use App\Models\User;
use App\Models\WorkShiftType;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class StaffIdCardController extends Controller
{

/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = 'Staff ID Card';
        $this->route = 'admin.staff-id-card';
        $this->view = 'admin.staff-id-card';
        $this->path = 'user';
        $this->access = 'user';


        $this->middleware('permission:' . $this->access . '-view');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $data['title']     = $this->title;
        $data['route']     = $this->route;
        $data['view']      = $this->view;
        $data['path']      = $this->path;
        $data['access']    = $this->access;


        if (!empty($request->role) || $request->role != null) {
            $data['selected_role'] = $role = $request->role;
        } else {
            $data['selected_role'] = '0';
        }

        if (!empty($request->department) || $request->department != null) {
            $data['selected_department'] = $department = $request->department;
        } else {
            $data['selected_department'] = '0';
        }

        if (!empty($request->designation) || $request->designation != null) {
            $data['selected_designation'] = $designation = $request->designation;
        } else {
            $data['selected_designation'] = '0';
        }

        if (!empty($request->shift) || $request->shift != null) {
            $data['selected_shift'] = $shift = $request->shift;
        } else {
            $data['selected_shift'] = '0';
        }

        if (!empty($request->contract_type) || $request->contract_type != null) {
            $data['selected_contract'] = $contract_type = $request->contract_type;
        } else {
            $data['selected_contract'] = '0';
        }


        if (isset($request->role) || isset($request->department) || isset($request->designation) || isset($request->shift) || isset($request->contract_type)) {
            // Filter Users
            $users = User::where('id', '!=', null);

            if (!empty($request->role)) {
                $users->with('roles')->whereHas('roles', function ($query) use ($role) {
                    $query->where('role_id', $role);
                });
            }
            if (!empty($request->department)) {
                $users->where('department_id', $department);
            }
            if (!empty($request->designation)) {
                $users->where('designation_id', $designation);
            }
            if (!empty($request->shift)) {
                $users->where('work_shift', $shift);
            }
            if (!empty($request->contract_type)) {
                $users->where('contract_type', $contract_type);
            }

            $data['rows'] = $users->orderBy('staff_id', 'asc')->get();
        }


        $data['departments'] = Department::where('status', '1')
            ->orderBy('title', 'asc')->get();
        $data['designations'] = Designation::where('status', '1')
            ->orderBy('title', 'asc')->get();
        $data['roles'] = Role::orderBy('name', 'asc')->get();
        $data['work_shifts'] = WorkShiftType::where('status', '1')
            ->orderBy('title', 'asc')->get();

        return view($this->view . '.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


     public function print($id)
    {
        
        // dd('s');
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view']  = $this->view;
        $data['path']  = $this->path;

        // View
        $data['rows'] = User::where('id', $id)->orderBy('staff_id', 'asc')->get();

        // $data['print'] = IdCardSetting::where('slug', 'student-card')->firstOrFail();

        return view($this->view . '.print', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
