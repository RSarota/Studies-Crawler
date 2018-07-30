<?php
	function new_tables(){
		try{
			$pdo = new PDO('mysql:host=localhost;dbname=crawler', 'root', 'admin'); 
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			$sql='DROP TABLE sites_viewed';
			$pdo->exec($sql);
			$sql='DROP TABLE sites_to_view';
			$pdo->exec($sql);
			$sql='CREATE TABLE sites_viewed( id INT AUTO_INCREMENT PRIMARY KEY, url VARCHAR(1000), content TEXT)';
			$pdo->exec($sql);
			$sql='CREATE TABLE sites_to_view( id INT AUTO_INCREMENT PRIMARY KEY, url VARCHAR(1000), content TEXT)';
			$pdo->exec($sql);
		}
		catch(PDOException $e){ 
			echo 'Database error: ' . $e->getMessage();
		}
	}
	/*function clear_tables(){
		try{ 
			$pdo = new PDO('mysql:host=localhost;dbname=crawler', 'root', 'admin'); 
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			$sql='delete from sites_viewed';
			$pdo->exec($sql);
			$sql='delete from sites_to_view';
			$pdo->exec($sql);
		}
		catch(PDOException $e){ 
			echo 'Database error: ' . $e->getMessage();
		}
	}*/
	function add_to_database($name,$url,$content){
		try{ 
			$pdo = new PDO('mysql:host=localhost;dbname=crawler', 'root', 'admin'); 
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if(check_records($name,$url)==0){
				$sql='INSERT INTO '.$name.' (url,content) VALUES ("'.$url.'","'.$content.'")';
				$pdo->exec($sql);
			}
			else{
				$sql='DELETE FROM '.$name.' WHERE url="'.$url.'"';
				$pdo->exec($sql);
				$sql='INSERT INTO '.$name.' (url,content) VALUES ("'.$url.'","'.$content.'")';
				$pdo->exec($sql);
			}
		}
		catch(PDOException $e){ 
			echo 'Database error: ' . $e->getMessage();
		}
	}
	function check_records($name,$url){
		try{ 
			$pdo = new PDO('mysql:host=localhost;dbname=crawler', 'root', 'admin'); 
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql='SELECT * FROM '.$name.' WHERE url="'.$url.'"';
			$result=$pdo->query($sql)->fetchColumn();
			
			if($result == 0){
				return 0;
			}
			else return 1;
		}
		catch(PDOException $e){ 
			echo 'Database error: ' . $e->getMessage();
		}
	}
?>