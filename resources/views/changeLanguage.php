<?php
session_start();
switch($_SESSION['language']) {
    case "DE": 
        $_SESSION['language'] = "EN";
        break; 
    default: 
        $_SESSION['language'] = "DE";
        break;
}