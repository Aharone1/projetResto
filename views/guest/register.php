<div class="row mt-3">
  <div class="col-12">

    <?php if(!empty($errors)):  ?>

      <div class="alert alert-danger">
        <p>Vous n'avez pas rempli le formulaire correctement !</p>
        <ul>
          <?php foreach ($errors as $error): ?>
            <li><?= $error; ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <section class="row">
      <div class="modal-dialog" role="document">
        <div class="modal-content rounded-5">
          <div class="modal-header p-5 pb-4 border-bottom-0">
            <!-- <h5 class="modal-title">Modal title</h5> -->
            <h1 class="fw-bold mb-0">Connexion</h1>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
          </div>

          <div class="modal-body p-5 pt-0">
            <form action="?page=users&action=registerAction" method="post">
              <div class="form-floating mb-3">
                <input type="email" class="form-control rounded-4" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control rounded-4" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
              </div>
              <button class="w-100 mb-2 btn btn-lg rounded-4 btn-primary" type="submit">Sign up</button>
              <!-- <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small> -->
              <hr class="my-4">
              <h2 class="fs-5 fw-bold mb-3">Or use a third-party</h2>
              <button class="w-100 py-2 mb-2 btn btn-outline-dark rounded-4" type="submit">
                <svg class="bi me-1" width="16" height="16"><use xlink:href="#twitter"/></svg>
                Sign up with Twitter
              </button>
              <button class="w-100 py-2 mb-2 btn btn-outline-primary rounded-4" type="submit">
                <svg class="bi me-1" width="16" height="16"><use xlink:href="#facebook"/></svg>
                Sign up with Facebook
              </button>
              <button class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-4" type="submit">
                <svg class="bi me-1" width="16" height="16"><use xlink:href="#github"/></svg>
                Sign up with GitHub
              </button>
            </form>
          </div>
        </div>
      </div>

      <div class="modal-dialog" role="document">
        <div class="modal-content rounded-5">
          <div class="modal-header p-5 pb-4 border-bottom-0">
            <!-- <h5 class="modal-title">Modal title</h5> -->
            <h1 class="fw-bold mb-0">Inscription</h1>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
          </div>

          <div class="modal-body p-5 pt-0">
            <form action="?page=users&action=registerAction" method="post">
              <div class="form-floating mb-3">
                <input type="text" class="form-control rounded-4" id="floatingName" placeholder="name@example.com">
                <label for="floatingName">Nom</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control rounded-4" id="floatingLastname" placeholder="name@example.com">
                <label for="floatingLastname">Prénom</label>
              </div>
              <div class="form-floating mb-3">
                <input type="email" class="form-control rounded-4" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control rounded-4" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
              </div>
              <button class="w-100 mb-2 btn btn-lg rounded-4 btn-primary" type="submit">Sign up</button>
              <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>
              <!-- <hr class="my-4">
              <h2 class="fs-5 fw-bold mb-3">Or use a third-party</h2>
              <button class="w-100 py-2 mb-2 btn btn-outline-dark rounded-4" type="submit">
              <svg class="bi me-1" width="16" height="16"><use xlink:href="#twitter"/></svg>
              Sign up with Twitter
            </button>
            <button class="w-100 py-2 mb-2 btn btn-outline-primary rounded-4" type="submit">
            <svg class="bi me-1" width="16" height="16"><use xlink:href="#facebook"/></svg>
            Sign up with Facebook
          </button>
          <button class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-4" type="submit">
          <svg class="bi me-1" width="16" height="16"><use xlink:href="#github"/></svg>
          Sign up with GitHub
        </button> -->
      </form>
    </div>
  </div>
</div>
</section>

<!-- <form action="?page=users&action=registerAction" method="post">
<div class="form-group">

<label for="">Pseudo</label>
<input type="text" name="username" class="form-control"/>

</div>

<div class="form-group">

<label for="">Email</label>
<input type="email" name="email" class="form-control"/>

</div>

<div class="form-group">

<label for="">Mot de Passe</label>
<input type="password" name="password" class="form-control"/>

</div>

<div class="form-group">

<label for="">Confirmez votre Mot de Passe</label>
<input type="password" name="password_confirm" class="form-control"/>

</div>

<button type="submit" name="button" class="btn btn-primary">M'inscrire</button>

</form> -->
</div>
</div>
