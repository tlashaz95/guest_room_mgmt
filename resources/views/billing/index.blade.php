@extends('layouts.app')
@section('content')

    <style>
        th, td, label {
            font-size: small;
            font-family: "Lucida Handwriting";
        }

        input {
            text-align: center;
        }

        .GenBill {
            background: transparent;
            border: none;
            font-size: 16px !important;
            text-align: left;
            padding: 0;
            margin: 0;
            font-weight: 800 !important;
        }
    </style>
    <div class="m-t-30 h4 text-dark" style="text-align: center"><b>Bills</b></div>
    <div class="alert row">
{{--        @if(Auth::user()->add == "1")--}}
{{--            <a href="{{route('create.edit.'.$module,['id'=>'-1'])}}" class="btn btn-primary">--}}
{{--                Add Bill--}}
{{--            </a>--}}
{{--        @endif--}}
    </div>
    <div style="padding: 1%" class="card table-responsive">
        <table class="table table-bordered datatable">
            <thead>
            <tr>
                <th>Actions</th>
                <th>#</th>
                <th>Name</th>
                <th>Total</th>
                <th>Room Rent</th>
                <th>Messing</th>
                <th>Washing</th>
                <th>Ironing</th>
                <th>Elec / Gas</th>
{{--                <th>Fridge Items</th>--}}
                <th>Water Bottles</th>
                <th>Extra Matress</th>
                <th>Toiletries</th>
                <th>Misc</th>
                <th>Adv Payment</th>
                <th>Bal</th>
                <th>Paid</th>
            </tr>
            </thead>
            <tbody>
            @foreach($module_data??[] as $key=>$item)
                <tr>
                    <td class="td-action">
                        @if(Auth::user()->edit == "1")
                            <a href="{{route('edit.'.$module,['id'=>$item->BillingID])}}" class="text-success">
                                <span class="material-icons">edit</span>
                            </a>
                        @endif

                        @if(Auth::user()->delete == "1")
                            <form method="post" action="{{route('delete.'.$module,['id'=>$item->BillingID])}}"
                                  style="display: inline">
                                @csrf
                                <button type="submit" class="text-danger margin-0 padding-0 btn-delete"
                                        onclick="confirm_link()">
                                    <span class="material-icons">delete</span>
                                </button>
                            </form>
                        @endif

                        @if(Auth::user()->role == "admin")
                                <a href="{{route('show.'.$module,['id'=>$item->BookingID])}}" class="text-info GenBill">
                                    <span class="material-icons">View Bill</span>
                                </a>
                        @endif
                    </td>
                    <td>{{++$key}}</td>
                    <td>{{$item->Rank}} {{$item->Name}}</td>
                    <td>{{$item->Total}}</td>
                    <td>{{$item->RoomRent}}</td>
                    <td>{{$item->Messing}}</td>
                    <td>{{$item->Washing}}</td>
                    <td>{{$item->Ironing}}</td>
                    <td>{{$item->ElecGas}}</td>
{{--                    <td>{{$item->FridgeItems}}</td>--}}
                    <td>{{$item->WaterBottle}}</td>
                    <td>{{$item->ExtraMatress}}</td>
                    <td>{{$item->PasteBrush}}</td>
                    <td>{{$item->Misc}}</td>
                    <td>{{$item->AdvPayment}}</td>
                    <td>{{$item->Bal}}</td>
                    <td>{{$item->Paid}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection


