<?php
include("connection.php");
$sql    = "SELECT * FROM lopp";
$result = mysqli_query($dbc, $sql);

if (mysqli_num_rows($result) > 0) {
    $rows = array();
    while ($row = mysqli_fetch_array($result)) {

        $rows[] = $row;
    }

    echo json_encode($rows);
	var_dump($rows);
} else {
    echo "no results found";
}

mysqli_close($dbc);
?>