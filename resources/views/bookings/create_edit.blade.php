@extends('layouts.app')
@section('content')
    <?php
    //$BookingID = $data[0]->BillingID;
    $month = date('m');
    $yr = date('y');
    ?>
    <div class="m-t-30 h4 text-dark" style="text-align: center">
        <a href="{{url('bookings/index')}}"><span class="glyphicon glyphicon-chevron-left"></span></a>
        <b>Checkin / Checkouts</b>
    </div>
    <form action="{{route('store.update.'.$module,['id'=>$id])}}" method="post">
        {{ csrf_field() }}

        <div style="font-size: small" class="card form-card col-lg-12">
            <div class="col-sm-7 col-sm-offset-3">
                <h6 style="color:red">
                    <i>(Fds marked with asterisk are mandatory to be filled in order to submit the form)</i>
                </h6>
            </div>

            <input type="hidden" value="{{$month}}" name="Month"/>
            <input type="hidden" value="{{$yr}}" name="Yr"/>

            <div class="row">
                <div class="col-sm-3">
                    <div class=" form-line">
                        <label for="">Cat <span class="mandatory">*</span></label>
                        <input type="text" list="cats" class="form-control" name="Cat"
                               value="{{$data[0]->Cat ?? ''}}" onkeypress="return alphabetsOnly(event)" maxlength="25"
                               required="required">
                        <datalist id="cats">
                            @foreach((new \App\Http\Controllers\Controller())->Cats as $item)
                                <option value="{{$item}}">{{$item}}</option>
                            @endforeach

                        </datalist>
                    </div>
                </div>

                <div class="col-sm-3 m-b-20">
                    <label for="">Army No</label>
                    <input type="text" class="form-control" name="ArmyNo"
                           value="{{$data[0]->ArmyNo ?? ''}}" onkeypress="return alphaNumericOnly(event)"
                           maxlength="15" min="0">
                </div>

                <div class="col-sm-3">
                    <div class=" form-line">
                        <label for="">Rank <span class="mandatory">*</span></label>
                        <input type="text" list="ranks" class="form-control" name="Rank"
                               value="{{$data[0]->Rank ?? ''}}" onkeypress="return alphabetsOnly(event)" maxlength="15"
                               required="required">
                        <datalist id="ranks">
                            @foreach((new \App\Http\Controllers\Controller())->Ranks as $item)
                                <option value="{{$item}}">{{$item}}</option>
                            @endforeach

                        </datalist>
                    </div>
                </div>

                <div class="col-sm-3 m-b-20">
                    <label for="">Name <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" name="Name"
                           value="{{$data[0]->Name ?? ''}}" onkeypress="return alphaNumericOnly(event)"
                           maxlength="50" min="0" required="required">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 m-b-20">
                    <label for="">Unit</label>
                    <input type="text" class="form-control" name="Unit"
                           value="{{$data[0]->Unit ?? ''}}" onkeypress="return alphaNumericOnly(event)"
                           maxlength="25" min="0">
                </div>

                <div class="col-sm-3 m-b-20">
                    <label for="">Room No <span class="mandatory">*</span></label>
                    <select class="selectize form-control" required name="RoomID" id="RoomID"
                            onkeypress="return alphaNumericOnly(event)" maxlength="5">
                        <option></option>
                        @foreach((new \App\Http\Controllers\RoomController())->get() as $item)
                            <option
                                @if(isset($data[0]) && $data[0]->RoomID == $item->RoomID) selected @endif
                            value="{{$item->RoomID}}">{{$item->RoomNo}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" name="RoomStatus" value="Occupied"/>

                <div class="col-sm-3">
                    <label for="">Check-in Date <span class="mandatory">*</span></label>
                    <input type="date" class="form-control" name="CheckIn"
                           value="{{$data[0]->CheckIn ?? ''}}" onkeypress="return alphaNumericOnly(event)"
                           maxlength="10" min="0" required="required">
                </div>

                <div class="col-sm-3">
                    <label for="">Check-out Date <span class="mandatory">*</span></label>
                    <input type="date" class="form-control" name="CheckOut"
                           value="{{$data[0]->CheckOut ?? ''}}" onkeypress="return alphaNumericOnly(event)"
                           maxlength="10" min="0" required="required">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 m-b-20">
                    <label for="">Mobile No</label>
                    <input type="text" class="form-control" name="MobileNo"
                           value="{{$data[0]->MobileNo ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="11" min="0">
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Veh No</label>
                    <input type="text" class="form-control" name="VehNo"
                           value="{{$data[0]->VehNo ?? ''}}" onkeypress="return alphaNumericOnly(event)"
                           maxlength=10" min="0">
                </div>

                <div class="col-sm-3 m-b-20">
                    <label for="">CNIC <span class="mandatory"></span></label>
                    <input type="text" class="form-control" name="CNIC"
                           value="{{$data[0]->CNIC ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="13" min="0">
                </div>

                <div class="col-sm-3 m-b-20">
                    <label for="">No of Guests</label>
                    <input type="text" class="form-control" name="GuestsNo"
                           value="{{$data[0]->GuestsNo ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="1" min="0">
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 m-b-20">
                    <label for="">Sponsored By</label>
                    <select class="selectize form-control" name="SponsoredBy" id="SponsoredBy"
                            onkeypress="return alphaNumericOnly(event)" maxlength="15">
                        <option value="Self">Self</option>
                        <option value="Complimentary">Complimentary</option>
{{--                        <option--}}
{{--                            @if(isset($data[0]) && $data[0]->SponsoredBy == 'Self') selected @endif--}}
{{--                        value="{{$data[0]->SponsoredBy ?? 'Self'}}">{{$data[0]->SponsoredBy ?? 'Self'}}--}}
{{--                        </option>--}}
{{--                        <option--}}
{{--                            @if(isset($data[0]) && $data[0]->SponsoredBy == 'Complimentary') selected @endif--}}
{{--                        value="{{$data[0]->SponsoredBy ?? 'Complimentary'}}">{{$data[0]->SponsoredBy ?? 'Complimentary'}}--}}
{{--                        </option>--}}

                    </select>
                </div>

                <div class="col-lg-3 m-b-20">
                    <label for="">Fmn <span class="mandatory"></span></label>
                    <select class="selectize form-control" name="Fmn" id="Fmn"
                            onkeypress="return alphaNumericOnly(event)" maxlength="15">
                        <option value="Own">Own</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">Address <span class="mandatory"></span></label>
                    <input type="text" class="form-control" name="Address"
                           value="{{$data[0]->Address ?? ''}}" onkeypress="return alphaNumericOnly(event)"
                           maxlength="50" min="0">
                </div>

                <input type="hidden" value="{{date('Y-m-d')}}">
            </div>

            <div class="col-lg-offset-4 col-lg-4">
                <button type="submit" class="btn btn-primary btn-block">
                    Submit
                </button>
            </div>
            {{--                <div class="col-lg-3 m-b-20">--}}
            {{--                    <label for="">Remarks</label>--}}
            {{--                    <input type="text" class="form-control" name="Remarks"--}}
            {{--                           value="{{$data[0]->Remarks ?? ''}}" onkeypress="return alphaNumericOnly(event)"--}}
            {{--                           maxlength=100" min="0">--}}
            {{--                </div>--}}
        </div>
    </form>

@endsection
