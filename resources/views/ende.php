<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];

$filename= $documentRoot . "/ibsys2_backend/resources/views/output.xml";
header('Content-Type: text/xml');
header("Content-Transfer-Encoding: utf-8");
header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\"");
readfile($filename);
?>
