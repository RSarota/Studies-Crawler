<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Crawler</title>
    <link rel="stylesheet" href="crawler.css">
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
		function get_URLs($url) 
		{
			$xml = new DOMDocument();
			$URLs = '';
			@$xml->loadHTMLFile($url);
			$links = array();

			foreach($xml->getElementsByTagName('a') as $link) {
				$href = $link->getAttribute('href');
				if  ( $ret = parse_url($href) ) 
				{
					if ( !isset($ret['scheme']) ) 
					{
						$href = "http://{$url}";
					}
				}
				$href = strtok($href, "#");
				$links[] = $href;
			}
			$links = array_unique($links);
			
			foreach($links as $link) 
			{
				$URLs .= '<a href="'.$link.'">'.$link.'</a>';
			}
			return $URLs;
		} 
	
		if(isset($_POST['URL']) && $_POST['URL'] != '')
		{
			$url = $_POST['URL'];
			echo $url;
			echo "<hr>";
			if (filter_var($url, FILTER_VALIDATE_URL))
			{	
				echo get_URLs($url);
			}
			else
			{
				echo 'Invalid url!';
			}	
		}
	?>

  </body>
</html>