<?php

class ControllerCategories {

    //Create Category 
    static public function ctrlCreateCategories() {
        if(isset($_POST["newCategory"])) {
            if(preg_match('/^[A-Za-z. ]+$/', $_POST["newCategory"])) {

                $table = "categories";
                $data = $_POST["newCategory"];
                $represent = CategoryModel::mdlCreateCategory($table, $data);

                if($represent == "ok") {
                    echo '
                    <script>
                        swal({
                            type:"success",
                            title:"Category have been Updated",
                            showConfirmButton: true,
                            confirmButtonText:"Finish",
                            closeOnConfirm:false

                        }).then((result) => {
                            if(result.value) {
                                window.location = "category";
                            }
                        });
                    </script>
                    ';
                }

            } else {
                echo'<script>
                        swal({
                            type: "error",
                            title: "Category cann\'t blank! ",
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

    // Show Category
    static public function ctrlShowCategories($item, $values) {
        $table = "categories";
        $represent = CategoryModel::mdlShowCategories($table, $item, $values);
        return ($represent);
    }

    // Edit Category
    static public function ctrleditCategories() {
        if(isset($_POST["editCategory"])){

            if(preg_match('/^[a-zA-Z. ]+$/', $_POST["editCategory"])){

                $table = "categories";

                $data = array("category"=>$_POST["editCategory"],
                                "id"=>$_POST["idCategory"]);

                $answer = CategoryModel::mdlEditCategory($table, $data);
                // var_dump($answer);

                if($answer == "ok"){

                    echo'<script>

                    swal({
                            type: "success",
                            title: "Category has been successfully saved ",
                            showConfirmButton: true,
                            confirmButtonText: "Close"
                            }).then(function(result){
                                    if (result.value) {

                                    window.location = "category";

                                    }
                                })

                    </script>';

                }


            }else{

                echo'<script>

                    swal({
                            type: "error",
                            title: "Category cann\'t change",
                            showConfirmButton: true,
                            confirmButtonText: "Close"
                            }).then(function(result){
                            if (result.value) {

                            window.location = "category";

                            }
                        })

                    </script>';

            }

        }

    }
    
    //delete category
    static public function ctrDeleteCategories(){

		if(isset($_GET["idCategory"])){

			$table ="categories";
			$data = $_GET["idCategory"];

			$answer = CategoryModel::mdlDeleteCategories($table, $data);
			var_dump($answer);

			if($answer == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "The category has been successfully deleted",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
                            if (result.value) {

                            window.location = "category";

                            }
						  })

					</script>';
			}
		
		}
}
}