<?php
class ControllerSell {

    // show Sales
    static public function ctrlShowSell($item, $value) {
        $table = "sales";
        $represent = ModelSell::mdlShowSell($table, $item, $value);
        return $represent;
    }

    // create sale
    static public function ctrlCreateSale() {

        if(isset($_POST["newSale"])) {
            $productList = json_decode($_POST["productsList"], true);
            // var_dump($productList);

            $totalPurchasedProducts = array();

            foreach( $productList as $key => $value) {

                array_push($totalPurchasedProducts, $value["quantity"]);

                $tableProducts = "products";
                $item = "id";
                $valueProductId  = $value["id"];

                $getProduct = productsModel::mdlShowProducts($tableProducts,$item, $valueProductId );
                
                // var_dump($getProduct["quantity"]);

                $item1a = "quantity";
                $value1a = $value["quantity"] + $getProduct["quantity"];

                $newSales = productsModel::mdlActiveProducts($tableProducts, $item1a, $value1a, $valueProductId);

                $item1b = "stock";
                $value1b = $value["stock"];

                $newStock = productsModel::mdlActiveProducts($tableProducts, $item1b, $value1b, $valueProductId);
            }

            $tableCustomer = "clients";
            $item = "id";
            $valueClientId = $_POST["selectClient"];

            $getCustomer = ClientModel::mdlShowClients($tableCustomer, $item, $valueClientId);

            // var_dump($getCustomer["total_purchases"]);
            
            $item1a = "total_purchases";
            $value1a = array_sum($totalPurchasedProducts) + $getCustomer["total_purchases"];
            
            $valueCustomer = ClientModel::mdlActiveClients($tableCustomer , $item1a, $value1a, $valueClientId);

            $item1b = "last_purchases";
            
            $date = date('Y-m-d');
            $hour = date('H:i:s');
            $value1b =  $date." ".$hour;
            
            $valueCustomer = ClientModel::mdlActiveClients($tableCustomer , $item1b, $value1b, $valueClientId);


            $table = "sales";
            $data = array("seller_id" => $_POST["sellerId"],
                          "client_id" => $_POST["selectClient"],
                          "code" => $_POST["newSale"],
                          "products" => $_POST["productsList"],
                          "payment_method" => $_POST["listPaymentMethod"],
                          "taxes" => $_POST["newPriceTaxes"],
                          "total" => $_POST["saleTotal"],
                          "net_price" => $_POST["newNetPrice"]);

            $represent = ModelSell::mdlCreateSales($table, $data);      

            var_dump($represent);
            
            if($represent == "ok") {
                echo '
                <script>
                    swal({
                        type:"success",
                        title:"Sale have been Created!",
                        showConfirmButton: true,
                        confirmButtonText:"Finish",
                        closeOnConfirm:false

                    }).then((result) => {
                        if(result.value) {
                            window.location = "sale";
                        }
                    });
                </script>
                ';
            }

        }
    }

