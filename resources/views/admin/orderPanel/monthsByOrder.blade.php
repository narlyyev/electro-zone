<script>
    Highcharts.chart('monthsByOrder', {
        title: {
            align: 'left',
            text: 'Sargytlaryň aýa görä näçe gezek manatlyk sargyt edileniň sany',
        },
        series: [{
            data: [
                @foreach($monthsByOrder as $month)
                        {{ $month['count'] }},
                @endforeach
            ],
            name: 'Monthly Quantity'
        }],
        xAxis: {
            categories: [
                @foreach($monthsByOrder as $month)
                    '{{ date("F", mktime(0, 0, 0, $month["month"], 1)) }}',
                @endforeach
            ]
        },
    });
</script>
