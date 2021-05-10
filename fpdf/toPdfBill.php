<?php
/*call the FPDF library*/
require('rotation.php');
class PDF extends PDF_Rotate
{
	function Header()
	{
		/* Put the watermark */
		$this->SetFont('Arial','B',30);
		$this->SetTextColor(224,224,224);
		$this->RotatedText(38,230,'Kerala State Electricity Monthly Bill',45);

	}

	function RotatedText($x, $y, $txt, $angle)
	{
		/* Text rotated around its origin */
		$this->Rotate($angle,$x,$y);
		$this->Text($x,$y,$txt);
		$this->Rotate(0);
	}
}
	
include '../connection.php';
$phno=$_GET['phno'];
$conno=$_GET['conno'];
$sql="select * from tb_bill where consumerno='".$conno."' and phno='".$phno."'";

  $result = mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($result))
  {
   		   $billdate = $row['billdate'];
		   $duedate = $row['duedate'];
		   $dcdate = $row['dcdate'];
		   $init = $row['initialread'];
		   $final = $row['finalread'];
		   $units = $row['unitsused'];
		   $fixedcharge = $row['fixedcharge'];
		   $energycharge = $row['energycharge'];
		   $totalamt = $row['total'];
		   $status = $row['status'];
  }

$pdf=new PDF();
$pdf->AddPage();


$pdf->SetXY(50,20);
$pdf->SetDrawColor(50,60,100);
$pdf->Image('kseblogo.jpg',92,13,33);


$pdf->SetFont('Arial','B',24);
$pdf->Cell(120,62,'KSEBLive - Bill',0,0,'C');
$pdf->SetFont('Arial','B',18);

$pdf->SetXY(75,-240);
$pdf->SetFont('Arial','B',18);
$pdf->Write (5, "Monthly Charge Sheet");

$pdf->SetXY(64,-242);
$pdf->SetFont('Arial','B',18);
$pdf->Write (5, "_____________________________________________________");

//Date
$pdf->SetXY(20,-200);
$pdf->SetFont('Arial','B',12);
$pdf->Write (5, "Date : ");

$pdf->SetXY(40,-200);
$pdf->SetFont('Arial','',12);
$pdf->Write (5, date('d-m-yy'));



$pdf->SetXY(20,-190);
$pdf->SetFont('Arial','B',12);
$pdf->Write (5, "Consumer # : ");

$pdf->SetXY(50,-190);
$pdf->SetFont('Arial','',12);
$pdf->Write (5, $conno);


$pdf->SetXY(20,-180);
$pdf->SetFont('Arial','B',12);
$pdf->Write (5, "Phone # : ");

$pdf->SetXY(50,-180);
$pdf->SetFont('Arial','',12);
$pdf->Write (5, $phno);




$pdf->SetXY(20,-170);
$pdf->SetFont('Arial','B',12);
$pdf->Write (5, "Bill date : ");

$pdf->SetXY(50,-170);
$pdf->SetFont('Arial','',12);
$pdf->Write (5, $billdate);


$pdf->SetXY(20,-160);
$pdf->SetFont('Arial','B',12);
$pdf->Write (5, "Due Date : ");

$pdf->SetXY(50,-160);
$pdf->SetFont('Arial','',12);
$pdf->Write (5, $duedate);


$pdf->SetXY(20,-150);
$pdf->SetFont('Arial','B',12);
$pdf->Write (5, "DC Date : ");

$pdf->SetXY(45,-150);
$pdf->SetFont('Arial','',12);
$pdf->Write (5, $dcdate);


$pdf->SetXY(20,-140);
$pdf->SetFont('Arial','B',12);
$pdf->Write (5, "Initial Reading :");

$pdf->SetXY(59,-140);
$pdf->SetFont('Arial','',12);
$pdf->Write (5, $init);


$pdf->SetXY(20,-130);
$pdf->SetFont('Arial','B',12);
$pdf->Write (5, "Final Reading : ");

$pdf->SetXY(59,-130);
$pdf->SetFont('Arial','',12);
$pdf->Write (5, $final);


$pdf->SetXY(20,-120);
$pdf->SetFont('Arial','B',12);
$pdf->Write (5, "Units Used : ");

$pdf->SetXY(50,-120);
$pdf->SetFont('Arial','',12);
$pdf->Write (5, $units);


$pdf->SetXY(20,-110);
$pdf->SetFont('Arial','B',12);
$pdf->Write (5, "Fixed Charge : ");

$pdf->SetXY(55,-110);
$pdf->SetFont('Arial','',12);
$pdf->Write (5, $fixedcharge);


$pdf->SetXY(20,-100);
$pdf->SetFont('Arial','B',12);
$pdf->Write (5, "Energy Charge : ");

$pdf->SetXY(55,-100);
$pdf->SetFont('Arial','',12);
$pdf->Write (5, $energycharge);


$pdf->SetXY(20,-80);
$pdf->SetFont('Arial','B',20);
$pdf->Write (5, "Total Amount : ");

$pdf->SetXY(80,-80);
$pdf->SetFont('Arial','',20);
$pdf->Write (5, $totalamt.' INR');

$pdf->SetXY(64,-32);
$pdf->SetFont('Arial','B',18);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "_____________________________________________________");
$pdf->Output('I',$conno.'.pdf');

?>
        
