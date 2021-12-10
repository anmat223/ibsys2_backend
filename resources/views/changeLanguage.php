<?php
session_start();
if ($_SESSION['language'] == null) {
  $_SESSION["language"] = "DE";
} else {
  switch ($_SESSION['language']) {
    case "DE":
      $_SESSION['language'] = "EN";
      break;
    default:
      $_SESSION['language'] = "DE";
      break;
  }
}
