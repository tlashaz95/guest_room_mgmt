
<style>
    .pop-up{
        width: 100%;
        text-align: center;
        margin-top: 4%;
        margin-bottom: 0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    }


    .alert-danger-red{
        background-color: #ed0000;
        color:white;

    }

</style>
{{--<div class="row">--}}
@if(Session::has('success'))
<div class="alert alert-success col-sm-12 pop-up">
    <p class="h4">{{Session::get('success')}}</p>
</div>
@endif
@if(Session::has('danger'))
    <div class="alert alert-danger-red col-sm-12 pop-up">
        <p class="h4">{{Session::get('danger')}}</p>
    </div>
@endif
    @if(Session::has('warning'))
        <div class="alert alert-warning col-sm-12 pop-up">
            <p class="h4">{{Session::get('warning')}}</p>
        </div>
    @endif
@if(Session::has('exception'))
    <div class="alert alert-warning col-sm-12 pop-up">
        <p class="h4">{{Session::get('exception')}}</p>
    </div>
@endif

@if(Session::has('message'))
    <div class="alert alert-danger-red col-sm-12 pop-up">
        <p class="h4">{{Session::get('message')?? "Testing message"}}</p>
    </div>
@endif
{{--</div>--}}
{{--@if(true)--}}
{{--    <div class="alert alert-warning col-sm-12 pop-up">--}}
{{--        <p class="h4">{{"dsaif isdjfoijaofs jdfsa sadf dsafjodsafiidsahf ojsadoifj djfpjppo"}}</p>--}}
{{--    </div>--}}
{{--@endif--}}
{{--<script>--}}
{{--    $(document).ready(function() {--}}
{{--        $(".pop-up").fadeTo(2000, 500).slideUp(500, function(){--}}
{{--            $(".pop-up").slideUp(500);--}}
{{--        })});--}}
{{--</script>--}}
