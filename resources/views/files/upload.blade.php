@extends('layouts.app')

@section('content')
 <h1>Upload New Document</h1>  
    {!! Form::open(['action'=>'FileUploadController@store', 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::file('file')}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection