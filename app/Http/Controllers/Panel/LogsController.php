<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Log;
class LogsController extends Controller
{

    public function list()
    {

        return view('panel.logs.index');

    }

    public function show($id)
    {
        $log = Log::findOrFail($id);

        return view('panel.logs.show', ['log' => $log]);
    }

    public function listData(Request $request)
    {
        $logs = Log::query();
        return DataTables::of($logs)
            ->editColumn('user_id', function ($log) {
                $user = $log->user;

                if (!$user){
                    $user = new \stdClass();
                    $user->name = 'Silinmiş';
                    $user->id = 0;
                }

                return $user->name . ' - ' . $user->id;
            })

            ->editColumn('created_at', function ($log) {
                return $log->created_at->format('d/m/Y H:i:s');
            })

            ->editColumn('type', function ($log) {
                return logTypeButton($log->type);
            })

            ->rawColumns(['type'])

            ->make(true);
    }

}
