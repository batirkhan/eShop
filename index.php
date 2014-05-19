<?php
include('db_fns.php');

$r = empty($_GET['r']) ? 'index' : $_GET['r'];
switch($r)

{
      case('index'):
        //   $id =$_GET['id'];
        //   $products =get_product($id);
       break;
    
   case('cat'):
       $cat = $_GET['id'];
       $products = get_cat_products($cat);    
    break;
    
     case('product'):
       $id =$_GET['id'];
       $product = get_product($id); 
    break;
          
}
// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();

?>