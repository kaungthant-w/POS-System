<?php

require_once("connection.php");

class productsModel {

    // show products
    static public function mdlShowProducts($table,$item, $values) {
        if($item != null) {
            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item =:$item
             ORDER BY id DESC");
            $stmt -> bindParam(":".$item, $values, PDO::PARAM_STR);
            $stmt -> execute();
            return $stmt -> fetch();
        } else {
            $stmt = Connection::connect()->prepare("SELECT * FROM $table");
            $stmt -> execute();
            return $stmt -> fetchAll();
        }

        $stmt = null;
    }

    // create products
    static public function mdlCreateProducts($table, $data) {
        $stmt = Connection::connect()->prepare("INSERT INTO $table(category_id, code, description ,stock ,buying_price , selling_price, image)VALUES(:category_id, :code, :description, :stock, :buying_price, :selling_price, :image)");

        $stmt -> bindParam(":category_id", $data["category_id"], PDO::PARAM_STR);
        $stmt -> bindParam(":code", $data["code"],PDO::PARAM_STR);
        $stmt -> bindParam(":description", $data["description"], PDO::PARAM_STR);
        $stmt -> bindParam(":stock", $data["stock"], PDO::PARAM_STR);
        $stmt -> bindParam(":buying_price", $data["buying_price"], PDO::PARAM_STR);
        $stmt -> bindParam(":selling_price", $data["selling_price"], PDO::PARAM_STR);
        $stmt -> bindParam(":image", $data["image"], PDO::PARAM_STR);

        if($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    //edit products
    static public function mdlEditProducts($table, $data) {
        $stmt = Connection::connect()->prepare("UPDATE $table SET category_id = :category_id, description = :description ,stock = :stock ,buying_price = :buying_price , selling_price = :selling_price, image = :image WHERE code = :code ");

        $stmt -> bindParam(":category_id", $data["category_id"], PDO::PARAM_STR);
        $stmt -> bindParam(":code", $data["code"],PDO::PARAM_STR);
        $stmt -> bindParam(":description", $data["description"], PDO::PARAM_STR);
        $stmt -> bindParam(":stock", $data["stock"], PDO::PARAM_STR);
        $stmt -> bindParam(":buying_price", $data["buying_price"], PDO::PARAM_STR);
        $stmt -> bindParam(":selling_price", $data["selling_price"], PDO::PARAM_STR);
        $stmt -> bindParam(":image", $data["image"], PDO::PARAM_STR);

        if($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    //delete products
    static public function mdlDeleteProducts($table, $data) {

        $stmt = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");

		$stmt -> bindParam(":id", $data, PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return 'ok';
		
		} else {

			return 'error';
		
		}
		
		$stmt = null;
    }

    //active products
    static public function mdlActiveProducts($table, $item1, $value1, $valueProductId) {
        $stmt = Connection::connect()->prepare("UPDATE $table SET $item1=:$item1 WHERE id=:id");

        $stmt -> bindParam(":".$item1, $value1, PDO::PARAM_STR);
        $stmt -> bindParam(":id", $valueProductId, PDO::PARAM_STR);

        if($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }
}