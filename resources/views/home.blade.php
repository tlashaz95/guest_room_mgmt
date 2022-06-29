@extends('layouts.app')
@section('content')
    <?php
    //$BookingID = $data[0]->BillingID;
    $month = date('m');
    $yr = date('y');
    ?>
    <link href="{{url('theme')}}/css/bookingBox.css" rel="stylesheet">
    <div class="container">

        <h2 class="text-success bold">Book a Room !</h2>

        <form action="{{route('store.update.bookings',['id'=>'-1'])}}" method="post">
            {{ csrf_field() }}

            <input type="hidden" value="{{$month}}" name="Month"/>
            <input type="hidden" value="{{$yr}}" name="Yr"/>

            <div class="group">
                <input type="text" list="cats" name="Cat"
                       onkeypress="return alphabetsOnly(event)" maxlength="25"
                       required="required">
                <datalist class="transparent" id="cats">
                    @foreach((new \App\Http\Controllers\Controller())->Cats as $item)
                        <option value="{{$item}}">{{$item}}</option>
                    @endforeach

                </datalist>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Cat</label>
            </div>

            <div class="group">
                <input type="text" name="ArmyNo"
                       onkeypress="return alphabetsOnly(event)" maxlength="25"
                       required="required">
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Army No</label>
            </div>

        </form>
    </div>


@endsection
