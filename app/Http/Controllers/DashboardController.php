<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\Dashboard\AdminDashboardService;
use App\Services\Dashboard\ManagerDashboardService;
use App\Services\Dashboard\StaffDashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return match ($user->role) {
            'Admin' => $this->admin(),
            'Manager' => $this->manager(),
            default => $this->staff(),
        };
    }

    private function admin()
    {
        $service = new AdminDashboardService();

        return view('dashboard.index', [
            'cards' => $service->getCards(),
            'role' => 'Admin',
        ]);
    }

    private function manager()
    {
        $service = new ManagerDashboardService();

        return view('dashboard.index', [
            'cards' => $service->getCards(),
            'role' => 'Manager',
        ]);
    }

    private function staff()
    {
        $service = new StaffDashboardService();

        return view('dashboard.index', [
            'cards' => $service->getCards(),
            'role' => 'Staff',
        ]);
    }

    public function dailyChart(Request $request)
    {
        $user = auth()->user();

        $service = match ($user->role) {
            'Admin' => new AdminDashboardService(),
            'Manager' => new ManagerDashboardService(),
            default => new StaffDashboardService(),
        };

        return response()->json(
            $service->getDailyChart($request->date)
        );
    }

    public function yearlyChart(Request $request)
    {
        $user = auth()->user();

        $service = match ($user->role) {
            'Admin' => new AdminDashboardService(),
            'Manager' => new ManagerDashboardService(),
            default => new StaffDashboardService(),
        };

        return response()->json(
            $service->getYearlyChart(
                $request->year,
                $request->view ?? 'Total'
            )
        );
    }
}
