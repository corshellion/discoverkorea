<?php 
$conn = new mysqli('localhost', 'root', '', 'discoverkorea_db');
if ($conn->connect_error) {
	die("Connection error: " . $conn->connect_error);
}
$result = $conn->query("SELECT nama FROM kontak");
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		echo $row['nama'] . '<br>';
	}
}
?>
