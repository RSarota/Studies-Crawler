<?php
	include('db_functions.php');
	if(isset($_GET['phrase']) && $_GET['phrase'] != ''){
		$phrase=$_GET['phrase'];
	
		try{
			$pdo = new PDO('mysql:host=localhost;dbname=crawler', 'root', 'admin'); 
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			$sql="SELECT url,content FROM sites_to_view WHERE content!='\n' AND url LIKE '%".$phrase."%' OR content LIKE '%".$phrase."%'"; 
			$result=$pdo->query($sql);
			$table=array();
			foreach($result as $row) {
				$table[] = $row;
			}
			$xml = new DOMDocument();
			$i=0;
			$desc=array();
			foreach($table as $row){
				@$xml->loadHTML($row['content']);
				$title=$xml->getElementsByTagName('title');
				@$title=$title->item(0)->nodeValue;
				$metadata = $xml->getElementsByTagName('meta');
				$content=null;
				foreach($metadata as $data){
					if ($data->getAttribute('name') == "description")
					{
						$content=$data->getAttribute('content');
					}
				}
				$desc[]=array('title'=>$title,'url'=>$row['url'],'content'=>$content);
				//echo json_encode($desc,JSON_PRETTY_PRINT).'<br><br>';
				$i+=1;
			}
			
			echo json_encode($desc,JSON_UNESCAPED_SLASHES);//,JSON_PRETTY_PRINT);
		}
		catch(PDOException $e){ 
			echo 'Database error: ' . $e->getMessage();
		}
	}
	else echo 'ERROR: EMPTY GET[]';
?>

