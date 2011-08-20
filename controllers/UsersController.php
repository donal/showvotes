<?php
session_start();

require_once(LIBRARY_PATH . DS . 'Template.php');
require_once(APP_PATH . DS . 'models/User.php');

class UsersController {

  public function __construct() {
    $this->template = new Template;
    $this->template->template_dir = APP_PATH . DS . 'views' . DS . 'users' . DS;

    $this->template->title = 'Users';
  }

  public function index() {
    // must be logged in and the admin to access this page
    if (!isset($_SESSION['user'])) {
      header("Location: /~e46762/wda/showvotes/session/new");
      exit;
    }
    if ($_SESSION['user']['role_id'] > 1) {
      header("Location: /~e46762/wda/showvotes/users/{$_SESSION['user']['id']}");
      exit;
    }

    $this->template->users = User::retrieve();
    $this->template->display('index.html.php');
  }

  public function show($id) {
    // must be logged in to access this page
    if (!isset($_SESSION['user'])) {
      header("Location: /~e46762/wda/showvotes/session/new");
      exit;
    }
    if ($_SESSION['user']['role_id'] > 1 && $_SESSION['user']['id'] != $id) {
      // this user is trying to access a different user
      header("Location: /~e46762/wda/showvotes/users/{$_SESSION['user']['id']}");
      exit;
    }

    $this->template->id = $id;

    // get the user with id = $id
    $user = User::retrieve(array('id' => $id));
    if (count($user) == 1) {
      $this->template->user = $user;
    } else if (count($user) == 0) {
      $this->template->id = $id;
    }

    $this->template->display('show.html.php');
  }

  public function add() {
    $this->template->display('add.html.php');
  }

  public function create() {
    // TODO need to validate data

    // go to this if the create fails
    // $this->template->display('add.html.php');
  }

}
