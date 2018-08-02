<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Strona Google</title>
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="results.css">
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="skrypt.js"></script>
  </head>
  <body>
    <!-- page content -->
    <div class="nav">
		<span>
			<a href="https://mail.google.com/mail/">Gmail</a>
			<a href="https://www.google.pl/imghp">Grafika</a>
		</span>
		<img src="selection.png" />
		<img src="bell.png" />
		<img src="icon.png" />	
	</div>
    <br />

	<div class="main">
	<center>
		<img src="Google_text.png" />
		<div class="SearchBox">
		<input type="text" id="phrase" size="40" maxlength="255" value=''/>
		</div>
		<span>
			<input type="submit" id="button" value="Szukaj w Google">
			<input type="submit" id="button1" value="Szczęśliwy traf">
		</span>
		<br />
</center>	
		<div id="results">
				
		</div>
	</div>	
	<center>
		<div class="footer">
			<p class="set_lang">
			Korzystaj z Google w tych językach: <a style="color:darkblue" href="http://www.google.com">English</a>
			</p>
		</div>
	</center>
  </body>
</html>