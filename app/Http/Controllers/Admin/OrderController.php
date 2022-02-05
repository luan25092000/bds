<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Bill;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.list', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $user = User::create([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 3
        ]);

        Bill::create([
            'order_id' => $id,
            'user_id' => $user->id
        ]);
        return redirect()->route('order.list')->with("success","Gửi hóa đơn thành công, vui lòng liên hệ khách hàng để kiểm tra");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->status = 1;
        $order->save();
        return redirect()->route('order.list')->with("success","Cập nhật thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->route('order.list')->with("success","Xóa thành công");
    }

    public function sendBill($id)
    {
        $order = Order::find($id);
        $email = $order->email;
        $user = User::where('email', $email)->first();
        if (!is_null($user)) {
            Bill::create([
                'order_id' => $id,
                'user_id' => $user->id
            ]);
            return redirect()->route('order.list')->with("success","Gửi hóa đơn thành công, vui lòng liên hệ khách hàng để kiểm tra");
        } else {
            return view('admin.orders.create-user', compact('id', 'email'));
        }
    }
}
