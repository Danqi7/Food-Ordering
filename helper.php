<?php

/**
	calculates the total
	@para array $form
**/
function computeTotal($form = array())
{
	$menu = simplexml_load_file("menu.xml");
	$sum = 0;
	if(!empty($form))
	{
		extract($form);
		extract($Pizza);
		foreach ($menu->xpath("/menu/catagory[@name='Pizza']/dish") as $dish)
		{
		
			$name = $dish->name;
			$counter = 0.00;
			foreach($dish->price as $price)
			{	
				if ($counter == 0)
				{
					if(isset($lq["$name"]) && $lq["$name"] != 0)
						$sum = $sum + intval($lq["$name"])* floatval($price);
				
				}
				elseif ($counter == 1)
				{
					if(isset($sq["$name"]) && $sq["$name"] != 0)
						$sum = $sum + intval($sq["$name"])* floatval($price);
				
				}
			
				$counter++;
			
			}	
		}
		print "$";
		print($sum);
	}
	else
	{
		echo "0";
	}
	
}



/**
	shopping cart dynamic tempalate
	@para array $form
**/
function shoppingCart($form = array())
{
	print "<form method='post' id='cartform' name='Cart'>";
	print "<ul>";
	$cartform = "cartform";
	$menu = simplexml_load_file("menu.xml");
	if (isset($form))
	{
		$real_form = $form['Pizza'];
		extract($form);
		extract($Pizza);
		foreach ($menu->xpath("/menu/catagory[@name='Pizza']/dish") as $dish)
		{
			$counter = 0.00;
			foreach($dish->price as $price)
			{
				
				if ($counter == 0)
				{
					foreach($real_form as $key => $value)
					{
						if ($key == 'lq')
						{
							foreach($lq as $name => $number)
							{
								if ($name == $dish->name && $number != 0)
								{
									$para = $dish->name . '1';
									print "<li id='$para'>";	
									print "Large Size " . "$name";
															
									print "&nbsp&nbspQuantity: ";
									print "<select onchange='changeQuan()' name='Pizza[lq][$name]'>";								
									for ($i = 1; $i < 100; $i++)
									{
										if ($lq[$name] == $i)
											print "<option selected value='$i'>$i</option>";
										else									
											print "<option value='$i'>$i</option>";
									}
									print "</select>";
							
									print "&nbsp&nbspDish Price: ";
									print ($price);
								
									print "&nbsp&nbsp&nbsp&nbsp";
									print "<input id='b1' style='width:50px' name='lcancel[$name]' type='button' value='Cancel' onclick='cancelOrder(\"$para\")'>";
									print "</li>";
								}
							}
						}
					}
				}	
				
				elseif ($counter == 1)
				{
					foreach($real_form as $key1 => $value1)
					{
						if ($key1 == 'sq')
						{
							foreach($sq as $name1 => $number1)
							{
								if ($name1 == $dish->name && $number1 != 0)
								{
									$para = $dish->name . '1';
									print "<li id='$para'>";	
									print "Small Size " . "$name1";
															
									print "&nbsp&nbspQuantity: ";
									print "<select onchange='changeQuan()' name='Pizza[sq][$name1]'>";								
									for ($i = 1; $i < 100; $i++)
									{
										if ($sq[$name1] == $i)
											print "<option selected value='$i'>$i</option>";
										else									
											print "<option value='$i'>$i</option>";
									}	
									print "</select>";
							
									print "&nbsp&nbspDish Price: ";
									print ($price);
								
									print "&nbsp&nbsp&nbsp&nbsp";
									print "<input id='b2' style='width:50px' name='lcancel[$name1]' type='button' value='Cancel' onclick='cancelOrder(\"$para\")'>";
									print "</li>";
								}
							}
						}
					}
				}
				$counter++;
			}
		}
	}
				

	print "&nbsp&nbsp&nbsp&nbsp";
	print "total:";
	computeTotal($form);
	print "</ul>";
	print "<input type='submit' value='Place the order' name='placeorder'>";
	print "<input type='submit' value='Continue shopping' name='continue'>";
	print "</form>";
}
?>