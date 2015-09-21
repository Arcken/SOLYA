<?php
if (isset($_SESSION['group']) && $_SESSION['group'] >=0) {
    ?>

<!-- Menu de l'application -->
<link type="text/css" href="css/style_menu.css" rel="stylesheet" >
<!--Conteneur principal du Menu -->
<aside id='menu'>
    <!--Elements du Menu -->
<ul>
   <li><a href='index.php?action=Accueil'><span>Accueil</span></a></li>
   <li><a href='#'><span>Contacts</span></a>
      <ul>
         <li><a href='index.php?action=ctc_add'><span>Créer</span></a>
            <ul>
               <li><a href='#'><span>Fournisseur</span></a></li>
               <li><a href='#'><span> Client</span></a></li>
               <li><a href='#'><span>Prospect</span></a></li>
            </ul>
         </li>
         <li><a href='#'><span>Consulter</span></a>
            <ul>
               <li><a href='#'><span>Fournisseur</span></a></li>
               <li><a href='#'><span>Client</span></a></li>
               <li class='last'><a href='#'><span>Prospect</span></a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li><a href='#'><span>Stock</span></a>
      <ul>
         <li><a href='#'><span>Créer</span></a>
            <ul>
               <li><a href='#'><span>Entrée</span></a></li>
               <li><a href='#'><span>Sortie</span></a></li>
               <li><a href='#'><span>Retour</span></a></li>
               <li><a href='#'><span>Inventaire</span></a></li>
            </ul>
         </li>
         <li><a href='#'><span>Consulter</span></a>
            <ul>
               <li><a href='#'><span>Entrée</span></a></li>
               <li><a href='#'><span>Sortie</span></a></li>
               <li><a href='#'><span>Retour</span></a></li>
               <li><a href='#'><span>Inventaire</span></a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li><a href='#'><span>Catalogue</span></a>
      <ul>
         <li><a href='#'><span>Créer</span></a>
            <ul>
               <li><a href='index.php?action=ga_add'><span>Gamme</span></a></li>
               <li><a href='index.php?action=fiart_add'><span>Fiche Article</span></a></li>
               <li class='last'><a href='index.php?action=ref_add'><span>Références</span></a></li>
            </ul>
         </li>
         <li><a href='#'><span>Consulter</span></a>
            <ul>
               <li><a href='#'><span>Gamme</span></a></li>
               <li><a href='#'><span>Fiche Article</span></a></li>
               <li><a href='#'><span>Références</span></a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li><a href='#'><span>Achats</span></a>
      <ul>
         <li><a href='#'><span>Créer</span></a>
            <ul>
               <li><a href='#'><span>Commande</span></a></li>
               <li><a href='#'><span>Facture</span></a></li>
               <li class='last'><a href='#'><span>Paiement</span></a></li>
            </ul>
         </li>
         <li><a href='#'><span>Consulter</span></a>
            <ul>
               <li><a href='#'><span>Commande</span></a></li>
               <li><a href='#'><span>Facture</span></a></li>
               <li class='last'><a href='#'><span>Paiement</span></a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li><a href='#'><span>Ventes</span></a>
      <ul>
         <li><a href='#'><span>Créer</span></a>
            <ul>
               <li><a href='#'><span>Commande</span></a></li>
               <li><a href='#'><span>Devis</span></a></li>
               <li><a href='#'><span>Facture</span></a></li>
               <li class='last'><a href='#'><span>Encaissement</span></a></li>
            </ul>
         </li>
         <li><a href='#'><span>Consulter</span></a>
            <ul>
               <li><a href='#'><span>Commande</span></a></li>
               <li><a href='#'><span>Devis</span></a></li>
               <li><a href='#'><span>Facture</span></a></li>
               <li><a href='#'><span>Encaissement</span></a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li><a href='#'><span>Statistiques</span></a>
      <ul>
         <li class='has-sub'><a href='#'><span>Consulter</span></a>
            <ul>
               <li><a href='#'><span>Annuel</span></a></li>
               <li><a href='#'><span>Mensuel</span></a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li><a href='#'><span>Alertes</span></a></li>
    <li><a href='#'><span>Consulter</span></a>
      <ul>
         <li class='has-sub'><a href='index.php?action=pays'><span>Pays</span></a>
             <ul>
               <li><a href='pays_add'><span>Ajouter</span></a></li>
               <li><a href='pays_list'><span>Liste</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='index.php?action=dd'><span>Droit douane</span></a>
             <ul>
               <li><a href='dd_add'><span>Ajouter</span></a></li>
               <li><a href='dd_list'><span>Liste</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='index.php?action=dc'><span>Durée conservation</span></a>
             <ul>
               <li><a href='dc_add'><span>Ajouter</span></a></li>
               <li><a href='dc_list'><span>Liste</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='index.php?action=tva'><span>TVA</span></a>
             <ul>
               <li><a href='tva_add'><span>Ajouter</span></a></li>
               <li><a href='tva_list'><span>Liste</span></a></li>
            </ul>
         </li>
          <li class='has-sub'><a href='index.php?action=tva'><span>Nutrition</span></a>
             <ul>
               <li><a href='nut_add'><span>Ajouter</span></a></li>
               <li><a href='nut_list'><span>Liste</span></a></li>
            </ul>
         </li>
          <li class='has-sub'><a href='index.php?action=emballage'><span>Emballage</span></a>
             <ul>
               <li><a href='emb_add'><span>Ajouter</span></a></li>
               <li><a href='emb_list'><span>Liste</span></a></li>
            </ul>
         </li>
          <li class='has-sub'><a href='index.php?action='><span>Liste Fiche article</span></a>
             <ul>
               <li><a href='index.php?action=fiart_list'><span>Liste fiche article</span></a></li>
               <li><a href='index.php?action=ref_list'><span>Liste référence</span></a></li>
            </ul>
         </li>
      </ul>
   </li>
</ul>
</aside>
<?php
}
else echo 'Le silence est d\'or'
?>