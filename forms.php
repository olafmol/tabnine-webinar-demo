<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = $_POST['title'];
  $body = $_POST['body'];
  // do something with the input values
  echo '<div>Title: '. $title. '</div>';
  echo '<div>Body: '. $body. '</div>';
}

?>