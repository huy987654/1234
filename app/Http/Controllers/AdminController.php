<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $now = Carbon::now();
        $completedStatusId = DB::table('statuses')->where('status_name', 'Hoan thanh')->value('id');

        $completedOrdersQuery = DB::table('orders');
        if ($completedStatusId) {
            $completedOrdersQuery->where('status_id', $completedStatusId);
        }

        $revenueToday = (clone $completedOrdersQuery)
            ->whereDate('order_date', $now->toDateString())
            ->sum('total_amount');
        $revenueThisMonth = (clone $completedOrdersQuery)
            ->whereYear('order_date', $now->year)
            ->whereMonth('order_date', $now->month)
            ->sum('total_amount');
        $revenueThisYear = (clone $completedOrdersQuery)
            ->whereYear('order_date', $now->year)
            ->sum('total_amount');

        $dailyRows = (clone $completedOrdersQuery)
            ->selectRaw('DAY(order_date) as day_number, SUM(total_amount) as revenue, COUNT(*) as order_count')
            ->whereYear('order_date', $now->year)
            ->whereMonth('order_date', $now->month)
            ->groupByRaw('DAY(order_date)')
            ->pluck('revenue', 'day_number');

        $dailyRevenue = [];
        for ($day = 1; $day <= $now->daysInMonth; $day++) {
            $dailyRevenue[] = [
                'label' => str_pad((string) $day, 2, '0', STR_PAD_LEFT),
                'value' => (float) ($dailyRows[$day] ?? 0),
            ];
        }

        $monthlyRows = (clone $completedOrdersQuery)
            ->selectRaw('MONTH(order_date) as month_number, SUM(total_amount) as revenue, COUNT(*) as order_count')
            ->whereYear('order_date', $now->year)
            ->groupByRaw('MONTH(order_date)')
            ->pluck('revenue', 'month_number');

        $monthlyRevenue = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlyRevenue[] = [
                'label' => 'T' . $month,
                'value' => (float) ($monthlyRows[$month] ?? 0),
            ];
        }

        return view('admin.dashboard', [
            'productCount' => DB::table('products')->count(),
            'customerCount' => DB::table('customers')->count(),
            'orderCount' => DB::table('orders')->count(),
            'pendingOrderCount' => DB::table('orders')
                ->join('statuses', 'orders.status_id', '=', 'statuses.id')
                ->whereIn('statuses.status_name', ['Cho xac nhan', 'Dang xu ly'])
                ->count(),
            'revenueToday' => $revenueToday,
            'revenueThisMonth' => $revenueThisMonth,
            'revenueThisYear' => $revenueThisYear,
            'dailyRevenue' => $dailyRevenue,
            'monthlyRevenue' => $monthlyRevenue,
            'currentMonth' => $now->month,
            'currentYear' => $now->year,
        ]);
    }

    public function users()
    {
        return view('admin.users');
    }


}
