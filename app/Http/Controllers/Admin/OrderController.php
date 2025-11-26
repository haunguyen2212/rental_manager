<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class OrderController extends Controller
{
    /**
     * Đơn hàng chờ xử lí.
     */
    public function pending()
    {
        // Fake data demo
        $data = collect([
            (object)[
                'id' => 1,
                'code' => 'DH0001',
                'customer_name' => 'Nguyễn Văn A',
                'customer_phone' => '0901 111 222',
                'created_at' => now()->subMinutes(10),
                'total_amount' => 1500000,
            ],
            (object)[
                'id' => 2,
                'code' => 'DH0002',
                'customer_name' => 'Trần Thị B',
                'customer_phone' => '0902 333 444',
                'created_at' => now()->subHours(2),
                'total_amount' => 2500000,
            ],
            (object)[
                'id' => 3,
                'code' => 'DH0003',
                'customer_name' => 'Lê Văn C',
                'customer_phone' => '0903 555 666',
                'created_at' => now()->subDays(1),
                'total_amount' => 3800000,
            ],
        ]);

        $collection = new Collection($data);
        $perPage = 10;
        $currentPage = request()->input('page', 1);

        $orders = new LengthAwarePaginator(
            $collection->forPage($currentPage, $perPage)->values(),
            $collection->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        return view('admin.order.pending', compact('orders'));
    }
}


