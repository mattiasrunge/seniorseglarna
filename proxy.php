<?php

$html = file_get_contents("https://docs.google.com/document/d/" . $_GET["id"] . "/pub?embedded=true");

$styleStart = strpos($html, "<style");
$styleEnd = strrpos($html, "</style>", $styleStart) + 8;



$bodyStart = strpos($html, "<body");
$bodyStart = strpos($html, ">", $bodyStart) + 1;

$bodyEnd = strrpos($html, "</body>");

header("content-type", "text/html; charset=utf-8");
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

//echo substr($html, $styleStart, $styleEnd - $styleStart);
echo utf8_encode(html_entity_decode(utf8_decode(substr($html, $bodyStart, $bodyEnd - $bodyStart))));

?>