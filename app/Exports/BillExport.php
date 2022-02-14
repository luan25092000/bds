<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Bill;

class BillExport implements FromCollection,WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

   /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $startDate = $this->data['start_date'];
        $endDate = $this->data['end_date'];
        $bills = Bill::whereBetween('updated_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])->get();
        foreach ($bills as $bill) {
            $bill['name'] = User::find($bill->user_id)->name;
            $bill['phone'] = Order::onlyTrashed()->where('email', User::find($bill->user_id)->email)->first()->phone;
            $bill['product'] = Product::find(Order::onlyTrashed()->find(Bill::find($bill->id)->order_id)->product_id)->name;
            $bill['price'] = number_format(Product::find(Order::onlyTrashed()->find(Bill::find($bill->id)->order_id)->product_id)->room_price + Product::find(Order::onlyTrashed()->find(Bill::find($bill->id)->order_id)->product_id)->electricity_price + Product::find(Order::onlyTrashed()->find(Bill::find($bill->id)->order_id)->product_id)->water_price,-3,',',',') . '₫';
            $bill['month'] = date('m', strtotime($bill->created_at));
            $bill['stt'] = $bill->status == 0 ? 'Chưa thanh toán' : 'Đã thanh toán';
            $bill['update_date'] = date('d/m/Y H:i:s',strtotime($bill->updated_at));
            unset($bill['id'], $bill['order_id'], $bill['user_id'], $bill['created_at'], $bill['updated_at'], $bill['status']);
        }
        return $bills;
    }

    public function headings():array
    {
        return [
            'Khách hàng',
            'Số điện thoại',
            'Sản phẩm',
            'Tiền cần phải trả (thuê hằng tháng + điện + nước)',
            'Tháng',
            'Trạng thái',
            'Thời gian cập nhật'
        ];
    }
}
