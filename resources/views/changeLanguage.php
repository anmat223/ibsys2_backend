<?php
if (!array_key_exists('language', $_SESSION)) {
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
