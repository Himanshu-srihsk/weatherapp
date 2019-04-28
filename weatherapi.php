<?php
 $weather="";
 $error="";
 if($_GET['city']){


 $urlcontent=
    
	 file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&appid=963e8ac12430210176c9aea23981db63");
 $weatherarray=json_decode($urlcontent,true);
  // print_r($weatherarray);
   
   if($weatherarray['cod'] == 200){
$weather="the weather in ".$_GET['city']." is currently '".$weatherarray['weather'][0]['description']."'.";

 $tempincelsius=intval($weatherarray['main']['temp']-273);
 
 $weather.="The temperature is".$tempincelsius."&deg;c and the wind speed is".$weatherarray['wind']['speed']."m/s.";
 
 }else{
$error="could not find city-please try again";

}
 }
 


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <title>Weather Scrapper!</title>
	<style type="text/css">
	html { 
  background: url(lion.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
body{
background:none;

}
.container{
text-align:center;
margin-top:200px;
width:450px;
}
input{
margin:20px 0;
}
#weather{
margin-top:15px;
}
	</style>
  </head>
  <body>
  <div class="container">
  <h1>What's the Weather?</h1>
  <form>
  <fieldset class="form-group">
    <label for="city">Enter the name of the City</label>
    <input type="text" class="form-control"  name="city" id="city" placeholder="eg:NewDelhi,India" VALUE="<?php
	
	 if(array_key_exists('city',$_GET)){
	echo $_GET['city'];
	}
	
	
	?>">
  </fieldset>
      <button type="submit" class="btn btn-primary">Submit</button>
</form>
<div id="weather"><?php 
if($weather){
echo '<div class="alert alert-success" role="alert">
  '.$weather.'
</div>';
}else if($error){
echo '<div class="alert alert-danger" role="alert">
  '.$error.'</div>';

}
 ?></div>
  </div>
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>