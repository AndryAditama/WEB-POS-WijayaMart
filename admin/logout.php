<?php
include "config.php";
session_start();
session_destroy(); //mematikan session
header('location:login.php'); //dan mengarahkan pada masuk.php/form login
