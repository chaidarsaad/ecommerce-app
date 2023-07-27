<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $customer = User::where('roles', 'USER')->count();
        $category = Category::count();
        $product = Product::count();
        $revenue = Transaction::sum('total_price');
        $completed_orders = Transaction::where('payment_status', 'PENDING')->count();
        $pending_orders = Transaction::where('payment_status', 'SUCCESS')->count();
        return view('pages.admin.dashboard', [
            'customer' => $customer,
            'category' => $category,
            'product' => $product,
            'revenue' => $revenue,
            'completed_orders' => $completed_orders,
            'pending_orders' => $pending_orders
        ]);
    }
}