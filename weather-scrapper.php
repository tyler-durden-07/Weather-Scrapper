<?php 
	
	$weather="";
	
	$error = "";
	 
	if(array_key_exists('city', $_GET)){
		
		$city = str_replace(' ', '', $_GET["city"]);
		
		$file_headers = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
		
	
		if($file_headers[0] == 'HTTP/1.0 404 Not Found') {
			echo "here";
		$error = "That city could not be found.";
		
		}else{
		
		$forecastPage = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
		
		$pageArray = explode('Weather Today</h2> (1–3 days)</div><p class="b-forecast__table-description-content"><span class="phrase">', $forecastPage);
		
		if (sizeof($pageArray)>1){
		
		$secondPageArray = explode('</span>',$pageArray[1]);
		
		if(sizeof($secondPageArray)>1){
		
		$weather = $secondPageArray[0];
		}else{
			$error= "That city could not be found.";
		}
		
		}else{
			
			$error= "That city could not be found.";
		
		
		}
		
		
		}
		
	}


?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Weather Scrapper</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Hello, world!</title>
	
	<style type="text/css">
	
		html { 
				background: url(https://images.unsplash.com/photo-1593799988139-a0ac058c71f8?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1951&q=80) no-repeat center center fixed; 
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
			margin-top:150px;
			width:450px;
		}
		
		input{
			margin:20px 0;
		}
		
		#weather{
			
			margin-top:15px;
			
		}
		#cc{
			color:yellow;
			font-size:150%;
		}
	</style>
  </head>
  <body>
	
	<div class="container">
	
		<h1> What's The Weather?</h1>
	    <p></p>
		
		<form>
			<div class="form-group">
				<label for="city" id="cc">Enter the name of a city</label>
				<input type="text" class="form-control" id="city" name="city" placeholder="eg. London, Tokyo" value = '<?php 
				
				if(array_key_exists('city', $_GET)){
					
					
					echo $_GET['city'];
				}
				
				
				?>'>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
		
		<div id="weather"><?php
		
			if($weather){
				
				echo '<div class="alert alert-success" role="alert">
  '.$weather.'
</div>';
				
			} else if ($error){
				
				echo '<div class="alert alert-danger" role="alert">
  '.$error.'
</div>';
				
			}
		?></div>
		
		
		
	
	</div>
	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>