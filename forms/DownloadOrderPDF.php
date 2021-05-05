<?php
require('../fpdf/fpdf.php');
include_once '../classes/Order.php';
include_once '../classes/ProductOrder.php'; 
include_once '../classes/Product.php';
include_once '../classes/Customer.php';

$id = $_GET['id'];

$order = new Order('','','','','','');
$respOrder = $order->FindOrder('intId',$id);

$customer = new Customer('','','','','','','','','','','','','','','','');
$respCust = $customer->FindCustomer('intId',$respOrder[0]->intIdCustomer);

$productOrder = new ProductOrder('','','','','');
$respProd = $productOrder->FindProductOrder('intIdOrder',$id);
   
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

    
      $pdf->Image('../img/logobarnett.jpg' , 10 ,10, 15, 15,'JPG', '');
	  $pdf->Cell(40,5,"",0);
	  $pdf->Cell(40,5,"",0);
      $pdf->Cell(40,5,"",0);
      $pdf->Cell(40,5,"",0);
	  $pdf->Cell(40,5,"",0);
	  $pdf->Ln();
	  $pdf->Cell(40,5,"",0);
	  $pdf->Cell(40,5,"",0);
      $pdf->Cell(40,5,"",0);
      $pdf->Cell(40,5,"Orden de Pedido:",0);
	  $pdf->Cell(40,5,$id,0);
	  $pdf->Ln();
      $pdf->Cell(40,5,"",0);
	  $pdf->Cell(40,5,"",0);
      $pdf->Cell(40,5,"",0);
      $pdf->Cell(40,5,"",0);
	  $pdf->Cell(40,5,"",0);
      $pdf->Ln();
	  $pdf->Ln();
      $pdf->Cell(45,6,"Fecha",1);
	  $pdf->SetFont('Arial','',10);
      $pdf->Cell(145,6,$respOrder[0]->tmpDate,1);
	  $pdf->Ln();
	  $pdf->SetFont('Arial','B',12);
      $pdf->Cell(45,6,"Documento Cliente",1);
	  $pdf->SetFont('Arial','',10);
      $pdf->Cell(145,6,$respCust[0]->txtDocument,1);
	  $pdf->Ln();
	  $pdf->SetFont('Arial','B',12);
      $pdf->Cell(45,6,"Nombre Cliente",1);
	  $pdf->SetFont('Arial','',10);
      $pdf->Cell(145,6,$respCust[0]->txtFirtsName.' '.$respCust[0]->txtSecondName.' '.$respCust[0]->txtLastName.' '.$respCust[0]->txtSecondLastName,1);
	  $pdf->Ln();
	  $pdf->SetFont('Arial','B',12);
      $pdf->Cell(190,6,"",0);
	  $pdf->Ln();
      $pdf->Cell(20,6,"Codigo",1);
      $pdf->Cell(110,6,"Descripcion",1);
      $pdf->Cell(20,6,"Valor",1);
      $pdf->Cell(20,6,"Cantidad",1);
	  $pdf->Cell(20,6,"Subtotal",1);
	  $pdf->Ln();
	  $pdf->SetFont('Arial','',10);
	  for ($i=0; $i<count($respProd); $i++){
		  	$prodOrder = $respProd[$i];
			$product = new Product('','','','','','','');
			$prod = $product->FindProduct('id',$prodOrder->intIdProduct);
		  
		  $pdf->Cell(20,6,$prod[0]->txtCod,1);
		  $pdf->Cell(110,6,$prod[0]->txtDescription,1);
		  $pdf->Cell(20,6,$prod[0]->dbValue,1);
		  $pdf->Cell(20,6,$prodOrder->intQuantity,1);
		  $pdf->Cell(20,6,$prodOrder->dbSubtotal,1);
		  $pdf->Ln();
	  }
      $pdf->Cell(20,6,"",1);
      $pdf->Cell(110,6,"",1);
      $pdf->Cell(20,6,"",1);
	  $pdf->SetFont('Arial','B',12);
      $pdf->Cell(20,6,"TOTAL",1);
	  $pdf->Cell(20,6,$respOrder[0]->dbTotal,1);
	  $pdf->Output();
   
?>