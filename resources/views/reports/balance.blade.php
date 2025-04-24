<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <style>
    body { font-family: DejaVu Sans, sans-serif; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 1em; }
    th, td { border: 1px solid #333; padding: 0.25em; text-align: left; }
    th { background: #eee; }
  </style>
</head>
<body>
  <h2>Reporte de Balance</h2>
  <p>Fecha: {{ now()->format('d/m/Y H:i') }}</p>
  <h3>Ingresos</h3>
  <table>
    <thead><tr><th>ID</th><th>Tipo</th><th>Monto</th><th>Factura</th><th>Fecha</th></tr></thead>
    <tbody>
      @foreach($incomes as $i)
        <tr>
          <td>{{ $i->id }}</td>
          <td>{{ $i->category->name }}</td>
          <td>{{ number_format($i->amount,2) }}</td>
          <td>{{ $i->invoice }}</td>
          <td>{{ $i->date }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <h3>Gastos</h3>
  <table>
    <thead><tr><th>ID</th><th>Tipo</th><th>Monto</th><th>Factura</th><th>Fecha</th></tr></thead>
    <tbody>
      @foreach($expenses as $e)
        <tr>
          <td>{{ $e->id }}</td>
          <td>{{ $e->category->name }}</td>
          <td>{{ number_format($e->amount,2) }}</td>
          <td>{{ $e->invoice }}</td>
          <td>{{ $e->date }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <h3>Resumen</h3>
  <p><strong>Total Ingresos:</strong> ${{ number_format($totalIn,2) }}</p>
  <p><strong>Total Gastos:</strong> ${{ number_format($totalOut,2) }}</p>
  <p><strong>Balance:</strong> ${{ number_format($balance,2) }}</p>
</body>
</html>
