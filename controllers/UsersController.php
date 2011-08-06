<?php

require_once(LIBRARY_PATH . DS . 'Template.php');
require_once(APP_PATH . DS . 'models/User.php');

class UsersController {

  public function __construct() {
    $this->template = new Template;
    $this->template->template_dir = APP_PATH . DS . 'views' . DS . 'users' . DS;

    $this->template->title = 'Users';
  }

  public function index() {
    $this->template->display('index.html.php');
  }

  public function show($id) {
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

}
