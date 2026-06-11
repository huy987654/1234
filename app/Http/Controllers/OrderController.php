<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Warranty;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function adminIndex(Request $request)
    {
        $keyword = trim((string) $request->get('q', ''));

        $orders = DB::table('orders')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('payments', 'orders.payment_id', '=', 'payments.id')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->select(
                'orders.*',
                'customers.customer_name',
                'customers.email',
                'customers.phone',
                'payments.method',
                'statuses.status_name'
            )
            ->when($keyword !== '', function ($query) use ($keyword) {
                $query->where(function ($subQuery) use ($keyword) {
                    $subQuery->where('orders.id', $keyword)
                        ->orWhere('orders.receiver_name', 'like', '%' . $keyword . '%')
                        ->orWhere('orders.receiver_phone', 'like', '%' . $keyword . '%')
                        ->orWhere('customers.customer_name', 'like', '%' . $keyword . '%')
                        ->orWhere('customers.email', 'like', '%' . $keyword . '%')
                        ->orWhere('customers.phone', 'like', '%' . $keyword . '%');
                });
            })
            ->orderBy('orders.id', 'desc')
            ->get();

        return view('admin.orders.index', [
            'orders'  => $orders,
            'keyword' => $keyword,
        ]);
    }

    public function adminShow(Order $order)
    {
        $orderInfo = DB::table('orders')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('payments', 'orders.payment_id', '=', 'payments.id')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->select(
                'orders.*',
                'customers.customer_name',
                'customers.email',
                'customers.phone',
                'payments.method',
                'statuses.status_name'
            )
            ->where('orders.id', $order->id)
            ->first();

        $details = $this->orderDetails($order->id);
        $statuses = DB::table('statuses')->orderBy('id')->get();

        // Lấy thông tin bảo hành của từng order_detail
        $warranties = DB::table('warranties')
            ->whereIn('order_detail_id', $details->pluck('id')->toArray())
            ->get()
            ->keyBy('order_detail_id');

        return view('admin.orders.show', [
            'order'      => $orderInfo,
            'details'    => $details,
            'statuses'   => $statuses,
            'warranties' => $warranties,
        ]);
    }

    public function adminUpdateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status_id' => 'required|exists:statuses,id',
        ]);

        $newStatusName = DB::table('statuses')
            ->where('id', $request->status_id)
            ->value('status_name');

        DB::table('orders')
            ->where('id', $order->id)
            ->update(['status_id' => $request->status_id]);

        // Tự động tạo bảo hành khi đơn hàng Hoàn thành
        if ($newStatusName === 'Hoan thanh') {
            Warranty::createForOrder($order->id);
        }

        return Redirect::route('admin.orders.show', $order->id)
            ->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
    }

    public function checkout()
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return Redirect::route('customer.login')->with('error', 'Vui long dang nhap de dat hang.');
        }

        $carts = Session::get('carts', []);

        if (count($carts) === 0) {
            return Redirect::route('carts.index');
        }

        return view('orders.checkout', [
            'carts'    => $carts,
            'customer' => $customer,
            'payments' => DB::table('payments')->orderBy('id')->get()
        ]);
    }

    public function placeOrder(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return Redirect::route('customer.login')->with('error', 'Vui long dang nhap de dat hang.');
        }

        $request->validate([
            'receiver_name'  => 'required|string|max:255',
            'receiver_phone' => 'required|string|max:20',
            'order_address'  => 'required|string|max:500',
            'payment_id'     => 'required|exists:payments,id',
        ]);

        $carts = Session::get('carts', []);

        if (count($carts) === 0) {
            return Redirect::route('carts.index');
        }

        foreach ($carts as $variantId => $item) {
            $stock = DB::table('product_variants')->where('id', $variantId)->value('pv_stock_qtt');

            if ($stock === null || (int) $item['quantity'] > (int) $stock) {
                return Redirect::route('carts.index')->with('error', 'Mot san pham trong gio hang khong du so luong ton kho.');
            }
        }

        $staffId  = DB::table('staffs')->value('id');
        $statusId = DB::table('statuses')->where('status_name', 'Cho xac nhan')->value('id')
            ?? DB::table('statuses')->value('id');

        if (!$staffId || !$statusId) {
            return Redirect::route('carts.index')->with('error', 'Chua co du lieu nhan vien hoac trang thai don hang.');
        }

        $total = 0;
        foreach ($carts as $item) {
            $total += (float) $item['price'] * (int) $item['quantity'];
        }

        $orderId = DB::transaction(function () use ($request, $customer, $staffId, $statusId, $total, $carts) {
            $orderId = DB::table('orders')->insertGetId([
                'order_date'     => now(),
                'total_amount'   => $total,
                'receiver_phone' => $request->receiver_phone,
                'receiver_name'  => $request->receiver_name,
                'order_address'  => $request->order_address,
                'payment_id'     => $request->payment_id,
                'customer_id'    => $customer->id,
                'staff_id'       => $staffId,
                'status_id'      => $statusId,
            ]);

            foreach ($carts as $variantId => $item) {
                DB::table('order_details')->insert([
                    'unit_price'         => (float) $item['price'],
                    'quantity'           => (int) $item['quantity'],
                    'order_id'           => $orderId,
                    'product_variant_id' => $variantId,
                ]);

                DB::table('product_variants')
                    ->where('id', $variantId)
                    ->update([
                        'pv_stock_qtt' => DB::raw('GREATEST(CAST(pv_stock_qtt AS SIGNED) - ' . (int) $item['quantity'] . ', 0)')
                    ]);
            }

            return $orderId;
        });

        Session::forget('carts');

        return Redirect::route('orders.show', $orderId)->with('success', 'Dat hang thanh cong.');
    }

    public function history()
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return Redirect::route('customer.login')->with('error', 'Vui long dang nhap de xem lich su mua hang.');
        }

        $orders = DB::table('orders')
            ->join('payments', 'orders.payment_id', '=', 'payments.id')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->select('orders.*', 'payments.method', 'statuses.status_name')
            ->where('orders.customer_id', $customer->id)
            ->orderBy('orders.id', 'desc')
            ->get();

        return view('orders.history', [
            'orders' => $orders
        ]);
    }

    public function show(Order $order)
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return Redirect::route('customer.login')->with('error', 'Vui long dang nhap de xem don hang.');
        }

        if ((int) $order->customer_id !== (int) $customer->id) {
            abort(403);
        }

        $orderInfo = DB::table('orders')
            ->join('payments', 'orders.payment_id', '=', 'payments.id')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->select('orders.*', 'payments.method', 'statuses.status_name')
            ->where('orders.id', $order->id)
            ->first();

        $details = $this->orderDetails($order->id);

        return view('orders.show', [
            'order'   => $orderInfo,
            'details' => $details
        ]);
    }

    public function cancel(Order $order)
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return Redirect::route('customer.login')->with('error', 'Vui long dang nhap de huy don hang.');
        }

        if ((int) $order->customer_id !== (int) $customer->id) {
            abort(403);
        }

        $currentStatus   = DB::table('statuses')->where('id', $order->status_id)->value('status_name');
        $canCancelStatuses = ['Cho xac nhan', 'Dang xu ly'];

        if (!in_array($currentStatus, $canCancelStatuses, true)) {
            return Redirect::route('orders.show', $order->id)
                ->with('error', 'Don hang nay khong the huy o trang thai hien tai.');
        }

        $cancelStatusId = DB::table('statuses')->where('status_name', 'Da huy')->value('id');

        if (!$cancelStatusId) {
            return Redirect::route('orders.show', $order->id)
                ->with('error', 'Chua co trang thai Da huy trong he thong.');
        }

        DB::transaction(function () use ($order, $cancelStatusId) {
            $details = DB::table('order_details')
                ->where('order_id', $order->id)
                ->get();

            foreach ($details as $detail) {
                DB::table('product_variants')
                    ->where('id', $detail->product_variant_id)
                    ->update([
                        'pv_stock_qtt' => DB::raw('CAST(pv_stock_qtt AS SIGNED) + ' . (int) $detail->quantity)
                    ]);
            }

            DB::table('orders')
                ->where('id', $order->id)
                ->update(['status_id' => $cancelStatusId]);
        });

        return Redirect::route('orders.show', $order->id)->with('success', 'Huy don hang thanh cong.');
    }

    private function orderDetails(int $orderId)
    {
        return DB::table('order_details')
            ->join('product_variants', 'order_details.product_variant_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->join('configurations', 'product_variants.configuration_id', '=', 'configurations.id')
            ->select(
                'order_details.*',
                'products.product_name',
                'product_variants.pv_color',
                'configurations.ram',
                'configurations.storage'
            )
            ->where('order_details.order_id', $orderId)
            ->get();
    }
}
