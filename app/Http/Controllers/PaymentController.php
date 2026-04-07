<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use Illuminate\Support\Facades\Redirect;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
            //Tao đối tượng của model
            $objPayment = new Payment();
            //Gọi đến function để lấy dữ liệu trong model
            $payments = $objPayment->index();
            //Gui len view
            return view('payments.index', [
                'payments' => $payments
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('payments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        //
        //Tạo đối tượng model
        $obj = new Payment();
        //Lấy dữ liệu từ form
        $obj->name = $request->name;
        //Gọi function lưu dữ liệu trong model
        $obj->createPayment();
        //Quay về danh sách
        return Redirect::route('payments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
        //Gọi view hiển thị form sửa
        return view('payments.edit', [
            'payment' => $payment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        //
        //Lấy dữ liệu
        $payment->name = $request->name;
        //Gọi function để update dữ liệu trong model
        $payment->updatePayment();
        //Quay về danh sách
        return Redirect::route('payments.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
        //Gọi function để xóa bản ghi trong db
        $payment->deletePayment();
        //Quay về danh sách
        return Redirect::route('payments.index');
    }
}
