<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bill;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BillExport;

class DashboardController extends Controller
{
    public function index() 
    {
        return view('admin.dashboard.index');
    }

    public function fillterBill(Request $request)
    {
       $startDate = $request->start_date;
       $endDate = $request->end_date;
       $bills = Bill::whereBetween('updated_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])->get();
       return view('admin.dashboard.index', compact('bills'));
    }

    public function exportExcel()
    {
        $url = url()->previous();
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);
        return Excel::download(new BillExport($params), 'bills.xlsx');
    }
}
