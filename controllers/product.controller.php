<?php

class ControllerProducts {
    //show products
    static public function ctrlShowProducts($item, $values) {
        $table = "products";
        $represent = productsModel::mdlShowProducts($table, $item, $values);
        return $represent;
    }

    //create products
    static public function ctrlCreateProduct() {
        if(isset($_POST["newDescription"])) {
            if(preg_match("/^[a-zA-Z. ]+$/", $_POST['newDescription']) && 
               preg_match("/^[0-9]+$/", $_POST["newStock"]) &&
               preg_match("/^[0-9.]+$/", $_POST["newBuyingPrice"]) &&
               preg_match("/^[0-9.]+$/", $_POST["newSellingPrice"])) {

                $photo = "views/img/products/default/anonymous.png";

                if(isset($_FILES["newPhoto"]["tmp_name"])) {
                    [$width, $height] = getimagesize($_FILES["newPhoto"]["tmp_name"]);
                    $newWidth = 500;
                    $newHeight = 500;
                    
                    $directory = "views/img/products/".$_POST["newCode"];

                    mkdir($directory, 0755);

                    if($_FILES["newPhoto"]["type"] == "image/jpeg"){

                        $randomNumber = mt_rand(100,999);
                        
                        $photo = "views/img/products/".$_POST["newCode"]."/".$randomNumber.".jpg";
                        
                        $srcImage = imagecreatefromjpeg($_FILES["newPhoto"]["tmp_name"]);
                        
                        $destination = imagecreatetruecolor($newWidth, $newHeight);

                        imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                        imagejpeg($destination, $photo);

                    }

                    if($_FILES["newPhoto"]["type"] == "image/png") {

                        $randomPhotoName = mt_rand(100, 999);

                        $photo = "views/img/products/".$_POST["newCode"]."/".$randomPhotoName.".png";

                        $oringinal = imagecreatefrompng($_FILES["newPhoto"]["tmp_name"]);

                        $des = imagecreatetruecolor($newWidth, $newHeight);

                        imagecopyresized($des, $oringinal, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                        imagepng($des, $photo);

                    }
                    
                }

                $table = "products";
                $data = ["category_id" => $_POST["newCategory"], 
                         "code" => $_POST["newCode"], 
                         "description" => $_POST["newDescription"], 
                         "stock" => $_POST["newStock"],
                         "buying_price" => $_POST["newBuyingPrice"],
                         "selling_price" => $_POST["newSellingPrice"],
                         "image" => $photo];

                $represent = productsModel::mdlCreateProducts($table, $data);   
                if($represent == "ok") {
                    echo '
                    <script>
                        swal({
                            type:"success",
                            title:"Product have been Created!",
                            showConfirmButton: true,
                            confirmButtonText:"Finish",
                            closeOnConfirm:false

                        }).then((result) => {
                            if(result.value) {
                                window.location = "product";
                            }
                        });
                    </script>
                    ';
                }

            } else {
                echo '<script>
                swal({
                    type: "error",
                    title: "Product doesn\'t complete! ",
                    showConfirmButton: true,
                    confirmButtonText: "Close"
                    }).then(function(result){
                        if(result.value){
                            window.location = "product";
                        }
                    });
                </script>';
            } 
        }
    }

    //edit products
    static public function ctrlEditProducts() {
        if(isset($_POST["editDescription"])) {
            if(preg_match("/^[a-zA-Z. ]+$/", $_POST['editDescription']) && 
               preg_match("/^[0-9]+$/", $_POST["editStock"]) &&
               preg_match("/^[0-9.]+$/", $_POST["editBuyingPrice"]) &&
               preg_match("/^[0-9.]+$/", $_POST["editSellingPrice"])) {

                $photo = $_POST["ActualImage"];

                if(isset($_FILES["editPhoto"]["tmp_name"]) && !empty($_FILES["editPhoto"]["tmp_name"])) {
                    [$width, $height] = getimagesize($_FILES["editPhoto"]["tmp_name"]);
                    $newWidth = 500;
                    $newHeight = 500;
                    
                    $directory = "views/img/products/".$_POST["editCode"];

                    if(!empty ($_POST["ActualImage"]) && $_POST["ActualImage"] != "views/img/products/default/anonymous.png") {
                        unlink($_POST["ActualImage"]);
                        
                    } else {
                        
                        mkdir($directory, 0755);
                    }


                    if($_FILES["editPhoto"]["type"] == "image/jpeg"){

                        $randomNumber = mt_rand(100,999);
                        
                        $photo = "views/img/products/".$_POST["editCode"]."/".$randomNumber.".jpg";
                        
                        $srcImage = imagecreatefromjpeg($_FILES["editPhoto"]["tmp_name"]);
                        
                        $destination = imagecreatetruecolor($newWidth, $newHeight);

                        imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                        imagejpeg($destination, $photo);

                    }

                    if($_FILES["editPhoto"]["type"] == "image/png") {

                        $randomPhotoName = mt_rand(100, 999);

                        $photo = "views/img/products/".$_POST["editCode"]."/".$randomPhotoName.".png";

                        $oringinal = imagecreatefrompng($_FILES["editPhoto"]["tmp_name"]);

                        $des = imagecreatetruecolor($newWidth, $newHeight);

                        imagecopyresized($des, $oringinal, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                        imagepng($des, $photo);

                    }
                       
                }

                $table = "products";
                $data = ["category_id" => $_POST["editCategory"], 
                         "code" => $_POST["editCode"], 
                         "description" => $_POST["editDescription"], 
                         "stock" => $_POST["editStock"],
                         "buying_price" => $_POST["editBuyingPrice"],
                         "selling_price" => $_POST["editSellingPrice"],
                         "image" => $photo];

                $represent = productsModel::mdlEditProducts($table, $data);   

                if($represent == "ok") {
                    echo '
                    <script>
                        swal({
                            type:"success",
                            title:"Product have been Updated!",
                            showConfirmButton: true,
                            confirmButtonText:"Finish",
                            closeOnConfirm:false

                        }).then((result) => {
                            if(result.value) {
                                window.location = "product";
                            }
                        });
                    </script>
                    ';
                }

            } else {
                echo '<script>
                swal({
                    type: "error",
                    title: "Product doesn\'t complete! ",
                    showConfirmButton: true,
                    confirmButtonText: "Close"
                    }).then(function(result){
                        if(result.value){
                            window.location = "product";
                        }
                    });
                </script>';
            } 
        }
    }

    // delete products
    static public function ctrlDeleteProducts() {
        if(isset($_GET["productId"])) {
            $table = "products";
            $data = $_GET["productId"];
            
            if($_GET["image"] != "" && $_GET["image"] != "views/img/products/default/anonymous.png") {
                unlink ($_GET["image"]);
                rmdir("views/img/products/".$_GET["code"]);
            }

            $represent = productsModel::mdlDeleteProducts($table, $data);

            if($represent == "ok") {
                echo '
                <script>
                    swal({
                        type:"success",
                        title:"User have been Deleted",
                        showConfirmButton: true,
                        confirmButtonText:"Close",
                        closeOnConfirm:false

                    }).then((result) => {
                        if(result.value) {
                            window.location = "product";
                        }
                    });
                </script>
                ';
            }

        }
    }

}