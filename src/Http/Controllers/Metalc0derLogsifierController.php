<?php

namespace Metalc0der\Logsifier\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Metalc0der\Logsifier\Models\Log;
use App\Http\Controllers\Validator;
use DB;
use Carbon\Carbon;

class Metalc0derLogsifierController extends Controller {

    protected function rules() {

        return [
            'user_id' => 'required|numeric',
            'ip' => 'required',
            'log_date' => 'required',
            'order_date' => 'required',
            'object' => 'required',
            'object_id' => 'required|numeric',
            
        ];

    }

    
    /**
     * Store a newly created resource in storage.
     *
     * 
     * 
     */
    public function store($ip,$object,$object_id,$description,$source)
    {
      

        $log = Log::create(['user_id' => Auth::user()->id,
                            'ip' => $ip,
                            'log_date' => Carbon::now(),
                            'object' => $object,
                            'object_id' => $object_id,
                            'description' => $description,
                            'source' => $source,

                            ]);

    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index(Request $request) {

        $target = '';
        $input = $request->all();

        return Log::orderBy('log_id', 'desc');

   
    }

    /**
     * Export to CSV file.
     *
     * 
     */
    public function exportCSV() {

        $logs = Log::selectRaw("user_id,ip,log_date,object,object_id,source,description")
                    ->get();

        $export = new ExcelController();
        $export->export('Logs-'Carbon::now()->timestamp,$logs);

   
    }

    /**
     * Rotate logs.
     *
     * 
     */
    public function rotate(Request $request) {

        if(count(Logs::all()) > 10000) {

            $this->exportCSV();
            Log::delete();

        }

   
    }

}
