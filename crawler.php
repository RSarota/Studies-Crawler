<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Crawler</title>
    <link rel="stylesheet" href="crawler.css">
	<script type="text/javascript" src="jquery.min.js"></script> 
	<script type="text/javascript"> 
		function funkcja(url){
			<?php
				echo $url;
		//new_tables();
		echo "<hr>";
		if (filter_var($url, FILTER_VALIDATE_URL)){	
			echo get_URLs($url);
		}
		else{
			echo 'Invalid url!';
		}	
			?>
		}
	</script>
  </head>
  <body>
    <!-- page content -->
	<div class="header">
		<h1>Crawler</h1>
		<form  method="post" action="<?php $_SERVER['PHP_SELF'];?>">
			<input type="text" name="URL"><br>
			<input type="submit" value="Crawl!">
		</form>
	</div>
	<?php
	include('create_db.php');

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
			$URLs .= '<a href="'.$link.'" onClick="funkcja(this.href);">'.$link.'</a>';
			$xml2 = new DOMDocument();
			@$xml2->loadHTMLFile($link);
			$content=$xml2->saveHTML();
			add_to_database('sites_to_view',$link,htmlspecialchars($content));
		}
		return $URLs;
	} 
	
	if(isset($_POST['URL']) && $_POST['URL'] != ''){
		$url = $_POST['URL'];
		echo $url;
		new_tables();
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