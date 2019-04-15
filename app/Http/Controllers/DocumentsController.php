<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Document as DocumentResource;
 

class DocumentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
       // $this->middleware('auth:web,admin', ['except'=>['index', 'show']]);  
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

    public function index(){
        $documents = Document::orderBy('title', 'asc')->paginate(10); 
        //$documents = Document::all();
        $newData = array();    
        foreach($documents as $document){
            $newData[] = array('id' => $document->id, 'title' => $document->title,'created_at'=> $document->created_at, 'user_name'=>$document->user['name'], 'admin_name'=>$document->admin['name']);
        }  

        // Return collection of articles as a resource
        return DocumentResource::collection($documents);

        //return view('pages.index')->with('documents', $newData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $document = Document::findOrFail($id);         
        // return view('documents.show')->with('document', $document);
      
        // Return single document as a resource
        return new DocumentResource($document);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $document = $request->isMethod('put') ? Document::findOrFail($request->id) : new Document;

        $this->validate($request, [
        'title' => 'required',
        'body' => 'nullable'
        ]);        
        
        // Create Document
        //$document = new Document();
        $document->id = $request->input('id');
        $document->title = $request->input('title');
        $document->document = $request->input('document');   
        $document->user_id =  "1";            
        $document->admin_id = "1";            
        //$document->user_id =  auth()->user()->id;            
        //$document->admin_id = auth()->user()->id; 

        if($document->save()){
            return new DocumentResource($document);
        }            
        
        //return redirect($this->redirectPath())->with('success', 'Document Created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function edit($id){
        $document = Document::find($id);   
        // Check for correct user
        if(auth()->user()->id!=$document->user_id){
            return redirect('/')->with('error', 'Unauthorized Page');  
        }
        return view('documents.edit')->with('document', $document);  
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function update(Request $request, $id){
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
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        // Get document
        $document = Document::findOrFail($id);
        
        // Check for correct user
       /* if(auth()->user()->id!=$document->user_id){
            return redirect('/')->with('error', 'Unauthorized Page');  
        }*/
       if( $document->delete()){
            return new DocumentResource($document);
       }     
        //return redirect($this->redirectPath())->with('success', 'Document Removed');
    }

    /*private function redirectPath(){
        if(Auth::guard('web')->check()){
          return  $redirect_path = 'user/dashboard';
        }else{
           return $redirect_path = 'admin';
        }
    }*/
}
