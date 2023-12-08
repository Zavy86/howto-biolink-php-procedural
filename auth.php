<?php
require_once 'script.php';
/**
 * @var boolean $error Authentication error
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
  <?php if($error === true): ?>
    <p class="error">Wrong password!</p>
  <?php endif; ?>
  <h1>Authentication</h1>
  <form action="auth.php" method="post">
    <label for="password">Password</label><br/>
    <input type="password" id="password" name="password" size="25"/>
    <br/><br/>
    <input type="button" value="Back" onClick="location.href='index.php'">
    <input type="submit" name="submit" value="Authenticate">
  </form>
</section>
</body>
</html>
