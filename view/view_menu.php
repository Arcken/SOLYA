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
               <li><a href='index.php?action=be_add'><span>Entrée</span></a></li>
               <li><a href='index.php?action=bon_add'><span>Sortie/Retour</span></a></li>
               <li><a href='#'><span>Inventaire</span></a></li>
            </ul>
         </li>
         <li><a href='#'><span>Consulter</span></a>
            <ul>
               <li><a href='#' ><span>Entrée</span></a></li>
               <li><a href='index.php?action=bon_list'><span>Sortie/Retour</span></a></li>
               <li><a href='index.php?action=bon_detail'><span>Modif/Détail</span></a></li>
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
               <li><a href='index.php?action=ga_list'><span>Gamme</span></a></li>
               <li><a href='index.php?action=fiart_list'><span>Fiche Article</span></a></li>
               <li><a href='index.php?action=ref_list'><span>Références</span></a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li><a href='#'><span>Achats</span></a>
      <ul>
         <li><a href='#'><span>Créer</span></a>
            <ul>
               <li><a href='index.php?action=be_add'><span>Bon Entrée</span></a></li>
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
          <li class='has-sub'><a href='index.php?action=be'><span>Bon entré</span></a>
             <ul>
               <li><a href='index.php?action=be_add'><span>Ajouter</span></a></li>
               <li><a href='index.php?action=be_list'><span>Liste</span></a></li>
               <li><a href='index.php?action=be_detail'><span>Détail</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='index.php?action=pays'><span>Pays</span></a>
             <ul>
               <li><a href='index.php?action=pays_add'><span>Ajouter</span></a></li>
               <li><a href='index.php?action=pays_list'><span>Liste</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='index.php?action=dd'><span>Droit douane</span></a>
             <ul>
               <li><a href='index.php?action=dd_add'><span>Ajouter</span></a></li>
               <li><a href='index.php?action=dd_list'><span>Liste</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='index.php?action=dc'><span>Durée conservation</span></a>
             <ul>
               <li><a href='index.php?action=dc_add'><span>Ajouter</span></a></li>
               <li><a href='index.php?action=dc_list'><span>Liste</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='index.php?action=mc'><span>Mode conservation</span></a>
             <ul>
               <li><a href='index.php?action=mc_add'><span>Ajouter</span></a></li>
               <li><a href='index.php?action=mc_list'><span>Liste</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='index.php?action=tva'><span>TVA</span></a>
             <ul>
               <li><a href='index.php?action=tva_add'><span>Ajouter</span></a></li>
               <li><a href='index.php?action=tva_list'><span>Liste</span></a></li>
            </ul>
         </li>
          <li class='has-sub'><a href='index.php?action=tva'><span>Nutrition</span></a>
             <ul>
               <li><a href='index.php?action=nut_add'><span>Ajouter</span></a></li>
               <li><a href='index.php?action=nut_list'><span>Liste</span></a></li>
            </ul>
         </li>
          <li class='has-sub'><a href='index.php?action=emballage'><span>Emballage</span></a>
             <ul>
               <li><a href='index.php?action=emb_add'><span>Ajouter</span></a></li>
               <li><a href='index.php?action=emb_list'><span>Liste</span></a></li>
            </ul>
         </li>
          <li class='has-sub'><a href='index.php?action='><span>Fiche article</span></a>
             <ul>
                 <li><a href='index.php?action=fiart_add'><span>Ajout fiche article</span></a></li>
               <li><a href='index.php?action=fiart_list'><span>Liste fiche article</span></a></li>
               <li><a href='index.php?action=ref_list'><span>Liste référence</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='index.php?action='><span>Référence</span></a>
             <ul>
                <li><a href='index.php?action=ref_add'><span>Ajout référence</span></a></li>
               <li><a href='index.php?action=ref_list'><span>Liste référence</span></a></li>
            </ul>
         </li>
          <li class='has-sub'><a href='index.php?action='><span>Inventaire</span></a>
             <ul>
                <li><a href='index.php?action=inventaire_add'><span>Ajout inventaire</span></a></li>
               <li><a href='index.php?action=inv_list'><span>Liste inventaire</span></a></li>
            </ul>
         </li>
          <li class='has-sub'><a href='index.php?action=export'><span>Export</span></a>
         </li>
      </ul>
   </li>
</ul>
</aside>
<?php
}
else echo 'Le silence est d\'or'
?>