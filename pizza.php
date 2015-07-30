<?
//start session
session_start();

?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width">
		<title>Pizza</title>
	</head>
	<body>
		<h1>Pizza<h1>
		<? if(isset($_SESSION)) print_r($_SESSION);?>
		<form style="font-size:20px" method="post" action="cart.php">
		<ul>
		<?
			if (isset($_SESSION))
			{
				extract($_SESSION);
				extract($Pizza);
			}
			$menu = simplexml_load_file("menu.xml");
			foreach ($menu->xpath("/menu/catagory[@name='Pizza']/dish") as $dish)	
			{
				print "<li>";
				print "$dish->name";
				print "</li>";
				
				$counter = 0;
				foreach ($dish->price as $price)
				{
					if ($counter == 0)
					{
						print "&nbsp&nbspLarge:$price";
						
						print "&nbsp&nbspquantity:&nbsp&nbsp";
						print "<select name='Pizza[lq][$dish->name]'>";
						for ($i = 0; $i < 100; $i++)
						{
							
							if (isset($lq["$dish->name"]) && $lq["$dish->name"] == $i)
							{	
								print "<option selected value='$i'>$i</option>";
							}
							else
								print "<option value='$i'>$i</option>";
						}
						print "</select>";
					}
					elseif ($counter == 1)
					{
						print "&nbsp&nbspSmall:$price";
						print "&nbsp&nbspquantity:&nbsp&nbsp";
						print "<select name='Pizza[sq][$dish->name]'>";
						for ($i = 0; $i < 100; $i++)
						{
							if (isset($sq["$dish->name"]) && $sq["$dish->name"] == $i)
								print "<option selected value='$i'>$i</option>";
							else
								print "<option value='$i'>$i</option>";
						}
						print "</select>";
					}
					
					$counter++;
				}
				print "<br>";
			}
		?>
		</ul>
			<br>	
			<input type="submit" name="Pizza[action]" value="Order now!">
		</form>
	</body>
</html>

