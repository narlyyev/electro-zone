<script>
    //    daysByViewed
    Highcharts.chart('daysByQuantity', {
        chart: {
            type: 'column'
        },
        title: {
            align: 'left',
            text: 'Harytlaryň güne görä näçe sargyt edileniň sany',
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
                        @foreach($daysByQuantity as $day)
                    {
                        name: "{{ \Carbon\Carbon::parse($day['day'])->format('d') }}" + "-" + "{{ \Carbon\Carbon::parse($day['day'])->format('M') }}" + "-" + "{{ \Carbon\Carbon::parse($day['day'])->format('Y') }}",
                        y: {{ $day['count'] }},
                    },
                    @endforeach
                ]
            }
        ],
    });
</script>