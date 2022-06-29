@extends('layouts.app')
@section('content')

    <div class="alert row">
    <a href="{{route('create.edit.teacher',['id'=>'-1'])}}" class="btn btn-primary">
        Add Teacher
    </a>
    </div>
    <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
                <th>{{$th}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($module_data??[] as $key=>$item)
        <tr>
            <td>{{++$key}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->father_name}}</td>
            <td>{{$item->address}}</td>
            <td>{{$item->mobile}}</td>
            <td>

                <a href="{{route('leaving.certificate.teacher',['id'=>$item->id])}}" class="btn btn-sm btn-info" title="Leaving Certificate">
                    certificate
                </a>

                <a href="{{route('create.edit.teacher',['id'=>$item->id])}}" class="btn btn-sm btn-success">
                    edit
                </a>

                <a href="{{route('delete.teacher',['id'=>$item->id])}}" class="btn btn-sm btn-danger" onclick="confirm_link()">
                    delete
                </a>
            </td>

        </tr>
            @endforeach

        </tbody>
    </table>
    </div>

@endsection
