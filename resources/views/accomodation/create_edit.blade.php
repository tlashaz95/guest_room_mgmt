@extends('layouts.app')
@section('content')
    <div class="m-t-30 h2 text-dark" style="text-align: center"><b>ACCN</b></div>
    <form action="{{route('store.update.'.$module,['id'=>$id])}}" method="post">
        {{ csrf_field() }}

        <div style="font-size: small" class="card form-card col-lg-12">
            <div class="row">
                <div class="col-sm-7 col-sm-offset-3">
                    <h6 style="color:red">
                        <i>(Fds marked with asterisk are mandatory to be filled in order to submit the form)</i>
                    </h6>
                </div>

                <div class="col-lg-6 m-b-10 m-t-10">
                    <div class=" form-line">
                        <label for="">Unit <span class="mandatory">*</span></label>
                        <input type="text" list="unit" class="form-control" name="Unit" value="{{$data[0]->Unit ?? ''}}"
                               onkeypress="return alphaNumericOnly(event)" maxlength="20" required="required">
                        <datalist id="unit">
                            @foreach((new \App\Http\Controllers\UnitController())->get() as $item)
                                <option value="{{$item->Unit}}">
                                    {{$item->Unit}}
                                </option>
                            @endforeach
                        </datalist>
                    </div>
                </div>

                <div class="col-lg-6 m-b-10 m-t-10">
                    <div class=" form-line">
                        <label for="">Bde <span class="mandatory">*</span></label>
                        <input type="text" class="form-control" list="bde" name="Bde" value="{{$data[0]->Bde ?? ''}}"
                               onkeypress="return alphaNumericOnly(event)" maxlength="20" required="required">
                        <datalist id="bde">
                            @foreach((new \App\Http\Controllers\Controller())->bde as $item)
                                <option value="{{$item}}">{{$item}}</option>
                            @endforeach

                        </datalist>
                    </div>
                </div>


                {{--                <div class="col-lg-6 m-b-20">--}}
                {{--                    <label for="">Fmn</label>--}}
                {{--                    <input type="text" class="form-control" name="Fmn"  value="{{$data[0]->Fmn ?? ''}}">--}}
                {{--                </div>--}}

                <div class="col-lg-6 m-b-20">
                    <label for="">Houses / MOQs Auth <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" name="Houses_MOQsAuth"
                           value="{{$data[0]->Houses_MOQsAuth ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="4" min="0" required="required">
                </div>


                <div class="col-lg-6 m-b-20">
                    <label for="">Houses / MOQs Held <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" name="Houses_MOQsHeld"
                           value="{{$data[0]->Houses_MOQsHeld ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">C/MOQs Auth <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="CMOQsAuth" value="{{$data[0]->CMOQsAuth ?? ''}}"
                           onkeypress="return NumericOnly(event)" maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">C/MOQs Held <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="CMOQsHeld" value="{{$data[0]->CMOQsHeld ?? ''}}"
                           onkeypress="return NumericOnly(event)" maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">BOQs Auth <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="BOQsAuth" value="{{$data[0]->BOQsAuth ?? ''}}"
                           onkeypress="return NumericOnly(event)" maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">BOQs Held <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="BOQsHeld" value="{{$data[0]->BOQsHeld ?? ''}}"
                           onkeypress="return NumericOnly(event)" maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">JCOs Qtr Auth <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="JCOsQtrAuth" value="{{$data[0]->JCOsQtrAuth ?? ''}}"
                           onkeypress="return NumericOnly(event)" maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">JCOs Qtr Held <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="JCOsQtrHeld" value="{{$data[0]->JCOsQtrHeld ?? ''}}"
                           onkeypress="return NumericOnly(event)" maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">Sldrs Qtr Auth <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="SldrsQtrAuth" value="{{$data[0]->SldrsQtrAuth ?? ''}}"
                           onkeypress="return NumericOnly(event)" maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">Sldr Qtr Held <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="SldrQtrHeld" value="{{$data[0]->SldrQtrHeld ?? ''}}"
                           onkeypress="return NumericOnly(event)" maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">NCsE Qtr Auth <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="NCsEQtrAuth" value="{{$data[0]->NCsEQtrAuth ?? ''}}"
                           onkeypress="return NumericOnly(event)" maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">NCsE Qtr Held <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="NCsEQtrHeld" value="{{$data[0]->NCsEQtrHeld ?? ''}}"
                           onkeypress="return NumericOnly(event)" maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">SM Bks Auth <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="SM_BksAuth" value="{{$data[0]->SM_BksAuth ?? ''}}"
                           onkeypress="return NumericOnly(event)" maxlength="4" min="0" required="required">
                </div>


                <div class="col-lg-6 m-b-20">
                    <label for="">SM Bks Held <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="SM_BksHeld" value="{{$data[0]->SM_BksHeld ?? ''}}"
                           onkeypress="return NumericOnly(event)" maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">JCOs Mess Auth <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="JCOsMessAuth" value="{{$data[0]->JCOsMessAuth ?? ''}}"
                           onkeypress="return NumericOnly(event)" maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">JCOs Mess Held <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="JCOsMessHeld" value="{{$data[0]->JCOsMessHeld ?? ''}}"
                           onkeypress="return NumericOnly(event)" maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">A Vehs Sheds Aut <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="AVehsShedsAuth"
                           value="{{$data[0]->AVehsShedsAuth ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">A Vehs Sheds Held <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="AVehsShedsHeld"
                           value="{{$data[0]->AVehsShedsHeld ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">B Vehs Sheds Auth <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="BVehsShedsAuth"
                           value="{{$data[0]->BVehsShedsAuth ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">B Vehs Sheds Held <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="B Vehs Sheds Held"
                           value="{{$data[0]->BVehsShedsHeld ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="4" min="0" required="required">
                </div>


                <div class="col-lg-6 m-b-20">
                    <label for="">Wksp Sheds Auth <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="WkspShedsAuth"
                           value="{{$data[0]->WkspShedsAuth ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">Wksp Sheds Held <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="WkspShedsHeld"
                           value="{{$data[0]->WkspShedsHeld ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">Regt Stores Auth <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="RegtStoresAuth"
                           value="{{$data[0]->RegtStoresAuth ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">Regt Stores Held <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="RegtStoresHeld"
                           value="{{$data[0]->RegtStoresHeld ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">POL Stores Auth <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="POLStoresAuth"
                           value="{{$data[0]->POLStoresAuth ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="4" min="0" required="required">
                </div>

                <div class="col-lg-6 m-b-20">
                    <label for="">POL Stores Held <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="POLStoresHeld"
                           value="{{$data[0]->POLStoresHeld ?? ''}}" onkeypress="return NumericOnly(event)"
                           maxlength="4" min="0" required="required">
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
