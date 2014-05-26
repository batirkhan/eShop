<script type="text/javascript" src="js/jquery-1.3.2.js"></script>
<script type="text/javascript" src="js/jquery.livequery.js"></script>
<link href="style1.css" rel="stylesheet" />
<script type="text/javascript">

$(document).ready(function() {
	
	var Arrays=new Array();
	

	
	$('#wrap li').click(function(){
		
		var thisID = $(this).attr('id');
		
		var itemname  = $(this).find('div .name').html();
		var itemprice = $(this).find('div .price').html();
			///////////// post to cart


		var formData = {type:"add",code:thisID,qty:"1",price:itemprice,name:itemname}; //Array
		 
		$.ajax({
		    url : "add_cart.php",
		    type: "POST",
		    data : formData,
		    success: function(data, textStatus, jqXHR)
		    {
		        //data - response from server
		    },
		    error: function (jqXHR, textStatus, errorThrown)
		    {
		 
		    }
		});
			///////////////////
		if(include(Arrays,thisID))
		{
			var price 	 = $('#each-'+thisID).children(".shopp-price").find('em').html();
			var quantity = $('#each-'+thisID).children(".shopp-quantity").html();
			quantity = parseInt(quantity)+parseInt(1);
			
			var total = parseInt(itemprice)*parseInt(quantity);
			
			$('#each-'+thisID).children(".shopp-price").find('em').html(total);
			$('#each-'+thisID).children(".shopp-quantity").html(quantity);
			
			var prev_charges = $('.cart-total span').html();
			prev_charges = parseInt(prev_charges)-parseInt(price);
			
			prev_charges = parseInt(prev_charges)+parseInt(total);
			$('.cart-total span').html(prev_charges);
			
			$('#total-hidden-charges').val(prev_charges);
		}
		else
		{
			Arrays.push(thisID);
			
			var prev_charges = $('.cart-total span').html();
			prev_charges = parseInt(prev_charges)+parseInt(itemprice);
			
			$('.cart-total span').html(prev_charges);
			$('#total-hidden-charges').val(prev_charges);
			
			$('#left_bar .cart-info').append('<div class="shopp" id="each-'+thisID+'"><div class="label">'+itemname+'</div><div class="shopp-price"> $<em>'+itemprice+'</em></div><span class="shopp-quantity">1</span><img src="images/remove.png" class="remove" /><br class="all" /></div>');
			
			$('#cart').css({'-webkit-transform' : 'rotate(20deg)','-moz-transform' : 'rotate(20deg)' });
		}
		
		setTimeout('angle()',200);
	});	
	
	////////////// huudas reload hiih

<?php

	if(isset($_SESSION["products"]))
    {
	   $total = 0;

					foreach ($_SESSION["products"] as $cart_itm)
					        {
					           $product_code = $cart_itm["code"];
					           $product_name = $cart_itm["name"];
					           $product_qty = $cart_itm["qty"];
					           $product_price = $cart_itm["price"];
					           $subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
							   $total = ($total + $subtotal);
							 
						  for ($i = 1; $i <= $product_qty; $i++) {
							  	echo "var test_id = '$product_code';
									var test_name = '$product_name';
									var test_price = '$product_price';
									test(test_id, test_name, test_price);";					 
						  };
	 				}

    }

	
    ?>	





function test(test_id, test_name, test_price){
		
		var thisID = test_id;
		
		var itemname  = test_name;
		var itemprice = test_price;

		if(include(Arrays,thisID))
		{
			var price 	 = $('#each-'+thisID).children(".shopp-price").find('em').html();
			var quantity = $('#each-'+thisID).children(".shopp-quantity").html();
			quantity = parseInt(quantity)+parseInt(1);
			
			var total = parseInt(itemprice)*parseInt(quantity);
			
			$('#each-'+thisID).children(".shopp-price").find('em').html(total);
			$('#each-'+thisID).children(".shopp-quantity").html(quantity);
			
			var prev_charges = $('.cart-total span').html();
			prev_charges = parseInt(prev_charges)-parseInt(price);
			
			prev_charges = parseInt(prev_charges)+parseInt(total);
			$('.cart-total span').html(prev_charges);
			
			$('#total-hidden-charges').val(prev_charges);
		}
		else
		{
			Arrays.push(thisID);
			
			var prev_charges = $('.cart-total span').html();
			prev_charges = parseInt(prev_charges)+parseInt(itemprice);
			
			$('.cart-total span').html(prev_charges);
			$('#total-hidden-charges').val(prev_charges);
			
			$('#left_bar .cart-info').append('<div class="shopp" id="each-'+thisID+'"><div class="label">'+itemname+'</div><div class="shopp-price"> $<em>'+itemprice+'</em></div><span class="shopp-quantity">1</span><img src="images/remove.png" class="remove" /><br class="all" /></div>');
			
			$('#cart').css({'-webkit-transform' : 'rotate(20deg)','-moz-transform' : 'rotate(20deg)' });
		}
		
		setTimeout('angle()',200);
	};	


	////////////////
	
	$('.remove').livequery('click', function() {
		
		var deduct = $(this).parent().children(".shopp-price").find('em').html();
		var prev_charges = $('.cart-total span').html();
		
		var thisID = $(this).parent().attr('id').replace('each-','');
		
		var pos = getpos(Arrays,thisID);
		Arrays.splice(pos,1,"0")
		
		prev_charges = parseInt(prev_charges)-parseInt(deduct);
		$('.cart-total span').html(prev_charges);
		$('#total-hidden-charges').val(prev_charges);
		$(this).parent().remove();

					///////////// post to cart


		var formData = {type:"remove",code:thisID}; //Array
		 
		$.ajax({
		    url : "add_cart.php",
		    type: "POST",
		    data : formData,
		    success: function(data, textStatus, jqXHR)
		    {
		        //data - response from server
		    },
		    error: function (jqXHR, textStatus, errorThrown)
		    {
		 
		    }
		});
			///////////////////
		
	});	
	
	$('#Submit').livequery('click', function() {
		
		//var totalCharge = $('#total-hidden-charges').val();
		
	//	$('#left_bar').html('Total Charges: $'+totalCharge);
	
	window.location.href = 'http://localhost/shop/glav/index.php?r=orders/index';
		return false;
		
	});	
	
});

