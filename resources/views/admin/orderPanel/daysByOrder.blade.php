<script>
    Highcharts.chart('daysByOrder', {
        chart: {
            type: 'column'
        },
        title: {
            align: 'left',
            text: 'Sargytlaryň güne görä näçe gezek sargyt edileniň sany',
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
                        @foreach($daysByOrder as $day)
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