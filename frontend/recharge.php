<?php
$titre_page='Recharge';
$page='
<div class="row">
    <div class="col m4 offset-m4 s12">
        <div class="row">
            <form method="post" action="index.php?page=recharger">
                <div class="input-field col s12">
                    Numéro étudiant
                    <input id="num_etu" name="num_etu" type="text" class="validate">
                </div>
                <div class="input-field col s12">
                    Montant
                    <input id="montant" name="montant" type="text" class="validate">
                </div>
                <div class="row center-align">
                    <button class="btn waves-effect waves-light bouton" type="submit" name="action">
                        Recharger<i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
';
