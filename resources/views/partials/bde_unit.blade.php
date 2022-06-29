<div class="container-fluid m-t-10">
    <div class="p-t-5 m-b-10 row">
        @if(Auth::user()->role == "admin")
            <p class="m-l-30">Bde</p>
            <a class="btn m-l-15
            @if(!isset($_GET['bde']))
                btn-primary
@else
                btn-default
@endif
                m-r-25 m-b-5
" href="{{route($module)}}">
                All
            </a>
            @foreach((new App\Http\Controllers\Controller())->bde as $item)
                <a class="btn m-l-15 @if(isset($_GET['bde']) && $_GET['bde'] == $item) btn-primary @else btn-default @endif m-r-25 m-b-1"
                   href="{{url()->current()."?bde=".$item}}">{{$item}}</a>
            @endforeach
        @endif
    </div>

    <div class="p-t-5 row">
        @if(Auth::user()->role == "user")
            @if(Auth::user()->unit == null || Auth::user()->unit == "")
                <div class="col-12">
                    <p class="m-l-30">Bde</p>
                    <a class="btn m-l-15 @if(isset($_GET['bde']) && $_GET['bde'] == Auth::user()->bde) btn-primary @else btn-default @endif m-r-25 m-b-1"
                       href="{{url()->current()."?bde=".Auth::user()->bde}}">{{Auth::user()->bde}}</a>
                </div>
            @endif
            @if(isset($_GET['bde']))
                <p class="m-l-30">Unit</p>
                @foreach((new \App\Http\Controllers\UnitController())->getWhereBde($_GET['bde']) as $item)
                    <a class="btn m-l-15 @if(isset($_GET['unit']) && $_GET['unit'] == $item->Unit) btn-primary @else btn-default @endif m-r-25 m-b-15"
                       href="{{url()->current()."?bde=".$_GET['bde']."&unit=".$item->Unit}}">{{$item->Unit}}</a>
                @endforeach
            @endif

            @if(Auth::user()->unit != null || Auth::user()->unit != "")
                <p class="m-l-30">Unit</p>
                <span class="btn btn-primary m-l-15 m-r-25 m-b-15">{{Auth::user()->unit}}</span>
            @endif
        @endif
        @if(Auth::user()->role == "admin")
            <p class="m-l-30">Unit</p>
            @if(isset($_GET['bde']))
                @foreach((new \App\Http\Controllers\UnitController())->getWhereBde($_GET['bde']) as $item)
                    <a class="btn m-l-15 @if(isset($_GET['unit']) && $_GET['unit'] == $item->Unit) btn-primary @else btn-default @endif m-r-25 m-b-15"
                       href="{{url()->current()."?bde=".$_GET['bde']."&unit=".$item->Unit}}">{{$item->Unit}}</a>
                @endforeach
            @endif
        @endif
    </div>
</div>
