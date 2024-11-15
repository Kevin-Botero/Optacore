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

      /* Información adicional */
      $this->Cell(100);
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono : 3005551122"), 0, 0, '', 0);
      $this->Ln(5);
      $this->Cell(100);
      $this->Cell(85, 10, utf8_decode("Correo : info@gafasonline.com"), 0, 0, '', 0);
      $this->Ln(10);

      /* Título del reporte */
      $this->SetTextColor(0, 95, 189);
      $this->Cell(50);
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE DE CITAS CANCELADAS POR ESPECIALISTA"), 0, 1, 'C', 0);
      $this->Ln(7);

      /* Encabezado de la tabla */
      $this->SetFillColor(125, 173, 221); // Color de fondo
      $this->SetTextColor(0, 0, 0); // Color del texto
      $this->SetDrawColor(163, 163, 163); // Color del borde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(15, 10, utf8_decode('N°'), 1, 0, 'C', 1);
      $this->Cell(120, 10, utf8_decode('ESPECIALISTA'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('CITAS CANCELADAS'), 1, 1, 'C', 1);
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

$consulta_canceladas = $con->prepare("
    SELECT e.Nombre, COUNT(*) AS cantidad_canceladas
    FROM citas c
    JOIN especialistas e ON c.especialistaID = e.especialistaID
    WHERE c.EstadoCita = 'Cancelada'
    GROUP BY e.especialistaID
");
$consulta_canceladas->execute();
$resultado_canceladas = $consulta_canceladas->get_result();

$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163);

while ($fila = $resultado_canceladas->fetch_assoc()) {
    $i++;
    $pdf->Cell(15, 10, utf8_decode($i), 1, 0, 'C', 0);
    $pdf->Cell(120, 10, utf8_decode($fila['Nombre']), 1, 0, 'C', 0);
    $pdf->Cell(50, 10, utf8_decode($fila['cantidad_canceladas']), 1, 1, 'C', 0);
}

$pdf->Output('Reporte_Citas_Canceladas.pdf', 'I'); // Generar y visualizar el PDF
?>
