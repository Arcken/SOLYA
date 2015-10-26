<?php
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

    <!-- Menu de l'application -->
    <link type="text/css" href="css/style_menu.css" rel="stylesheet" >
    <!--Conteneur principal du Menu -->
    <aside id='menu'>
        <ul>
            <!--Elements du Menu -->

            <!--Partie Accueil-->
            <li><a href='index.php?action=Accueil'><span>Accueil</span></a></li>

            <!--Partie Catalogue-->
            <li><a href='#'><span>Catalogue</span></a>
                <ul>
                    <li><a href='#'><span>Créer</span></a>
                        <ul>
                            <li><a href='index.php?action=ga_add'><span>Gamme</span></a></li>
                            <li><a href='index.php?action=fiart_add'><span>Fiche Article</span></a></li>
                            <li class='last'><a href='index.php?action=ref_add'><span>Référence</span></a></li>
                        </ul>
                    </li>
                    <li><a href='#'><span>Consulter</span></a>
                        <ul>
                            <li><a href='index.php?action=ga_list'><span>Gamme</span></a></li>
                            <li><a href='index.php?action=fiart_list'><span>Fiche Article</span></a></li>
                            <li><a href='index.php?action=ref_list'><span>Référence</span></a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <!--Partie Contact-->
            <li><a href='#'><span>Contact</span></a>
                <ul>
                    <li><a href='#'><span>Créer</span></a>
                        <ul>
                            <li><a href='index.php?action=pers_add'><span>Personne</span></a></li>
                            <li><a href='index.php?action=ent_add'><span>Entreprise</span></a></li>
                        </ul>
                    </li>
                    <li><a href='index.php?action=ctc_list'><span>Consulter</span></a>
                    </li>
                </ul>
            </li>

            <!--Partie Export-->
            <li class='has-sub'><a href='index.php?action=export'><span>Export</span></a>
            </li>

            <!--Partie Information -->
            <li class='has-sub'><a href='#'><span>Information</span></a>
                <ul>
                    <!--Créations -->
                    <li><a href='#'><span>Créer</span></a>
                        <ul>
                            <li><a href='index.php?action=dd_add'><span>Droit de douane</span></a></li>
                            <li><a href='index.php?action=pays_add'><span>Pays</span></a></li>
                            <li><a href='index.php?action=dc_add'><span>Durée conservation</span></a></li>
                            <li><a href='index.php?action=mc_add'><span>Mode conservation</span></a></li>
                            <li><a href='index.php?action=tva_add'><span>Tva</span></a></li>
                            <li><a href='index.php?action=nut_add'><span>Nutrition</span></a></li>
                        </ul>
                    </li>

                    <!--Consultations -->
                    <li><a href='#'><span>Consulter</span></a>
                        <ul>
                            <li><a href='index.php?action=dd_list'><span>Droit de douane</span></a></li>
                            <li><a href='index.php?action=pays_list'><span>Pays</span></a></li>
                            <li><a href='index.php?action=dc_list'><span>Durée conservation</span></a></li>
                            <li><a href='index.php?action=mc_list'><span>Mode conservation</span></a></li>
                            <li><a href='index.php?action=tva_list'><span>Tva</span></a></li>
                            <li><a href='index.php?action=nut_list'><span>Nutrition</span></a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <!--Partie Stock-->
            <li><a href='index.php?action=ref_list'><span>Stock</span></a>
                <ul>
                    <li><a href='#'><span>Créer</span></a>
                        <ul>
                            <li><a href='index.php?action=be_add'><span>Entrée</span></a></li>
                            <li><a href='index.php?action=bon_add'><span>Sortie/Retour</span></a></li>
                            <li><a href='index.php?action=inventaire_add'><span>Inventaire</span></a></li>
                        </ul>
                    </li>
                    <li><a href='#'><span>Consulter</span></a>
                        <ul>
                            <li><a href='index.php?action=be_list' ><span>Entrée</span></a></li>
                            <li><a href='index.php?action=bon_list'><span>Sortie/Retour</span></a></li>
                            <li><a href='index.php?action=inventaire_list'><span>Inventaire</span></a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <!--Partie Utilisateur-->
            <?php if ($_SESSION['group'] >= '1') { ?>
                <li><a href='#'><span>Utilisateur</span></a>
                    <ul>
                        <li class='has-sub'><a href='index.php?action=ut_add'><span>Créer</span></a>
                        </li>

                        <li class='has-sub'><a href='index.php?action=ut_list'><span>Consulter</span></a>
                        </li>
                    </ul>
                </li>
            <?php } ?>

        </ul>
    </aside>
    <?php
} else
    echo 'Le silence est d\'or'




    
?>