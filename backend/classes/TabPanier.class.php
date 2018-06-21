<?php
use Parse\ParseQuery;

class TabPanier{
    protected $objet;           //on stocke direct un tableau de parseobject
    protected $id;

    public function __construct($etu)
    {
        $query = new ParseQuery("TABLE_PANIER");
        $query->equalTo("ID_OWNER", $etu);
        $query->descending("createdAt");
        $this->objet = $query->find();
        $this->id=0;
    }

    //renvoie un parseObject de type panier
    public function getPanier()
    {
        if(isset($this->objet[$this->id]))
        {
            $this->id++;
            return $this->objet[($this->id-1)];
        }else{
            return NULL;
        }

    }
}
