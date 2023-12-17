<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderedProduct;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardIndex()
    {

        #Monthly
        $all_orders = [];
        $monthly_total_sale = null;
        $monthly_all_order_costing = null;
        $monthly_profit_loss = null;
        $monthly_canceled_order = 0;
        $monthNumber = now()->month;
        $currentYear = now()->year;
        $start_date = \Carbon\Carbon::create($currentYear, $monthNumber, 1)->startOfMonth();
        $end_date = \Carbon\Carbon::create($currentYear, $monthNumber, 1)->endOfMonth();
        $all_orders = Order::where([
            ['payment_status', '=', 'Succeeded'],
            ['created_at', '>=', $start_date],
            ['created_at', '<=', $end_date]
        ])->get();
        $monthly_total_sale = null;
        foreach ($all_orders as $order) {
            #For getting Total amount of sell
            $monthly_total_sale = $monthly_total_sale + (float)$order->grand_total;
            $single_order[] = OrderedProduct::where([['order_id', '=', $order->id]])->get();
            $monthly_all_order_costing = 0;
            foreach ($single_order as $singles) {
                $single_cost = 0;
                foreach ($singles as $single) {
                    $single_cost = $single_cost + $single->cost_price;
                }
                $monthly_all_order_costing = $monthly_all_order_costing + $single_cost;
            }
            #cancel-orders
            if ($order->order_status === 'canceled') {
                $monthly_canceled_order++;
            }
            #returned-orders
            // if ($order->order_status === 'canceled') {
            //     $monthly_canceled_order++;
            // }
        }
        $monthly_profit_loss = null;
        $monthly_profit_loss = $monthly_total_sale - $monthly_all_order_costing;


        #Yearly
        $yearly_orders = [];
        $yearly_total_sale = null;
        $yearly_all_order_costing = null;
        $yearly_profit_loss = null;
        $yearly_canceled_order = 0;
        $end_date=null;
        $start_date=null;
        $single_order=[];


        $selectedYear=null;
        $selectedYear = now()->year;
        $start_date = \Carbon\Carbon::create($selectedYear, 1, 1)->startOfYear();
        $end_date = \Carbon\Carbon::create($selectedYear, 12, 31)->endOfYear();
        $yearly_orders = Order::where([
            ['payment_status', '=', 'Succeeded'],
            ['created_at', '>=', $start_date],
            ['created_at', '<=', $end_date]
        ])->get();
        $yearly_total_sale = null;
        foreach ($yearly_orders as $order) {
            #For getting Total amount of sell
            $yearly_total_sale = $yearly_total_sale + (float)$order->grand_total;
            $single_order[] = OrderedProduct::where([['order_id', '=', $order->id]])->get();
            $yearly_all_order_costing = 0;
            foreach ($single_order as $singles) {
                $single_cost = 0;
                foreach ($singles as $single) {
                    $single_cost = $single_cost + $single->cost_price;
                }
                $yearly_all_order_costing = $yearly_all_order_costing + $single_cost;
            }
            #cancel-orders
            if ($order->order_status === 'canceled') {
                $yearly_canceled_order++;
            }
            #returned-orders
            // if ($order->order_status === 'canceled') {
            //     $monthly_canceled_order++;
            // }
        }
        $yearly_profit_loss = null;
        $yearly_profit_loss = $yearly_total_sale - $yearly_all_order_costing;

        $recent_orders = Order::where('order_status', 'pending')->get()->sortByDesc('id');

        return view('backend.layouts.admin_dashboard', compact('recent_orders','yearly_canceled_order','yearly_profit_loss','yearly_total_sale','yearly_all_order_costing','monthly_canceled_order', 'monthly_all_order_costing', 'monthly_profit_loss', 'monthly_total_sale'));
    }
}