    // update sale
    static public function ctrlUpdateSale() {

        if(isset($_POST["editSale"])) {

            $table = "sales";
            $item = "code";
            $value = $_POST["editSale"];

            $getSale = ModelSell::mdlShowSell($table, $item, $value);
            // var_dump($getSale);


            //if product is empty

            if($_POST["productsList"] == "") {
                $productList = $getSale["products"];
                $changeProduct = false;
                // var_dump($productList);

            } else {
                $productList = $_POST["productsList"];
                $changeProduct = true;
            }

            if( $changeProduct ) {

                $products = json_decode($getSale["products"], true);

                // var_dump($products);

                $totalPurchasedProducts = array();

                foreach($products as $key => $value) {

                    array_push($totalPurchasedProducts, $value["quantity"]);
                    // var_dump($value);
                    
                    $tableProducts = "products";

                    $item = "id";
                    $valueProductId = $value["id"];

                    $getProduct = productsModel::mdlShowProducts($tableProducts, $item, $value);

                    $item1a = "quantity";
                    $value1a =  $getProduct["quantity"] - $value["quantity"];

                    // var_dump($value1a);

                    $newSales = productsModel::mdlActiveProducts($tableProducts, $item1a, $value1a, $valueProductId);

                    // var_dump($newSales);

                    $item1b = "stock";
                    $value1b = $value["quantity"] + $getProduct["stock"];

                    $newStock = productsModel::mdlActiveProducts($tableProducts, $item1b, $value1b, $valueProductId);

                    // var_dump($value1b);  
                }

                $tableCustomer = "clients";
                $itemClient = "id";
                $valueClientId = $_POST["selectClient"];

                $getCustomer = ClientModel::mdlShowClients($tableCustomer, $itemClient, $valueClientId);

                // var_dump($getCustomer);

                $item1a = "total_purchases";
                $value1a = $getCustomer["total_purchases"] - array_sum($totalPurchasedProducts);
                
                $valueCustomer = ClientModel::mdlActiveClients($tableCustomer , $item1a, $value1a, $valueClientId);

                // var_dump($valueCustomer);
                
                $productList_2 = json_decode( $productList, true);
                // var_dump($productList_2);

                $totalPurchasedProducts_2 = array();

                foreach( $productList_2 as $key => $value) {

                    // var_dump($value);

                    array_push($totalPurchasedProducts_2, $value["quantity"]);

                    $tableProducts_2 = "products";

                    $item_2 = "id";
                    $value_2  = $value["id"];

                    $getProduct_2 = productsModel::mdlShowProducts($tableProducts_2,$item_2, $value_2 );

                    // var_dump($getProduct_2["quantity"]);

                    $item1a_2 = "quantity";
                    $value1a_2 = $value["quantity"] + $getProduct_2["quantity"];

                    $newSales_2 = productsModel::mdlActiveProducts($tableProducts_2, $item1a_2, $value1a_2, $valueProductId);

                    $item1b_2 = "stock";
                    $value1b_2 = $value["stock"] - $value["quantity"];

                    $newStock_2 = productsModel::mdlActiveProducts($tableProducts, $item1b_2, $value1b_2, $valueProductId);

                }

                $tableCustomer_2 = "clients";
                $item_2 = "id";
                $valueClientId_2 = $_POST["selectClient"];

                $getCustomer_2 = ClientModel::mdlShowClients($tableCustomer_2, $item_2, $valueClientId_2);
                
                // var_dump($getCustomer_2['total_purchases']);
                
                $item1a_2 = "total_purchases";
                $value1a_2 = array_sum($totalPurchasedProducts_2) + $getCustomer_2["total_purchases"];
                
                $valueCustomer_2 = ClientModel::mdlActiveClients($tableCustomer_2 , $item1a_2, $value1a_2, $valueClientId_2);

                // var_dump($value1a_2);

                $item1b_2 = "last_purchases";
                
                $date_2 = date('Y-m-d');
                $hour_2 = date('H:i:s');
                $value1b_2 =  $date_2." ".$hour_2;
                
                $valueCustomer_2 = ClientModel::mdlActiveClients($tableCustomer_2 , $item1b_2, $value1b_2, $valueClientId_2);


            } 

            

            $data = array("seller_id" => $_POST["sellerId"],
                          "client_id" => $_POST["selectClient"],
                          "code" => $_POST["newSale"],
                          "products" => $productList,
                          "payment_method" => $_POST["listPaymentMethod"],
                          "taxes" => $_POST["newPriceTaxes"],
                          "total" => $_POST["saleTotal"],
                          "net_price" => $_POST["newNetPrice"]);

            $represent = ModelSell::mdlEditeSales($table, $data);      

            var_dump($represent);
            
            if($represent == "ok") {
                echo '
                <script>
                    swal({
                        type:"success",
                        title:"Sale have been Edited!",
                        showConfirmButton: true,
                        confirmButtonText:"Finish",
                        closeOnConfirm:false

                    }).then((result) => {
                        if(result.value) {
                            window.location = "sale";
                        }
                    });
                </script>
                ';
            }

        }
        
    }

