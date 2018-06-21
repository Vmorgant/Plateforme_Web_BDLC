<?php
use Parse\ParseQuery;

class TabProduit{
    protected $objet;           //on stocke direct un tableau de parseobject

    public function __construct($categorie)
    {
        $query = new ParseQuery("TABLE_PRODUIT");
        $query->equalTo("CATEGORIE", $categorie);
        $query->notEqualTo("STOCK", 0);
        $this->objet = $query->find();
    }

    public function getTab()
    {
        return $this->objet;
    }
}
