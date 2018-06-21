<?php
use Parse\ParseQuery;
use Parse\ParseObject;

class Etudiant{
    protected $objet;           //on stocke direct un parseobject
    protected $panier;

    /*$tabParam doit être NULL si on se contente de récupérer un étudiant existant
    Sinon $tabParam=[num_etu; username]*/
    public function __construct($login, $tabParam)
    {
        if($tabParam==NULL)
        {
            $query = new ParseQuery("TABLE_USER");
            $query->equalTo("NUM_ETU", $login);
            $result = $query->find();
            if($result!=NULL)
            {
                $this->objet=$result["0"];
            }else{
                $this->objet=NULL;
            }
        }else{
            $this->objet=new ParseObject("TABLE_USER");
            $this->objet->set("NUM_ETU", $tabParam["num_etu"]);
            $this->objet->set("USERNAME", $tabParam["username"]);
            $this->objet->set("CATEGORIE", "client");
            $this->objet->set("MDP", $tabParam["num_etu"]);
            $this->objet->set("CREDIT", 0);
        }
    }

    public function recuperationPanier()
    {
        //pour charger le panier de l'etudiant
        $this->panier = new Panier($this->getNum());
    }

    public function getPanier()
    {
        return $this->panier;
    }

    public function getName()
    {
        return $this->objet->get("USERNAME");
    }
	public function getNum()
    {
        return $this->objet->get("NUM_ETU");
    }
    public function getCredit()
    {
        return $this->objet->get("CREDIT");
    }

    public function getMdp()
    {
        return $this->objet->get("MDP");
    }

    public function getCategorie()
    {
        return $this->objet->get("CATEGORIE");
    }

    public function save()
    {
        return $this->objet->save();
    }

    public function ajouterArticle($produit)
    {
        if(($this->getCredit()-$this->getPanier()->getPrix())>=$produit->getPrixVente())
        {
            return$this->panier->ajouterArticle($produit);
        }else{
            return 5;
        }
    }

    public function retirerArticle($id)
    {
        return$this->panier->supprimerArticle($id);
    }

	public function validerCommande()
    {
        $solde=floatval($this->getCredit());
        if($this->panier->getPrix() > $solde)
        {
            return 5;
		}else{
            $retour=$this->panier->valider();
            if($retour["code"]!=14)
            {
                $this->objet->set("CREDIT", strval($solde-$retour["prix"]));
                $this->save();
            }
            return $retour["code"];
		}
    }

	public function changer_mdp($ancien_mdp,$new_mdp,$confirm_mdp)
    {
			if($ancien_mdp != $this->objet->get('MDP')){
				return(23);
			}
			else if ($new_mdp != $confirm_mdp){
				return(24);
			}
			else{
				$this->objet->set("MDP", $new_mdp);
				$this->objet->save();
				return(20);
			}
    }

    public function reset_password()
    {
				$this->objet->set("MDP", $this->getName());
				$this->objet->save();
				return(-1);
    }

    public function verif_existence()
    {
        //sert à tester la bonne récupération de l'étudiant notamment lorsqu'on veut rajouter du crédit
        if($this->objet)
        {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function changer_credit($delta)
    {
        if($delta && is_numeric($delta))
        {
            $this->objet->set("CREDIT", strval(floatval($this->objet->get("CREDIT"))+$delta));
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function offrirUnCadeau($numEtu)
    {
        $cible=new Etudiant($numEtu, NULL);
        if($cible->verif_existence())
        {
            $retour=$this->validerCommande();
            if($retour!=5)
            {
                $this->panier->changerProprio($numEtu);
                return 15;
            }else{
                return 5;
            }
        }else{
            return 11;
        }
    }
}
