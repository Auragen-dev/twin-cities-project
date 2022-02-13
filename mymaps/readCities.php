<?php     
    
        // Open connection o mysql db
        $connection = mysqli_connect("localhost","root","","cities_database") or die("Error " . mysqli_error($connection));

        // Fetch table rows from mysql db
        $sql = "SELECT city_id, city_name, city_lat, city_long FROM city";
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