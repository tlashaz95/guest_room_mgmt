@extends('layouts.app')
@section('content')

    <div class="m-t-30 h3 text-dark" style="text-align: center"><b>ACTIVITY LOG</b></div>
    <div class="alert row">

    </div>
    <div style="padding: 1%; font-size:small" class="card table-responsive">
    <table class="table table-bordered datatable">
        <thead>
        <tr>
            <th>#</th>
            <th>User</th>
            <th>Unit</th>
            <th>Bde</th>
            <th>Module</th>
            <th>Activity</th>
            <th>Date / Time</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data??[] as $key=>$item)
        <tr>
            <td class="td-action">
                <span class="row-number">{{++$key}}</span>
            </td>
            <td>{{$item->LogUser}}</td>
            <td>{{$item->Unit}}</td>
            <td>{{$item->Bde}}</td>
            <td>{{$item->Module}}</td>
            @if($item->Action == "Data Added")
                <td style="color:green;"><b>{{$item->Action}}</b></td>
            @elseif($item->Action == "Data Deleted")
                <td style="color:darkred"><b>{{$item->Action}}</b></td>
            @else
                <td style="color:orangered"><b>{{$item->Action}}</b></td>
            @endif
            <td>{{$item->created_at}}</td>
        </tr>
            @endforeach

        </tbody>
    </table>
    </div>

@endsection
