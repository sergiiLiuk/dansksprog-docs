@extends('layouts.app')

@section('content')
<a href="/" class="btn btn-default">Go Back</a>
<hr>
<h2>{{$document->title}}</h2>
<p>{!!$document->document!!}</p> 
<!--@if (!Auth::guest())
    @if (Auth::user()->id == $document->user_id)
        <a href="/documents/{{$document->id}}/edit" class="btn btn-default">Edit</a>

        {!!Form::open(['action' => ['DocumentsController@destroy', $document->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
    @endif
@endif  -->
@endsection