<?php
use Parse\ParseQuery;
use Parse\ParseObject;
require 'Article.class.php';

class Panier{
    protected $panier;
    protected $tabArticles;

    public function __construct($etu)
    {
        $query = new ParseQuery("TABLE_PANIER");
        $query->equalTo("ID_OWNER", $etu);
        $query->equalTo("STATE", "preparation");
        $result = $query->find();
        if($result!=NULL)
        {
            $this->panier=$result["0"];
            $queryArticles = new ParseQuery("TABLE_ARTICLE");
            $queryArticles->equalTo("ID_PANIER", $this->getId());
            $this->tabArticles = $queryArticles->find();
        }else{
            $this->panier = new ParseObject("TABLE_PANIER");
            $this->panier->set("STATE", "preparation");
            $this->panier->set("ID_OWNER", $etu);
            $this->panier->set("PRIX_TOTAL", 0);
            $this->panier->set("ID_PANIER", $this->createID($etu));
            $this->tabArticles=array();
        }
    }

    public function makeDate()
    {
        return(date("d").'/'.date("m").'/'.date("Y"));
    }

    public function createID($etu)
    {
        $query = new ParseQuery("TABLE_PANIER");
        $query->descending("createdAt");
        $query->limit(1);       //vérifier que ça pose pas pb, /!\ à l'ordre
        $result = $query->find();
        if($result==NULL)
        {
            //si première commande du site
            $id=($this->makeDate().'_'.$etu.'_1');
        }else{
            //on split entre le début qui change pas et la fin
            $date=str_split($result["0"]->get("ID_PANIER"), 10);
            if($this->makeDate() != $date["0"])
            {
                //si premier du jour
                $id=($this->makeDate().'_'.$etu.'_1');
            }else{
                $chaineSplit=str_split($result["0"]->get("ID_PANIER"), 19);
                $calcId=intval($chaineSplit["1"])+1;
                $id=$date["0"].'_'.$etu.'_'.$calcId;
            }
        }
        return $id;
    }


    public function getId()
    {
        return $this->panier->get("ID_PANIER");
    }

    public function getState()
    {
        return $this->panier->get("STATE");
    }

    public function getPrix()
    {
        return $this->panier->get("PRIX_TOTAL");
    }

    public function ajouterNomArticles()
    {
        if(isset($this->tabArticles["0"]) && ($this->tabArticles["0"]->get("NOM_PRODUIT"))==NULL)
        {
            $i=0;
            while(isset($this->tabArticles[$i]))
            {
                $query = new ParseQuery("TABLE_PRODUIT");
                $query->equalTo("ID_PRODUIT", $this->tabArticles[$i]->get("ID_PRODUIT"));
                $produit = $query->find();
                $this->tabArticles[$i]->set("NOM_PRODUIT", $produit["0"]->get("NOM"));
                $this->tabArticles[$i]->set("PRIX", $produit["0"]->get("PRIX_VENTE"));
                $i++;
            }
        }
    }

    public function getTabArticle()
    {
        return $this->tabArticles;
    }

    public function save()
    {
        return $this->panier->save();
    }

	public function ajouterArticle($produit){
        //mise à jour du prix
        $this->panier->set("PRIX_TOTAL", ($this->panier->get("PRIX_TOTAL")+$produit->getPrixVente()));
        //on regarde si un article similaire est déjà présent dans le panier
        $i=0;
        $id=-1;
        while(isset($this->tabArticles[$i]))
        {
            if($this->tabArticles[$i]->get("ID_PRODUIT")==$produit->getId())
            {
                $id=$i;
            }
            $i++;
        }
        //création et ajout de l'article dans le tableau
        if($id==-1)
        {
            $article = new Article($produit->getId(), $this->getId());
            $article->save();
            $this->tabArticles[$i]=$article->getArticle();
        }else{
            $this->tabArticles[$id]->set("QUANTITE", ($this->tabArticles[$id]->get("QUANTITE")+1));
            $this->tabArticles[$id]->save();
        }
		$this->save();
        return 9;
	}

	public function supprimerArticle($id)
    {
        $aSupp=new Article($id, NULL);
        //ajout verif panier
        if($aSupp->getArticle())
        {
            $i=0;
            //on récupère l'id
            while($this->tabArticles[$i]->getObjectId() != $aSupp->getId())
            {
                $i++;
            }
            $aSupp->delete();
            $aSupp->save();
            while(isset($this->tabArticles[$i+1]))
            {
                $this->tabArticles[$i]=$this->tabArticles[$i+1];
                $i++;
            }
            unset($this->tabArticles[$i]);
            $produit=new Produit($aSupp->getIdProduit());
            $this->panier->set("PRIX_TOTAL", round($this->panier->get("PRIX_TOTAL")-$produit->getPrixVente()*$aSupp->getQt(),2));
            $this->save();
            return 6;
        }else{
            //article inexistant, arrête de tricher
            return 7;
        }
	}

    public function valider()
    {
        $this->recalculPrix();
        if($this->getPrix()!=0)
        {
            $prix=$this->getPrix();
            $this->panier->set("STATE", "commande");
            $this->save();
            $this->tabArticles=array();
            $this->panier->set("PRIX_TOTAL", 0);
            return array("code"=>13, "prix"=>$prix);
        }else{
            return array("code"=>14);
        }
    }

    public function recalculPrix()
    {
        $this->getTabArticle();
        $prix=0;
        $i=0;
        $this->ajouterNomArticles();
        while(isset($this->tabArticles[$i]))
        {
            $prix+=$this->tabArticles[$i]->get("PRIX")*$this->tabArticles[$i]->get("QUANTITE");
            $i++;
        }
        $this->panier->set("PRIX_TOTAL", $prix);
    }

    public function changerProprio($etu)
    {
        $this->panier->set("ID_OWNER", $etu);
        $this->save();
    }
}
