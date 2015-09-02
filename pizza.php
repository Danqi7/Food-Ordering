<?
//start session
session_start();
require_once("helper.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width">
		<title>Pizza</title>
	</head>
	<body>
		<h1>Pizza<h1>
		<?
			menuDisplay('Pizza');
		?>
	</body>
</html>
