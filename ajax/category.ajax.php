<?php

require_once "../controllers/category.controller.php";
require_once "../models/category.model.php";

class AjaxCategories {
    public $idCategory;
    public function ajaxEditCategory(){
        $item = "id";
        $value = $this->idCategory;
        $answer = ControllerCategories::ctrlShowCategories($item, $value);

        echo json_encode($answer);
    }
}

//edit category
if(isset($_POST["idCategory"])) {
    $category = new AjaxCategories();
    $category -> idCategory = $_POST["idCategory"];
    $category -> ajaxEditCategory();
}