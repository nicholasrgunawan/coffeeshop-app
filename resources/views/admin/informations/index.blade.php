<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <a href="{{ route('admin.export.csv') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Export CSV</a>
                <!-- Display the number of reservations -->
                <div class="mt-4">
                    <h3 class="text-lg font-semibold">Total Reservations: {{ array_sum($reservationsByDayOfWeek) }}</h3>
                </div>

                <div class="mt-4">
                    <canvas id="reservationsDayChart" width="400" height="200"></canvas>
                </div>

                <div class="mt-4">
                    <h3 class="text-lg font-semibold">Reservations Per Week</h3>
                    <canvas id="reservationsWeekChart" width="400" height="200"></canvas>
                </div>

                <div class="mt-4">
                    <h3 class="text-lg font-semibold">Reservations Per Month</h3>
                    <canvas id="reservationsMonthChart" width="400" height="200"></canvas>
                </div>

                <div class="mt-4">
                    <h3 class="text-lg font-semibold">Reservations Per Year</h3>
                    <canvas id="reservationsYearChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctxDay = document.getElementById('reservationsDayChart').getContext('2d');
            var ctxWeek = document.getElementById('reservationsWeekChart').getContext('2d');
            var ctxMonth = document.getElementById('reservationsMonthChart').getContext('2d');
            var ctxYear = document.getElementById('reservationsYearChart').getContext('2d');

            var reservationsByDayOfWeek = {!! json_encode($reservationsByDayOfWeek) !!};
            var reservationsByWeek = {!! json_encode($reservationsByWeek) !!};
            var reservationsByMonth = {!! json_encode($reservationsByMonth) !!};
            var reservationsByYear = {!! json_encode($reservationsByYear) !!};

            var dayLabels = Object.keys(reservationsByDayOfWeek);
            var dayData = Object.values(reservationsByDayOfWeek);

            var weekLabels = Object.keys(reservationsByWeek);
            var weekData = Object.values(reservationsByWeek);

            var monthLabels = Object.keys(reservationsByMonth);
            var monthData = Object.values(reservationsByMonth);

            var yearLabels = Object.keys(reservationsByYear);
            var yearData = Object.values(reservationsByYear);

            var backgroundColors = [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(231, 233, 237, 0.2)' // Add more colors as needed
            ];

            new Chart(ctxDay, {
                type: 'bar',
                data: {
                    labels: dayLabels,
                    datasets: [{
                        label: 'Reservations per Day',
                        data: dayData,
                        backgroundColor: backgroundColors,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            new Chart(ctxWeek, {
                type: 'bar',
                data: {
                    labels: weekLabels,
                    datasets: [{
                        label: 'Reservations per Week',
                        data: weekData,
                        backgroundColor: backgroundColors,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            new Chart(ctxMonth, {
                type: 'bar',
                data: {
                    labels: monthLabels,
                    datasets: [{
                        label: 'Reservations per Month',
                        data: monthData,
                        backgroundColor: backgroundColors,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            new Chart(ctxYear, {
                type: 'bar',
                data: {
                    labels: yearLabels,
                    datasets: [{
                        label: 'Reservations per Year',
                        data: yearData,
                        backgroundColor: backgroundColors,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</x-admin-layout>
