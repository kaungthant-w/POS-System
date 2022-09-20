<?php

include_once "connection.php";

class UserModel {

    //show user
    static public function mdlShowUser($table, $item, $value) {

        if($item != null) {
            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");
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

    //create new user
    static  public function mdlInsertUser($table, $data) {

        $stmt = Connection::connect()->prepare("INSERT INTO $table (name, user, password, profile, photo)VALUES(:name, :user, :password, :profile, :photo)");
        $stmt -> bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt -> bindParam(":user", $data["user"], PDO::PARAM_STR);
        $stmt -> bindParam(":password", $data["password"], PDO::PARAM_STR);
        $stmt -> bindParam(":profile", $data["profile"], PDO::PARAM_STR);
        $stmt -> bindParam(":photo", $data["photo"], PDO::PARAM_STR);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }

    //Update user
    static public function mdlEditUser($table, $data) {
        $stmt = Connection::connect()->prepare("UPDATE $table SET name = :name, password = :password, profile = :profile , photo = :photo WHERE user = :user");
        $stmt -> bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt -> bindParam(":user", $data["user"], PDO::PARAM_STR);
        $stmt -> bindParam(":password", $data["password"], PDO::PARAM_STR);
        $stmt -> bindParam(":profile", $data["profile"], PDO::PARAM_STR);
        $stmt -> bindParam(":photo", $data["photo"], PDO::PARAM_STR);

        if($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    //active user
    static public function mdlActiveUser($table, $item1, $value1, $item2, $value2) {
        $stmt = Connection::connect()->prepare("UPDATE $table SET $item1=:$item1 WHERE $item2=:$item2");

        $stmt -> bindParam(":".$item1, $value1, PDO::PARAM_STR);
        $stmt -> bindParam(":".$item2, $value2, PDO::PARAM_STR);

        if($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    //delete user
    static public function mdlDeleteUser($table, $data) {
        $stmt = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");
        $stmt -> bindParam(":id", $data , PDO::PARAM_STR);

        if($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;

    }

}
