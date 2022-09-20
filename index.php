<?php
include_once "controllers/templates.controller.php";
include_once "controllers/category.controller.php";
include_once "controllers/client.controller.php";
include_once "controllers/product.controller.php";
include_once "controllers/sale.controller.php";
include_once "controllers/users.controller.php";

include_once "models/category.model.php";
include_once "models/client.model.php";
include_once "models/product.model.php";
include_once "models/sale.model.php";
include_once "models/users.model.php";

$template = new ControllerTemplate();

$template -> ctrlTemplate();