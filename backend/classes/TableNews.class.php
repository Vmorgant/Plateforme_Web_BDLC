<?php
use Parse\ParseQuery;
class TableNews {

   


    protected $table_news; 


    public function __construct()
    {
    	$query = new ParseQuery("TABLE_NEWS");
        $query->descending("ID_NEWS");
        $this->table_news = $query->find();
    }


    public function get_news() {
    	return $this->table_news;
	}
/* cette fonction permet de n'est plus afficher apres la date */
public function comparDate($id_news){ 
    foreach ( $this->table_news  as $news) {

        if($news->get("ID_NEWS")==$id_news){
          
            if($news->get("DATE")=='aucune' || $news->get("DATE")=='aucun'){
                
                 return 1;

              }else{
               $date1 = new DateTime("now");
                $date2 = new DateTime($news->get("DATE"));
                 return $date1 < $date2;
              }

}
}
}
}
