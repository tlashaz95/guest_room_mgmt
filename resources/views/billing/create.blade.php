@extends('layouts.app')
@section('content')
    <?php
    $RoomRent = 0;
    $month = date('m');
    $yr = date('y');

    $CheckInDate = $getBookingDetails[0]->CheckIn;
    $CheckOutDate = $getBookingDetails[0]->CheckOut;

    $checkIn = date_create($CheckInDate);
    $checkOut = date_create($CheckOutDate);
    $diff = date_diff($checkIn, $checkOut);

    $NoOfDays = $diff->format("%a");
    $Cat = $getBookingDetails[0]->Cat;
    $Rank = $getBookingDetails[0]->Rank;
    $Fmn = $getBookingDetails[0]->Fmn;

    // Cal Room Rent
    if($Cat == "Serving(Duty)" && ($Rank == "2/Lt" || $Rank == "Lt" || $Rank == "Capt" || $Rank == "Maj"))
        $RoomRent = 3840;
    if($Cat == "Serving(Duty)" && ($Rank == "Lt Col" || $Rank == "Col" || $Rank == "Brig" || $Rank == "Maj Gen"))
        $RoomRent = 4920;
    if($Cat == "Serving(Lve)" && $Fmn == "Own")
        $RoomRent = 1200;
    if($Cat == "Serving(Lve)" && $Fmn == "Other")
        $RoomRent = 1800;
    if($Cat == "Serving(Lve)" && ($Rank != "2/Lt" && $Rank != "Lt" && $Rank != "Capt" && $Rank != "Maj" &&
            $Rank != "Lt Col" && $Rank != "Col" && $Rank != "Brig" && $Rank != "Maj Gen" && $Rank != "Lt Gen"))
        $RoomRent = 2000;
    if($Cat == "Blood Relative" && $Fmn == "Own")
        $RoomRent = 1200;
    if($Cat == "Blood Relative" && $Fmn == "Other")
        $RoomRent = 2000;
    if($Cat == "Retd" && ($Rank == "2/Lt" || $Rank == "Lt" || $Rank == "Capt" || $Rank == "Maj" ||
            $Rank == "Lt Col"))
        $RoomRent = 2200;
    if($Cat == "Civ Serving Offr")
        $RoomRent = 2000;
    if($Cat == "Civ")
        $RoomRent = 3500;
    if($Cat == "Serving(Lve)" && ($Rank == "Col" || $Rank == "Brig" || $Rank == "Maj Gen" || $Rank == "Lt Gen" ||
            $Rank == "Gen"))
        $RoomRent = 2000;
    if($Cat == "Retd" && ($Rank == "Col" || $Rank == "Brig" || $Rank == "Maj Gen" || $Rank == "Lt Gen" ||
            $Rank == "Gen"))
        $RoomRent = 2800;

    $RoomRent = $RoomRent * $NoOfDays;
    $ElecGas = 260 * $NoOfDays;
    ?>
    <form action="{{route('store.'.$module,['id'=>$id])}}" method="post">
    <div class="m-t-30 h4 text-dark" style="text-align: center">
        <a href="{{url('billing/index')}}"><span class="glyphicon glyphicon-chevron-left"></span></a>
        <b>Gen Bill</b> - {{$getBookingDetails[0]->ArmyNo ?? ''}} {{$getBookingDetails[0]->Rank ?? ''}}
        {{$getBookingDetails[0]->Name ?? ''}}{{", ".$getBookingDetails[0]->Unit ?? 'Civ'}}
    </div>
        {{ csrf_field() }}

        <div style="font-size: small" class="card form-card col-lg-12">
            <div class="row">
                <div class="col-sm-7 col-sm-offset-3">
                    <h6 style="color:red">
                        <i>(Fds marked with asterisk are mandatory to be filled in order to submit the form)</i>
                    </h6>
                </div>

                <input type="hidden" value="{{$getBookingDetails[0]->BookingID}}" name="BookingID"/>
                <input type="hidden" value="{{(new \App\Http\Controllers\RoomController())->getRoom($getBookingDetails[0]->RoomID)}}" name="RoomNo"/>
                <input type="hidden" value="{{$getBookingDetails[0]->RoomID}}" name="RoomID"/>
                <input type="hidden" value="{{$getBookingDetails[0]->CheckIn}}" name="CheckIn"/>
                <input type="hidden" value="{{$getBookingDetails[0]->CheckOut}}" name="CheckOut"/>
                <input type="hidden" value="{{$month}}" name="Month"/>
                <input type="hidden" value="{{$yr}}" name="Yr"/>

                <div class="col-lg-4 m-b-20">
                    <label for="">Room Rent <span class="mandatory">*</span></label>
                    <input type="text" class="charges form-control" name="RoomRent"
                           value="{{$data[0]->RoomRent ?? $RoomRent}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0" readonly required="required">
                </div>

                <div class="col-lg-4 m-b-20">
                    <label for="">Messing <span class="mandatory">*</span></label>
                    <input type="text" class="charges form-control" name="Messing"
                           value="{{$data[0]->Messing ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0" required="required">
                </div>

                <div class="col-lg-4 m-b-20">
                    <label for="">Elec / Gas<span class="mandatory">*</span></label>
                    <input type="text" class="charges form-control" name="ElecGas"
                           value="{{$ElecGas}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0" readonly required="required">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Washing</label>
                    <input type="text" class="charges form-control" name="Washing"
                           value="{{$data[0]->Washing ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Ironing</label>
                    <input type="text" class="charges form-control" name="Ironing"
                           value="{{$data[0]->Ironing ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Extra Matress</label>
                    <input type="text" class="charges form-control" name="ExtraMatress"
                           value="{{$data[0]->ExtraMatress ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0">
                </div>

