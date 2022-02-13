<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>RSS Feed & Photos</title>
      <meta name="description" content="atwd1 wk 2 - html file">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pure/2.0.3/pure-min.css">
      <style>
         body {
         margin-left:12px;
         margin-top:12px;
         margin-top:8px;
         font-size:16px;
         font-family: "Times New Roman", Times, serif;
         }
         .topright {
         position: absolute;
         top: -4px;
         right: 12px;
         }
         h2 {
         font-weight: 900;
         font-size: 15px;
         font-family: "Times New Roman", Times, serif;
         }
         h3 {
         color: #82AB6D;
         font-weight: 900;
         font-size: 20px;
         text-decoration: underline;
         font-family: "Times New Roman", Times, serif;
         }
         h4  {
         font-size: 18px;
         font-weight: 600;
         color: #065535;
         font-family: "Times New Roman", Times, serif;
         }
         td {
         vertical-align: top;
         }
         a {
         color: #6897BB;
         font-weight: 500;
         font-family: "Times New Roman", Times, serif;
         }
         figure {
         display: table;
         top: -4px;
         right: 12px;
         font-size:12px;
         font-weight: 600;     
         }
         figcaption {
         display: table-caption;
         position: absolute;
         top: -4px;
         right: 12px;
         font-size:12px;
         font-weight: 600;
         }
         .input-submit {
         background: #82AB6D;
         color: #fff;
         border: 2px solid #eee;
         border-radius: 20px;
         }
         input, select, textarea {
         font-size: 1.5em;
         }
         span{
         margin: 10px;
         }
      </style>
   </head>
   <body>
      <!-- Form to chose city/tag and what license -->
      <form class="form-inline" id="photo_form" method="post">
         <!-- No numbers or special characters, it would mess up the api call -->
         <input type="text" id="City" name="City" class="input-medium" placeholder="City / tag" pattern="[a-zA-Z]*">
         <!-- This option is just to show that better images can appear, but they have copyright and shouldn't really be used -->
         <select id="License" name="License">
            <!-- 9 and 10 = No Copyright -->
            <option value="9,10" selected>Copyright Free</option>
            <option value="0,1,2,3,4,5,6,7,8,9,10">No Specific License</option>
         </select>
         <input class="input-submit" type="submit" name="submit" value="Get photos"/>
      </form>
      <br> 
<?php


//setting the default to tags that are not used
$tag = 'defaultnone';
$license = '';
$cache = array();
$previousphoto = '0';
$config = include ('config.php');
$api = $config['flickrapi'];

//reads the submit test to get the search, and license options
if (isset($_POST["submit"]))
{
    $tag = $_POST['City'];

    $license = $_POST['License'];

}
       
//Get the photos
$urlphotos = 'https://www.flickr.com/services/rest/?method=flickr.photos.search&api_key='. $api .'&tags=' . $tag . '&format=json&nojsoncallback=1&per_page=10&license=' . $license;
//9 and 10 = Public Domain Dedication
//loads json
$data = json_decode(file_get_contents($urlphotos)) or die("Error: Cannot create object");

$photos = $data->photos->photo;
    
       
//gets individual photo
foreach ($photos as $photo)
{
       
    $previousphoto = $photo->id;

    
            $db = new PDO('mysql:host=localhost;dbname=cities_database;charset=utf8', 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
              
               #Prepare and execute query
               $sth = $db->Prepare(
                    "SELECT s.flickr_id, s.flickr_photo
                    FROM flickr s");
            
          //execute the statement
          $sth->execute();
              
          //fetch all rows in the result set as an array of arrays
          $results = $sth->fetchAll(PDO::FETCH_ASSOC);
              
          //close the connection
          $db->connection = null;
                
        foreach($results as $result) 
{
        //setting the defaults
$flickr_id = $result['flickr_photo']. PHP_EOL;
            if(!empty($flickr_id)){
            array_push($cache, $flickr_id);    
            }
        } 

    if (!empty($cache)){
    
    if (!in_array($previousphoto, $cache)){


        $urlphoto = 'http://farm' . $photo->farm . '.staticflickr.com/' . $photo->server . '/' . $photo->id . '_' . $photo->secret . '.jpg';
        echo '<span><img src= "' . $urlphoto . '" height=140px></span>';

         $db2 = new PDO('mysql:host=localhost;dbname=cities_database;charset=utf8', 'root', '');
               $db2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $db2->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
              
               #Prepare and execute query
               $sth = $db2->Prepare(
                    "INSERT INTO `flickr` (`flickr_photo`) VALUES ('" . $previousphoto . "')");
            
          //execute the statement
          $sth->execute();
              
          //fetch all rows in the result set as an array of arrays
          $results = $sth->fetchAll(PDO::FETCH_ASSOC);
              
          //close the connection
          $db2->connection = null;
 
    }
       
               
    }
    
    else {
        
       $urlphoto = 'http://farm' . $photo->farm . '.staticflickr.com/' . $photo->server . '/' . $photo->id . '_' . $photo->secret . '.jpg';
        echo '<span><img src= "' . $urlphoto . '" height=140px></span>';

         $db2 = new PDO('mysql:host=localhost;dbname=cities_database;charset=utf8', 'root', '');
               $db2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $db2->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
              
               #Prepare and execute query
               $sth = $db2->Prepare(
                    "INSERT INTO `flickr` (`flickr_photo`) VALUES ('" . $previousphoto . "')");
            
          //execute the statement
          $sth->execute();
              
          //fetch all rows in the result set as an array of arrays
          $results = $sth->fetchAll(PDO::FETCH_ASSOC);
              
          //close the connection
          $db2->connection = null; 
        
        
    }
}
 
       
       
?>
</body>
</html>