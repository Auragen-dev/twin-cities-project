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
    <script>
        var category2 = [];
        var c = [];
    </script>
<body id="important">
    <section class="navbar navbar-dark bg-dark photo-form">

        <!-- Form to chose city/tag and what license -->
        <form class="form-inline" id="photo_form" method="post">
            <section class="input-group">
                <!--Button to open photos menu-->
                <a href="javascript:void(0)" class="photoMenuButton" onclick="photoMenu()">
                    <i id="photoArrow" class="material-icons btn btn-secondary">keyboard_arrow_down</i>
                </a>
                <a href="javascript:void(0)" class="xmlButton" onclick="xmlMenu()">
                    <i id="xmlArrow" class="material-icons btn btn-light">keyboard_arrow_down</i>
                </a>

                <!-- This option is just to show that better images can appear, but they have copyright and shouldn't really be used -->
                <select id="License" name="License">
                    <!-- 9 and 10 = No Copyright -->
                    <option value="9,10" selected>Copyright Free</option>
                    <option value="0,1,2,3,4,5,6,7,8,9,10">No Specific License</option>
                </select>
                <input class="btn btn-outline-success" id="photoButton" type="submit" name="submit" value="Get photos" />
            </section>
            <!-- No numbers or special characters, it would mess up the api call -->
            <input type="text" id="City" name="City" class="form-control" placeholder="City / tag" pattern="[a-zA-Z]*">
        </form>

    </section>
    <section id="xml-form">
        <form class="form-inline" id="update_form" method="post">
            <input class="input-submit" type="submit" name="update" value="Click to Load XML" />
            <input class="input-submit" type="submit" name="load" value="Reload Page" />
        </form>
    </section>
    <?php
if (isset($_POST["update"]))
{
    ob_start();
    //change to your path
    $rss_url = 'http://localhost/cwk/linkDatabase.php';
    header('Location: ' . $rss_url);
    ob_end_flush();

}
if (isset($_POST["load"]))
{
    header("Refresh:0");

}

//setting the defaults, tag that is not used
$config = include('config.php');
$api = $config['flickrapi'];
$tag = 'defaultnone';
$license = '';
$cache = array();

//reads the submit test to get the search, and license options
if (isset($_POST["submit"]))
{
    $tag = $_POST['City'];

    $license = $_POST['License'];

}

/*---------------------------------------------------------------------------------------------------------------------------------------------------------
 Code for photo wiget*/
   
       
//Get the photos
$urlphotos = 'https://www.flickr.com/services/rest/?method=flickr.photos.search&api_key='. $api .'&tags=' . $tag . '&format=json&nojsoncallback=1&per_page=10&license=' . $license;
//9 and 10 = Public Domain Dedication
       
//loads json
$data = json_decode(file_get_contents($urlphotos)) or die("Error: Cannot create object");

$photos = $data->photos->photo;
 
echo '<section id="photoGrid" class="photoGrid">';
//gets individual photo
foreach ($photos as $photo)
{
    if (in_array($photo->id, $cache) == false)
    {
        $urlphoto = 'http://farm' . $photo->farm . '.staticflickr.com/' . $photo->server . '/' . $photo->id . '_' . $photo->secret . '.jpg';
        echo '<section class="photo"> <span><img src= "' . $urlphoto . '" height=140px></span></section>';
       }


    array_push($cache, $photo->id);
}
echo '</section>';
echo'<section class="citiesAndPlaces">';
    
?>
    <script>
    function categoryFix(category1, category2, c){ //variable 'c' is the counter from the PHP code
    var categoryText = document.getElementById("c"+(c-1));
    var categoryHtml = categoryText.innerHTML;
    var res = categoryHtml.split(":");
    var category1 = res[1];
    categoryText.innerHTML = "Categories: "+category1.trim()+" | "+category2;
}
    </script>
    <?php
/*---------------------------------------------------------------------------------------------------------------------------------------------------------
 Code for RSS Feed*/

//sets file
$file_name = 'data.rss';

//loads xml
$getitem = simplexml_load_file($file_name) or die("Error: Cannot create object");

//gets individual piece of information
echo '<h4 class="display-4">' . $getitem
    ->channel->title . '</h4>';
     $i = 0;
    $c = 0;
