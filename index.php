<?php

use App\Http\Controllers\MediaController;
use App\Validetion\Request;

include "vendor/autoload.php";

function view()
{
    return header("location:views/index.php");
}
view();
$_SESSION['response'] = MediaController::store($_POST);
$_SESSION['oldValues'] = $_POST;
