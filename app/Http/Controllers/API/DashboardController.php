<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Calculate Total Revenue (Assuming 'completed' or all statuses for now, we sum all total_amount)
        $totalRevenue = Order::sum('total_amount');
        
        // Total Orders Count
        $totalOrders = Order::count();
        
        // Active Users Count
        $activeUsers = User::count();
        
        // Calculate Revenue Growth (compare current month vs previous month)
        $currentMonthRevenue = Order::whereMonth('created_at', Carbon::now()->month)->sum('total_amount');
        $lastMonthRevenue = Order::whereMonth('created_at', Carbon::now()->subMonth()->month)->sum('total_amount');
        
        $revenueGrowth = 0;
        if ($lastMonthRevenue > 0) {
            $revenueGrowth = (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100;
        } elseif ($currentMonthRevenue > 0) {
            $revenueGrowth = 100;
        }

        // Calculate Order growth
        $currentMonthOrders = Order::whereMonth('created_at', Carbon::now()->month)->count();
        $lastMonthOrders = Order::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $ordersGrowth = 0;
        if ($lastMonthOrders > 0) {
            $ordersGrowth = (($currentMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100;
        } elseif ($currentMonthOrders > 0) {
            $ordersGrowth = 100;
        }

        // Calculate User growth
        $currentMonthUsers = User::whereMonth('created_at', Carbon::now()->month)->count();
        $lastMonthUsers = User::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $usersGrowth = 0;
        if ($lastMonthUsers > 0) {
            $usersGrowth = (($currentMonthUsers - $lastMonthUsers) / $lastMonthUsers) * 100;
        } elseif ($currentMonthUsers > 0) {
            $usersGrowth = 100;
        }

        // Generate Chart Data: Rolling 7 days (including today)
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dayName = $date->format('D');
            $dateString = $date->toDateString();
            
            $sales = Order::whereDate('created_at', $dateString)->sum('total_amount');
            $orders = Order::whereDate('created_at', $dateString)->count();

            $chartData[] = [
                'name' => $dayName,
                'sales' => (float) $sales,
                'orders' => $orders
            ];
        }

        return response()->json([
            'success' => true,
            'data' => [
                'totalRevenue' => round($totalRevenue, 2),
                'totalOrders' => $totalOrders,
                'activeUsers' => $activeUsers,
                'revenueGrowth' => round($revenueGrowth, 1),
                'ordersGrowth' => round($ordersGrowth, 1),
                'usersGrowth' => round($usersGrowth, 1),
                'chartData' => $chartData
            ]
        ]);
    }
}
