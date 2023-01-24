<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function datauser()
    {
        $data = User::orderBy('name','asc')->get();

        return datatables()->of($data)
        ->addColumn('action', 'admin.setting.user.action')
        ->addIndexColumn()
        ->addColumn('role', function($data){
            return $data->currentTeam->name;
        })
        ->addColumn('status', function($data){
            if ($data->active == 1) {
                return'<span class="text-success">Active</span>';
            }else {
                return'<span class="text-danger">Inactive</span>';
            }
        })
        ->rawColumns(['action','status'])
        ->toJson();
    }

    public function dataactivity()
    {
        $data = Activity::latest();

        return datatables()->of($data)
        ->addColumn('action', 'admin.information.activity.action')
        ->addIndexColumn()
        ->addColumn('user', function($data){
            return $data->user->name;
        })
        ->addColumn('time', function($data){
            return Carbon::parse($data->created_at)->diffForHumans();
        })
        ->addColumn('data', function($data){
            return $data->log_name.' ('.$data->subject_id.')';
        })
        ->addColumn('events', function($data){
            if ($data->event == 'created') {
                return'<span class="badge badge-light-success fs-8 fw-bolder">Created</span>';
            }  elseif ($data->event == 'updated') {
                return'<span class="badge badge-light-warning fs-8 fw-bolder">Updated</span>';
            } else {
                return'<span class="badge badge-light-danger fs-8 fw-bolder">Deleted</span>';
            }
        })
        ->rawColumns(['action','events'])
        ->toJson();
    }
}
