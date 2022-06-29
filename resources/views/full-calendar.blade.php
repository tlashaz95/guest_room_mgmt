@extends('layouts.app')
@section('content')
    <?php
    //$BookingID = $data[0]->BillingID;
    $month = date('m');
    $yr = date('y');
    ?>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <div class="container">
        <br />
        <h1 class="text-center text-primary"><u>How to Use Fullcalendar in Laravel 8</u></h1>
        <br />

        <div id="calendar"></div>

    </div>

    <script>

        $(document).ready(function () {

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#calendar').fullCalendar({
                editable:true,
                header:{
                    left:'prev,next today',
                    center:'title',
                    right:'month,agendaWeek,agendaDay'
                },
                events:'/full-calender',
                selectable:true,
                selectHelper: true,
                select:function(From, To, allDay)
                {
                    var Name = prompt('Name:');

                    var RoomNo = prompt('Room No:');

                    if(Name)
                    {
                        var From = $.fullCalendar.formatDate(From, 'Y-MM-DD');

                        var To = $.fullCalendar.formatDate(To, 'Y-MM-DD');

                        $.ajax({
                            url:"/full-calendar/action",
                            type:"POST",
                            data:{
                                Name: Name,
                                RoomNo: RoomNo,
                                From: From,
                                To: To,
                                type: 'add'
                            },
                            success:function(data)
                            {
                                calendar.fullCalendar('refetchEvents');
                                alert("Event Created Successfully");
                            }
                        })
                    }
                },
                editable:true,
                eventResize: function(event, delta)
                {
                    var From = $.fullCalendar.formatDate(event.start, 'Y-MM-DD');
                    var To = $.fullCalendar.formatDate(event.end, 'Y-MM-DD');
                    var Name = event.Name;
                    var RoomNo = event.RoomNo;
                    var id = event.id;
                    $.ajax({
                        url:"/full-calender/action",
                        type:"POST",
                        data:{
                            Name: Name,
                            RoomNo: RoomNo,
                            From: From,
                            To: To,
                            id: id,
                            type: 'update'
                        },
                        success:function(response)
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Updated Successfully");
                        }
                    })
                },
                eventDrop: function(event, delta)
                {
                    var From = $.fullCalendar.formatDate(event.start, 'Y-MM-DD');
                    var To = $.fullCalendar.formatDate(event.end, 'Y-MM-DD');
                    var Name = event.Name;
                    var RoomNo = event.RoomNo;
                    var id = event.id;
                    $.ajax({
                        url:"/full-calender/action",
                        type:"POST",
                        data:{
                            Name: Name,
                            RoomNo: RoomNo,
                            From: From,
                            To: To,
                            id: id,
                            type: 'update'
                        },
                        success:function(response)
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Updated Successfully");
                        }
                    })
                },

                eventClick:function(event)
                {
                    if(confirm("Are you sure you want to remove it?"))
                    {
                        var id = event.id;
                        $.ajax({
                            url:"/full-calender/action",
                            type:"POST",
                            data:{
                                id:id,
                                type:"delete"
                            },
                            success:function(response)
                            {
                                calendar.fullCalendar('refetchEvents');
                                alert("Event Deleted Successfully");
                            }
                        })
                    }
                }
            });

        });

    </script>
@endsection
