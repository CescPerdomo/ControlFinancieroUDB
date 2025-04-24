<<?php



use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

// 1) Login (sin persistir sesión real)
Route::match(['get','post'],'/login', function(Request $req){
    if ($req->isMethod('post')) {
        // podrías validar aquí, pero solo redirigimos:
        return redirect()->route('dashboard');
    }
    return view('auth.login');
})->name('login');

// 2) Dashboard
Route::get('/', function(){
    $totalEntradas = DB::table('entradas')->sum('monto');
    $totalGastos   = DB::table('gastos')->sum('monto');
    $balance       = $totalEntradas - $totalGastos;
    return view('dashboard', compact('totalEntradas','totalGastos','balance'));
})->name('dashboard');

// 3) Entradas
Route::get('/entradas', function(){
    $entradas = DB::table('entradas')->orderBy('fecha','desc')->get();
    return view('entradas.index', compact('entradas'));
})->name('entradas.index');

Route::match(['get','post'],'/entradas/create', function(Request $req){
    if ($req->isMethod('post')) {
        $data = $req->validate([
            'categoria_id'=>'required|integer',
            'monto'=>'required|numeric',
            'factura'=>'nullable|string',
            'fecha'=>'required|date',
        ]);
        DB::table('entradas')->insert($data);
        return redirect()->route('entradas.index');
    }
    $categorias = DB::table('categorias')
                    ->where('tipo','entrada')
                    ->pluck('nombre','id');
    return view('entradas.create', compact('categorias'));
})->name('entradas.create');

// 4) Gastos (idéntico a Entradas, cambiando tabla y tipo)
Route::get('/gastos', function(){
    $gastos = DB::table('gastos')->orderBy('fecha','desc')->get();
    return view('gastos.index', compact('gastos'));
})->name('gastos.index');

Route::match(['get','post'],'/gastos/create', function(Request $req){
    if ($req->isMethod('post')) {
        $data = $req->validate([
            'categoria_id'=>'required|integer',
            'monto'=>'required|numeric',
            'factura'=>'nullable|string',
            'fecha'=>'required|date',
        ]);
        DB::table('gastos')->insert($data);
        return redirect()->route('gastos.index');
    }
    $categorias = DB::table('categorias')
                    ->where('tipo','gasto')
                    ->pluck('nombre','id');
    return view('gastos.create', compact('categorias'));
})->name('gastos.create');

// 5) Reporte a PDF
Route::get('/report/pdf', function(){
    $entradas = DB::table('entradas')->get();
    $gastos   = DB::table('gastos')->get();
    $totalEntradas = $entradas->sum('monto');
    $totalGastos   = $gastos->sum('monto');
    $balance       = $totalEntradas - $totalGastos;

    $pdf = PDF::loadView('reports.balance', compact(
        'entradas','gastos','totalEntradas','totalGastos','balance'
    ));
    return $pdf->download('reporte_balance_'.date('Ymd').'.pdf');
})->name('report.pdf');
