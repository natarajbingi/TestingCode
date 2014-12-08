<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "mmdb");

$result = $conn->query("SELECT * FROM  `sales`");
//(`slno`, `empid`, `DATE`, `billno`, `name`, `pid`, `cat`, `saleb`, `salel`, `amount`, `discount`, `comment`, `ptype`)
$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"slno":"'  . $rs["slno"] . '",';
    $outp .= '"empid":"'  . $rs["empid"] . '",';
    $outp .= '"DATE":"'  . $rs["DATE"] . '",';
    $outp .= '"billno":"'   . $rs["billno"]. '",';
    $outp .= '"name":"'. $rs["name"]. '",';
    $outp .= '"pid":"'. $rs["pid"]. '",';
    $outp .= '"cat":"'. $rs["cat"]. '",';
    $outp .= '"saleb":"'. $rs["saleb"].  '",';
    $outp .= '"salel":"'. $rs["salel"]. '",';
    $outp .= '"amount":"'. $rs["amount"].'",';
    $outp .= '"discount":"'. $rs["discount"]. '",';
    $outp .= '"comment":"'. $rs["comment"]. '"}';
}
$outp .="]";

$conn->close();

echo($outp);
