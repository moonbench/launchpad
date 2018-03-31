<?
$title = "Launchpad";
if($data->title) $title = $data->title . " - " . $title;
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?= $title ?></title>

    <meta charset="utf-8" />
<? if(isset($data->description)): ?>
    <meta name="description" content="<?= clean($data->description) ?>">
<? endif; ?>

    <link rel="stylesheet" href="css/mistdrop.css" />
    <link rel="stylesheet" href="css/page.css" />

    <script type="text/javascript" src="js/base.js"></script>
  </head>

  <body>
    <div id="page">
      <div id="header">
        <h1>Launchpad</h1>
      </div>
      <hr>

      <div id="body">
       <?= $data->body ?>
      </div>
      <hr>

      <div id="footer">
        <div>
          You can edit or replace the page template in: <code>app/view/page.tpl.php</code>
        </div>
        Launchpad 0.1.0
      </div>
    </div>
  </body>
</html>
