<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        Artisan::call('cache:clear');
        Artisan::call('route:cache');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        return redirect()->back();
    }

    public function optimizeDatabase() {
        try{
            $alltables = \DB::select('SHOW TABLES');
            $tables_in_db_name = 'Tables_in_'.env('DB_DATABASE');
            foreach($alltables as $table){
                \DB::select("OPTIMIZE TABLE ".$table->$tables_in_db_name);
                print $table->$tables_in_db_name." optimize OK<br>";
            }
        } catch (Exception $e) {
           print "cannot optimize database. ".$e->getMessage();
           return false;
        }
    }
}
