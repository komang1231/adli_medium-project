<?php

namespace App\Services\Dashboard;

use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class StaffDashboardService extends BaseDashboardService
{
    public function getCards(): array
    {
        return [

            [
                'title' => 'Total Transaksi Ditangani',
                'value' => number_format(
                    Transaksi::where('user_id', Auth::id())->count()
                ),
                'col' => 'col-lg-12',
            ],

        ];
    }

    protected function baseQuery(): Builder
    {
        return Transaksi::where('user_id', auth()->id());
    }
}
