
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Computerspellen</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
	<h1>Computer Spellen</h1>
    <form method="Post">
        <p>Zoek: <input type="text" name="search" /><br></p>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>

<?php
	if(isset($_POST['submit'])){
	try{
	    $db = new PDO('mysql:host=localhost;dbname=computer_games','root',''); 
	    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	     
	    $sql = " 
	        select * from game where developer or publisher = :search"; 

	     $stmt = $db->prepare($sql);

	     $stmt->bindParam(':search', $search, PDO::PARAM_STR); 
	     $search = $_POST['search'];

	     $stmt->execute(); 

	     $result = $stmt ->fetchAll();

	     echo "<p>'" .$search. "'</p>";

	     echo "<table>";
	     echo "<tr>";
	     echo"<th>Name</th>";
		 echo"<th>Developer</th>";
		 echo"<th>Publisher</th>";
		 echo"</tr>";
		
		foreach ($result as $row) {
			echo "<tr>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>" . $row['developer'] . "</td>";
			echo "<td>" . $row['publisher'] . "</td>";
			echo "</tr>";
		}
			   
		echo "</table>";
	}
		catch(PDOException $e) 
	{ 
	    echo '<pre>'; 
	    echo 'Regel: '.$e->getLine().'<br>'; 
	    echo 'Bestand: '.$e->getFile().'<br>'; 
	    echo 'Foutmelding: '.$e->getMessage(); 
	    echo '</pre>'; 
	}
	}
?>