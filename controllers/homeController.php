<?php

class homeController
{
  public function index()
  {
    if(isset($_SESSION['auth'])){

      $_SESSION['flash']['danger'] = "Veuillez vous connecter";
      header('Location: ?page=users&action=login');
      exit();
    }

    // $userModel = new userModel;
    // $user = $userModel->searchById($_GET['id']);
    //
    // return '../views/profile.php';
  }
}
