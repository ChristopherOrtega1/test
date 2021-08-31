<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Formulario</title>
		<meta charset="UTF-8">
	</head>
	
	<body>

		
		<h1>Contacto</h1>
		
		<form method="POST">
			<label for= "nombre">Nombre:</label>
			<input type="text" name="nombre" placeholder="Escribe nombre" required>
			<br><br>
			
			<label for= "correo">Correo:</label>
			<input type="email" name="correo" placeholder="Escribe correo" required>
			<br><br>
			
			<label for= "genero">Genero:</label>
			<input type="radio" name="genero" value="Hombre">Hombre
			<input type="radio" name="genero" value="Mujer">Mujer
			<br><br>

			<label for= "contraseña">Contraseña:</label>
			<input type="password" name="contraseña" required>
			<br><br>

			<label for= "comentario">Comentario:</label>
			<textarea rows="3" cols="30" name="comentario" placeholder="Escribe comentario"></textarea>
			<br><br>
			
			<label for= "ciudad">Ciudad:</label>
			<select name="ciudad">
				<option value="gdl">Guadalajara </option>
				<option value="zap" >Zapopopan </option>
				<option value="ton" >Tonalá </option>
				<option value="otr" >Otra </option>
			</select>
			<br><br>
			
			<label for= "contra">Me interesa contratarte: </label>
			<input type="checkbox" name="contra" value="quiere_contra">
			<br><br>
						
			<button type="submit">Enviar</button>
			
		</form>
		<?php
			var_dump($_POST)
		?>
		<?php
		$servername = "localhost";
		$username = "root";
		$password = "";

		try {
		$conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connected successfully";
		} catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
		}

		$sql = "INSERT INTO new_table (name,comment) VALUES('Chris','Com')";
		$conn->exec($sql);
		$conn = null;
		?>
	<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th></tr>";

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT id, name, comment FROM new_table");
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
	</body>
	
<html>