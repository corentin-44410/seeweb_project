<?php
session_start();
include('../controleur/domain_name_controller.php');
include('./header.php');
include('sidebar.php');
?>


<section id="edit_domain_main" class="card_perso">
  <div class="container">
    <?php if(isset($_GET) && sizeof($_GET)>0){ ?>
      <div class="edit_card_title">
        <h2>Modification de <?= $domain_details['nom'] ?></h2>
      </div>
    <?php }else{ ?>
      <div class="edit_card_title">
        <h2>Créer un nouveau nom de domaine</h2>
      </div>
    <?php } ?>

    <form method="post" action="../controleur/traitement_domain_controller.php">
      <div class="row">
        <div class="col-md-9">
            <div class="form-group">
              <label>Nom de domaine</label>
              <?php if(isset($_GET) && sizeof($_GET)>0){ ?>
                <input type="text" name="domain_name" class="form-control" placeholder="www.example.com" value="<?= $domain_details['nom'] ?>">
              <?php }else{ ?>
                <input type="text" name="domain_name" class="form-control" placeholder="www.example.com">
              <?php } ?>
            </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Coût annuel(€/an)</label>
            <?php if(isset($_GET) && sizeof($_GET)>0){ ?>
              <input type="text" name="domain_price" class="form-control" placeholder="3.99" value="<?= $domain_details['cout_annuel']?>">
            <?php }else{ ?>
              <input type="text" name="domain_price" class="form-control" placeholder="3.99">
            <?php } ?>
          </div>
        </div>
      </div>
      <?php if(isset($_GET) && sizeof($_GET)>0){ ?>
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label>Client du nom de domaine</label>
                <select class="custom-select" name="client">
                  <option value="0">Aucun client</option>
                  <?php
                  foreach ($liste_client as $key => $value) { ?>
                    <?php
                    if ($domain_details['leClient'] == $value['id']) {?>
                      <option selected value="<?= $value['id']?>"><?= $value['prenom'].' '.$value['nom'] ?></option>
                    <?php
                    }
                    else{ ?>
                      <option value="<?= $value['id']?>"><?= $value['prenom'].' '.$value['nom'] ?></option>
                    <?php
                    }
                    ?>
                    <?php
                  } ?>
                </select>
              </div>
          </div>
        </div>
      <?php } ?>
      <br>
      <div style='text-align : right; font-weight : 200;'>
        <?php if(isset($_GET) && sizeof($_GET)>0){ ?>
          <input type="hidden" name="type" value="modify">
          <input type="hidden" name="id_domain" value="<?= $_GET['domain'] ?>">
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

<!-- inclusion of the javascript scripts -->
<script src="../js/edit_domain.js"></script>
