@extends ('layouts.app')

@section('content')
    <div id="chrtPie"></div>
    <div id="chrtLine"></div>
    
    <script src="{{asset('js/library/loader.js')}}"></script>
    <script>
        // Load the current library release
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawPieChart);
        google.charts.setOnLoadCallback(drawLineChart);

        function drawPieChart() {

            // Convert Array to DataTable to dispaly
            var data = google.visualization.arrayToDataTable([
                ['Course Title', 'Number of Students'],
                <?php echo $chartData[0]?>
            ]);

            // Set options for Pie Chart
            var options = {
                title: 'Total Number of Characters by Houses',
                is3D: true,
                width: 800,
                height: 500
            };

            // Draw Pie chart
            var chart = new google.visualization.PieChart(document.getElementById('chrtPie'));
            chart.draw(data, options);
        }

        function drawLineChart() {

            // Convert Array to DataTable to dispaly
            var data = google.visualization.arrayToDataTable([
                ['Course Title', 'Number of Student'],
                <?php echo $chartData[1]?>
            ]);

            // Set options for Line Chart
            var options = {
                title: 'Total Number of Student by Course Title',
                width: 800,
                height: 600
            };

            // Draw Line chart
            var chart = new google.visualization.LineChart(document.getElementById('chrtLine'));
            chart.draw(data, options);
        }
    </script>
@endsection

