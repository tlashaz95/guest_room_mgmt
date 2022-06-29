@extends('layouts.app')
@section('content')
    <div class="m-t-30 h4 text-dark" style="text-align: center">
        <a href="{{url('billing/index')}}"><span class="glyphicon glyphicon-chevron-left"></span></a>
        <b>Add Bill</b>
    </div>
    <form action="{{route('store.update.'.$module,['id'=>$id])}}" method="post">
        {{ csrf_field() }}

        <div style="font-size: small" class="card form-card col-lg-12">
            <div class="row">
                <div class="col-sm-7 col-sm-offset-3">
                    <h6 style="color:red">
                        <i>(Fds marked with asterisk are mandatory to be filled in order to submit the form)</i>
                    </h6>
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Room Rent <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" name="ArmyNo"
                           value="{{$data[0]->RoomRent ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0" required="required">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Messing <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" name="Name"
                           value="{{$data[0]->Messing ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0" required="required">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Elec <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" name="Unit"
                           value="{{$data[0]->Elec ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0" required="required">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Gas <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" name="MobileNo"
                           value="{{$data[0]->Gas ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0" required="required">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Washing</label>
                    <input type="text" class="form-control" name="Unit"
                           value="{{$data[0]->Washing ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Ironing</label>
                    <input type="text" class="form-control" name="Unit"
                           value="{{$data[0]->Ironing ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Extra Matress</label>
                    <input type="text" class="form-control" name="MobileNo"
                           value="{{$data[0]->ExtraMatress ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Fridge Items</label>
                    <input type="text" class="form-control" name="MobileNo"
                           value="{{$data[0]->FridgeItems ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Water Bottle</label>
                    <input type="text" class="form-control" name="MobileNo"
                           value="{{$data[0]->WaterBottle ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Toiletries</label>
                    <input type="text" class="form-control" name="MobileNo"
                           value="{{$data[0]->PasteBrush ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Misc</label>
                    <input type="text" class="form-control" name="MobileNo"
                           value="{{$data[0]->Misc ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Total <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" name="MobileNo"
                           value="{{$data[0]->Total ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0" readonly required="required">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Adv Payment <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" name="MobileNo"
                           value="{{$data[0]->AdvPayment ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0" required="required">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Bal <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" name="MobileNo"
                           value="{{$data[0]->Bal ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="5" min="0" required="required">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Paid <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" name="MobileNo"
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

            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary btn-block">
                    Submit
                </button>
            </div>
        </div>
    </form>

@endsection
