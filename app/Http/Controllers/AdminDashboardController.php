<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Admin;
use App\Document;
use Illuminate\Support\Facades\Auth;
use DB;

class AdminDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $user_id = auth()->user()->id;
        $user = Admin::find($user_id);
        // Check storage    
        $folderPath=public_path('/storage/upload/');
        $file = glob($folderPath."*");
        $countFile = 0;
        if ($file != false)
        {            
            $countFile = count($file);
        }
        return view('admin.dashboard')->with('data', ['files' =>$countFile, 'documents' => $user->documents]);
    }    
}
