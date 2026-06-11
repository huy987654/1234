<?php

namespace App\Http\Controllers;

use App\Models\Warranty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class WarrantyController extends Controller
{
    /**
     * Danh sách bảo hành
     */
    public function index()
    {
        $keyword = trim(request('q', ''));
        $warranties = Warranty::getAllWithDetails($keyword);

        return view('warranties.index', [
            'warranties' => $warranties,
            'keyword'    => $keyword,
        ]);
    }

    /**
     * Chi tiết bảo hành
     */
    public function show(string $warrantyNo, int $orderDetailId)
    {
        $warranty = Warranty::getDetail($warrantyNo, $orderDetailId);

        if (!$warranty) {
            abort(404);
        }

        return view('warranties.show', [
            'warranty' => $warranty,
        ]);
    }

    /**
     * Cập nhật trạng thái bảo hành
     */
    public function update(Request $request, string $warrantyNo, int $orderDetailId)
    {
        $request->validate([
            'warranty_status' => 'required|in:Còn bảo hành,Hết bảo hành,Đang xử lý',
            'description'     => 'nullable|string|max:500',
        ]);

        DB::table('warranties')
            ->where('warranty_no', $warrantyNo)
            ->where('order_detail_id', $orderDetailId)
            ->update([
                'warranty_status' => $request->warranty_status,
                'description'     => $request->description,
            ]);

        return Redirect::route('warranties.show', [$warrantyNo, $orderDetailId])
            ->with('success', 'Cập nhật bảo hành thành công.');
    }
}
