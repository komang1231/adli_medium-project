<?php

namespace App\Services\Dashboard;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseDashboardService
{
    abstract protected function baseQuery(): Builder;

    public function getDailyChart($date): array
    {
        $date = Carbon::parse($date);

        $labels = [];
        $series = [];

        for ($hour = 8; $hour <= 18; $hour++) {

            $labels[] = sprintf('%02d', $hour);

            $series[] = (clone $this->baseQuery())
                ->whereDate('created_at', $date)
                ->whereRaw('HOUR(created_at) = ?', [$hour])
                ->count();
        }

        return [
            'labels' => $labels,
            'series' => $series,
        ];
    }

    public function getYearlyChart($year, $view = 'Total'): array
    {
        $labels = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des'
        ];

        if ($view === 'Detail') {

            // $total = [];
            $member = [];
            $nonMember = [];

            for ($month = 1; $month <= 12; $month++) {

                $query = (clone $this->baseQuery())
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month);

                // $total[] = (clone $query)->count();

                $member[] = (clone $query)
                    ->where('tipe_pelanggan', 'Member')
                    ->count();

                $nonMember[] = (clone $query)
                    ->where('tipe_pelanggan', 'Non-Member')
                    ->count();
            }

            return [
                'labels' => $labels,
                'series' => [
                    // [
                    //     'name' => 'Total',
                    //     'data' => $total
                    // ],
                    [
                        'name' => 'Member',
                        'data' => $member
                    ],
                    [
                        'name' => 'Non Member',
                        'data' => $nonMember
                    ]
                ]
            ];
        }

        $series = [];

        for ($month = 1; $month <= 12; $month++) {

            $series[] = (clone $this->baseQuery())
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();
        }

        return [
            'labels' => $labels,
            'series' => [
                [
                    'name' => 'Total',
                    'data' => $series
                ]
            ]
        ];
    }
}
