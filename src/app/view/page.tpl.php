<?
$title = clean(!!$data->title ? $data->title." - ".SITE_CONFIG['name'] : SITE_CONFIG['default_title']);
$description = clean(!!$data->description ? $data->description : SITE_CONFIG['default_description']);
$keywords = clean(!!$data->keywords ? $data->keywords : SITE_CONFIG['default_keywords']);
$image = clean(!!$data->image ? $data->image : SITE_CONFIG['default_image']);
$url = clean(!!$data->url ? $data->url : "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?= $title ?></title>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui" />
    <meta name="description" content="<?= $description ?>" />
    <meta name="keywords" content="<?= $keywords ?>" />

    <meta property="og:title" content="<?= $title ?>" />
    <meta property="og:image" content="<?= $image ?>" />
    <meta property="og:description" content="<?= $description ?>" />
    <meta property="og:site_name" content="<?= SITE_CONFIG['name'] ?>" />
    <meta property="og:url" content="<?= $url ?>" />
    <meta property="og:type" content="website" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="<?= $title ?>" />
    <meta name="twitter:description" content="<?= $description ?>" />
    <meta name="twitter:image" content="<?= $image ?>">

    <link rel="stylesheet" href="<?= SITE_ROOT?>css/page.css" />
  </head>

  <body>
    <div id="page">
      <?= $data->body ?>
    </div>
  </body>
</html>
