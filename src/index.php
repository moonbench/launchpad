<?php
require "app/main.php";

render("page", [
  "body" => "<h2>Hello world!</h2><div>This is the default <code>index.php</code> file.</div>",
  "title" => "Home",
]);
?>
