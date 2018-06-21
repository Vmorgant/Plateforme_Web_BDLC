<?php
use Parse\ParseQuery;
use Parse\ParseObject;

//un produit est achetable (=/= article qui est dans un panier)
class Produit{
    protected $objet;           //on stocke direct un parseobject

    public function __construct($idProduit)
    {
        $query = new ParseQuery("TABLE_PRODUIT");
        $query->equalTo("ID_PRODUIT", intval($idProduit));
        $result = $query->find();
        if($result!=NULL)
        {
            $this->objet=$result["0"];
        }else{
            $this->objet=NULL;
        }
    }

    public function existe()
    {
        return($this->objet!=NULL);
    }

    public function getPrixVente()
    {
        return$this->objet->get("PRIX_VENTE");
    }

    public function getId()
    {
        return$this->objet->get("ID_PRODUIT");
    }

    public function estDispo()
    {
        return($this->objet->get("STOCK")>0);
    }

    // sert à quoi ???? laisser en commentaire tant qu'on sait pas
    public function save()
    {
        //return $this->objet->save();
    }
}
