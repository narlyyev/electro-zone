<script>
    //    daysByViewed
    Highcharts.chart('monthsByViewed', {
        chart: {
            type: 'pie'
        },
        title: {
            align: 'left',
            text: 'Harytlaryň aýa görä görülen sany',
        },
        xAxis: {
            type: 'category'
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                }
            }
        },

        series: [
            {
                colorByPoint: true,
                data: [
                        @foreach($monthsByViewed as $month)
                    {
                        name: '{{ date("F", mktime(0, 0, 0, $month["month"], 1)) }}',
                        y: {{ $month['count'] }},
                    },
                    @endforeach
                ]
            }
        ],
    });
</script>