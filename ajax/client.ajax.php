<?php

require_once "../controllers/client.controller.php";
require_once "../models/client.model.php";

class AjaxClients {
    public $clientId;
    public function ajaxEditClient() {
        $item = "id";
        $value = $this->clientId;
        $represent = ClientController::ctrlShowClients($item, $value);

        echo json_encode($represent);

    }
}

if(isset($_POST["clientId"])) {
    $editClient = new AjaxClients();
    $editClient -> clientId = $_POST["clientId"];
    $editClient -> ajaxEditClient();
}