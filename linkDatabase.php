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
              

header("Content-Type: text/xml;charset=iso-8859-1"); // header info
$path = '.';
$filename = 'Data.rss';
header ("Content-Disposition: attachment; filename=$filename");
$xml = new SimpleXMLElement('<city_data/>');
    
echo "<?xml version='1.0' encoding='UTF-8' ?>" . PHP_EOL; //head of XML file, PHP_EOL for end of line
echo "<rss version='2.0'>".PHP_EOL;//starts rss tag and sets version
    echo '<channel>' . PHP_EOL; //open channel
        echo '<title>Twin Cities</title>' . PHP_EOL; // title of rss
        echo '
        <link>http://localhost:8000/cwk/DatabaseRss.php</link>'. PHP_EOL;// link to page
        echo '<description>Twin City Infomation</description>'. PHP_EOL; // descripton of page
        echo '<language>en</language>'. PHP_EOL; //setting language
        echo '<copyright> RSS </copyright>'. PHP_EOL; //copyright

        $previouscity = 0;
        $previousplace = 0;

        // getting results of database
        foreach($results as $result)
        {

        //setting the defaults
        $city_id = $result['city_id'];
        $place_id = $result['place_id'];


        // if statement to make sure the city information is only displayed once
        if ($city_id > $previouscity){
        echo '<item>'. PHP_EOL;
            echo '<city>'. PHP_EOL;

                echo '<CityName>' . $result['city_name'] . '</CityName>'. PHP_EOL;
                echo '<CountryName>' . $result['country_name'] . '</CountryName>'. PHP_EOL;
                echo '<Population>' . $result['population'] . '</Population>'. PHP_EOL;
                echo '<CityLat>' . $result['city_lat'] . '</CityLat>'. PHP_EOL;
                echo '<CityLong>' . $result['city_long'] . '</CityLong>'. PHP_EOL;
                echo '<Woeid>' . $result['woeid'] . '</Woeid>'. PHP_EOL;
                echo '<Currency>' . $result['currency'] . '</Currency>'. PHP_EOL;
                echo '<Region>' . $result['region'] . '</Region>'. PHP_EOL;
                echo '<TimeZone>' . $result['time_zone'] . '</TimeZone>'. PHP_EOL;
                echo '<Area>' . $result['area'] . '</Area>'. PHP_EOL;
                echo '<PostalCode>' . $result['postal_code'] . '</PostalCode>'. PHP_EOL;
                echo '</city>'. PHP_EOL;
            echo '</item>'. PHP_EOL;
        }

        echo '<item>'. PHP_EOL;
            //Creating an if satement to not repeat places, when there are two categorys
            if ($place_id !== $previousplace){

            echo '<place>'. PHP_EOL;
                echo '<PlaceName>' . $result['place_name'] . '</PlaceName>'. PHP_EOL;
                echo '<Capacity>' . $result['capacity'] . '</Capacity>'. PHP_EOL;
                echo '<PlaceLat>' . $result['place_lat'] . '</PlaceLat>'. PHP_EOL;
                echo '<PlaceLong>' . $result['place_long'] . '</PlaceLong>'. PHP_EOL;
                echo '<Category>' . $result['category_name'] . '</Category>'. PHP_EOL;
                //All photos have Creative Commons licenses
                echo '<Photo>images/' . $result['photo_name'] . '</Photo>'. PHP_EOL;
                echo '</place>'. PHP_EOL;
            }
            //echoing the second category if there is one
            else {echo '<Category>' . $result['category_name'] . '</Category>'. PHP_EOL;}

            //setting the
            $previouscity = $city_id;
            $previousplace = $place_id;


            echo '</item>'. PHP_EOL;

        }

        echo '</channel>'. PHP_EOL; //closes channel
    echo '</rss>'. PHP_EOL; // closes rss tag


//Error message (catch)
}catch(Exception $e) {
die("<h3> Sorry, data is unavailable</h3>");
}

?>
