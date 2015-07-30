<?
session_start(); //start session
require_once("helper.php");
if (isset($_POST['continue']))
{	
	$_SESSION = $_POST;
	header("Location:http://localhost/~admin/pizza.php");
}
?>

<script>
	//1 for large; 0 for small
	
	function cancelOrder(dish)
	{
		var para = document.getElementById(dish);
		para.parentNode.removeChild(para);
		document.getElementById("cartform").submit();
	}
	
	function changeQuan()
	{
		document.getElementById("cartform").submit();
	}

</script>


<!DOCTYPE html>
<html>
	<head>
		<title>Shopping Cart</title>
	</head>
	<body>
		<h1>Shopping Cart</h1>
		<? 
			if (isset($_POST))
				print_r($_POST); 
		?>
		<? 
			if (isset($_POST['placeorder']))
				print "<h1>Your order has been placed!</h1>";
		    else
		    {
		       
					shoppingCart($_POST);
				//elseif (!empty($_SESSION))
				//	shoppingCart($_SESSION);
			}
		?>
	</body>
</html>