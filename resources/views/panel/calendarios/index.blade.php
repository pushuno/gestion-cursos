@extends('layouts.panel')

@section('title',"Calendario")

@section('seccion','Calendario')

@section('cabecera')
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('css/panel/calendario/main.min.css') }}">
    <!--<link rel="stylesheet" href="../plugins/fullcalendar-interaction/main.min.css">-->
    <link rel="stylesheet" href="{{ asset('css/panel/calendario/daygrid_main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/panel/calendario/timegrid_main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/panel/calendario/bootstrap_main.min.css') }}">
@endsection

@section('content')
    <div class="row">
      <!-- /.col -->
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-body p-0">
            <!-- THE CALENDAR -->
            <div id="calendar"></div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection

@section('scripts')
<!-- fullCalendar 2.2.5 -->
<script src="{{ asset('js/panel/calendario/moment.min.js') }}"></script>
<script src="{{ asset('js/panel/calendario/main.min.js') }}"></script>
<script src="{{ asset('js/panel/calendario/daygrid_main.min.js') }}"></script>
<script src="{{ asset('js/panel/calendario/timegrid_main.min.js') }}"></script>
<script src="{{ asset('js/panel/calendario/interaction_main.min.js') }}"></script>
<script src="{{ asset('js/panel/calendario/bootstrap_main.min.js') }}"></script>

<script>
    $(function () {
      var date = new Date()
      var d    = date.getDate(),
          m    = date.getMonth(),
          y    = date.getFullYear()

      var Calendar = FullCalendar.Calendar;
      var Draggable = FullCalendarInteraction.Draggable;
      var containerEl;
      var calendarEl = document.getElementById('calendar');


      var calendar = new Calendar(calendarEl, {
        plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
        header    : {
          left  : 'prev,next today',
          center: 'title',
          right : 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        businessHours: {
            daysOfWeek: [ 1, 2, 3, 4, 5 ],
            startTime: '07:00',
            endTime: '20:00',
        },
        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Dia'
          },
        locale: 'es',
        defaultDate: '{{ date("Y-m-d") }}',
        //Random default events
        events    : [
            @foreach($fechas as  $fecha)
                {
                    title          : '{{ ucwords(strtolower($fecha->catedra->curso->nombre)) }}',
                    start          : new Date(y, {{ $fecha->fecha('m')-1 }}, {{ $fecha->fecha('d') }},{{ $fecha->hora_inicio('H,i') }}),
                    end            : new Date(y, {{ $fecha->fecha('m')-1 }}, {{ $fecha->fecha('d') }},{{ $fecha->hora_fin('H,i') }}),
                    url            : '{{ route('catedras.show',['catedra' => $fecha->catedra]) }}',
                    backgroundColor: '#{{ $fecha->catedra->color() }}', //Primary (light-blue)
                    borderColor    : '#{{ $fecha->catedra->color() }}' //Primary (light-blue)
                },
            @endforeach
            @foreach($feriados as  $feriado)
                {
                    start: '{{ $feriado->fecha('Y-m-d') }}',
                    end: '{{ $feriado->fecha('Y-m-d') }}',
                    overlap:true,
                    rendering: 'background',
                    color: '#ff0000'
                },
            @endforeach
        ],
        editable  : false,
        droppable : false, // this allows things to be dropped onto the calendar !!!

      });

      calendar.render();
      // $('#calendar').fullCalendar()


    });
  </script>

@endsection


