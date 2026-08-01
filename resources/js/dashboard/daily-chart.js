import ApexCharts from 'apexcharts';

document.addEventListener('DOMContentLoaded', () => {

    const chartElement = document.querySelector('#dailyChart');

    if (!chartElement) return;

    const dateInput = document.getElementById('selectedDate');
    const prevBtn = document.getElementById('prevDay');
    const nextBtn = document.getElementById('nextDay');

    const chart = new ApexCharts(chartElement, {

        chart: {
            type: 'bar',
            height: 400,
            toolbar: {
                show: false
            }
        },

        colors: ['#8B7EFF'],

        plotOptions: {
            bar: {
                borderRadius: 6,
                columnWidth: '45%'
            }
        },

        series: [{
            name: 'Transaksi',
            data: []
        }],

        xaxis: {
            categories: []
        },

        yaxis: {
            min: 0,
            forceNiceScale: true
        },

        dataLabels: {
            enabled: false
        },

        plotOptions: {
            bar: {
                borderRadius: 6,
                columnWidth: '45%'
            }
        },

        noData: {
            text: 'Loading...'
        }

    });

    chart.render();

    loadChart();

    function loadChart() {

        fetch(`/dashboard/daily-chart?date=${dateInput.value}`)

            .then(res => res.json())

            .then(data => {

                const total = response.series.reduce((a, b) => a + b, 0);

                if (total === 0) {

                    chart.updateOptions({
                        noData: {
                            text: 'Belum ada data transaksi'
                        }
                    });

                    chart.updateSeries([]);

                    return;
                }

                chart.updateOptions({
                    xaxis: {
                        categories: response.labels
                    }
                });

                chart.updateSeries([{
                    name: 'Transaksi',
                    data: response.series
                }]);

                toggleNext();

            });

    }

    function toggleNext() {

        const today = new Date();
        today.setHours(0, 0, 0, 0);

        const selected = new Date(dateInput.value);
        selected.setHours(0, 0, 0, 0);

        nextBtn.disabled = selected >= today;

    }

    dateInput.addEventListener('change', loadChart);

    prevBtn.addEventListener('click', () => {

        let d = new Date(dateInput.value);

        d.setDate(d.getDate() - 1);

        dateInput.value = d.toISOString().slice(0, 10);

        loadChart();

    });

    nextBtn.addEventListener('click', () => {

        let d = new Date(dateInput.value);

        d.setDate(d.getDate() + 1);

        if (d <= new Date()) {

            dateInput.value = d.toISOString().slice(0, 10);

            loadChart();

        }

    });

});