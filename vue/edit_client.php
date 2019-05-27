<?php
session_start();
include('../controleur/client_controller.php');
include('./header.php');
include('sidebar.php');

?>


<section id="edit_domain_main" class="card_perso">
  <div class="container">
    <?php if(isset($_GET) && sizeof($_GET)>0){ ?>
      <div class="edit_card_title">
        <h2>Modification de <?= $client_details['prenom'].' '.$client_details['nom'] ?></h2>
      </div>
    <?php }else{ ?>
      <div class="edit_card_title">
        <h2>Création d'un nouveau client</h2>
      </div>
    <?php } ?>

    <form method="post" action="../controleur/traitement_client_controller.php">
      <div class="row">
        <div class="col-md-4">
            <div class="form-group">
              <label>Nom</label>
              <?php if(isset($_GET) && sizeof($_GET)>0){ ?>
                <input type="text" name="client_name" class="form-control" placeholder="ex. TOTO" value="<?= $client_details['nom'] ?>">
              <?php }else{ ?>
                <input type="text" name="client_name" class="form-control" placeholder="ex. TOTO">
              <?php } ?>
            </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Prénom</label>
            <?php if(isset($_GET) && sizeof($_GET)>0){ ?>
              <input type="text" name="client_surname" class="form-control" placeholder="ex. maxime" value="<?= $client_details['prenom']?>">
            <?php }else{ ?>
              <input type="text" name="client_surname" class="form-control" placeholder="ex. maxime">
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
            <div class="form-group">
              <label>Société</label>
              <?php if(isset($_GET) && sizeof($_GET)>0){ ?>
                <input type="text" name="client_society" class="form-control" placeholder="ex. Seeweb" value="<?= $client_details['societe']?>">
              <?php }else{ ?>
                <input type="text" name="client_society" class="form-control" placeholder="ex. Seeweb">
              <?php } ?>
            </div>
        </div>
      </div>
      <br>
      <div style='text-align : right; font-weight : 200;'>
        <?php if(isset($_GET) && sizeof($_GET)>0){ ?>
          <input type="hidden" name="type" value="modify">
          <input type="hidden" name="id_client" value="<?= $_GET['client'] ?>">
          <button type="submit" class="btn btn-success"><i class="fas fa-check" style="margin-right : 5px"></i>Modifier</button>
          <button  class="btn btn-danger"><i class="fas fa-reply" style="margin-right : 5px"></i>Retour</button>
        <?php }else{ ?>
          <input type="hidden" name="type" value="create">
          <button type="submit" class="btn btn-success"><i class="fas fa-check" style="margin-right : 5px"></i>Confirmer</button>
          <button  class="btn btn-danger"><i class="fas fa-reply" style="margin-right : 5px"></i>Retour</button>
        <?php } ?>
      </div>
    </form>
  </div>
</section>
