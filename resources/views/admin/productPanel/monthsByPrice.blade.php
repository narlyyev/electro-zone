<script>
    Highcharts.chart('monthsByPrice', {
        title: {
            align: 'left',
            text: 'Harytlaryň aýa görä näçe manatlyk sargyt edileniň sany',
        },
        series: [{
            data: [
                @foreach($monthsByPrice as $month)
                        {{ $month['count'] }},
                @endforeach
            ],
            name: 'Monthly Quantity'
        }],
        xAxis: {
            categories: [
                @foreach($monthsByQuantity as $month)
                    '{{ date("F", mktime(0, 0, 0, $month["month"], 1)) }}',
                @endforeach
            ]
        },
    });
</script>
