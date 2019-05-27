<?php
session_start();
include_once('../controleur/domain_name_controller.php');
include_once('./header.php');
include_once('sidebar.php');
?>
<h1 style="margin-top : 20px">Noms de domaines</h1>

<!-- Haut de la page -->
<section id="top_search_bar_section" class="">
  <div class="row">
    <div class="input-group mb-3 col-md-12">
      <input id="searchbar" type="text" class="form-control searchbar" style="background: transparent;color: white;" placeholder="Entrer un nom de domaine ici...">
      <div id="searchbar_div" class="input-group-append">
        <button class="btn btn-warning button-action" type="button"><i class="fas fa-search" style="margin-right : 5px"></i></button>
        <div id="list" class="list-group">
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Fin du haut de la page web -->

<!-- Liste des noms de domaines -->
<section id="main">
  <!-- Header du tableau -->
  <div class="tbl-header" style="padding-right : 0px">
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
          <th>Nom de domaine</th>
          <th>Disponibilité</th>
          <th>Prix Annuel</th>
          <th></th>
      </thead>
    </table>
  </div>
  <!-- Contenu du tableau -->
  <div class="tbl-content">
    <table id="table" cellpadding="0" cellspacing="0" border="0">
      <tbody>
        <?php foreach ($liste_domain_name as $key => $value) { ?>
          <tr>
            <td style="font-weight : bold"><?= $value['nom'] ?></td>
            <?php if(isset($value['leClient'])){ ?>
              <td class="unavalaible"><i class="fas fa-times" style="margin-right : 5px"></i><?= $value['prenomClient'].' '.$value['nomClient'].'('.$value['societe'].')' ?></td>
            <?php }else{ ?>
              <td class="avalaible"><i class="fas fa-check" style="margin-right : 5px"></i>Disponible</td>
            <?php } ?>
            <td><?= $value['cout_annuel'] ?>€/an</td>
            <!-- Si le domaine a un client -->
            <?php if(isset($value['leClient'])){ ?>
              <td>
                <a href="edit_domain.php?domain=<?= $value['id']?>" type="button" class="btn btn-primary button-action">
                  <i class="fas fa-pencil-alt" style="margin-right : 5px"></i>Modifier
                </a>
                <button type="button" class="btn btn-danger button-action" data-toggle="modal" data-target="#modal_delete_domain" data-value-delete="<?= $value['id']?>">
                  <i class="fas fa-trash-alt" style="margin-right : 5px"></i>Supprimer
                </button>
              </td>
            <!-- Sinon -->
            <?php }else{ ?>
              <td>
                <button type="button" class="btn btn-warning button-action" data-toggle="modal" data-target="#modal_reserve_domain" data-myvalue="<?= $value['id']?>">
                  <i class="fas fa-plus" style="margin-right : 5px"></i>Réserver
                </button>
                <button type="button" class="btn btn-danger button-action" data-toggle="modal" data-target="#modal_delete_domain" data-value-delete="<?= $value['id']?>">
                  <i class="fas fa-trash-alt" style="margin-right : 5px"></i>Supprimer
                </button>
              </td>
            <?php } ?>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</section>
<!-- Fin de la liste des noms  de domaine -->

<!-- Modal reservation du nom de domaine-->
<div class="modal fade" id="modal_reserve_domain" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <form action="../controleur/reserve_domain_controller.php" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Réservation du nom de domaine</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="index.php" method="post">
            <select name="client" class="form-control form-control-lg">
              <?php foreach ($liste_client as $key => $value) { ?>
                <option value="<?= $value['id']?>"><?php echo $value['nom'].' '.$value['prenom']; ?></option>
              <?php } ?>
            </select>
          </form>
          <input type="hidden" id="modal-myvalue" name="domain" value=""></input>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-warning">Réserver</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Fin de la Modal -->

<!-- Modal suppression du nom de domaine-->
<div class="modal fade" id="modal_delete_domain" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <form method="post" action="../controleur/traitement_domain_controller.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Avertissement</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Voulez vous vraiment supprimer le nom de domaine ?
        </div>
        <input type="hidden" id="modal-value-delete" name="domain" value=""></input>
        <input type="hidden" name="type" value="delete"></input>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
          <button type="submit" class="btn btn-danger">Oui</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Fin de la Modal -->

<!-- Modal modification des clients-->
<div class="modal fade" id="modal_modify_client" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <form method="get" action="../vue/edit_client.php" style="width: 100%;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Sélection d'un client</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Sélectionnez un client à modifier
          <select class="custom-select" name="client" >
            <?php foreach ($liste_client as $key => $value) { ?>
              <option value="<?=$value['id']?>"><?= $value['prenom'].' '.$value['nom'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-danger">Sélectionner</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Fin de la Modal -->


<!-- inclusion of the javascript scripts -->
<script src="../js/index.js"></script>
