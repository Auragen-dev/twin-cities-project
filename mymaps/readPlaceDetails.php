<?php
    // Open connection o mysql db
    $connection = mysqli_connect("localhost","root","","cities") or die("Error " . mysqli_error($connection));

    // Fetch table rows from mysql db
    $getID = $_GET["id"];
    $sql = "SELECT * FROM place WHERE place_id='$getID'";
    $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

    // Create an array
    $placeNameArray = array();
    while($row = mysqli_fetch_assoc($result))
    {
        $placeNameArray[] = $row;
    }
    echo json_encode($placeNameArray);

    // Close the db connection
    mysqli_close($connection);

?>