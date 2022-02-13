<!DOCTYPE html>

<?php
//setting defaults
$config = include('config.php');
   $tag = 'Leeds'; 
   $weather = 'Current';
   $api = $config['weatherapi'];;
   ?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>City Weather</title>
    <meta name="description" content="atwd1 wk 2 - html file">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pure/2.0.3/pure-min.css">
    <!--<link rel="stylesheet" href="css.css">-->
</head>

<body>
    <section id="navbar" class="navbar smart-scroll navbar-dark bg-dark">
    <h4 class="display-4 text-white">City Weather</h4>
    <!-- Form to chose city/tag and what license -->
    <form class="form-inline" id="weather_form" method="post">
        <select id="City" name="City" class="custom-select">
            <option value="Leeds" selected>Leeds</option>
            <option value="Brno">Brno</option>
        </select>
        <select id="Weather" name="Weather" class="custom-select">
            <option value="Current" selected>Current Weather</option>
            <option value="Five">5 Day Forecast</option>
        </select>
        <input class="input-submit btn btn-outline-success" type="submit" name="submit" value="Get weather data" />
    </form>
    </section>
    <?php
if (isset($_POST["submit"]))
{
    $tag = $_POST['City'];

    $weather = $_POST['Weather'];

}

if ($weather == 'Five')
{

    //sets url
    $urlforcast = 'http://api.openweathermap.org/data/2.5/forecast?q=' . $tag . '&cnt=5&mode=xml&appid='. $api;

    //loads xml
    $getforecast = simplexml_load_file($urlforcast) or die("Error: Cannot create object");
    
        echo '<h3 class="display-4">' . $tag . '</h3><section class="row">';
    //gets individual piece of information
    foreach ($getforecast
        ->forecast->time as $forecast)
    {

        //gets individual piece of information
        //get forecast date and time
        $gettimef = $forecast['from'];
        $gettimet = $forecast['to'];

        //get forecast temerature information
        $gettempa = $forecast->temperature['value'];
        $getmaxtemp = $forecast->temperature['max'];
        $gettempl = $forecast->temperature['min'];
        //gets feels like
        $getfeel = $forecast->feels_like['value'];

        //get forecast clouds
        $getclouds = $forecast->clouds['value'];

        //get forecast precipitation chance
        $getrain = $forecast->precipitation['probability'];

        //get forecast wind information
        $getwindn = $forecast->windSpeed['name'];
        $getwindv = $forecast->windSpeed['value'];
        $getwindu = $forecast->windSpeed['unit'];
        $getwindd = $forecast->windDirection['code'];

        //get humidity
        $gethumidityv = $forecast->humidity['value'];
        $gethumidityu = $forecast->humidity['unit'];

        //echoing  weather data as HTML, if not empty
        if (!empty($gettimef) and !empty($gettimet))
        {
            ?>
    
            <section class="card mb-3 col-md-4" style="max-width: 18rem;">
            <h4 class="card-header"><?=$gettimef?> to  <?=$gettimet?></h4>
            <section class="card-body">
                
            <?php
        }

        if (!empty($getwindn) and !empty($getclouds))
        {
            echo '<p> Summary : ' . $getwindn . ' with ' . $getclouds . '</p>';
        }

        if (!empty($gettempa))
        {
            echo '<p>Average temperature : ' . $gettempa . '°C</p>';
        }

        if (!empty($gettempl) and !empty($getmaxtemp))
        {
            echo '<p>Minimum temperature : ' . $gettempl . '°C and maximum temperature : ' . $getmaxtemp . '°C</p>';
        }

        if (!empty($getfeel))
        {
            echo '<p>Feels like : ' . $getfeel . '°C</p>';
        }

        if (!empty($getwindv) and !empty($getwindu) and !empty($getwindd))
        {
            echo '<p>Wind : ' . $getwindv . '' . $getwindu . ' from ' . $getwindd . ' direction</p>';
        }

        if (!empty($getrain))
        {

            echo '<p>Chances of precipitation : ' . $getrain * 100 . '%</p>';
        }

        if (!empty($gethumidityv) and !empty($gethumidityu))
        {
            echo '<p>Humidity : ' . $gethumidityv . '' . $gethumidityu . '</p>';
            echo '</section></section>';
        }

    }

}

if ($weather == 'Current')
{

    //sets url
    $urlweather = 'http://api.openweathermap.org/data/2.5/weather?q=' . $tag . '&units=metric&mode=xml&APPID='. $api;

    //loads xml
    $getweather = simplexml_load_file($urlweather);

    //gets individual piece of information
    //get humidity
    $gethumidityv = $getweather->humidity['value'];
    $gethumidityu = $getweather->humidity['unit'];

    //get temerature
    $gettemp = $getweather->temperature['value'];
    //gets feels like
    $getfeel = $getweather->feels_like['value'];

    //get cloud type
    $getclouds = $getweather->clouds['name'];

    //gets wind information
    $getwindn = $getweather
        ->wind
        ->speed['name'];
    $getwindv = $getweather
        ->wind
        ->speed['value'];
    $getwindu = $getweather
        ->wind
        ->speed['unit'];
    $getwindd = $getweather
        ->wind
        ->direction['code'];

    //get precipitation
    $getrain = $getweather->precipitation['mode'];

    //echos out the weather data as HTML
    ?>
    <section>
        <h3 class="display-4"><?= $tag ?></h3>
    </section>
                <section class="row">
    
    <section class="card">
    <section class="card-header">
    <h4><strong><?=date('l jS M Y')?></strong></h4>
    <h4>Weather at <?=date("h:i:sa")?></h4>
    </section>
    <section class="card-body">
    <p> Summary : <?= $getwindn ?> with <?= $getclouds ?></p>
    <p>Temperature : <?= $gettemp?>°C</p>
    <p>Feels like : <?= $getfeel ?>°C</p>
    <p>Wind : <?= $getwindv ?><?= $getwindu ?> from <?= $getwindd ?> direction</p>
    <p>Precipitation : <?= $getrain ?></p>
    <p>Humidity : <?= $gethumidityv ?><?= $gethumidityu ?></p>
        </section></section></section>
<?php
}

?>
</section>
</body>

</html>
