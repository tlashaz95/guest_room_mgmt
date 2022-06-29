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

        .revenue {
            background: #0c5460;
            text-align: center;
            padding: 1%;
            margin-right: 5px;
        }

        .go {
            background: #0c5460;
            color: white;
            font-weight: 600;
            font-family: Verdana, sans-serif;
        }

        .go:hover {
            transform: scale(1.5);
            transition: all 0.5s;
            background: #0E2231;
            color: darkgray;
        }
    </style>
    <?php
    $month = date('m');
    $yr = date('y');

    $days = cal_days_in_month(CAL_GREGORIAN, $month, $yr);
    $maxOccupancy = $totalRooms * $days;
    $Occupancy = ($occupancy / $maxOccupancy) * 100;
    ?>
    {{--    <div class="col-md-12 w3-border-top border-danger w3-margin-top">--}}
    {{--        <br/><br/>--}}
    {{--        <form method="post" action="{{route('getData.'.$module)}}">--}}
    {{--            @csrf--}}
    {{--            <div class="col-md-offset-2 col-md-4">--}}
    {{--                <label>Select Day</label>--}}
    {{--                <select class="form-control select-dropdown" id="Day" name="Day">--}}
    {{--                    <option value="{{date('d')}}" selected="selected">{{date('d')}}</option>--}}
    {{--                        @for($i = 1 ; $i<=31 ; $i++)--}}
    {{--                            <option value="{{$i}}">{{$i}}</option>--}}
    {{--                        @endfor--}}
    {{--                </select>--}}
    {{--            </div>--}}
    {{--            <div class="col-md-4">--}}
    {{--                <label>Select Month</label>--}}
    {{--                <select class="form-control select-dropdown" id="Month" name="Month">--}}
    {{--                    <option value="{{$month}}">{{$month}}</option>--}}
    {{--                    <option value="01">01</option>--}}
    {{--                    <option value="02">02</option>--}}
    {{--                    <option value="03">03</option>--}}
    {{--                    <option value="04">04</option>--}}
    {{--                    <option value="05">05</option>--}}
    {{--                    <option value="06">06</option>--}}
    {{--                    <option value="07">07</option>--}}
    {{--                    <option value="08">08</option>--}}
    {{--                    <option value="09">09</option>--}}
    {{--                    <option value="10">10</option>--}}
    {{--                    <option value="11">11</option>--}}
    {{--                    <option value="12">12</option>--}}
    {{--                </select>--}}
    {{--            </div>--}}
    {{--            <div class="col-md-offset-5 col-md-2" style="text-align: center">--}}
    {{--                <button type="submit" class="btn btn-circle-lg go">--}}
    {{--                    Go--}}
    {{--                </button>--}}
    {{--            </div>--}}
    {{--        </form>--}}
    {{--    </div>--}}
    <div class="col-lg-10">
        <button onClick="printJS({ printable: 'report', type: 'html', targetStyles: ['*']})" class="text-danger">
            <span class="glyphicon glyphicon-print"></span>
            Print
        </button>
    </div>
    <div class="col-md-12" id="report">
        <div class="alert row">
            {{--        @if(Auth::user()->add == "1")--}}
            {{--            <a href="{{route('create.edit.'.$module,['id'=>'-1'])}}" class="btn btn-primary">--}}
            {{--                Add Bill--}}
            {{--            </a>--}}
            {{--        @endif--}}
            <div id="reportData" class="col-md-12 w3-border-top border-danger w3-margin-top">
                <div class="m-t-30 h3 black-text" style="text-align: center; color: darkslategrey"><b>
                        {{$title}}
                    </b></div>
                <hr style="height: 5px; color: darkslategrey"/>
                <h4 class="w3-text-green font-weight-bold align-center"><b>Occupancy Status</b></h4>
                <div class="progress" style="background: #cecece; height: 30px; border-radius: 24px">
                    <div class="progress-bar my-2" role="progressbar"
                         style="width: {{round($Occupancy, 2)}}%; font-size: 1.2em; padding: 0.3%"
                         aria-valuenow="{{round($Occupancy, 2)}}" aria-valuemin="0"
                         aria-valuemax="100">{{round($Occupancy, 2)}}%
                    </div>
                </div>

                <i class="col-md-offset-3 col-md-6 revenue">
                    <h4><span class="glyphicon glyphicon-credit-card"></span> Today's Revenue:</h4>
                    <h1><span class="label">Rs.</span>{{$revenue}}  </h1>
                </i>

                {{--            <i class="col-md-3 revenue">--}}
                {{--                <h4><span class="glyphicon glyphicon-credit-card"></span> Self Paid:</h4>--}}
                {{--                <h1><span class="label">Rs.</span>{{$revenue}}  </h1>--}}
                {{--            </i>--}}

                {{--            <i class="col-md-3 revenue">--}}
                {{--                <h4><span class="glyphicon glyphicon-credit-card"></span> Complimentary:</h4>--}}
                {{--                <h1><span class="label">Rs.</span>{{$revenue}}  </h1>--}}
                {{--            </i>--}}
            </div>
        </div>
        <div style="padding: 1%;" class="card table-responsive">
            <h4 class="font-18 font-bold text-center">Details of {{$title}}</h4>
            <table class="table table-bordered datatable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Bill No</th>
                    <th>Name of Guest</th>
                    <th>Address</th>
                    <th>Cat</th>
                    <th>Room No</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Nis</th>
                    <th>Room Rent</th>
                    <th>Messing</th>
                    <th>Total</th>
                    <th>Sponsored By</th>
                </tr>
                </thead>
                <tbody>
                @foreach($CombData ??[] as $key=>$item)
                    <?php
                    $checkIn = date_create($item->CheckIn);
                    $checkOut = date_create($item->CheckOut);
                    $diff = date_diff($checkIn, $checkOut);

                    $Nis = $diff->format("%a");
                    $BillID = "00" . $item->BillingID;
                    $BillID = substr($BillID, -4);
                    ?>
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$BillID}}
                            @if(Auth::user()->role == "admin")
                                <a href="{{route('show.billing',['id'=>$item->BookingID])}}" class="text-info GenBill">
                                    <span class="material-icons">View Bill</span>
                                </a>
                            @endif
                        </td>
                        <td>{{$item->Name}}</td>
                        <td>{{$item->Address}}</td>
                        <td>{{$item->Cat}}</td>
                        <td>{{(new \App\Http\Controllers\RoomController())->getRoom($item->RoomID)}}</td>
                        <td>{{$item->CheckIn}}</td>
                        <td>{{$item->CheckOut}}</td>
                        <td>{{$Nis}}</td>
                        <td>{{$item->RoomRent}}</td>
                        <td>{{$item->Messing}}</td>
                        <td>{{$item->Total}}</td>
                        <td>{{$item->SponsoredBy}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


