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
		$this->RotatedText(38,230,'Kerala State Electricity Payment Successfull',45);

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
$key=$_GET['t'];

$sql="select * from tb_addsupplyrequest where supkey='".$key."'"; 

  $result = mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($result))
  {
		   $supname = $row['supname'];
		   $purpose = $row['suppurpose'];
		   $supdate = $row['supdate'];
		   $section = $row['supsection'];
		   $conno = $row['supconno'];
		   $phno = $row['supphno'];
		   $total = $row['total'];
  }

$pdf=new PDF();
$pdf->AddPage();


$pdf->SetXY(50,20);
$pdf->SetDrawColor(50,60,100);
$pdf->Image('kseblogo.jpg',92,13,33);


$pdf->SetFont('Arial','B',24);
$pdf->Cell(120,62,'KSEBLive - Additional Supply',0,0,'C');
$pdf->SetFont('Arial','B',18);

$pdf->SetXY(64,-240);
$pdf->SetFont('Arial','B',18);
$pdf->Write (5, "Additional Supply Payment Slip");

$pdf->SetXY(64,-242);
$pdf->SetFont('Arial','B',18);
$pdf->Write (5, "_____________________________________________________");




$pdf->SetXY(20,-200);
$pdf->SetFont('Arial','B',12);
$pdf->Write (5, "Date : ");

$pdf->SetXY(35,-200);
$pdf->SetFont('Arial','',12);
$pdf->Write (5, date('d-m-yy'));

$pdf->SetXY(20,-190);
$pdf->SetFont('Arial','B',12);
$pdf->Write (5, "Name : ");

$pdf->SetXY(40,-190);
$pdf->SetFont('Arial','',12);
$pdf->Write (5, $supname);

$pdf->SetXY(20,-180);
$pdf->SetFont('Arial','B',12);
$pdf->Write (5, "Consumer # : ");

$pdf->SetXY(50,-180);
$pdf->SetFont('Arial','',12);
$pdf->Write (5, $conno);


$pdf->SetXY(20,-170);
$pdf->SetFont('Arial','B',12);
$pdf->Write (5, "Phone # : ");

$pdf->SetXY(45,-170);
$pdf->SetFont('Arial','',12);
$pdf->Write (5, $phno);

$pdf->SetXY(20,-160);
$pdf->SetFont('Arial','B',12);
$pdf->Write (5, "Purpose : ");

$pdf->SetXY(45,-160);
$pdf->SetFont('Arial','',12);
$pdf->Write (5, $purpose);


$pdf->SetXY(20,-150);
$pdf->SetFont('Arial','B',12);
$pdf->Write (5, "Request Date : ");

$pdf->SetXY(55,-150);
$pdf->SetFont('Arial','',12);
$pdf->Write (5, $supdate);


$pdf->SetXY(20,-140);
$pdf->SetFont('Arial','B',12);
$pdf->Write (5, "Section :");

$pdf->SetXY(45,-140);
$pdf->SetFont('Arial','',12);
$pdf->Write (5, $section);


$pdf->SetXY(20,-105);
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0,0,255);
$pdf->Write (5, "Amount : ".$total." INR [Paid]");

$pdf->SetXY(20,-95);
$pdf->SetFont('Arial','B',17);
$pdf->SetTextColor(0,0,255);
$pdf->Write (5, "Request Approved");

$pdf->Image('success.png',90,182,33);

$pdf->SetXY(64,-32);
$pdf->SetFont('Arial','B',18);
$pdf->SetTextColor(0,0,0);
$pdf->Write (5, "_____________________________________________________");
$pdf->Output('I',$conno.'.pdf');

?>
        
