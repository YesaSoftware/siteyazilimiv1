<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Languages;

class LanguagesController extends Controller
{
    public function list()
    {

        return view('panel.languages.index');
    }


    public function listData()
    {
        $model = Languages::query();

        return DataTables::eloquent($model)
            ->editColumn('status',function ($model) {
               return statusButtonTable($model->status);
            })
            ->editColumn('icon',function ($model) {
                return '<img src="'.asset('flags/'.$model->icon).'" width="50" height="50">';
            })
            ->rawColumns(['status','icon'])
            ->make(true);

    }
}
