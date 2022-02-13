<!DOCTYPE html>

<?php 
//setting defaults
$config = include('config.php');
   $tag = 'Leeds'; 
   $api = $config['newsapi'];
   ?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>City News</title>
    <meta name="description" content="atwd1 wk 2 - html file">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pure/2.0.3/pure-min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="css.css">-->
</head>

<body>

    <!-- Form to chose city/tag and what license -->
    <nav class="row navbar navbar-dark bg-dark">
        <form class="form-inline" id="weather_form" method="post">
            <h3 class="display-4 text-white">City News</h3>
            <div class="col-md-4">
                <select class="custom-select" id="City" name="City">
                    <option value="Leeds" selected>Leeds</option>
                    <option value="Brno">Brno</option>
                </select>
                <input class="input-submit btn btn-outline-success" type="submit" name="submit" value="Get News" /></div>
        </form>
    </nav>
    <section class="fill"></section>
    <section class="articleContainer container-fluid">
        <?php
          
if (isset($_POST["submit"]))
{
    $tag = $_POST['City'];


}
    $newsurl = 'http://newsapi.org/v2/everything?q='.$tag.'&apiKey='. $api;
        $data = json_decode(file_get_contents($newsurl));
        $i = 0;
        $articles = $data->articles;
         foreach ($articles as $article) {
             if ($i == 0){
                 echo '<section class = "row">';
             }
             ?>
            <section class="container col-md-4">
             <section class="article card" style="width: 25rem;">
             <h2 class="card-header"><?=$article->title?></h2>
            <section class="card-body">
             <h3> Author: <?=$article->author?></h3>
             <h4> Description: <?=$article->description?></h4>
             <p><?=$article->content?></p>
             </section></section></section>
        <?php
             if ($i >= 2){
                 echo '</section>';
                 $i = 0;
             }
             else{$i++;}
             
         }

   ?>
    </section>
    <script src="js.js"></script>
</body>

</html>
