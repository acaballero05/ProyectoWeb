<?php

require_once 'controllers/LayoutController.php';

$layoutController = new LayoutController();
$layoutController->view('login');

?>