<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Cache-Control" content="private" />
<meta http-equiv="Expires" content="86400000" />
<meta http-equiv="Cache-Control" content="max-age=86400000" />

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pure/2.0.3/pure-min.css">
    <!--<link rel="stylesheet" href="css.css">-->
    <title>Photos</title>
    <meta charset='utf-8' />
</head>

<body>
    <section id="navbar" class="navbar navbar-dark bg-dark smart-scroll">
        <h5 class="display-4 text-white">City Photos</h5>
        <!-- Form to chose city/tag and what license -->
        <form class="form-inline" id="photo_form" method="post">
            <!-- No numbers or special characters, it would mess up the api call -->
            <input type="text" id="City" name="City" class="input-medium form-control" placeholder="City / tag" pattern="[a-zA-Z]*">
            <!-- This option is just to show that better images can appear, but they have copyright and shouldn't really be used -->
            <select class="custom-select" id="License" name="License">
                <!-- 9 and 10 = No Copyright -->
                <option value="9,10" selected>Copyright Free</option>
                <option value="0,1,2,3,4,5,6,7,8,9,10">No Specific License</option>
            </select>
            <input class="input-submit btn btn-outline-success" type="submit" name="submit" value="Get photos" />
        </form>
    

        <form class="input-group mb-3" action="upload.php" method="post" enctype="multipart/form-data">
            <section class="input-group-prepend">
                <input class="btn btn-outline-secondary" id="uploadFile" type="submit" value="Upload File"/>
            </section>
            <section class="custom-file">
                <input class="custom-file-input" id="inputFile" aria-describedby="uploadFile" type="file" name="file" size="50" />
                <label class="custom-file-label" for="inputFile">Choose file</label>
            </section>
            
        </form>
        </section>
    <section class="row">
    <?php
       
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
         
         
         //Get the photos
          $urlphotos = 'https://www.flickr.com/services/rest/?method=flickr.photos.search&api_key='. $api .'&tags=' . $tag . '&format=json&nojsoncallback=1&per_page=10&license=' . $license;
         //9 and 10 = Public Domain Dedication
             
         //loads json
         $data = json_decode(file_get_contents($urlphotos)) or die("Error: Cannot create object");
         
         $photos = $data
             ->photos->photo;
         
         //gets individual photo
         foreach ($photos as $photo)
         {
             if (in_array($photo->id,$cache)== false)
             {
                 
                 $urlphoto = 'http://farm' . $photo->farm . '.staticflickr.com/' . $photo->server . '/' . $photo->id . '_' . $photo->secret . '.jpg';
                 ?>
                <section class="card col-md-4" style="width: 18rem;">
                <img src= "<?=$urlphoto?>" class="card-img-top">
                    <section class="card-body">
                    <a href="<?=$urlphoto?>" class="btn btn-primary">Open full image</a>
                    </section>
                </section>
                <span></span>
    <?php
                 
             }
             
               array_push($cache, $photo->id);
         }

         ?>
    </section>
</body>

</html>
