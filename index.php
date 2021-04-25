<?php
include_once("db.php");
function where_or_and($q, $s){
  $buffer = $s ? " AND" : " WHERE";
  $q .= $buffer;
  return $q;
}
parse_str($_SERVER['QUERY_STRING'], $output);
$start = False;
$query = "SELECT * FROM task";

if(isset($output['subject'])){
  $query = where_or_and($query,$start);
  $query .= " subject=" . "'" . $output['subject'] . "'";
  $start = True;
}

if(isset($output['date']['gt'])){
  $query = where_or_and($query,$start);
  $query .= "  date>=" . "'" . $output['date']['gt'] . "'";
  $start = True;
}

if(isset($output['date']['eq'])){
  $query = where_or_and($query,$start);
  $query .= " date=" . "'" . $output['date']['eq'] . "'";
  $start = True;
}

if(isset($output['date']['lt'])){
  $query = where_or_and($query,$start);
  $query .= " date<=" . "'" . $output['date']['lt'] . "'";
  $start = True;
}

if(isset($output['name'])){
  $query = where_or_and($query,$start);
  $query .= " name=" . "'" . $output['name'] . "'";
  $start = True;
}


if(isset($output['mark']['lt'])){
  $query = where_or_and($query, $start);
  $query .= " mark <=" . $output['mark']['lt'];
  $start = True;
}
if(isset($output['mark']['eq'])){
   $query = where_or_and($query, $start);
   $query .= " mark =" . $output['mark']['eq'];
   $start = True;
 }
 if(isset($output['mark']['gt'])){
   $query = where_or_and($query, $start);
   $query .= " mark >=" . $output['mark']['gt'];
   $start = True;
 }


if(isset($limit)){
  $query .= " LIMIT " . $limit;
}
$result = mysqli_query($conn, $query);
if(!$result){
    die("query failed");
}


while ($row = mysqli_fetch_assoc($result)){
    $data[]=$row;
}

echo json_encode($data);


?>

