<?php
$AccnAuth = array(
    array("label"=>"Houses / MOQs", "y"=>\App\Http\Controllers\AccomodationController::getAccn('Houses_MOQsAuth')),
    array("label"=>"C/MOQs", "y"=>\App\Http\Controllers\AccomodationController::getAccn('CMOQsAuth')),
    array("label"=>"BOQs", "y"=>\App\Http\Controllers\AccomodationController::getAccn('BOQsAuth')),
    array("label"=>"JCOs Qtr", "y"=>\App\Http\Controllers\AccomodationController::getAccn('JCOsQtrAuth')),
    array("label"=>"Sldr Qtrs", "y"=>\App\Http\Controllers\AccomodationController::getAccn('SldrsQtrAuth')),
    array("label"=>"SM Bks", "y"=>\App\Http\Controllers\AccomodationController::getAccn('NCsEQtrAuth')),
    array("label"=>"JCOs Mess", "y"=>\App\Http\Controllers\AccomodationController::getAccn('SM_BksAuth')),
    array("label"=>"A Veh Sheds", "y"=>\App\Http\Controllers\AccomodationController::getAccn('JCOsMessAuth')),
    array("label"=>"B Veh Sheds", "y"=>\App\Http\Controllers\AccomodationController::getAccn('AVehsShedsAuth')),
    array("label"=>"Wksp Sheds", "y"=>\App\Http\Controllers\AccomodationController::getAccn('BVehsShedsAuth')),
    array("label"=>"Regt Stores", "y"=>\App\Http\Controllers\AccomodationController::getAccn('WkspShedsAuth')),
    array("label"=>"POL Stores", "y"=>\App\Http\Controllers\AccomodationController::getAccn('RegtStoresAuth')),
    array("label"=>"POL Stores", "y"=>\App\Http\Controllers\AccomodationController::getAccn('POLStoresAuth'))
);

$AccnHeld = array(
    array("label"=>"Houses / MOQs", "y"=>\App\Http\Controllers\AccomodationController::getAccn('Houses_MOQsHeld')),
    array("label"=>"C/MOQs", "y"=>\App\Http\Controllers\AccomodationController::getAccn('CMOQsHeld')),
    array("label"=>"BOQs", "y"=>\App\Http\Controllers\AccomodationController::getAccn('BOQsHeld')),
    array("label"=>"JCOs Qtr", "y"=>\App\Http\Controllers\AccomodationController::getAccn('JCOsQtrHeld')),
    array("label"=>"Sldr Qtrs", "y"=>\App\Http\Controllers\AccomodationController::getAccn('SldrQtrHeld')),
    array("label"=>"SM Bks", "y"=>\App\Http\Controllers\AccomodationController::getAccn('NCsEQtrHeld')),
    array("label"=>"JCOs Mess", "y"=>\App\Http\Controllers\AccomodationController::getAccn('SM_BksHeld')),
    array("label"=>"A Veh Sheds", "y"=>\App\Http\Controllers\AccomodationController::getAccn('JCOsMessHeld')),
    array("label"=>"B Veh Sheds", "y"=>\App\Http\Controllers\AccomodationController::getAccn('AVehsShedsHeld')),
    array("label"=>"Wksp Sheds", "y"=>\App\Http\Controllers\AccomodationController::getAccn('BVehsShedsHeld')),
    array("label"=>"Regt Stores", "y"=>\App\Http\Controllers\AccomodationController::getAccn('WkspShedsHeld')),
    array("label"=>"POL Stores", "y"=>\App\Http\Controllers\AccomodationController::getAccn('RegtStoresHeld')),
    array("label"=>"POL Stores", "y"=>\App\Http\Controllers\AccomodationController::getAccn('POLStoresHeld'))
);
?>
<style>
    .graph{
        width:95%;
        height:400px;
        margin-bottom: 10px;
    }
</style>
<script src="{{asset('js/canvasjs.min.js')}}"></script>
<script>
    window.onload = function() {
        //CanvasJS.addColorSet("shades",["red", "orange", "#e6e600", "green"]);

        var chart = new CanvasJS.Chart("chart_div", {
            animationEnabled: true,
            //colorSet:"shades",
            // title: {
            //     text: "Accn"
            // },
            toolTip: {
                shared: true
            },
            // subtitles: [{
            //     text: "Score %age"
            // }],
            axisY: {
                title: "No of Units"
            },
            data: [{
                type: "column",
                name: "Auth",
                legendText: "Auth",
                showInLegend: true,
                yValueFormatString: "#,##0",
                indexLabel: "({y})",
                dataPoints: <?php echo json_encode($AccnAuth, JSON_NUMERIC_CHECK); ?>
            },
                {
                    type: "column",
                    name: "Held",
                    legendText: "Held",
                    showInLegend: true,
                    yValueFormatString: "#,##0",
                    indexLabel: "({y})",
                    dataPoints: <?php echo json_encode($AccnHeld, JSON_NUMERIC_CHECK); ?>
                }]
        });
        chart.render();
    }
</script>

<div id="chart_div" class="col-md-5 graph"></div>
