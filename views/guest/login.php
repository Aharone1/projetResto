
<div class="row mt-3">
  <div class="col-12">
    <h1>Se connecter</h1>

    <form action="?page=users&action=loginAction" method="post">
      <div class="form-group">
        <label for="">Pseudo ou Email</label>
        <input type="text" name="username" class="form-control"/>
      </div>

      <div class="form-group">
        <label for="">Mot de Passe</label>
        <input type="password" name="password" class="form-control"/>
        <a href="?page=users&action=forgetAction">Mot de passe oublié</a>
      </div>
      <button type="submit" name="button" class="btn btn-primary">Se connecter</button>
    </form>
  </div>
</div>
