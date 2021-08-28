<?php

    $error = "";
    $weather = "";
    error_reporting(0);
    if($_POST){
        if(!$_POST["city"]){
            $error = '<div class="alert alert-danger" role="alert"><strong>We require the name of a city.</strong></div>';
        }
        else{
            $city = ucwords($_POST["city"]);
            $city = str_replace(" ","-",$city);
            $address = "https://www.weather-forecast.com/locations/$city/forecasts/latest";
            if($content = file_get_contents($address)){
                $weather = explode("The Long-range 12 day forecast also includes detail for $city weather today. Live weather reports from $city weather stations and weather warnings that include risk of thunder, high UV index and forecast gales. See the links below the 12-day $city weather forecast table for other cities and towns nearby along with weather conditions for local outdoor activities."
                                ,$content);
                $weather = explode('<div class="bn-placeholder bn-placeholder-0" id="cont_bn_by_forecast">'
                                ,$weather[1]);    
                //$weather = explode('<a class="read-more-label read-more-label-unused" href="#">Read More</a></div></div></div></div></section><section class="row expanded"><div class="small-12 column without-right"><div class="b-forecast interactive-forecast-cont"><div class="bnr"></div>'
                                //,$weather[0]);

                $weather = '<div class="alert alert-success" role="alert">'.$weather[0].'</div>';
            }
            else{
                $error = '<div class="alert alert-danger" role="alert"><strong>We can not find this city.<br>Try again!</strong></div>';
            }
        }
    }
    

?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

        <title>Weather Scraper</title>

        <style type="text/css">

            /*
            body {
                background: url(bg.jpg);
                background-repeat: no-repeat;
                background-size: cover;
            }
            */

            html { 
                background: url(bg.jpg) no-repeat center center fixed; 
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }

            input{
                margin: 10px 0px;
            }

            a{
                color: white;
                text-decoration: none;
            }

            a:hover{
                text-decoration: underline;
                color: white;
            }


            /*
            body{
                background: none;
            }
            */

            .mid{
                text-align: center;
                position: absolute;
                left: 50%;
                top: 50%;
                width: 40%;
                height: 40%;
                margin-left: -20%;
                margin-top: -10%;
            }

            @media screen and (max-width: 800px){
                .mid{
                    top: 35%;
                    left: 32%;
                    width: 80%;
                }
            }

            @media screen and (max-width: 600px){
                .mid{
                    top:27%;
                    left: 25%;
                    width: 90%;
                }
            }

        </style>

    </head>
    <body>
        <div class="container mid" >
            <form method="post" class="container">

                <h1 id="h1">What's The Weather?</h1>

                <div class="mb-3">
                    <label for="city" class="form-label">Enter the name of a city</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter the city">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </form>

            <br>

            <div class="container" ><?php echo $error; ?></div>

            <div class="container"><?php echo $weather; ?></div>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            $("a").hover(function(){
                $("a").attr("href",'<?php echo $address; ?>');
            });     
        </script>
    </body>
</html>