<?php

require_once "../../../controllers/sale.controller.php";
require_once "../../../controllers/users.controller.php";
require_once "../../../controllers/client.controller.php";
require_once "../../../controllers/product.controller.php";

require_once "../../../models/sale.model.php";
require_once "../../../models/users.model.php";
require_once "../../../models/client.model.php";
require_once "../../../models/product.model.php";


class printBill {
	public $code;
	public function getBillPrinting() {

		$itemSale = "code";
		$valueSale = $this -> code;
		$represent = ControllerSell::ctrlShowSell($itemSale, $valueSale);

		$date = substr($represent["date"], 0, -8);
		$products = json_decode($represent["products"], true);
		$net = number_format($represent["net_price"], 2);
		$tax = number_format($represent["taxes"], 2);
		$total = number_format($represent["total"], 2);

		$itemClient = "id";
		$valueClient = $represent["client_id"];
		$representClient = ClientController::ctrlShowClients($itemClient, $valueClient);

		$itemSeller = "id";
		$valueSeller = $represent["seller_id"];
		$representSeller = ControllerUsers::ctrlShowUser($itemSeller, $valueSeller);

		require_once('tcpdf_include.php');

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->startPageGroup();

		$pdf->AddPage();


		$block1 = <<<EOF

			<table>
				
				<tr>
					
					<td style="width:150px"><img src="images/logo-negro-bloque.png"></td>

					<td style="background-color:white; width:140px">
						
						<div style="font-size:8.5px; text-align:right; line-height:15px;">
							
							<br>
							NIT: 71.759.963-9

							<br>
							ADDRESS: Calle 44B 92-11

						</div>

					</td>

					<td style="background-color:white; width:140px">

						<div style="font-size:8.5px; text-align:right; line-height:15px;">
							
							<br>
							CELLPHONE: 300 786 52 49
							
							<br>
							sales@inventorysystem.com

						</div>
						
					</td>

					<td style="background-color:white; width:110px; text-align:center; color:red"><br><br>BILL N.<br>$valueSale</td>

				</tr>

			</table>

			EOF;

			$pdf->writeHTML($block1, false, false, false, false, '');

			
			
		$block2 = <<<EOF
			<table style="font-size:10px; padding:5px 10px;">

				<tr>
					<td style="width:540px"><img src="images/back.jpg"/></td>
				</tr>

				<tr>
					<td style="border:1px solid #666; background-color:white; width:390px">
						Client : $representClient[name]
					</td>

					<td style="border:1px solid #666; background-color:white; width:150px; text-align:right">
						Date : $date
					</td>
				</tr>

				<tr>
					<td style="border:1px solid #666; background-color:white; width:540px">
						Seller : $representSeller[profile]
					</td>
				</tr>
				
			</table>	
		EOF;
			$pdf->writeHTML($block2, false, false, false, false,'');

		$block3 = <<<EOF
			<table style="font-size:10px; padding:5px 10px;">
				<tr>
				<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Product</td>
				<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Quantity</td>
				<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Unit</td>
				<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Total</td>
				</tr>
			</table>
		EOF;
			$pdf->writeHTML($block3, false, false, false, false,'');


		foreach($products as $key => $item) {


			$itemProduct = "description";
			$valueProduct = $item["description"];
			$order = null;
			$representProduct = ControllerProducts::ctrlShowProducts($itemProduct, $valueProduct, $order);

			$valueUnitPrice = number_format($representProduct["selling_price"], 2);
			$totalPrice = number_format($item["totalPrice"], 2);

			$block4 = <<<EOF
				<table style="font-size:10px; padding:5px 10px;">
					<tr>
						<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">$item[description]</td>

						<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">$item[quantity]</td>

						<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">$valueUnitPrice</td>

						<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">$totalPrice</td>
					</tr>
				</table>
				
				EOF;
				$pdf->writeHTML($block4, false, false, false, false,'');
		}	

		$block5 = <<<EOF

			<table style="font-size:10px; padding:5px 10px;">
				<tr>

					<td style="border: 1px solid #666; background-color:white; width:340px; text-align:center"></td>

					<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

					<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

				</tr>

				<tr>
					<td style="border-right: 1px solid #666; background-color:white; width:340px; text-align:center"></td>

					<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">NetPrice:</td>

					<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">$net</td>

				</tr>

				<tr>
					<td style="border-right: 1px solid #666; background-color:white; width:340px; text-align:center"></td>

					<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Tax:</td>

					<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">$tax</td>

				</tr>

				<tr>
					<td style="border-right: 1px solid #666; background-color:white; width:340px; text-align:center"></td>

					<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">TotalPrice:</td>

					<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">$total</td>

				</tr>

			</table>

		EOF;
		$pdf->writeHTML($block5, false, false, false, false,'');	
		$pdf->Output('bill.pdf');
			

  	}
}


$bill = new printBill();
$bill -> code = $_GET["code"];
$bill -> getBillPrinting();

?>