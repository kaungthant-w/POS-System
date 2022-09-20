<?php

require_once "../controllers/product.controller.php";
require_once "../models/product.model.php";


class ProductsTableSales {
    static public function showProductTableSales() {

        $item = null;
        $value = null;

        $products = ControllerProducts::ctrlShowProducts($item, $value);
        // var_dump($products);
        
        $JsonData =  '{
            "data": [';
              
               for($i = 0; $i < count($products); $i++) {

                    $image = "<img src='".$products[$i]["image"]."' width='40px'>";
                    
                    if($products[$i]["stock"] <= 10) {
                        $stock = "<button class='btn btn-sm btn-danger'>".$products[$i]["stock"]."</button>";
                    } else if($products[$i]["stock"] > 11 && $products[$i]["stock"] <= 15) {
                        $stock = "<button class='btn btn-sm btn-warning'>".$products[$i]["stock"]."</button>";
                    } else {
                        $stock = "<button class='btn btn-sm btn-success'>".$products[$i]["stock"]."</button>";
                    }
                    
                    $button ="<div class='btn-group'><button class='btn btn-primary addProduct recallBackButton' productId='".$products[$i]["id"]."'>Add</button></div>";

                    
                   $JsonData .='[
                    "'.($i+1).'",
                    "'.$image.'",
                    "'.$products[$i]["code"].'",
                    "'.$products[$i]["description"].'",
                    "'.$stock.'",
                    "'.$button.'"
               ],';
               }
               
               $JsonData = substr($JsonData, 0, -1);
               $JsonData .=']
        }';
        echo $JsonData;
    }
}

$activeProductsSales = new ProductsTableSales();
$activeProductsSales -> showProductTableSales();