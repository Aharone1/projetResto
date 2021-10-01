<?php

/**
*
*/
class usersController
{
  public function login()
  {
    require '../views/guest/login.php';
  }

  public function loginAction()
  {

    if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
      require_once '../models/db.php';
      // $req = $pdo->prepare('SELECT * FROM users WHERE username = :username OR email = :username');
      $req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');
      $req->execute(['username' => $_POST['username']]);
      $user = $req->fetch();
      if($user == null){
        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
      }elseif(password_verify($_POST['password'], $user->password)){
        $_SESSION['auth'] = $user;
        $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
        header('Location: ?page=users&action=account');
        exit();
      }else{
        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
      }
    }
  }

  public function register()
  {
    require '../views/guest/register.php';
  }

  public function registerAction()
  {

    if (!empty($_POST)) {

      $errors = array();
      require_once '../models/db.php';
      require_once '../helpers/stringHelper.php';

      function str_random($length){
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
      }

      if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){
        $errors['username'] = "Votre pseudo n'est pas valide";
      }else{
        $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $req->execute([$_POST['username']]);
        $user = $req->fetch();
        if($user){
          $errors['username'] = 'Ce pseudo est déjà pris';
        }
      }

      if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Votre email n'est pas valide";
      }else{
        $req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $req->execute([$_POST['email']]);
        $user = $req->fetch();
        if($user){
          $errors['email'] = 'Cet email est déjà utilisé pour un autre compte';
        }
      }

      if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
        $errors['password'] = "Vous devez rentrer un mot de passe valide";
      }

      if(empty($errors)){

        $req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $token = str_random(60);
        $req->execute([$_POST['username'], $password, $_POST['email'], $token]);
        $user_id = $pdo->lastInsertId();
        mail($_POST['email'], 'Confirmation de votre compte Expense Management', "Pour valider votre compte, merci de cliquer sur ce lien : \n\nhttp://localhost:81/PHP/ExpenseManagement/public/?page=users&action=confirmAction?id=$user_id&token=$token");
        $_SESSION['flash']['sucess'] = 'Un email de confirmation vous a été envoyer pour confirmer votre compte';
        header('Location: ?page=users&action=login');
        exit();
      }
    }
  }

  public function account()
  {
    require '../views/guest/account.php';
  }

  public function accountAction()
  {
    logged_only();

    if(!empty($_POST)){
      if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
        $_SESSION['flash']['danger'] = "Les mots de passe ne correspondent pas";
      }else {
        $user_id = $_SESSION['auth']->id;
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        require_once '../models/db.php';
        $pdo->prepare('UPDATE users SET password = ? WHERE id = ?')->execute([$password, $user_id]);

        $_SESSION['flash']['success'] = "Mot de passe mis à jour";

      }
    }
  }

  // public function confirm()
  // {
  //   require '../views/guest/confirm.php';
  // }

  public function confirmAction()
  {
    $user_id = $_GET['id'];
    $token = $_GET['token'];
    require '../models/db.php';
    $req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    $req->execute([$user_id]);
    $user = $req->fetch();
    session_start();

    if($user && $user->confirmation_token == $token ){
      $pdo->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?')->execute([$user_id]);
      $_SESSION['flash']['success'] = 'Votre compte a bien été validé';
      $_SESSION['auth'] = $user;
      header('Location: ?page=users&action=account');
    }else{
      $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
      header('Location: ?page=users&action=login');
    }
  }

  public function reset()
  {
    require '../views/guest/reset.php';
  }

  public function resetAction()
  {
    if(isset($_GET['id']) && isset($_GET['token'])) {

      require '../models/db.php';
      $req = $pdo->prepare('SELECT * FROM users WHERE id = ? AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
      $req->execute([$_GET['id'], $_GET['token']]);
      $user = $req->fetch();
      if($user){
        debug($user);
      }else{
        $_SESSION['flash']['danger'] = "Ce token n'est pas valide";
        header('Location: ?page=users&action=login');
        exit();
      }
    }else{
      header('Location: ?page=users&action=login');
      exit();
    }
  }

  public function forget()
  {
    require '../views/guest/forget.php';
  }

  public function forgetAction()
  {
    if(!empty($_POST) && !empty($_POST['email'])){
      require_once '../models/db.php';
      // $req = $pdo->prepare('SELECT * FROM users WHERE username = :username OR email = :username');
      $req = $pdo->prepare('SELECT * FROM users WHERE email = :email AND confirmed_at IS NOT NULL');
      $req->execute(['email' => $_POST['email']]);
      $user = $req->fetch();
      if($user){
        session_start();
        $reset_token = str_random(60);
        $pdo->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user->id]);
        $_SESSION['flash']['success'] = 'Un email vous a été envoyer';
        mail($_POST['email'], 'Réinitialisation du mot de passe Expense Management', "Pour réinitialiser votre mot de passe, merci de cliquer sur ce lien : \n\nhttp://localhost:81/PHP/ExpenseManagement/public/?page=users&action=resetAction?id={user->id}&token=$reset_token");
        header('Location: ?page=users&action=login');
        exit();
      }else {
        $_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cet email';
      }
    }
  }

  // public function archivesAction();
  // {
  // }
}