    // delete sale
    static public function ctrlDeleteSale() {

        if($_GET["saleId"]) {
            $table = "sales";
            $item = "id";
            $value = $_GET["saleId"];

            $getSale = ModelSell::mdlShowSell($table, $item, $value);

            $tableCustomer = "clients";
            $itemSale = null;
            $valueSale = null;
            
            $getSales = ModelSell::mdlShowSell($table, $itemSale, $valueSale);

            $saveDate = array();

            foreach($getSales as $key => $value) {
                if($value["client_id"] == $getSale["client_id"]){

                    array_push($saveDate, $value["date"]);
                    // var_dump($value["date"]);
                }

            }
        

        // var_dump($saveDate);

        if(count($saveDate) > 1) {

            if($getSale["date"] > $saveDate[count($saveDate) - 2]) {
                $item = "last_purchases";
                $value = $saveDate[count($saveDate)-2];
                $valueClientId = $getSale["client_id"];

                $clientPurchase = ClientModel::mdlActiveClients($tableCustomer, $item, $value, $valueClientId); 
                
            } else {
                $item = "last_purchases";
                $value = $saveDate[count($saveDate)-1];
                $valueClientId = $getSale["client_id"];

                $clientPurchase = ClientModel::mdlActiveClients($tableCustomer, $item, $value, $valueClientId); 
            }


        } else {

            $item = "last_purchases";
            $value = "0000-00-00 00:00:00";
            $valueClientId = $getSale["client_id"];

            $clientPurchase = ClientModel::mdlActiveClients($tableCustomer, $item, $value, $valueClientId); 

        }

        //format products and client table
        $products = json_decode($getSale["products"], true);

        // var_dump($products);
        $totalPurchasedProducts = array();

            foreach($products as $key => $value) {

                array_push($totalPurchasedProducts, $value["quantity"]);
                
                $tableProducts = "products";
                $item = "id";
                $valueProductId = $value["id"];
                $getProduct = productsModel::mdlShowProducts($tableProducts, $item, $value);

                $item1a = "quantity";
                $value1a =  $getProduct["quantity"] - $value["quantity"];

                $newSales = productsModel::mdlActiveProducts($tableProducts, $item1a, $value1a, $valueProductId);

                $item1b = "stock";
                $value1b = $value["quantity"] + $getProduct["stock"];

                $newStock = productsModel::mdlActiveProducts($tableProducts, $item1b, $value1b, $valueProductId);
            }

            $tableCustomer = "clients";
            $itemClient = "id";
            $valueClientId = $getSale["client_id"];

            $getCustomer = ClientModel::mdlShowClients($tableCustomer, $itemClient, $valueClientId);

            $item1a = "total_purchases";
            $value1a = $getCustomer["total_purchases"] - array_sum($totalPurchasedProducts);
            
            $valueCustomer = ClientModel::mdlActiveClients($tableCustomer , $item1a, $value1a, $valueClientId);


            // delete sale
            $represent = ModelSell::mdlDeleteSale($table, $_GET["saleId"]);

            if($represent == "ok") {
                echo '
                <script>
                    swal({
                        type:"success",
                        title:"Sale have been Deleted!",
                        showConfirmButton: true,
                        confirmButtonText:"Finish",
                        closeOnConfirm:false

                    }).then((result) => {
                        if(result.value) {
                            window.location = "sale";
                        }
                    });
                </script>
                ';
            }
        }    
    }

    // range date
    static public function ctrlDateRangeSale($initialDate, $endDate) {
        $table = "sales";
        $represent = ModelSell::mdlDateRangeSale($table, $initialDate, $endDate);

        return $represent;

    }
}