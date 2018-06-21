<?php
 require 'backend/classes/News.class.php';
  require 'backend/classes/TableNews.class.php';

//<<<<<<< Updated upstream
if(isset($_POST["titre"]) && $_FILES['image']['error'] == 0)
/*=======
if(isset($_POST["titre"]) && $_FILES["picture"]['error'] == 0)
>>>>>>> Stashed changes
*/
{
   $nv=new News($_POST["titre"],$_POST["details"],$_POST["lien"],$_POST["date"],$_FILES["image"],NULL);
   if($nv->verification()){
   	$nv->save();
   }else{
       $nv->verification();
   }
}

if(isset($_POST["news_delect"]) ){
	$id_news=intval($_POST["news_delect"]);
	$nv=new News(NULL,NULL,NULL,NULL,NULL,$id_news);
	//$nv->save();


}
$nv=new TableNews();
