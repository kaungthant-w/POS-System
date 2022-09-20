<?php

require_once "../controllers/product.controller.php";
require_once "../models/product.model.php";
require_once "../controllers/category.controller.php";
require_once "../models/category.model.php";

class ProductsTable {
    static public function showProductTable() {

        $item = null;
        $value = null;

        $products = ControllerProducts::ctrlShowProducts($item, $value);
        // var_dump($products);
        
        $JsonData =  '{
            "data":[';
              
               for($i = 0; $i < count($products); $i++) {

                    $item = "id";
				  	$values = $products[$i]["category_id"];
				  	$categories = ControllerCategories::ctrlShowCategories($item, $values);

                    $button ="<div class='btn btn-group'><button class='btn btn-warning fa fa-pencil btnEditProduct' productId='".$products[$i]["id"]."' data-toggle='modal' data-target='#modalEditProduct'></button><button class='btn btn-danger fa fa-times btnDeleteProduct' productId='".$products[$i]["id"]."' code='".$products[$i]["code"]."' image='".$products[$i]["image"]."'></button></div>";

                    // $image = "<img src='views/img/products/default/anonymous.png' style='width:40px;'/>";  

                    $image = "<img src='".$products[$i]["image"]."' width='40px'>";

                    if($products[$i]["stock"] <= 10) {
                        $stock = "<button class='btn btn-sm btn-danger'>".$products[$i]["stock"]."</button>";
                    } else if($products[$i]["stock"] > 11 && $products[$i]["stock"] <= 15) {
                        $stock = "<button class='btn btn-sm btn-warning'>".$products[$i]["stock"]."</button>";
                    } else {
                        $stock = "<button class='btn btn-sm btn-success'>".$products[$i]["stock"]."</button>";
                    }
                    
                   $JsonData .='[
                    "'.($i+1).'",
                    "'.$image.'",
                    "'.$products[$i]["code"].'",
                    "'.$products[$i]["description"].'",
                    "'.$categories["category"].'",
                    "'.$stock.'",
                    "'.$products[$i]["buying_price"].'",
                    "'.$products[$i]["selling_price"].'",
                    "'.$products[$i]["date"].'",
                    "'.$button.'"
               ],';
               }
               
               $JsonData = substr($JsonData, 0, -1);
               $JsonData .=']
        }';
        // return;
        echo $JsonData;
    }
}

$activeProducts = new ProductsTable();
$activeProducts -> showProductTable();