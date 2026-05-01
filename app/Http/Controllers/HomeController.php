<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function clearCache() {
      try{
        Artisan::call('cache:clear');
        Artisan::call('route:cache');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        return response()->json(['message' => 'Clear cache OK']);
      } catch (\Exception $e) {
        header("Content-Type: application/json");
        print json_encode(['message' => 'Cannot run clear cache. '.$e->getMessage()]);
        return false;
      }
    }

    public function optimizeDatabase() {
        try{
            $alltables = \DB::select('SHOW TABLES');
            $tables_in_db_name = 'Tables_in_'.env('DB_DATABASE');
            $tableArr = [];
            foreach($alltables as $table){
                \DB::select("OPTIMIZE TABLE ".$table->$tables_in_db_name);
                $tableArr[$table->$tables_in_db_name] = "Optimize OK";
            }
            return response()->json(['message' => $tableArr]);
        } catch (\Exception $e) {
           header("Content-Type: application/json");
           print json_encode(['message' => 'Cannot optimize database. '.$e->getMessage()]);
           return false;
        }
    }
}
