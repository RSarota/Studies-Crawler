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
	function add_to_database($name,$url,$content)
	{
		try{ 
			$pdo = new PDO('mysql:host=localhost;dbname=crawler', 'root', 'admin'); 
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			$sql='INSERT INTO '.$name.' (url,content) VALUES ("'.$url.'","'.$content.'")';
			$pdo->exec($sql);
		}
		catch(PDOException $e){ 
			echo 'Database error: ' . $e->getMessage();
		}
	}
	
?>