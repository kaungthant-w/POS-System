<?php

require_once "../controllers/product.controller.php";
require_once "../models/product.model.php";

require_once "../controllers/category.controller.php";
require_once "../models/category.model.php";

class AjaxProduct {
    
    //create product

    public $idCategory;

    public function ajaxCreateProductCode(){

		$item = "category_id";

		$values = $this->idCategory;

		$answer = controllerProducts::ctrlShowProducts($item, $values);

		echo json_encode($answer);
    
	}

  //edit product

  public $productId;
  public $bringProduct;
  public $productName;

  public function ajaxEditProduct(){

    if($this->bringProduct == "ok") {

      $item = null;
      $values = null;
      $represent = ControllerProducts::ctrlShowProducts($item, $values);
      echo json_encode($represent);

    } else if($this->productName !="") {

      $item = "description";
      $values = $this->productName;
      $represent = ControllerProducts::ctrlShowProducts($item, $values);
      echo json_encode($represent);

    } else {

      $item = "id";
      $values = $this -> productId;
      $represent = ControllerProducts::ctrlShowProducts($item, $values);
      echo json_encode($represent);

    }

  }
}

//create product
if(isset($_POST["idCategory"])){

	$productCode = new AjaxProduct();
	$productCode -> idCategory = $_POST["idCategory"];
	$productCode -> ajaxCreateProductCode();

}

//edit product
if(isset($_POST["productId"])) {
  $editProduct =  new AjaxProduct();
  $editProduct -> productId = $_POST["productId"];
  $editProduct -> ajaxEditProduct();
}

//bring product
if(isset($_POST["bringProduct"])) {
  $bringProduct =  new AjaxProduct();
  $bringProduct -> bringProduct = $_POST["bringProduct"];
  $bringProduct -> ajaxEditProduct();
}


//product name
if(isset($_POST["productName"])) {
  $bringProduct =  new AjaxProduct();
  $bringProduct -> productName = $_POST["productName"];
  $bringProduct -> ajaxEditProduct();
}