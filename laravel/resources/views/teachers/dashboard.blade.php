@extends ('layouts.app')

@section('assets')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')
    <div class="statistics">
        <div class="totalStudent student-data">
            <h2 class="data-title">Total Number of Students</h2>
            <p class="data"><strong>{{ $totalStudent[0]->totalStudent }}</strong></p>
        </div>
    </div>

    <table class="columns">
        <tr>
            <td>
                <div id="piechart_div" style="border: 1px solid #ccc"></div>
            </td>
            <td>
                <div id="barchart_div" style="border: 1px solid #ccc"></div>
            </td>
        </tr>
    </table>
@endsection

@section('scripts')
    <script src="{{ asset('js/library/loader.js') }}"></script>
    <script>
        // Load Charts and the corechart and barchart packages.
        google.charts.load('current', {
            'packages': ['corechart']
        });

        // Draw the pie chart and bar chart when Charts is loaded.
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
          var dataPie = google.visualization.arrayToDataTable([
                ['Course Title', 'Students'],
                <?php echo $chartData[0]; ?>
            ]);

            var piechart_options = {
                title: 'Total Number of Students | Enrollment by Courses',
                width: 500,
                is3D: true,
                height: 300
            };

            var piechart = new google.visualization.PieChart(document.getElementById('piechart_div'));
            piechart.draw(dataPie, piechart_options);

            var dataChart = google.visualization.arrayToDataTable([
                ['Course Title', 'Students'],
                <?php echo $chartData[1]; ?>
            ]);

            var barchart_options = {
                title: 'Enrollment by Gender',
                width: 450,
                height: 300,
                legend: 'none'
            };
            
            var barchart = new google.visualization.BarChart(document.getElementById('barchart_div'));
            barchart.draw(dataChart, barchart_options);
        }
    </script>
@endsection
