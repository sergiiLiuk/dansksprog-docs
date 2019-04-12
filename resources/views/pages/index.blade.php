@extends('layouts.app')
@section('content')
<h1>Documents Store</h1>
<hr>
@if (count($documents)>0)
    @foreach ($documents as $item)   
    <h3><a href="/documents/{{$item['id']}}">{{$item['title']}}</a></h3> 
    <small>Created on {{$item['created_at']}} by {{$item['user_name']!=null ? $item['user_name']:$item['admin_name']}}</small>               
    @endforeach
@else
    <p>No Documents Found</p>
@endif    
@endsection