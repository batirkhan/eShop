<?php /* @var $this Controller */ ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style1.css" />
</head>

<body>
<div id="header">
		<div class="block1">
        	<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
            	array('url'=>Yii::app()->getModule('user')->registrationUrl, 'label'=>Yii::app()->getModule('user')->t("Register"), 'visible'=>Yii::app()->user->isGuest),
            	array('url'=>Yii::app()->getModule('user')->loginUrl, 'label'=>Yii::app()->getModule('user')->t("Login"), 'visible'=>Yii::app()->user->isGuest),
		     	array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),
      ),)); ?>
               
		</div>
		<div class="block2">
			<h1>Интернет-магазин ЭТ</h1>
            <p class="squ">электронные товары по низким ценам</p>
		</div>
        <div class="block3">
			<a href="http://localhost/shop/glav/index.php?r=orders/index"><img src="images/cart.jpg" alt="" width="35" height="25" /></a>
			<span>Shopping<br /> Cart</span>
			<span>в корзине <strong>
			<?php 
			if(isset($_SESSION["products"])){	
			$quality =0;
			foreach ($_SESSION["products"] as $cart_itm){
			$product_qty = $cart_itm["qty"];
				   $quality = ($quality + $cart_itm["qty"]);
				   
			}
			echo "$quality товаров";
			}else echo "нет товаров" ;
			 ?>  </strong></span>
		</div>
        	<img src="images/banner.jpg" alt="" width="900" height="145" /><br />
    <nav id="menu-navi">
     <?php 
     
       if (Yii::app()->user->name === 'admin') {    
        
         $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
                 array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Профиль"), 'visible'=>!Yii::app()->user->isGuest),
                 array('url'=>Yii::app()->getModule('user')->Viewadmin, 'label'=>Yii::app()->getModule('user')->t("Пользователи"),'visible'=>!Yii::app()->user->isGuest),
                 array('url'=>array('/category/admin'),'label'=>'Категории','visible'=>!Yii::app()->user->isGuest),
	   	 		 array('url'=>array('/products/admin'),'label'=>'Продукты','visible'=>!Yii::app()->user->isGuest), 
                 array('url'=>array('/orders/admin'),'label'=>'Заказы','visible'=>!Yii::app()->user->isGuest), 
              

         )));
        
                        
        }
        
               if (Yii::app()->user->name !== 'admin') {                                                          
     $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Главная', 'url'=>array('/site/index')),
                array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Профиль"), 'visible'=>!Yii::app()->user->isGuest),
   	       //     array('label'=>'Корзина', 'url'=>array('/site/cart')),
           //     array('label'=>'Оформить заказ', 'url'=>array('/orders/create')),
                array('label'=>'Контакты', 'url'=>array('/site/contact')), ),
		));
        ?> 
        <?php 
        }
//		if(yii::app()->user->isGuest) {$this->widget('zii.widgets.CMenu',array(
//			'items'=>array(		 
 //              ), ));}
                       ?>
    </nav>
    </div><!-- mainmenu -->
    <div id="content">
		<div class="left">
        
        <p class="category">Категория</p>
			
			<ul> 
       <?php
        $categories = get_cat();
                 foreach($categories as $item): ?>
                <li class="dots"><a href="index.php?r=site/cat&id=<?php echo $item['id']; ?>">
                <?php echo $item['name']?></a></li>
              <?php endforeach ?>
              </ul>
             
                
  	<?php
  //    $this->breadcrumbs=array(
//	UserModule::t('Users')=>array('admin'),
	//$model->username,);

      // $this->widget('zii.widgets.CMenu',array(
		
    //array('label'=>UserModule::t('Create User'), 'url'=>array('create')),
    //array('label'=>UserModule::t('Update User'), 'url'=>array('update','id'=>$model->id)),
   // array('label'=>UserModule::t('Delete User'), 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>UserModule::t('Are you sure to delete this item?'))),
   // array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
   // array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
   // array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
   // ));	                   
      
       ?>
            </ul>
      </div>
     <div class="right">
     <div id="breadcrumbs">
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?>
        </div><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	</div>
   
	</div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->
</body>
</html>
