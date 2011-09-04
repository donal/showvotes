<?php
session_start();

require_once(LIBRARY_PATH . DS . 'Template.php');
require_once(APP_PATH . DS . 'models/Show.php');

class ShowsController {

  public function __construct() {
    $this->template = new Template;
    $this->template->template_dir = APP_PATH . DS . 'views' . DS . 'shows' . DS;

    $this->template->title = 'Shows';
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

    $this->template->shows = Show::retrieve();
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

    // get the show with id = $id
    $show = Show::retrieve(array('id' => $id));
    if (count($show) == 1) {
      $this->template->show = $show;
    } else if (count($show) == 0) {
      $this->template->id = $id;
    }

    $this->template->display('show.html.php');
  }

  public function add() {
    // must be logged in and the admin to access this page
    if (!isset($_SESSION['user'])) {
      header("Location: /~e46762/wda/showvotes/session/new");
      exit;
    }
    if ($_SESSION['user']['role_id'] > 1) {
      header("Location: /~e46762/wda/showvotes/users/{$_SESSION['user']['id']}");
      exit;
    }

    if (isset($_SESSION['show']['errors'])) {
      $this->template->errors = $_SESSION['show']['errors'];
      unset($_SESSION['show']['errors']);
    }
    if (isset($_SESSION['show'])) {
      $this->template->show = $_SESSION['show'];
      unset($_SESSION['show']);
    }
    $this->template->display('add.html.php');
  }

  public function create() {
    // must be logged in and the admin to access this page
    if (!isset($_SESSION['user'])) {
      header("Location: /~e46762/wda/showvotes/session/new");
      exit;
    }
    if ($_SESSION['user']['role_id'] > 1) {
      header("Location: /~e46762/wda/showvotes/users/{$_SESSION['user']['id']}");
      exit;
    }

    // must have some POSTed data
    // could check for referer here
    if (!isset($_POST) || empty($_POST)) {
      header("Location: /~e46762/wda/showvotes/users/new");
      exit;
    }
    // TODO need to validate data
    $data = array(
      'name' => $_POST['name'],
      'hashtag' => $_POST['hashtag'],
      'image' => $_FILES['image'],
    );
    if (!Show::validates($data)) {
      // store errors in session and redirect
      $_SESSION['show'] = $data;
      $_SESSION['show']['errors'] = Show::errors();
      header("Location: /~e46762/wda/showvotes/shows/new");
      exit;
    }

    // copy the image into the web directory
    $from = $_FILES['image']['tmp_name'];
    $to = '/home/staff/e46762/.HTMLinfo/wda/showvotes/webroot/images/shows/' . $_FILES['image']['name'];

    if (!move_uploaded_file($from, $to)) {
      // something went wrong with upload, handle this somehow
      echo "file move failed";
      exit;
    }

    $_POST['image'] = $_FILES['image']['name'];
    // create a new show
    // log the show in
    // redirect to show's view page
    $id = Show::create($_POST);
    header("Location: /~e46762/wda/showvotes/shows/{$id}");
    exit;
  }

  public function edit($id) {
    // must be logged in and the admin to access this page
    if (!isset($_SESSION['user'])) {
      header("Location: /~e46762/wda/showvotes/session/new");
      exit;
    }
    if ($_SESSION['user']['role_id'] > 1) {
      header("Location: /~e46762/wda/showvotes/users/{$_SESSION['user']['id']}");
      exit;
    }

    if (!$show = Show::retrieve(array('id' => $id))) {
      // something has gone wrong with db request
      header("Location: /~e46762/wda/showvotes/shows/{$id}}");
      exit;
    }
    $this->template->show = $show;

    if (isset($_SESSION['show']['errors'])) {
      $this->template->errors = $_SESSION['show']['errors'];
      unset($_SESSION['show']['errors']);
    }

    $this->template->display('edit.html.php');
  }

  public function update($id) {
    // must be logged in and the admin to access this page
    if (!isset($_SESSION['user'])) {
      header("Location: /~e46762/wda/showvotes/session/new");
      exit;
    }
    if ($_SESSION['user']['role_id'] > 1) {
      header("Location: /~e46762/wda/showvotes/users/{$_SESSION['user']['id']}");
      exit;
    }

    // must have some POSTed data
    // could check for referer here
    if (!isset($_POST) || empty($_POST)) {
      header("Location: /~e46762/wda/showvotes/shows/{$id}");
      exit;
    }
    // TODO need to validate data
    if (!Show::validates($_POST)) {
      // store errors in session and redirect
      $_SESSION['show']['errors'] = Show::errors();
      header("Location: /~e46762/wda/showvotes/shows/{$id}/edit");
      exit;
    }

    // update show
    // redirect to show's show page
    Show::update($id, $_POST);
    header("Location: /~e46762/wda/showvotes/shows/{$id}");
    exit;
  }

  public function tweets($id) {
    $this->template->id = $id;

    // get the show with id = $id
    $show = Show::retrieve(array('id' => $id));
    if (count($show) == 1) {
      $this->template->show = $show;
    } else if (count($show) == 0) {
      header("Location: /~e46762/wda/showvotes/shows/{$id}");
      exit;
    }

    // get tweets with this show's hashtag
    $search = urlencode($show->hashtag); 
    $ch = curl_init("http://search.twitter.com/search.json?q={$search}&result_type=recent");

    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   
    $tweets = array(); 
    if ($result = curl_exec($ch)) {
      $json_obj = json_decode($result);
      foreach ($json_obj->results as $result) {
        $tweets[] = $result->text;
      }
    }
    curl_close($ch);
    $this->template->tweets = $tweets;

    $this->template->display('tweets.html.php');
  }

  public function ajaxtweets($id) {
    $this->template->id = $id;

    // get the show with id = $id
    $show = Show::retrieve(array('id' => $id));
    if (count($show) == 1) {
      $this->template->show = $show;
    } else if (count($show) == 0) {
      header("Location: /~e46762/wda/showvotes/shows/{$id}");
      exit;
    }

    // get tweets with this show's hashtag
    $search = urlencode($show->hashtag); 

    $this->template->display('ajaxtweets.html.php');
  }


}
