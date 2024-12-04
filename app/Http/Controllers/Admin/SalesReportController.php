<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{

    private function calculateTotalSales($orders)
    {
        return $orders->where('status_id',3)->sum('final_total');
    }

    private function calculateStatusBreakdown($orders)
    {
        return $orders->groupBy('status.name')->map->count();
    }

    private function calculateDailySales($orders)
    {
        return $orders->where('status_id',3)->groupBy('order_date')->map->sum('final_total')->take(30);
    }


    private function calculateTopCustomers($orders)
    {
        return $orders->where('status_id', 3)
            ->filter(function ($order) {
                return $order->user_id !== null;
            })
            ->groupBy('user_id')->map(function ($orders) {
            $user = $orders->first()->user;
            return [
                'name' => $user->name?? "unknown-user",
                'total_spent' => $orders->sum('final_total'),
                'order_count' => $orders->count(),
            ];
        })->sortByDesc('total_spent')->take(10);
    }

    public function salesReport()
    {
        $orders = Order::with(['user', 'status', 'orderDetails.accessory'])
            ->select('id', 'final_total', 'user_id', 'status_id',
                DB::raw('DATE(created_at) as order_date'))
            ->orderBy('created_at', 'desc')
            ->get();

        $report = [
            'total_sales' => $this->calculateTotalSales($orders),
            'total_orders' => $orders->count(),
            'completed_orders' => $orders->where('status_id',3)->count(),
            'status_breakdown' => $this->calculateStatusBreakdown($orders),
            'daily_sales' => $this->calculateDailySales($orders),
            'top_customers' => $this->calculateTopCustomers($orders),
        ];

        return view('admin.reports.sales_report', compact('report'));
    }



}
