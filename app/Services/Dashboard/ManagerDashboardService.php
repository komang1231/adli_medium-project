<?php

namespace App\Services\Dashboard;

use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;


class ManagerDashboardService extends BaseDashboardService
{
    public function getCards(): array
    {
        $teamIds = User::where('created_by', Auth::id())
            ->pluck('id')
            ->push(Auth::id());

        return [

            [
                'title' => 'Total Staff Dibuat',
                'value' => number_format(
                    User::where('created_by', Auth::id())
                        ->where('role', 'Staff')
                        ->count()
                ),
                'col' => 'col-lg-6',
            ],

            [
                'title' => 'Total Transaksi Tim',
                'value' => number_format(
                    Transaksi::whereIn('user_id', $teamIds)->count()
                ),
                'col' => 'col-lg-6',
            ],

        ];
    }

    protected function baseQuery(): Builder
    {
        $teamIds = User::where('created_by', auth()->id())
            ->pluck('id')
            ->push(auth()->id());

        return Transaksi::whereIn('user_id', $teamIds);
    }

    
}
