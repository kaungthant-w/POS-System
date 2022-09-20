<?php

require_once "connection.php";

class ModelSell {

    //show sales
    static public function mdlShowSell( $table, $item, $value ) {

        if($item != null) {
            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY id ASC");

            $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();
            return $stmt -> fetch();
        } else {
            $stmt = Connection::connect()->prepare("SELECT * FROM $table ORDER BY id ASC");
            $stmt -> execute();
            return $stmt -> fetchAll();
        }
        
        $stmt = null;
    }

     // create sales
     static public function mdlCreateSales($table, $data) {
        $stmt = Connection::connect()->prepare("INSERT INTO $table(code, client_id, seller_id , products, taxes, net_price, total, payment_method)VALUES(:code, :client_id, :seller_id, :products, :taxes, :net_price, :total, :payment_method)");

        $stmt -> bindParam(":code", $data["code"], PDO::PARAM_INT);
        $stmt -> bindParam(":client_id", $data["client_id"],PDO::PARAM_INT);
        $stmt -> bindParam(":seller_id", $data["seller_id"], PDO::PARAM_INT);
        $stmt -> bindParam(":products", $data["products"], PDO::PARAM_STR);
        $stmt -> bindParam(":taxes", $data["taxes"], PDO::PARAM_STR);
        $stmt -> bindParam(":net_price", $data["net_price"], PDO::PARAM_STR);
        $stmt -> bindParam(":total", $data["total"], PDO::PARAM_STR);
        $stmt -> bindParam(":payment_method", $data["payment_method"], PDO::PARAM_STR);

        if($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    // Edit sales
    static public function mdlEditeSales($table, $data) {
        $stmt = Connection::connect()->prepare("UPDATE $table SET client_id = :client_id, seller_id = :seller_id , products = :products, taxes = :taxes, net_price = :net_price, total = :total, payment_method = :payment_method WHERE code = :code");

        $stmt -> bindParam(":code", $data["code"], PDO::PARAM_INT);
        $stmt -> bindParam(":client_id", $data["client_id"],PDO::PARAM_INT);
        $stmt -> bindParam(":seller_id", $data["seller_id"], PDO::PARAM_INT);
        $stmt -> bindParam(":products", $data["products"], PDO::PARAM_STR);
        $stmt -> bindParam(":taxes", $data["taxes"], PDO::PARAM_STR);
        $stmt -> bindParam(":net_price", $data["net_price"], PDO::PARAM_STR);
        $stmt -> bindParam(":total", $data["total"], PDO::PARAM_STR);
        $stmt -> bindParam(":payment_method", $data["payment_method"], PDO::PARAM_STR);

        if($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    // delete sales
    static public function mdlDeleteSale($table, $data) {
        $stmt = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");

		$stmt -> bindParam(":id", $data, PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return 'ok';
		
		} else {

			return 'error';
		
		}
		
		$stmt = null;
    }

    // range date
    static public function mdlDateRangeSale($table, $initialDate, $endDate) {
        if($initialDate == null) {

            $stmt = Connection::connect()->prepare("SELECT * FROM $table ORDER BY id ASC");
            $stmt -> execute();
            return $stmt -> fetchAll();

        } else if ($initialDate == $endDate) {
            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE date like '%$initialDate%'");

            $stmt -> bindParam(":date", $initialDate, PDO::PARAM_STR);
            $stmt -> execute();
            return $stmt -> fetchAll();

        } else {
            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE date BETWEEN '$initialDate' AND '$endDate'");
            $stmt -> execute();
            return $stmt -> fetchAll();

        }
    }
}

