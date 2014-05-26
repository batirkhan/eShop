<form action="" method="post" id="cart-form">
<h3>Оформление заказа:</h3>

<?php

$mas = array();
      $mess = '';

 if(isset($_SESSION["products"]))
    {
	   $total = 0;
	   echo "<table id='customers' width='600px' style='margin-left:20px;'>
									<tbody>
										<tr>
										<th>Названия товара</th>
										<th width='100px'>Количество</th>
										<th>Цена</th>
										</tr>";
		
					foreach ($_SESSION["products"] as $cart_itm)
					        {
					           $product_code = $cart_itm["code"];
					           $product_name = $cart_itm["name"];
					           $product_qty = $cart_itm["qty"];
					           $product_price = $cart_itm["price"];
					           $subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
							   $total = ($total + $subtotal);
							  // $results = mysql_query("SELECT id, image FROM tbl_products WHERE id='$product_code' LIMIT 1");
		   					  // while($row = mysql_fetch_array($results)){
								//   $photo = $row['image'];
								//   }
							   echo "		
									
										<tr>
										<td>$product_name</td>
										<td align='center'>$product_qty</td>
										<td>$ $product_price</td>
										<tr>";					 
						 
	 				}

echo"<tr>
		<td colspan='2'><strong>Сумма</strong></td>
		<td style='color:#FF0000'><strong>$ $total</strong></td></table>";
	 		
?>
</form>
<br /><br />
<?php
        $from = "Электронный магазин ЭТ";
        $title = 'Заказ в Электронном магазине ЭТ'; 
        $message = "В нашем электронном магазине Вы заказали следующие товары: " .$product_name. "На сумму: ".$total." $.";
        
 if (Yii::app()->user->isGuest) 
 
 { ?>

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Введите Ваше имя:
    <input type="text" name="name" size="20" />
<br /><br />
    Введите Вашу фамилию:
    <input type="text" name="f_name" size="20" />
  <br /><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    Введите Ваш e-mail:
    <input type="text" name="email" size="20" />
    <br /> <br /> 
    <p align="center"> <input type="submit" name="orderbut" value="Заказать"> </p>   
   
    <?php 
    
    function check_form($name,$fname,$email)
   { 
     if (strpos($email, '@')===false) return false; 
     if ((strlen($name)<5)||(strlen($fname)<5)||(strlen($email))<5) return false;
  
    return true;
   }
        
    if (isset($_POST['orderbut']))
     {       
        $name = trim(strip_tags($_POST['name']));
        $f_name = trim(strip_tags($_POST['f_name']));
        $email = trim(strip_tags($_POST['email'])); 
      
  
   $k=false;   
       
     $k=check_form($name,$f_name,$email);
          if (!$k) echo "Ошибка. Вы неправильно ввели данные "; else{
          $j = 0;
      while ($j != strlen($str))
      {
        $i = get_zakaz();
        if ($i !=0 ) {$i++;}
          
           $model = new Orders;
          
          $id=$mas[$j]; 
                    
        $product = get_product($id);
             
        $date = date('Y-m-d');
        $time = date('H:i:s');
        
         $model->id =  $i;
         $model->name = $name;
         $model->fname = $f_name;
         $model->idprod = $product['id'];
         $model->product = $product['title'];
         $model->price = $product['price'];
         $model->email = $email;
         $model->date = $date;
         $model->time = $time;
         $model->save();   
         
       
          
  //  echo $name.' '.$f_name.' '.$email.' '.$product['id'].' '.$product['title'].' '.$product['price'].' '.$date.' '.$time.'<br />';
    
       //   $query = mysql_query("INSERT INTO tbl_orders(id,product, product_id, price,name,f_name,email,date,time) VALUES ('$i',{$product['title']}','{$product['id']}',{$product['price']},'$name','$f_name','$email','$date','$time')");
        $j++;
     
        }
         $to = $email;
         mail($to, $title, $message, 'From:'.$from);
         header("Location: http://localhost/shop/glav/index.php?r=site/final&message=1");
       }       
 }} ?>
      
    <?php
    ; 
    if ((!Yii::app()->user->isGuest)&&(Yii::app()->user->name !== 'admin')) 
    
    { ?>
         <p align="center"> <input type="submit" name="orderbut" value="Заказать"> </p>   
     <?php if (isset($_POST['orderbut']))
     {  
       
      $name = Yii::app()->user->name;
      $f_name = Yii::app()->user->lastname;
      $email = Yii::app()->user->email;
       
        $j = 0;
          
      while ($j != strlen($str))
      {
        $i = get_zakaz();
        if ($i !=0 ) {$i++;}
     
          
           $model = new Orders;
          
          $id=$mas[$j]; 
                    
        $product = get_product($id);
             
        $date = date('Y-m-d');
        $time = date('H:i:s');
        
         $model->id =  $i;
         $model->name = $name;
         $model->fname = $f_name;
         $model->idprod = $product['id'];
         $model->product = $product['title'];
         $model->price = $product['price'];
         $model->email = $email;
         $model->date = $date;
         $model->time = $time;
         $model->save();   
          
   //     echo $name.' '.$f_name.' '.$email.' '.$product['id'].' '.$product['title'].' '.$product['price'].' '.$date.' '.$time.'<br />';
    
       //   $query = mysql_query("INSERT INTO tbl_orders(id,product, product_id, price,name,f_name,email,date,time) VALUES ('$i',{$product['title']}','{$product['id']}',{$product['price']},'$name','$f_name','$email','$date','$time')");
        $j++;
        }
        
         $to = $email;
         mail($to, $title, $message, 'From:'.$from);
         header("Location: http://localhost/shop/glav/index.php?r=site/final&message=1");
        }
           
    }}	
    else echo('<p align="center">Ваша корзина пуста</p>')  ?>
