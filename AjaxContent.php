<?php

header("Content-Type: text/html; charset=UTF-8");
$count = $_POST['count'];
$mysqli = new Mysqli('localhost', 'root', '', 'malmart');
$mysqli->query("SET NAMES utf8");
$r = array();
$result = $mysqli->query(mysql_real_escape_string("SELECT * FROM `tbl_chat`"));
while($row = $result->fetch_assoc()) {
    $r[] = $row;
}
if(empty($r)) {
    echo "empty";
} else {
    for ($i=0;$i < count($r);$i++) {
        $data=$r[$i];
        $rows[$i] = '['.date('d.m.Y  H:i:s',$data['created']).'] '.$data['username'].': '.$data['message'];
        echo '<tr><td>'.$rows[$i].'</td></tr>';
    }
    //echo json_encode($r);
}
?>
