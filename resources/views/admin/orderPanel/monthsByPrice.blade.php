<script>
    Highcharts.chart('monthsByPrice', {
        chart: {
            type: 'pie'
        },
        title: {
            align: 'left',
            text: 'Sargytlaryň aýa görä naçe manatlyk sargyt edileniň sany',
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
                        @foreach($monthsByPrice as $month)
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