foreach ($getitem
    ->channel->item as $item)
{

    //get city information
    $getcity_name = $item->city->CityName;
    $getcountry_name = $item->city->CountryName;
    $getpopulation = $item->city->Population;
    $getcity_lat = $item->city->CityLat;
    $getcity_long = $item->city->CityLong;
    $getwoeid = $item->city->Woeid;
    $getcurrency = $item->city->Currency;
    $getregion = $item->city->Region;
    $gettimezone = $item->city->TimeZone;
    $getarea = $item->city->Area;
    $getpost = $item->city->PostalCode;

    //get place information
    $getplace_name = $item->place->PlaceName;
    $getcapacity = $item->place->Capacity;
    $getplace_lat = $item->place->PlaceLat;
    $getplace_long = $item->place->PlaceLong;
    $getplace_cat1 = $item->place->Category;
    $getplace_cat2 = $item->Category;
    $getplace_photo = $item->place->Photo;

    //echoing city information, if not empty
    if (!empty($getcity_name))
    {
        if ($i > 0){echo '</section>';}
        echo '';
        echo '<section id="cityInfo'.$i.'" class="cityInfo container col-md-3">';
        echo '<h3 class="display-5">City Name : ' . $getcity_name . '</h3>';
    }

    if (!empty($getcountry_name))
    {
        echo '<p>Country Name : ' . $getcountry_name . '</p>';
    }

    if (!empty($getpopulation))
    {
        echo '<p>Population : ' . $getpopulation . '</p>';
    }

    if (!empty($getcity_lat))
    {
        echo '<p>City Latitude : ' . $getcity_lat . '</p>';
    }

    if (!empty($getcity_long))
    {
        echo '<p>City Longitude : ' . $getcity_long . '</p>';
    }

    if (!empty($getwoeid))
    {
        echo '<p>City Woeid : ' . $getwoeid . '</p>';
    }

    if (!empty($getcurrency))
    {
        echo '<p>City Currency : ' . $getcurrency . '</p>';
    }

    if (!empty($getregion))
    {
        echo '<p>City Region : ' . $getregion . '</p>';
    }

    if (!empty($gettimezone))
    {
        echo '<p>City TimeZone : ' . $gettimezone . '</p>';
    }

    if (!empty($getarea))
    {
        echo '<p>City Area : ' . $getarea . '</p>';
    }

    if (!empty($getpost))
    {
        echo '<p>City PostalCode : ' . $getpost .'</p>';
        echo '<a href="javascript:void(0)" class="placesMenuButton" onclick="placeMenu('.strval($i).')">';
        echo '<section id="placeExtend'.$i.'" class="placeExtend">';
        echo '<i id="placesArrow'.$i.'" class="material-icons btn btn-dark btn-block">keyboard_arrow_down</i></section></a>';
        echo '</section><section id="places'.$i.'" class="places row">';

        
        $i++;//Incriments the counter by 1.
        
    }
    
    //echoing place information
    //All photos have Creative Commons licenses
    if (!empty($getplace_photo))
    {   
        echo '<section class="container-fluid col-md-2">';
        //echo '<span class="border-right">';
        echo '<section class="place card" style="width: 13rem;">';
        echo '<img src = ' . $getplace_photo . ' class="card-img-top" alt=' . $getplace_photo . '>';
        
    }
    if (!empty($getplace_name))
    {
        echo '<section class="card-body">';
        echo '<h5 class="card-title">Place Name : ' . $getplace_name . '</h4>';
        
    }
    //get only or first category
    if (!empty($getplace_cat1))
    {
        echo '<p id="c'.$c.'">Category : ' . $getplace_cat1 .'</p>';
        
    }
    //get second category, if there is one
    if (!empty($getplace_cat2))
    {  
        ?>
            <script type="text/javascript">
                var category1 = "<?=$getplace_cat1?>";
                var category2 = "<?=$getplace_cat2?>";
                var c = <?=$c?>;
                categoryFix(category1, category2, c);
            </script>';
    <?php
    }
    elseif (empty($getplace_cat2) and !empty($getplace_name)){
        $c++;
    }
    if (!empty($getcapacity))
    {
        echo '<p>Place Capacity : ' . $getcapacity . '</p>';
    }

    if (!empty($getplace_lat))
    {
        echo '<p>Place Latitude : ' . $getplace_lat . '</p>';
    }

    if (!empty($getplace_long))
    {
        echo '<p>Place Longitude : ' . $getplace_long . '</p>';
    }

    if (!empty($getplace_name)){
        echo '</section></section></section>';
    }
        
}
    

?>
    </section>
    <script>       
        const cityInfo0Height = document.getElementById("cityInfo0").style.height;
        const cityInfo1Height = document.getElementById("cityInfo1").style.height;
    </script>
    <script src="js.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>
