<?php

require_once "connection.php";

class ClientModel {

    //create client
    static public function mdlCreateClients($table, $data) {
        $stmt = Connection::connect()->prepare("INSERT INTO $table(name, id_document, email, phone, address, birthday, total_purchases)VALUES(:name, :id_document, :email, :phone, :address, :birthday, :total_purchases)");

        $stmt  -> bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt  -> bindParam(":id_document", $data["id_document"], PDO::PARAM_INT);
        $stmt  -> bindParam(":email", $data["email"], PDO::PARAM_STR);
        $stmt  -> bindParam(":phone", $data["phone"], PDO::PARAM_STR);
        $stmt  -> bindParam(":address", $data["address"], PDO::PARAM_STR);
        $stmt  -> bindParam(":birthday", $data["birthday"], PDO::PARAM_STR);
        $stmt  -> bindParam(":total_purchases", $data["total_purchases"], PDO::PARAM_STR);


        if($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    //show client
    static public function mdlShowClients($table, $item, $value) {
        if($item != null) {
            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item =:$item
             ORDER BY id DESC");
            $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();
            return $stmt -> fetch();
        } else {
            $stmt = Connection::connect()->prepare("SELECT * FROM $table");
            $stmt -> execute();
            return $stmt -> fetchAll();
        }

        $stmt = null;
    }

    //edit client
    static public function mdlEditeClients($table, $data) {

        $stmt = Connection::connect()->prepare("UPDATE $table SET name=:name, id_document=:id_document, email=:email, phone=:phone, address=:address, birthday=:birthday, total_purchases=:total_purchases WHERE id=:id");

        $stmt  -> bindParam(":id", $data["id"], PDO::PARAM_INT);
        $stmt  -> bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt  -> bindParam(":id_document", $data["id_document"], PDO::PARAM_INT);
        $stmt  -> bindParam(":email", $data["email"], PDO::PARAM_STR);
        $stmt  -> bindParam(":phone", $data["phone"], PDO::PARAM_STR);
        $stmt  -> bindParam(":address", $data["address"], PDO::PARAM_STR);
        $stmt  -> bindParam(":birthday", $data["birthday"], PDO::PARAM_STR);
        $stmt  -> bindParam(":total_purchases", $data["total_purchases"], PDO::PARAM_STR);


        if($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    // delete client
    static public function mdlDeleteClients($table, $data) {
        
        $stmt = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");

		$stmt -> bindParam(":id", $data, PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return 'ok';
		
		} else {

			return 'error';
		
		}
		
		$stmt = null;
    }

    // active client
    static public function mdlActiveClients($table, $item1, $value1, $valueClientId) {
        $stmt = Connection::connect()->prepare("UPDATE $table SET $item1=:$item1 WHERE id=:id");

        $stmt -> bindParam(":".$item1, $value1, PDO::PARAM_STR);
        $stmt -> bindParam(":id", $valueClientId, PDO::PARAM_STR);

        if($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }
}