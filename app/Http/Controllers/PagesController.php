<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\Http\Resources\Document as DocumentResource;

class PagesController extends Controller
{
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

    public function about(){
        return view('pages.about');
    }    
}
