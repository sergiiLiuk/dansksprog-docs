<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileUploadController extends Controller
{   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validate($request, [        
        'file.*' => 'mimes:doc,pdf,docx|max:2048'
        ]);
           
        if($request->hasfile('file')){ 
            $fileName = $request->file->getClientOriginalName();
            // Get file name
            //$fileName = $request->input('title');
            // Get file extension  
            $extension = $request->file('file')->getClientOriginalExtension();
            // File name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            // Upload file
            $path = $request->file->storeAs('public/upload', $fileNameToStore);     
        }

        if(Auth::guard('web')->check()){
            $redirect_path = 'user/dashboard';
            $message = 'Document sent for review to Administrator';
        }else{
            $redirect_path = 'admin';
            $message = 'You uploaded a new document';
        }

        return redirect($redirect_path)->with('success', $message);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(){
        return view('files.upload');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        return view('files.upload');         
    }
     
}
