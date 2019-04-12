<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use Illuminate\Support\Facades\Auth;
 

class DocumentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth:web,admin', ['except'=>['index', 'show']]);  
    }        

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('documents.create');
    }

    public function upload(){
        return view('documents.upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validate($request, [
        'title' => 'required',
        'body' => 'nullable'
        ]);        
        
        // Create Document
        $document = new Document();
        $document->title = $request->input('title');
        $document->document = $request->input('body');              
        $document->user_id =  auth()->user()->id;            
        $document->admin_id = auth()->user()->id;                 
        $document->save();                
        return redirect($this->redirectPath())->with('success', 'Document Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $document = Document::find($id);         
        return view('documents.show')->with('document', $document);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $document = Document::find($id);   
        // Check for correct user
        if(auth()->user()->id!=$document->user_id){
            return redirect('/')->with('error', 'Unauthorized Page');  
        }
        return view('documents.edit')->with('document', $document);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $this->validate($request, [
        'title' => 'required',
        'body' => 'required'
        ]);

        // Create Document
        $document = Document::find($id);
        $document->title = $request->input('title');
        $document->document = $request->input('body');
        $document->save();    
        return redirect($this->redirectPath())->with('success', 'Document Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $document = Document::find($id);
        
        // Check for correct user
        if(auth()->user()->id!=$document->user_id){
            return redirect('/')->with('error', 'Unauthorized Page');  
        }
        $document->delete();     
        return redirect($this->redirectPath())->with('success', 'Document Removed');
    }

    private function redirectPath(){
        if(Auth::guard('web')->check()){
          return  $redirect_path = 'user/dashboard';
        }else{
           return $redirect_path = 'admin';
        }
    }
}
