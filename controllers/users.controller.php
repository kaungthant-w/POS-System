<?php
error_reporting(0);
    class ControllerUsers {
        
        //Show login user
        static public function ctrlLoginUser() {
            if(isset($_POST["loginUser"])) {

                if(preg_match('/^[a-zA-Z. ]+$/', $_POST["loginUser"])&&
                (preg_match('/^[a-zA-Z0-9]+$/', $_POST['loginPass'])) ) {

                    $encript = crypt($_POST["loginPass"], '$2a$07$usesomesillystringforsalt$');
                    $table = 'users';
                    $item = "user";
                    $value = $_POST["loginUser"];
                    $represent = UserModel::mdlShowUser($table, $item, $value);
                    // var_dump($represent["user"]);

                    if($represent["user"] == $_POST["loginUser"] && $represent["password"] == $encript) {

                    if($represent["status"]) {

                    $_SESSION["homeSession"] = "ok";
                    $_SESSION["id"] = $represent["id"];
                    $_SESSION["name"] = $represent["name"];
                    $_SESSION["user"] = $represent["user"];
                    $_SESSION["photo"] = $represent["photo"];
                    $_SESSION["profile"] = $represent["profile"];
                    $_SESSION["last_login"] = $represent["last_login"];

                    //last login
                    date_default_timezone_set("America/Bogota");
                    $date = date('Y-m-d');
                    $hour = date('H:i:s');

                    $dateActual = $date." ".$hour;
                    $item1 = "last_login";
                    $value1 = $dateActual;

                    $item2 = "id";
                    $value2 = $represent["id"];

                    $lastLogin = UserModel::mdlActiveUser($table, $item1, $value1, $item2, $value2);
                    if($lastLogin == "ok") {
                        header("location:home");
                    }

                    header("location:home");
                    } else {
                        echo "<br><div class='alert alert-warning'>User doesn't active yet!</div>";
                    }
                         
                    } else {
                        echo "<div class='alert alert-warning'>Wrong Password or User !</div>";
                     }
                }
            }
        }

        //Create New User
        static public function ctrlCreateUser() {
            if(isset($_POST["newUser"])) {
                if(preg_match('/^[a-zA-Z. ]+$/', $_POST["newName"])&&
                preg_match('/^[a-zA-Z. ]+$/', $_POST["newUser"])&&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["newPassword"])) {

                    // $photo = "";

                    if(isset($_FILES["newPhoto"]["tmp_name"])) {
                        [$width, $height] = getimagesize($_FILES["newPhoto"]["tmp_name"]);
                        $directory = "views/img/users/".$_POST["newUser"];
                        $newWidth = 500;
                        $newHeight = 500;
                        
                        mkdir($directory, 0755);

                        if($_FILES["newPhoto"]["type"] == "image/jpeg"){

                            $randomNumber = mt_rand(100,999);
                            
                            $photo = "views/img/users/".$_POST["newUser"]."/".$randomNumber.".jpg";
                            
                            $srcImage = imagecreatefromjpeg($_FILES["newPhoto"]["tmp_name"]);
                            
                            $destination = imagecreatetruecolor($newWidth, $newHeight);
    
                            imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    
                            imagejpeg($destination, $photo);
    
                        }

                        if($_FILES["newPhoto"]["type"] == "image/png") {

                            $randomPhotoName = mt_rand(100, 999);

                            $photo = "views/img/users/".$_POST["newUser"]."/".$randomPhotoName.".png";

                            $oringinal = imagecreatefrompng($_FILES["newPhoto"]["tmp_name"]);

                            $des = imagecreatetruecolor($newWidth, $newHeight);

                            imagecopyresized($des, $oringinal, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                            imagepng($des, $photo);

                        }
                        
                    }

                    $table = "users";
                    $encript = crypt($_POST["newPassword"], '$2a$07$usesomesillystringforsalt$');
                    $data = ["name" => $_POST["newName"], 
                            "user" => $_POST["newUser"], 
                            "password" => $encript, 
                            "profile" => $_POST["newProfile"] , 
                            "photo" => $photo ];

                    $represent = UserModel::mdlInsertUser($table, $data);  
                    

                    if($represent == "ok") {
                        echo '
                        <script>
                            swal({
                                type:"success",
                                title:"User have been Created",
                                showConfirmButton: true,
                                confirmButtonText:"Close",
                                closeOnConfirm:false

                            }).then((result) => {
                                if(result.value) {
                                    window.location = "users";
                                }
                            });
                        </script>
                        ';
                    }

                } else {
                    echo '<script>
                        swal({
                            type: "error",
                            title: "No characters or empty fields",
                            showConfirmButton: true,
                            confirmButtonText: "Close"
                            }).then(function(result){
                                if(result.value){
                                    window.location = "users";
                                }
                            });
					
				    </script>';
                }
            }
        }   
        
        //show user
        static public function ctrlShowUser($item, $value) {
            $table = "users";
            $represent =UserModel::mdlShowUser($table, $item, $value);
            return $represent;
        }

        //Upate User
        static public function ctrlUpdateUser() {
            if(isset($_POST["editUser"])) {
                if(preg_match('/^[A-Za-z. ]+$/', $_POST["editName"])) {

                    // validate image
                    $photo = $_POST["photoActual"];

                    if(isset($_FILES["editPhoto"]["tmp_name"]) && !empty($_FILES["editPhoto"]["tmp_name"])) {
                        list($width, $height) = getimagesize($_FILES["editPhoto"]["tmp_name"]);

                        $directory = "views/img/users/".$_POST["editUser"];
                        $editWdith = 500;
                        $editHeight = 500;

                        if(!empty($_POST["photoActual"])) {
                            unlink($_POST["photoActual"]);
                        } else {

                            mkdir($directory, 0755);
                        }


                        if($_FILES["editPhoto"]["type"] == "image/png") {

                            $randomPhotoName = mt_rand(100, 999);

                            $photo = "views/img/users/".$_POST["editUser"]."/".$randomPhotoName.".png";

                            $oringinal = imagecreatefrompng($_FILES["editPhoto"]["tmp_name"]);

                            $des = imagecreatetruecolor($editWdith, $editHeight);

                            imagecopyresized($des, $oringinal, 0, 0, 0, 0, $editWdith, $editHeight, $width, $height);

                            imagepng($des, $photo);

                        }

                        if($_FILES["editPhoto"]["type"] == "image/jpeg") {

                            $randomPhotoName = mt_rand(100, 999);

                            $photo = "views/img/users/".$_POST["editUser"]."/".$randomPhotoName.".jpg";

                            $oringinal = imagecreatefromjpeg($_FILES["editPhoto"]["tmp_name"]);

                            $des = imagecreatetruecolor($editWdith, $editHeight);

                            imagecopyresized($des, $oringinal, 0, 0, 0, 0, $editWdith, $editHeight, $width, $height);

                            imagejpeg($des, $photo);

                        }

                    }

                    $table = "users";
                    if($_POST["editPassword"] != "") {
                        if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editPassword"])) {

                            $encript = crypt($_POST["editPassword"],'$2a$07$usesomesillystringforsalt$');
                        } else {
                            echo '<script>
                                swal({
                                    type: "error",
                                    title: "Password cann\'t blank! ",
                                    showConfirmButton: true,
                                    confirmButtonText: "Close"
                                    }).then(function(result){
                                        if(result.value){
                                            window.location = "users";
                                        }
                                    });
				            </script>';
                        }
                    } else {
                        $encript = $_POST["passwordActual"];
                    }

                    $data = array("name" => $_POST["editName"],
                                    "user" => $_POST["editUser"],
                                    "password" => $encript,
                                    "profile" => $_POST["editProfile"],
                                    "photo" => $photo);
                    $represent = UserModel::mdlEditUser($table, $data);

                    if($represent == "ok") {
                        echo '
                        <script>
                            swal({
                                type:"success",
                                title:"User have been Updated",
                                showConfirmButton: true,
                                confirmButtonText:"Finish",
                                closeOnConfirm:false

                            }).then((result) => {
                                if(result.value) {
                                    window.location = "users";
                                }
                            });
                        </script>
                        ';
                    }
                    
                }else {
                    echo '<script>
                        swal({
                            type: "error",
                            title: "Name doesn\'t complete! ",
                            showConfirmButton: true,
                            confirmButtonText: "Close"
                            }).then(function(result){
                                if(result.value){
                                    window.location = "users";
                                }
                            });
                    </script>';
                }
            }
        }

        //delete User
        static public function ctrlDeleteUser() {
            if(isset($_GET["userId"])) {
                $table = "users";
                $data = $_GET["userId"];

                if($_GET["userPhoto"] != "") {
                    unlink($_GET["userPhoto"]);
                    rmdir('views/img/users/'.$_GET["user"]);
                }

                $represent = UserModel::mdlDeleteUser($table, $data);

                if($represent == "ok") {
                    echo '
                        <script>
                            swal({
                                type:"success",
                                title:"User has been deleted",
                                showConfirmButton: true,
                                confirmButtonText:"Finish",
                                closeOnConfirm:false

                            }).then((result) => {
                                if(result.value) {
                                    window.location = "users";
                                }
                            });
                        </script>
                        ';
                }
            }
        }
    }