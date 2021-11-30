@extends ('layouts.app')

@section('title', 'Dashboard')

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

    <div class="chart-bg" id="charts">
        <table class="columns">
            <tr>
                <td>
                    <div id="piechart_div" class="pie-col"></div>
                </td>
                <td>
                    <div id="barchart_div"></div>
                </td>
            </tr>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/library/loader.js') }}"></script>

    <!-- To show the chart -->
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
                height: 350
            };

            var piechart = new google.visualization.PieChart(document.getElementById('piechart_div'));
            piechart.draw(dataPie, piechart_options);

            var dataChart = google.visualization.arrayToDataTable([
                ['Course Title', 'Students'],
                <?php echo $chartData[1]; ?>
            ]);

            var barchart_options = {
                title: 'Enrollment by Gender',
                width: 400,
                height: 350,
                legend: 'none'
            };

            var barchart = new google.visualization.BarChart(document.getElementById('barchart_div'));
            barchart.draw(dataChart, barchart_options);

            if (dataPie.getNumberOfRows() === 0 && dataChart.getNumberOfRows() === 0) {
                $("#charts").append("<div class='msg-box-empty'><p>No Data Yet.</p></div>")
            }
        }
    </script>
@endsection
