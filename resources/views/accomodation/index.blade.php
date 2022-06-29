@extends('layouts.app')
@section('content')

    <div class="m-t-30 h2 text-dark" style="text-align: center"><b>ACCN</b></div>
    @include('partials.bde_unit')
    @include('partials.graphs_js')
    <div class="alert row">
        @if(Auth::user()->add == "1")
            <a href="{{route('create.edit.'.$module,['id'=>'-1'])}}" class="btn btn-primary">
                Add Accn
            </a>
        @endif
    </div>
    <div class="card table-responsive">
    <table class="table table-bordered datatable">
        <thead>
        <tr>
            <th>#</th>
            <th>Unit</th>
            <th>Bde</th>
            <th>Houses_MOQs Auth</th>
            <th>Houses_MOQs Held</th>
            <th>CMOQs Auth</th>
            <th>CMOQs Held</th>
            <th>BOQs Auth</th>
            <th>BOQs Held</th>
            <th>JCOs Qtr Auth</th>
            <th>JCOs Qtr Held</th>
            <th>Sldrs Qtr Auth</th>
            <th>Sldrs Qtr Held</th>
            <th>NCsE Qtr Auth</th>
            <th>NCsE Qtr Held</th>
            <th>SM_Bks Auth</th>
            <th>SM_Bks Held</th>
            <th>JCOs Mess Auth</th>
            <th>JCOs Mess Held</th>
            <th>AVehs Sheds Auth</th>
            <th>AVehs Sheds Held</th>
            <th>BVehs Sheds Auth</th>
            <th>BVehs Sheds Held</th>
            <th>Wksp Sheds Auth</th>
            <th>Wksp Sheds Held</th>
            <th>Regt Stores Auth</th>
            <th>Regt Stores Held</th>
            <th>POL Stores Auth</th>
            <th>POL Stores Held</th>
        </tr>
        </thead>
        <tbody>
        @foreach($module_data??[] as $key=>$item)
        <tr>
            <td class="td-action">
                @if(Auth::user()->edit == "1")
                    <a href="{{route('create.edit.'.$module,['id'=>$item->AccnID])}}" class="text-success">
                        <span class="material-icons">edit</span>
                    </a>
                @endif

                @if(Auth::user()->delete == "1")
                    <form method="post" action="{{route('delete.'.$module,['id'=>$item->AccnID])}}" style="display: inline">
                        @csrf
                        <button type="submit" class="text-danger margin-0 padding-0 btn-delete" onclick="confirm_link()">
                            <span class="material-icons">delete</span>
                        </button>
                    </form>
                @endif
                <span class="row-number">{{++$key}}</span>
            </td>
            <td>{{$item->Unit}}</td>
            <td>{{$item->Bde}}</td>
            <td>{{$item->Houses_MOQsAuth}}</td>
            <td>{{$item->Houses_MOQsHeld}}</td>
            <td>{{$item->CMOQsAuth}}</td>
            <td>{{$item->CMOQsHeld}}</td>
            <td>{{$item->BOQsAuth}}</td>
            <td>{{$item->BOQsHeld}}</td>
            <td>{{$item->JCOsQtrAuth}}</td>
            <td>{{$item->JCOsQtrHeld}}</td>
            <td>{{$item->SldrsQtrAuth}}</td>
            <td>{{$item->SldrQtrHeld}}</td>
            <td>{{$item->NCsEQtrAuth}}</td>
            <td>{{$item->NCsEQtrHeld}}</td>
            <td>{{$item->SM_BksAuth}}</td>
            <td>{{$item->SM_BksHeld}}</td>
            <td>{{$item->JCOsMessAuth}}</td>
            <td>{{$item->JCOsMessHeld}}</td>
            <td>{{$item->AVehsShedsAuth}}</td>
            <td>{{$item->AVehsShedsHeld}}</td>
            <td>{{$item->BVehsShedsAuth}}</td>
            <td>{{$item->BVehsShedsHeld}}</td>
            <td>{{$item->WkspShedsAuth}}</td>
            <td>{{$item->WkspShedsHeld}}</td>
            <td>{{$item->RegtStoresAuth}}</td>
            <td>{{$item->RegtStoresHeld}}</td>
            <td>{{$item->POLStoresAuth}}</td>
            <td>{{$item->POLStoresHeld}}</td>
        </tr>
            @endforeach

        </tbody>
    </table>
    </div>

@endsection
