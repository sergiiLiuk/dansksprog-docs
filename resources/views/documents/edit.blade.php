@extends('layouts.app')

@section('content')
 <h1>Edit Document</h1>  
    {!! Form::open(['action'=>['DocumentsController@update', $document->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $document->title, ['class' => 'form-control', 'placeholder'=>'Title'])}}
        </div>
        <div class="form-group">
                {{Form::label('body', 'Body')}}
                {{Form::textarea('body', $document->document, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder'=>'Body Text'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection