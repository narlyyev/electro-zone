<script>
    Highcharts.chart('daysByPrice', {
        chart: {
            type: 'column'
        },
        title: {
            align: 'left',
            text: 'Harytlaryň güne görä näçe manatlyk sargyt edileniň sany',
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
                        @foreach($daysByPrice as $day)
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