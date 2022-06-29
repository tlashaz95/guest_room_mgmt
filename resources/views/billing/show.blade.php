@extends('layouts.app')
@section('content')
    <style>
        td, th {
            text-align: center;
        }
    </style>
    <?php
    $from = $bookingData[0]->CheckIn;
    $CheckIn = strtotime($from);

    $to = $bookingData[0]->CheckOut;
    $CheckOut = strtotime($to);

    $BillID = "00".$data[0]->BillingID;
    $BillID = substr($BillID,-4);
    ?>
    <div class="col-lg-offset-2 col-lg-2">
        <button onClick="printJS({ printable: 'bill', type: 'html', targetStyles: ['*']})" class="text-danger">
            <span class="glyphicon glyphicon-print"></span>
            Print
        </button>
    </div>

    <div id="bill" class="col-md-12">
        <div class="col-md-offset-5 col-md-5" style="padding-left: 6%;">
            <img src="{{url('theme')}}/images/Div.png" height="70" width="70"/>
            <b class="large" style="margin-left: 60%;"># {{$BillID}}</b>
        </div>
        <div class="col-md-offset-5 col-md-4">
            <h4 class="font-bold">CHAWINDA BOQS</h4>
        </div>
        <div style="font-size: small; text-align: center" class="card form-card col-lg-8 col-lg-offset-2">
            <h5 class="align-left">
                Name - <b>{{$bookingData[0]->ArmyNo ?? ''}} {{$bookingData[0]->Rank ?? ''}}
                    {{$bookingData[0]->Name ?? ''}} {{'; Unit: '.$bookingData[0]->Unit ?? ''}}
                </b>
            </h5>
            <h5 class="align-left">
                Checkin - <b>{{date('d-m-Y', $CheckIn) ?? ''}}</b> ; Check Out - <b>{{date('d-m-Y', $CheckOut) ?? ''}}
                </b>
            </h5>
            <h6 class="align-left">Room No. <b>{{(new \App\Http\Controllers\RoomController())->getRoom($bookingData[0]->RoomID)}}</b></h6>
                <table style="text-align: center;" class="table table-responsive table-bordered nestable-dark-theme">
                    <tr>
                        <th>
                            <b>Description</b>
                        </th>
                        <th>
                            Amount (in Rs)
                        </th>
                    </tr>
                    <tr>
                        <td>Room Rent</td>
                        <td>{{$data[0]->RoomRent ?? '0'}}</td>
                    </tr>

                    <tr>
                        <td>Messing</td>
                        <td>{{$data[0]->Messing ?? '0'}}</td>
                    </tr>

                    <tr>
                        <td>Elec / Gas</td>
                        <td>{{$data[0]->ElecGas ?? '0'}}</td>
                    </tr>

                    <tr>
                        <td>Water Bottle</td>
                        <td>{{$data[0]->WaterBottle ?? '0'}}</td>
                    </tr>

                    <tr>
                        <td>Fridge Items</td>
                        <td>{{$data[0]->FridgeItems ?? '0'}}</td>
                    </tr>

                    <tr>
                        <td>Extra Matress</td>
                        <td>{{$data[0]->ExtraMatress ?? '0'}}</td>
                    </tr>

                    <tr>
                        <td>Washing</td>
                        <td>{{$data[0]->Washing ?? '0'}}</td>
                    </tr>

                    <tr>
                        <td>Ironing</td>
                        <td>{{$data[0]->Ironing ?? '0'}}</td>
                    </tr>

                    <tr>
                        <td>Toiletries</td>
                        <td>{{$data[0]->PasteBrush ?? '0'}}</td>
                    </tr>

                    <tr>
                        <td>Misc</td>
                        <td>{{$data[0]->Misc ?? '0'}}</td>
                    </tr>

                    <tr>
                        <td class="bal">Total</td>
                        <td class="bal">{{$data[0]->Total ?? '0'}}</td>
                    </tr>

                    <tr>
                        <td class="paid">Discount</td>
                        <td class="paid">{{$data[0]->Discount ?? '0'}}</td>
                    </tr>

                    <tr>
                        <td><b>Adv Payment</b></td>
                        <td><b>{{$data[0]->AdvPayment ?? '0'}}</b></td>
                    </tr>

                    <tr>
                        <td class="bal"><b>Bal</b></td>
                        <td class="bal"><b>{{$data[0]->Bal ?? '0'}}</b></td>
                    </tr>

                    <tr>
                        <td class="paid">Paid</td>
                        <td class="paid">{{$data[0]->Paid ?? '0'}}</td>
                    </tr>
                </table>
            <h5 class="text-danger"><b>Note:</b> This is a computer generated Bill and does not require signature.</h5>
            </div>
        <div class="col-md-3"></div>
        </div>

    <script type="text/javascript">
        function printBill() {
            var divContents = document.getElementById("bill").innerHTML;
            var a = window.open('', '', 'height=600, width=300');
            a.document.write('<html><head><title>Bill Receipt</title>');
            a.document.write('<link rel="stylesheet" href="{{url('theme')}}/css/bill.css" type=\"text\/css" media=\"print\"/>');
            a.document.write('</head><body style="text-align: center">');
            a.document.write('<table style="text-align: center">');
            a.document.write(divContents);
            a.document.write('</table>');
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    </script>

@endsection
