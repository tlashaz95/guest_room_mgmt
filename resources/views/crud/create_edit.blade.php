@extends('layouts.app')
@section('content')

    <h4>
        {{$title??''}}
    </h4>
    <form action="{{route('store.update.{{$module}}',['id'=>$id])}}" method="post">
        {{ csrf_field() }}
    </form>

@endsection
