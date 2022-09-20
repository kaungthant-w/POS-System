<?php   

class ClientController {

    //create client
    static public function ctrlCreateClients() {
        if(isset($_POST["addName"])) {
            if(preg_match('/^[a-zA-Z0-9. ]+$/', $_POST["addName"]) &&
                preg_match('/^[0-9]+$/', $_POST["addDocumentId"]) &&
                preg_match('/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/', $_POST["addEmail"]) && 
                preg_match('/^[0-9]+$/', $_POST["addPhone"]) && 
                preg_match('/^[a-zA-Z0-9. ]+$/', $_POST["addAddress"])){

                    $table = "clients";

                    $data = [
                        "name" => $_POST["addName"],
                        "id_document" => $_POST["addDocumentId"],
                        "email" => $_POST["addEmail"],
                        "phone" => $_POST["addPhone"],
                        "address" => $_POST["addAddress"],
                        "birthday" => $_POST["addBirthday"],
                        "total_purchases" => $_POST["addTotalPurchase"]
                    ];

                    $represent = clientModel::mdlCreateClients($table, $data);
                    var_dump($represent);

                    if($represent == "ok") {
                        echo '
                        <script>
                            swal({
                                type:"success",
                                title:"Client have been Created!",
                                showConfirmButton: true,
                                confirmButtonText:"Finish",
                                closeOnConfirm:false
    
                            }).then((result) => {
                                if(result.value) {
                                    window.location = "client";
                                }
                            });
                        </script>
                        ';
                    }


            } else {

                echo '<script>
                swal({
                    type: "error",
                    title: "client doesn\'t complete! ",
                    showConfirmButton: true,
                    confirmButtonText: "Close"
                    }).then(function(result){
                        if(result.value){
                            window.location = "client";
                        }
                    });
                </script>';

            }
        }
    }

    // show client
    static public function ctrlShowClients($item, $value) {
        $table = "clients";
        $represent = ClientModel::mdlShowClients($table, $item, $value);
        return $represent;
    }

    //edit client
    static public function ctrlEditClients() {
        if(isset($_POST["editName"])) {
            if(preg_match('/^[a-zA-Z0-9. ]+$/', $_POST["editName"]) &&
                preg_match('/^[0-9]+$/', $_POST["editDocumentId"]) &&
                preg_match('/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/', $_POST["editEmail"]) && 
                preg_match('/^[0-9]+$/', $_POST["editPhone"]) && 
                preg_match('/^[a-zA-Z0-9. ]+$/', $_POST["editAddress"])){

                    $table = "clients";

                    $data = [
                        "id" => $_POST["clientId"],
                        "name" => $_POST["editName"],
                        "id_document" => $_POST["editDocumentId"],
                        "email" => $_POST["editEmail"],
                        "phone" => $_POST["editPhone"],
                        "address" => $_POST["editAddress"],
                        "birthday" => $_POST["editBirthday"],
                        "total_purchases" => $_POST["editTotalPurchase"]
                    ];

                    $represent = clientModel::mdlEditeClients($table, $data);
                    // var_dump($represent);

                    if($represent == "ok") {
                        echo '
                        <script>
                            swal({
                                type:"success",
                                title:"Client have been Edited!",
                                showConfirmButton: true,
                                confirmButtonText:"Finish",
                                closeOnConfirm:false
    
                            }).then((result) => {
                                if(result.value) {
                                    window.location = "client";
                                }
                            });
                        </script>
                        ';
                    }


            } else {

                echo '<script>
                swal({
                    type: "error",
                    title: "client doesn\'t complete! ",
                    showConfirmButton: true,
                    confirmButtonText: "Close"
                    }).then(function(result){
                        if(result.value){
                            window.location = "client";
                        }
                    });
                </script>';

            }
        }
    }

    //delete client
    static public function ctrlDeleteClients() {
        if(isset($_GET["clientId"])) {
            $table = "clients";
            $data = $_GET["clientId"];
            $represent = ClientModel::mdlDeleteClients($table, $data);

            if($represent == "ok") {
                echo '
                <script>
                    swal({
                        type:"success",
                        title:"client have been Deleted!",
                        showConfirmButton: true,
                        confirmButtonText:"Finish",
                        closeOnConfirm:false

                    }).then((result) => {
                        if(result.value) {
                            window.location = "client";
                        }
                    });
                </script>
                ';
            }

        }
    }
}