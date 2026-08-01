import ApexCharts from 'apexcharts';

document.addEventListener('DOMContentLoaded', () => {

    const chartElement = document.querySelector('#yearlyChart');

    if (!chartElement) return;

    const yearInput = document.getElementById('selectedYear');
    const viewInput = document.getElementById('chartView');
    const prevBtn = document.getElementById('prevYear');
    const nextBtn = document.getElementById('nextYear');

    const chart = new ApexCharts(chartElement, {

        chart: {
            type: 'bar',
            height: 420,
            toolbar: {
                show: false
            }
        },

        colors: [
            '#8B7EFF', // Member
            '#4ECDC4' // Non Member
            // ,'#F6A531'  // Pendapatan
        ],

        series: [],

        xaxis: {
            categories: [],
            labels: {
                style: {
                    colors: '#D9D9E3'
                }
            },
            axisBorder: {
                color: 'rgba(255,255,255,.12)'
            },
            axisTicks: {
                color: 'rgba(255,255,255,.12)'
            }
        },

        yaxis: {
            labels: {
                style: {
                    colors: '#D9D9E3'
                }
            }
        },

        grid: {
            borderColor: 'rgba(255,255,255,.08)'
        },

        legend: {
            position: 'top',
            horizontalAlign: 'right',
            labels: {
                colors: '#D9D9E3'
            }
        },

        tooltip: {

            theme: 'dark',

            y: {

                formatter: function (value, { seriesIndex, w }) {

                    const seriesName = w.globals.seriesNames[seriesIndex];

                    if (seriesName === 'Pendapatan') {

                        return 'Rp ' + Number(value).toLocaleString('id-ID');

                    }

                    return value;

                }

            }

        },

        dataLabels: {
            enabled: false
        },

        plotOptions: {
            bar: {
                borderRadius: 6,
                columnWidth: '55%'
            }
        },

        noData: {
            text: 'Loading...',
            style: {
                color: '#D9D9E3'
            }
        }

    });

    chart.render();

    loadChart();

    function loadChart() {

        fetch(`/dashboard/yearly-chart?year=${yearInput.value}&view=${viewInput.value}`)

            .then(res => res.json())

            .then(data => {

                const totalSeries = data.series.reduce((carry, item) => {

                    return carry + item.data.reduce((a, b) => a + b, 0);

                }, 0);

                if (totalSeries === 0) {

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
                        categories: data.labels
                    }
                });

                chart.updateSeries(data.series);

                toggleNext();

            });

    }

    function toggleNext() {

        nextBtn.disabled = parseInt(yearInput.value) >= new Date().getFullYear();

    }

    yearInput.addEventListener('change', loadChart);

    viewInput.addEventListener('change', loadChart);

    prevBtn.addEventListener('click', () => {

        yearInput.value--;

        loadChart();

    });

    nextBtn.addEventListener('click', () => {

        if (parseInt(yearInput.value) < new Date().getFullYear()) {

            yearInput.value++;

            loadChart();

        }

    });

});