{{--                <div class="col-lg-3 m-b-20">--}}
{{--                    <label for="">Fridge Items</label>--}}
{{--                    <input type="text" class="charges form-control" name="FridgeItems"--}}
{{--                           value="{{$data[0]->FridgeItems ?? ''}}" onkeypress="return NumericOnly(event)"--}}
{{--                           maxlength="5" min="0">--}}
{{--                </div>--}}

                <div class="col-lg-3 m-b-20">
                    <label for="">Water Bottle</label>
                    <input type="text" class="charges form-control" name="WaterBottle"
                           value="{{$data[0]->WaterBottle ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Toiletries</label>
                    <input type="text" class="charges form-control" name="PasteBrush"
                           value="{{$data[0]->PasteBrush ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Misc</label>
                    <input type="text" class="charges form-control" name="Misc"
                           value="{{$data[0]->Misc ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Total <span class="mandatory">*</span></label>
                    <input type="text" id="total" class="form-control text-danger" name="Total"
                           value="{{$data[0]->Total ?? ($RoomRent + $ElecGas)}}" placeholder="{{$RoomRent + $ElecGas}}" onkeypress="return NumericOnly(event)"
                           maxlength="6" min="0" readonly required="required">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Discount <span class="mandatory">*</span></label>
                    <input type="text" id="discount" class="discount form-control text-danger" name="Discount"
                           value="{{$data[0]->Discount ?? '0'}}" onkeypress="return NumericOnly(event)"
                           maxlength="6" min="0" required="required">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Adv Payment <span class="mandatory">*</span></label>
                    <input type="text" class="discount form-control" id="advPayment" name="AdvPayment"
                           value="0" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0" required="required">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Bal <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" id="bal" name="Bal"
                           value="{{$data[0]->Bal ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0" readonly required="required">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Paid <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" name="Paid"
                           value="{{$data[0]->Paid ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0" required="required">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Remarks</label>
                    <input type="text" class="form-control" name="MobileNo"
                           value="{{$data[0]->Remarks ?? ''}}" onkeypress="return alphaNumericOnly(event)"
                           maxlength="50" min="0">
                </div>

            </div>

            <div class="col-lg-offset-4 col-lg-4">
                <button type="submit" class="btn btn-danger btn-block">
                    Gen Bill of Room {{(new \App\Http\Controllers\RoomController())->getRoom($getBookingDetails[0]->RoomID) ?? ''}}
                </button>
            </div>
        </div>
    </form>

    <script type="text/javascript">
            $(document).ready(function(){
                $(".discount").keyup(function ()
                {
                   var discount = $("#discount").val();
                   var total = $("#total").val();
                   var advPayment = $("#advPayment").val();
                   var bal = (total - discount) - advPayment;
                   $("#bal").val(bal);
                });
            //iterate through each textboxes and add keyup
            //handler to trigger sum event
            $(".charges").each(function() {

                $(this).keyup(function(){
                    calculateSum();
                });
            });

        });

            function calculateSum() {

            //alert("clicked");
            var sum = 0;
            //iterate through each textboxes and add the values
            $(".charges").each(function() {

            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
            sum += parseFloat(this.value);
        }

        });
            //.toFixed() method will roundoff the final sum to 2 decimal places
            $("#total").val(sum.toFixed(2));
        }
    </script>
@endsection
