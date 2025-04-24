<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Expense;
use PDF; // alias de Dompdf

class ReportController extends Controller
{
    public function exportPdf()
    {
        $incomes  = Income::all();
        $expenses = Expense::all();
        $totalIn  = $incomes->sum('amount');
        $totalOut = $expenses->sum('amount');
        $balance  = $totalIn - $totalOut;

        $pdf = PDF::loadView('reports.balance', compact(
            'incomes','expenses','totalIn','totalOut','balance'
        ));

        return $pdf->download('reporte_balance_'.date('Ymd').'.pdf');
    }
}
