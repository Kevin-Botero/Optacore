<?php

require('./fpdf.php');

class PDF extends FPDF
{
   // Cabecera de página
   function Header()
   {
      include '../BD/conexion.php'; // Llamamos a la conexión a la base de datos

      $this->Image('../IMAGENES/logop.png', 165, 5, 40); // Logo
      $this->SetFont('Arial', 'B', 19); 
      $this->Cell(40); 
      $this->SetTextColor(0, 0, 0); 
      $this->Cell(110, 15, utf8_decode("OPTACORE"), 1, 1, 'C', 0); 
      $this->Ln(3);
      $this->SetTextColor(103); 

      /* Informacion adicional */
      $this->Cell(100);  
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono : 3005551122"), 0, 0, '', 0);
      $this->Ln(5);
      $this->Cell(100);  
      $this->Cell(85, 10, utf8_decode("Correo : info@gafasonline.com"), 0, 0, '', 0);
      $this->Ln(10); 

      /* Título */
      $this->SetTextColor(0, 95, 189);
      $this->Cell(50);
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE PRODUCTOS MÁS VENDIDOS"), 0, 1, 'C', 0);
      $this->Ln(7);

      /* Encabezado de tabla */
      $this->SetFillColor(125, 173, 221);
      $this->SetTextColor(0, 0, 0);
      $this->SetDrawColor(163, 163, 163);
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(15, 10, utf8_decode('N°'), 1, 0, 'C', 1);
      $this->Cell(70, 10, utf8_decode('NOMBRE'), 1, 0, 'C', 1);
      $this->Cell(35, 10, utf8_decode('PRECIO'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('CANTIDAD'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('TOTAL'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15);
      $this->SetFont('Arial', 'I', 8);
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
      $hoy = date('d/m/Y');
      $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C');
   }
}

include '../BD/conexion.php';

$consulta_ventas = $con->prepare("
    SELECT dv.ProductoID, p.NombreProducto, p.Precio, SUM(dv.Cantidad) as CantidadVendida, 
           SUM(dv.Cantidad * p.Precio) as TotalVendido
    FROM tbdetalle_vent dv
    JOIN productos p ON dv.ProductoID = p.ProductoID
    JOIN tbventas v ON dv.id = v.id
    WHERE v.Status_vent = 'Pendiente'
    GROUP BY dv.ProductoID, p.NombreProducto, p.Precio
    ORDER BY CantidadVendida DESC
");
$consulta_ventas->execute();
$resultado_ventas = $consulta_ventas->get_result();

$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163);

while ($venta = $resultado_ventas->fetch_assoc()) {
    $i++;
    $pdf->Cell(15, 10, utf8_decode($i), 1, 0, 'C', 0);
    $pdf->Cell(70, 10, utf8_decode($venta['NombreProducto']), 1, 0, 'C', 0);
    $pdf->Cell(35, 10, utf8_decode(number_format($venta['Precio'], 2, ",", ".")), 1, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode($venta['CantidadVendida']), 1, 0, 'C', 0);
    $pdf->Cell(40, 10, utf8_decode(number_format($venta['TotalVendido'], 2, ",", ".")), 1, 1, 'C', 0);
}

$pdf->Output('Reporte_Productos_Mas_Vendidos.pdf', 'I');
?>
