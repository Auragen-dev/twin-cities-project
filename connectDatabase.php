<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>RSS Feed & Photos</title>
    <meta name="description" content="atwd1 wk 2 - html file">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pure/2.0.3/pure-min.css">
    <link rel="stylesheet" href="css.css">
</head>
    
    <body>
<?php
$config = include('config.php');
//try to do connection
try {
               $db = new PDO('mysql:host='. $config['host'].';dbname='. $config['name'].';charset=utf8', ''. $config['user'].'', ''. $config['pass'].'');
               $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
              
               #Prepare and execute query
               $sth = $db->Prepare(
                    "SELECT s.city_id, s.city_name, s.country_name, s.population, s.city_long, s.city_lat, s.woeid, s.currency, s.region, s.time_zone, s.area, s.postal_code, n.place_name,  n.capacity, n.place_long, n.place_lat, n.city_id, c.place_id, c.category_id, ss.category_id, ss.category_name, ss.category_icon, cc.photo_id, cc.place_id, cc.photo_name 
                    FROM city s 
                    JOIN place n ON s.city_id = n.city_id 
                    JOIN place_cat c ON c.place_id = n.place_id 
                    JOIN cat ss ON ss.category_id = c.category_id
                    JOIN photo cc ON cc.place_id = n.place_id
                    ORDER BY n.place_id");
            
          //execute the statement
          $sth->execute();
              
          //fetch all rows in the result set as an array of arrays
          $results = $sth->fetchAll(PDO::FETCH_ASSOC);
              
          //close the connection
          $db->connection = null;
              
 
$previouscity = 0;
$previousplace = 0;
    


        
          //output array 
          foreach($results as $result) {
              
//setting the defaults
$city_id = $result['city_id'];
$place_id = $result['place_id'];
              
if ($city_id > $previouscity){ 

              echo '<h3 class="display-5">City Name : ' . $result['city_name'] . '</h3>';
              echo '<p> Country Name: '.$result['country_name'].'</p>';
              echo '<p> Population: '.$result['population'].'</p>';
              echo '<p> Woeid: '.$result['woeid'].'</p>';
              echo '<p> Currency: '.$result['currency'].'</p>';
              echo '<p> Region: '.$result['region'].'</p>';
              echo '<p Time Zone: >'.$result['time_zone'].'</p>';
              echo '<p> Area: '.$result['area'].'</p>';
              echo '<p> Postal Code: '.$result['postal_code'].'</p>';
              echo '<p> Latitude: '.$result['city_lat'].'</p>';
              echo '<p> Longitude: '.$result['city_long'].'</p>';
}

if ($place_id !== $previousplace){ 
              echo '<h5 class="card-title">Place Name : ' . $result['place_name'] . '</h4>';
              echo '<p> Country Name: '.$result['capacity'].'</p>';
              echo '<p> Population: '.$result['place_lat'].'</p>';
              echo '<p> Woeid: '.$result['place_long'].'</p>';
              echo '<p> Category: '.$result['category_name'].'</p>';
        echo '<img src = images/' . $result['photo_name'] . ' class="card-img-top" alt=' . $result['photo_name'] . '>';

    
}
            
            else {echo '<p> Category: '.$result['category_name'].'</p>';}
              
  //setting the updates
  $previouscity = $city_id;  
  $previousplace = $place_id;
        }

    

//Error message (catch)
}catch(Exception $e) {
              die("<h3> Sorry, data is unavailable</h3>");
          }

?>
        </body>
</html>