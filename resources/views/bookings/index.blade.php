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

    <div class="m-t-30 h4 text-dark" style="text-align: center"><b>Checkin / Checkouts</b></div>
    <div class="alert row">
        @if(Auth::user()->add == "1")
            <a href="{{route('create.edit.'.$module,['id'=>'-1'])}}" class="btn btn-primary">
                Check-In
            </a>
        @endif
    </div>
    <div style="padding: 1%" class="card table-responsive">
        <table class="table table-bordered datatable">
            <thead>
            <tr>
                <th>Actions</th>
                <th>#</th>
                <th>Cat</th>
                <th>Army No</th>
                <th>Rank</th>
                <th>Name</th>
                <th>Unit</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Room No</th>
                <th>Mobile No</th>
                <th>Address</th>
                <th>CNIC</th>
                <th>No of Guests</th>
                <th>Veh No</th>
                <th>Sponsored by</th>
                <th>Remarks</th>
            </tr>
            </thead>
            <tbody>
            @foreach($module_data??[] as $key=>$item)
                <?php
                $from = $item->CheckIn;
                $CheckIn = strtotime($from);

                $to = $item->CheckOut;
                $CheckOut = strtotime($to);
                ?>
                <tr>
                    <td class="td-action">
                        @if(Auth::user()->edit == "1")
                            <a href="{{route('create.edit.'.$module,['id'=>$item->BookingID])}}" class="text-success">
                                <span class="material-icons">edit</span>
                            </a>
                        @endif

                        @if(Auth::user()->delete == "1")
                            <form method="post" action="{{route('delete.'.$module,['id'=>$item->BookingID])}}"
                                  style="display: inline">
                                @csrf
                                <button type="submit" class="text-danger margin-0 padding-0 btn-delete"
                                        onclick="confirm_link()">
                                    <span class="material-icons">delete</span>
                                </button>
                            </form>
                        @endif

                        @if(Auth::user()->role == "admin")
                            <a href="{{route('create.billing',['id'=>$item->BookingID])}}" class="text-info">
                                <span class="material-icons">Gen Bill</span>
                            </a>
                        @endif
                    </td>
                    <td>{{++$key}}</td>
                    <td>{{$item->Cat}}</td>
                    <td>{{$item->ArmyNo ?? '-'}}</td>
                    <td>{{$item->Rank ?? '-'}}</td>
                    <td>{{$item->Name}}</td>
                    <td>{{$item->Unit ?? '-'}}</td>
                    <td class="paid">{{date('d-m-Y', $CheckIn)}}</td>
                    <td class="bal">{{date('d-m-Y', $CheckOut)}}</td>
                    <td>{{(new \App\Http\Controllers\RoomController())->getRoom($item->RoomID)}}</td>
                    <td>{{$item->MobileNo}}</td>
                    <td>{{$item->Address}}</td>
                    <td>{{$item->CNIC ?? '-'}}</td>
                    <td>{{$item->GuestsNo}}</td>
                    <td>{{$item->VehNo}}</td>
                    <td>{{$item->SponsoredBy}}</td>
                    <td>{{$item->Remarks}}</td>
                </tr>

                <!-- Modal -->
                <div class="modal fade text-center" id="billModal" role="dialog">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4><b>{{$item->BookingID}} # Bill of {{$item->ArmyNo ?? ''}} {{$item->Name ?? ''}}
                                        , {{$item->Unit ?? ''}}</b></h4>
                                <h6>Period from <b>{{date('d-m-Y', $CheckIn)}}</b> to
                                    <b>{{date('d-m-Y', $CheckOut)}}</b></h6>
                                <h6>Room No <b>{{(new \App\Http\Controllers\RoomController())->getRoom($item->RoomID)}}</b></h6>
                                <hr/>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('store.billing',['id'=>$id])}}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="BookingID" value="{{$item->BookingID}}"/>
                                    <div class="row">
                                        <div class="col-lg-4 m-b-10">
                                            <label for="">Room Rent <span class="mandatory">*</span></label>
                                            <input type="text" class="charges form-control" name="RoomRent"
                                                   value="{{$item->RoomRent ?? '0'}}"
                                                   onkeypress="return NumericOnly(event)"
                                                   maxlength="5" min="0" required="required">
                                        </div>
                                        <div class="col-lg-4 m-b-20">
                                            <label for="">Messing <span class="mandatory">*</span></label>
                                            <input type="text" class="charges form-control" name="Messing"
                                                   value="{{$item->Messing ?? '0'}}"
                                                   onkeypress="return NumericOnly(event)"
                                                   maxlength="5" min="0" required="required">
                                        </div>
                                        <div class="col-lg-4 m-b-20">
                                            <label for="">Elec / Gas<span class="mandatory">*</span></label>
                                            <input type="text" class="charges form-control" name="ElecGas"
                                                   value="260" onkeypress="return NumericOnly(event)"
                                                   maxlength="5" min="0" readonly required="required">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4 m-b-20">
                                            <label for="">Washing</label>
                                            <input type="text" class="charges form-control" name="Washing"
                                                   value="{{$item->Washing ?? '0'}}"
                                                   onkeypress="return NumericOnly(event)"
                                                   maxlength="5" min="0">
                                        </div>

                                        <div class="col-lg-4 m-b-20">
                                            <label for="">Extra Matress</label>
                                            <input type="text" class="charges form-control" name="ExtraMatress"
                                                   value="{{$item->ExtraMatress ?? '0'}}"
                                                   onkeypress="return NumericOnly(event)"
                                                   maxlength="5" min="0">
                                        </div>

                                        <div class="col-lg-4 m-b-20">
                                            <label for="">Ironing</label>
                                            <input type="text" class="charges form-control" name="Ironing"
                                                   value="{{$item->Ironing ?? '0'}}"
                                                   onkeypress="return NumericOnly(event)"
                                                   maxlength="5" min="0">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4 m-b-20">
                                            <label for="">Water Bottle</label>
                                            <input type="text" class="charges form-control" name="WaterBottle"
                                                   value="{{$item->WaterBottle ?? '0'}}"
                                                   onkeypress="return NumericOnly(event)"
                                                   maxlength="5" min="0">
                                        </div>
                                        <div class="col-lg-4 m-b-20">
                                            <label for="">Toiletries</label>
                                            <input type="text" class="charges form-control" name="PasteBrush"
                                                   value="{{$item->PasteBrush ?? '0'}}"
                                                   onkeypress="return NumericOnly(event)"
                                                   maxlength="5" min="0">
                                        </div>

                                        <div class="col-lg-4 m-b-20">
                                            <label for="">Misc</label>
                                            <input type="text" class="charges form-control" name="Misc"
                                                   value="{{$item->Misc ?? '0'}}" onkeypress="return NumericOnly(event)"
                                                   maxlength="5" min="0">
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{--                            <div class="col-lg-4 m-b-20">--}}
                                        {{--                                <label for="">Fridge Items</label>--}}
                                        {{--                                <input type="text" class="charges form-control" name="FridgeItems"--}}
                                        {{--                                       value="{{$item->FridgeItems ?? ''}}" onkeypress="return NumericOnly(event)"--}}
                                        {{--                                       maxlength="5" min="0">--}}
                                        {{--                            </div>--}}

                                        <div class="col-lg-12 m-b-20">
                                            <label for="">Total <span class="mandatory">*</span></label>
                                            <input type="text" id="total" class="form-control" name="Total"
                                                   value="{{$item->Total ?? ''}}" onkeypress="return NumericOnly(event)"
                                                   maxlength="6" min="0" value="0" readonly required="required">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4 m-b-20">
                                            <label for="">Adv Payment <span class="mandatory">*</span></label>
                                            <input type="text" class="form-control" name="AdvPayment"
                                                   value="{{$item->AdvPayment ?? '0'}}"
                                                   onkeypress="return NumericOnly(event)"
                                                   maxlength="6" min="0" required="required">
                                        </div>
                                        <div class="col-lg-4 m-b-20">
                                            <label for="">Bal <span class="mandatory">*</span></label>
                                            <input type="text" class="form-control" name="Bal"
                                                   value="{{$item->Bal ?? '0'}}" onkeypress="return NumericOnly(event)"
                                                   maxlength="6" min="0" required="required">
                                        </div>
                                        <div class="col-lg-4 m-b-20">
                                            <label for="">Paid <span class="mandatory">*</span></label>
                                            <input type="text" class="form-control" name="Paid"
                                                   value="{{$item->Paid ?? '0'}}" onkeypress="return NumericOnly(event)"
                                                   maxlength="6" min="0" required="required">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {

            //iterate through each textboxes and add keyup
            //handler to trigger sum event
            $(".charges").each(function () {

                $(this).keyup(function () {
                    calculateSum();
                });
            });

        });

        function calculateSum() {

            //alert("clicked");
            var sum = 0;
            //iterate through each textboxes and add the values
            $(".charges").each(function () {

                //add only if the value is number
                if (!isNaN(this.value) && this.value.length != 0) {
                    sum += parseFloat(this.value);
                }

            });
            //.toFixed() method will roundoff the final sum to 2 decimal places
            $("#total").val(sum.toFixed(2));
        }

        // function getTotal()
        // {
        //     var rent = document.getElementsByName('RoomRent').value;
        //     var messing = document.getElementsByName('Messing').value;
        //
        //     if(rent == "")
        //         rent = 0;
        //     if(messing == "")
        //         messing = 0;
        //
        //     var total = parseInt(rent) + parseInt(messing);
        //     if(!isNaN(total))
        //         document.getElementsByName('Total').value = total;
        // }
        // $("input.charges").on('change',function () {
        //
        //     let $rent = $('[name="RoomRent"]').val();
        //     let $messing = $('[name="Messing"]').val();
        //     let $elec = $('[name="Elec"]').val();
        //     let $gas = $('[name="Gas"]').val();
        //     let $washing = $('[name="Washing"]').val();
        //
        //     $total = parseInt($rent)+parseInt($messing)+parseInt($elec)+parseInt($gas)+parseInt($washing);
        //
        //     // Show Total
        //     $('input[name=Total]')
        //         .val($total);
        //     console.log($total);
    </script>
@endsection


