@extends ('layouts.app')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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

<div id="columnchart_material" style="width: 500px; height: 400px;"></div>

<script src="{{asset('js/library/loader.js')}}"></script>
<script>
  // Load the current library release
  google.charts.load('current', {
    'packages': ['bar']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    // var data = google.visualization.arrayToDataTable([
    //   ['Courses', 'Basic', 'Intermediate'],
    //   ['1', 50, 60],
    //   ['2', 70, 60],
    //   ['3', 66, 75],
    //   ['4', 30, 54]
    // ]);

    var data = google.visualization.arrayToDataTable([
            ['assignmentName', 'assignmentGrade'],
            <?php echo $studentChartData[0] ?>
        ]);

    // var dataArray = [];
    // var Header = ['Courses', 'Basic', 'Intermediate'];
    // data.push(Header);
    // for (var i = 0; i < $studentChartData.length; i++) {
    //   var temp = [];
    //   temp.push($studentChartData[i],);
    //   data.push(temp);
    // }
    // var data = new google.visualization.arrayToDataTable(dataArray);

    var options = {
      chart: {
        title: 'Student Performance',
        subtitle: 'Basic and Intermediate: Assignments',
        width: 900,
      }
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>
@endsection