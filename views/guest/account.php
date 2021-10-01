
<div class="row mt-3">
  <div class="col-12">
    <h3>Bonjour <?=$_SESSION['auth']->username; ?> </h3>

    <form action="?page=users&action=accountAction" method="post">
      <!-- <div class="form-group">
      <input class="form-control" type="password" name="old_password" placeholder="Ancien mot de passe"/>
    </div> -->
    <div class="form-group">
      <input class="form-control" type="password" name="password" placeholder="Nouveau mot de passe"/>
    </div>
    <div class="form-group">
      <input class="form-control" type="password" name="password_confirm" placeholder="Confirmez mon nouveau mot de passe"/>
    </div>
    <button class="btn btn-primary">Changer mon mot de passe</button>
  </form>
</div>
</div>
<?php require '../guest/comon/footer.php'; ?>
