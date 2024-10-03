<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\CustomersExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function customers(Request $request)
    {
        $data_quantity = [5, 10, 50, 100];

        $customers = Service::with(['users', 'menu'])
            ->filter($request->only(['search', 'date', 'lokasi']))
            ->paginate($request->get('data_quantity', 5))
            ->withQueryString();

        return view('auth.admin.customers.customers', [
            'customers' => $customers,
            'data_quantity' => $data_quantity
        ]);
    }

    // excel export service
    // public function exportDataInExcel(Request $request)
    // {
    //     if ($request->type == 'xlsx') {

    //         $fileExt = 'xl`sx';
    //         $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
    //     } elseif ($request->type == 'csv') {

    //         $fileExt = 'csv';
    //         $exportFormat = \Maatwebsite\Excel\Excel::CSV;
    //     } elseif ($request->type == 'xls') {

    //         $fileExt = 'xls';
    //         $exportFormat = \Maatwebsite\Excel\Excel::XLS;
    //     } else {

    //         $fileExt = 'xlsx';
    //         $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
    //     }


    //     $filename = "customers-" . date('d-m-Y') . "." . $fileExt;
    //     return Excel::download(new CustomersExport, $filename, $exportFormat);
    // }
}
