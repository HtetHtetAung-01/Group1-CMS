@extends ('layouts.app')

@section('title', "Dashboard")

@section('assets')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')

<div class="statistics">
  <div class="totalEnrolled student-data">
    <h2 class="data-title">Total<br>Enrolled Course</h2>
    <p class="data"><strong>{{ $enrolledData[0]->totalEnrolledCourse }}</strong></p>
  </div>
  <div class="totalCompleted student-data">
    <h2 class="data-title">Total<br>Completed Course</h2>
    <p class="data"><strong>{{ $completedData[0]->totalCompletedCourse }}</strong></p>
  </div>
</div>

<div class="chart-bg">
  <div id="columnchart_material" class="chart-pnl"></div>
</div>

<script src="{{asset('js/library/loader.js')}}"></script>
<script>
  // Load the current library release
  google.charts.load('current', {
    'packages': ['bar']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['', 'assignmentGrade'],
      <?php echo $studentChartData[0] ?>
    ]);

    var options = {
      chart: {
        title: 'Student Performance',
        subtitle: 'Basic and Intermediate: Assignments',
      },
      bars: 'horizontal',
      height: 300,
      hAxis: {
        format: '#\'%\''
      },
      
    };

    if (data.getNumberOfRows() === 0) {
      $("#columnchart_material").append("No data yet.")
    } else {
      var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
    
  }
</script>
@endsection