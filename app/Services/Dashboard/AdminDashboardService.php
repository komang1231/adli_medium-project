<?php

namespace App\Services\Dashboard;

use App\Models\Menu;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;



class AdminDashboardService extends BaseDashboardService
{
    public function getCards(): array
    {
        return [

            [
                'title' => 'Total Menu',
                'value' => number_format(Menu::count()),
                'col' => 'col-lg-3 col-md-6',
            ],

            [
                'title' => 'Total Transaksi',
                'value' => number_format(Transaksi::count()),
                'col' => 'col-lg-3 col-md-6',
            ],

            [
                'title' => 'Total User',
                'value' => number_format(User::count()),
                'col' => 'col-lg-3 col-md-6',
            ],

            [
                'title' => 'Total Pendapatan',
                'value' => 'Rp ' . number_format(Transaksi::sum('grand_total'), 0, ',', '.'),
                'col' => 'col-lg-3 col-md-6',
            ],

        ];
    }

    protected function baseQuery(): Builder
    {
        return Transaksi::query();
    }

    
}
