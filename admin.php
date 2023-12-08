<?php
require_once 'script.php';
/**
 * @var array $profile Profile data
 * @var boolean $saved Data saved
 */
?>
<html lang="it">
<head>
  <title>BioLink</title>
  <link rel="stylesheet" href="style.css"/>
  <script src="script.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<section>
  <?php if($saved === true): ?>
    <p class="success">Data saved successfully!</p>
  <?php elseif($saved === false): ?>
    <p class="error">An error occurred while saving data!</p>
  <?php endif; ?>
  <h1>Administration</h1>
  <form action="admin.php" method="post" enctype="multipart/form-data">
    <label for="avatar">Avatar</label><br/>
    <input type="file" id="avatar" name="avatar" accept=".jpg"/>
    <br/><br/>
    <label for="title">Title</label><br/>
    <input type="text" id="title" name="title" size="20" value="<?= $profile['title'] ?>"/>
    <br/><br/>
    <label for="description">Description</label><br/>
    <input type="text" id="description" name="description" size="40" value="<?= $profile['description'] ?>"/>
    <br/><br/>
    <div id="links">
      <?php foreach($profile['links'] as $name => $url): ?>
        <div>
          <input type="text" name="linksName[]" size="10" value="<?= $name ?>"/>
          <input type="text" name="linksURL[]" size="20" value="<?= $url ?>"/>
          <input type="button" value="Remove" class="removeLink"/>
          <br/><br/>
        </div>
      <?php endforeach; ?>
    </div>
    <div id="linkTemplate" class="hidden">
      <input type="text" name="linksName[]" size="10"/>
      <input type="text" name="linksURL[]" size="20"/>
      <input type="button" value="Remove" class="removeLink"/>
      <br/><br/>
    </div>
    <input type="button" value="Back" onClick="location.href='index.php'">
    <input type="button" value="Logout" onClick="location.href='auth.php'">
    <input type="button" value="New Link" onClick="addLink()">
    <input type="submit" name="submit" value="Save">
  </form>
</section>
</body>
</html>
