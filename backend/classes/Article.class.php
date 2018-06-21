<?php
use Parse\ParseQuery;
use Parse\ParseObject;

class Article{
    protected $article;

    /*Pour récupérer un panier déjà existant mettre le second paramètre à NULL*/
    public function __construct($idProduit, $idPanier)
    {
        if($idPanier)
        {
            $this->article=new ParseObject("TABLE_ARTICLE");
            $this->article->set("QUANTITE", 1);
            $this->article->set("ID_PRODUIT", $idProduit);
            $this->article->set("ID_PANIER", $idPanier);
        }else{
            $query=new ParseQuery("TABLE_ARTICLE");
            $this->article=$query->get($idProduit);
        }
    }

    public function save()
    {
        $this->article->save();
    }

    public function delete()
    {
        $this->article->destroy();
    }

    public function getArticle()
    {
        return $this->article;
    }

    public function getIdProduit()
    {
        return $this->article->get("ID_PRODUIT");
    }

    public function getQt()
    {
        return $this->article->get("QUANTITE");
    }

    public function getId()
    {
        return $this->article->getObjectId();
    }
}
