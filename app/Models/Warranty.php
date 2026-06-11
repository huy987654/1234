<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Warranty extends Model
{
    use HasFactory;

    protected $table = 'warranties';

    // Không dùng auto-increment id vì là weak entity
    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = null; // composite key

    protected $fillable = [
        'warranty_no',
        'start_date',
        'end_date',
        'warranty_status',
        'description',
        'order_detail_id',
    ];

    /**
     * Lấy danh sách bảo hành kèm thông tin liên quan
     */
    public static function getAllWithDetails(string $keyword = '')
    {
        return DB::table('warranties')
            ->join('order_details', 'warranties.order_detail_id', '=', 'order_details.id')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('product_variants', 'order_details.product_variant_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->select(
                'warranties.*',
                'order_details.id as order_detail_id',
                'orders.id as order_id',
                'customers.customer_name',
                'customers.phone as customer_phone',
                'products.product_name',
                'product_variants.pv_color',
            )
            ->when($keyword !== '', function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('warranties.warranty_no', 'like', '%' . $keyword . '%')
                        ->orWhere('customers.customer_name', 'like', '%' . $keyword . '%')
                        ->orWhere('products.product_name', 'like', '%' . $keyword . '%')
                        ->orWhere('customers.phone', 'like', '%' . $keyword . '%');
                });
            })
            ->orderByDesc('warranties.start_date')
            ->get();
    }

    /**
     * Lấy chi tiết 1 bảo hành theo warranty_no + order_detail_id
     */
    public static function getDetail(string $warrantyNo, int $orderDetailId)
    {
        return DB::table('warranties')
            ->join('order_details', 'warranties.order_detail_id', '=', 'order_details.id')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('product_variants', 'order_details.product_variant_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->join('configurations', 'product_variants.configuration_id', '=', 'configurations.id')
            ->select(
                'warranties.*',
                'order_details.id as order_detail_id',
                'order_details.quantity',
                'order_details.unit_price',
                'orders.id as order_id',
                'orders.order_date',
                'orders.order_address',
                'customers.customer_name',
                'customers.phone as customer_phone',
                'customers.email as customer_email',
                'products.product_name',
                'product_variants.pv_color',
                'configurations.storage',
                'configurations.ram',
            )
            ->where('warranties.warranty_no', $warrantyNo)
            ->where('warranties.order_detail_id', $orderDetailId)
            ->first();
    }

    /**
     * Tự động tạo warranty cho tất cả order_details của 1 đơn hàng
     */
    public static function createForOrder(int $orderId): void
    {
        $details = DB::table('order_details')
            ->where('order_id', $orderId)
            ->get();

        foreach ($details as $detail) {
            // Kiểm tra đã tạo chưa (tránh duplicate)
            $exists = DB::table('warranties')
                ->where('order_detail_id', $detail->id)
                ->exists();

            if (!$exists) {
                $warrantyNo = 'WR-' . $orderId . '-' . $detail->id;
                $startDate = now();
                $endDate = now()->addMonths(12);

                DB::table('warranties')->insert([
                    'warranty_no'      => $warrantyNo,
                    'start_date'       => $startDate,
                    'end_date'         => $endDate,
                    'warranty_status'  => 'Còn bảo hành',
                    'description'      => 'Bảo hành 12 tháng từ ngày mua hàng.',
                    'order_detail_id'  => $detail->id,
                ]);
            }
        }
    }
}