function include(arr, obj) {
  for(var i=0; i<arr.length; i++) {
    if (arr[i] == obj) return true;
  }
}
function getpos(arr, obj) {
  for(var i=0; i<arr.length; i++) {
    if (arr[i] == obj) return i;
  }
}
function angle(){$('#cart').css({'-webkit-transform' : 'rotate(0deg)','-moz-transform' : 'rotate(0deg)' });}


</script>

<div class="right">
<?php 
$cat = $_GET['id'];
$products= get_cat_products($cat);
//$products= get_products();
foreach($products as $item):?>	

<div id="wrap" align="left">
	<ul>
        <div id="item">
				<a href="index.php?r=site/product_rez&id=<?php echo $item['id']?>"><img src="images/tovar/thumb_<?php echo $item['image']?>" width="116" height="100" alt="<?php echo $item['title']?>" /></a>
				<div class="opisanie"><a href="index.php?r=site/product_rez&id=<?php echo $item['id']?>">Описание</a></div>               
                <li id=<?php echo $item['id']?>>
                <div id="title"><span class="name"><?php echo $item['title']?></span>
				<div id="add_cart"><span class="name1">Добавить в корзину </span>: <span class="price"><?php echo $item['price']?> </span><span style="color:#F00">$</span></div></div>
		    	</li>
            
			</div>
            
		</ul>
		
</div>	

<?php endforeach; ?>	
<?php   if (Yii::app()->user->name != 'admin') {  ?>

<div id="left_bar"> 
		
	<form action="#" id="cart_form" name="cart_form">
		
	<div class="cart-info"></div>
		
	<div class="cart-total">
		
		<b>Сумма за всю покупку:&nbsp;&nbsp;&nbsp;</b> $<span>0</span>
			
<input type="hidden" name="total-hidden-charges" id="total-hidden-charges" value="0" />
 </div>
 <button type="submit" id="Submit">Оформить заказ</button>
 </form>
		
</div>
		
		<?php } ?>
	
</div>

