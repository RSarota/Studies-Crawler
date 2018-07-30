<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Crawler</title>
    <link rel="stylesheet" href="crawler.css">
	<script type="text/javascript" src="jquery.min.js"></script> 
	<script type="text/javascript"> 
		function funkcja(url){
			alert(url);
		}
	</script>
  </head>
  <body>
    <!-- page content -->
	<div class="header">
		<h1>Crawler</h1>
		<form  method="get" action="<?php $_SERVER['PHP_SELF'];?>">
			<input type="text" name="URL"><br>
			<input type="submit" value="Crawl!">
		</form>
	</div>
	<?php
	include('db_functions.php');

	function get_URLs($url){
		$xml = new DOMDocument();
		$URLs = '';
		@$xml->loadHTMLFile($url);
		$content=$xml->saveHTML();
		$links = array();
		add_to_database('sites_viewed',$url,htmlspecialchars($content));
		
		foreach($xml->getElementsByTagName('a') as $link){
			$href = $link->getAttribute('href');
			if($ret = parse_url($href)){
				if(!isset($ret['scheme'])){
					$href = "http://{$url}";
				}
			}
			$href = strtok($href, "#");
			$links[] = $href;
		}
		$links = array_unique($links);
		
		foreach($links as $link){
			$URLs .= '<a href="crawler.php?URL='.$link.'" name="'.$link.'">'.$link.'</a>';
			$xml2 = new DOMDocument();
			@$xml2->loadHTMLFile($link);
			$content=$xml2->saveHTML();
			add_to_database('sites_to_view',$link,htmlspecialchars($content));
		}
		return $URLs;
	} 
	
	if(isset($_GET['URL']) && $_GET['URL'] != ''){
		$url = $_GET['URL'];
		echo $url;
		//new_tables();
		echo "<hr>";
		if (filter_var($url, FILTER_VALIDATE_URL)){	
			echo get_URLs($url);
		}
		else{
			echo 'Invalid url!';
		}	
	}
	?>

  </body>
</html>