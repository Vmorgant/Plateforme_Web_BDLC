<?php
use Parse\ParseQuery;
use Parse\ParseObject;
use Parse\ParseFile;


class News{
    protected $objet;           //on stocke direct un parseobject
    //protected $tableNews;

     public function  __construct($title,$details,$link,$date,$picture,$id_news)
    {

        

        if($title==NULL && $details==NULL && $link==NULL && $date==NULL && $picture==NULL){
            $this->objet=new ParseQuery("TABLE_NEWS");
            $this->objet->equalTo("ID_NEWS",$id_news);
            $results=$this->objet->find(); 
          $this->objet=$results[0];
          $this->objet->destroy();



        }else{

         $this->objet=new ParseObject("TABLE_NEWS");
         $this->objet->set("ID_NEWS", $this->generate_id());
         $this->objet->set("TITLE",$title);
         $this->objet->set("DETAILS",$details);
         $this->objet->set("LINK", $link);
         $this->objet->set("DATE",$this->get_date($date));
//<<<<<<< Updated upstream
         $this->objet->set("PICTURE", ParseFile::createFromFile($picture["tmp_name"], $title.".png"));


/*=======
         $this->objet->set("PICTURE", ParseFile::createFromFile($picture,$title.'.png'));
//>>>>>>> Stashed changes
*/ }

    }


    public function get_date($nbresJour)
    {
        if(is_numeric($nbresJour)){
            $nbresJour=intval( $nbresJour);

            $date= date("d/m/Y",(time()+$nbresJour*3600*24));

        }else{
           $date='aucune' ;
        }
        return $date;

    }

    public function verification()
    {

        if ($this->objet->get("TITLE")==NULL){
            echo 'Le tite est obligatoire';
            return FALSE;
        }else if($this->objet->get("PICTURE")==NULL){
            echo 'L\'image est obligatoire';
            return FALSE;

        }else{ return TRUE;}

    }

    public function afficher()
    {
        echo$this->objet->get("DETAILS");
    }

    public function ajoutDetails($details)
    {
        $this->objet->set('DETAILS',$details );
    }

    public function save()
    {
        $this->objet->save();
    }

 public function generate_id()
    {
        $id=0;
        $query = new ParseQuery("TABLE_NEWS");
        $query->descending("ID_NEWS");
        $query->limit(1);       //vérifier que ça pose pas pb, /!\ à l'ordre
        $result = $query->find();
        if($result!=NULL)
        { $id=$result['0']->get("ID_NEWS")+1;}

    return  $id;
    }

    


   
 
}
