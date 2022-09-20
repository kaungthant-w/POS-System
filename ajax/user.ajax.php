<?php
require_once("../controllers/users.controller.php");
require_once("../models/users.model.php");

class AjaxUser {
    //edit user
    public $idUser;
    public function ajaxEditUser() {
        $item = "id";
        $value = $this->idUser;
        $represent = ControllerUsers::ctrlShowUser($item, $value);
        echo json_encode($represent);
    }

    //active user
    public $activeUser;
    public $activeId;
    public function ajaxActiveUser() {

        $table = "users";
        $item1 = "status";
        $value1 = $this -> activeUser;

        $item2 = "id";
        $value2 = $this -> activeId;

        $represent = UserModel::mdlActiveUser($table, $item1, $value1, $item2, $value2);
    }

    // validate user
    public $validateUser;
    public function ajaxValidateUser() {
        $item = "user";
        $value = $this->validateUser;
        $represent = ControllerUsers::ctrlShowUser($item, $value);
        echo json_encode($represent);
    }
}

//edit user
if(isset($_POST["idUser"])) 
{   
    $editUser = new AjaxUser();
    $editUser -> idUser = $_POST["idUser"];
    $editUser -> ajaxEditUser();
}

//active user
if(isset($_POST["activeUser"])) {
    $activeUser = new AjaxUser();
    $activeUser -> activeUser = $_POST["activeUser"];
    $activeUser -> activeId = $_POST["activeId"];  
    $activeUser -> ajaxActiveUser(); 

}

//validate user
if(isset($_POST["validateUser"])) {
    $valUser = new AjaxUser;
    $valUser -> validateUser = $_POST["validateUser"];
    $valUser -> ajaxValidateUser();
}