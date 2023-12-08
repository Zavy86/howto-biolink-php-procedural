<?php

// start session
session_start();

// check authentication
if(str_ends_with($_SERVER['PHP_SELF'],'admin.php')){
  if(
    !array_key_exists('authenticated',$_SESSION) ||
    $_SESSION['authenticated'] !== true
  ){
    header('location: auth.php');
  }
}

// try to authenticate
if(str_ends_with($_SERVER['PHP_SELF'],'auth.php')){
  $error = null;
  if(array_key_exists('submit',$_REQUEST) && $_REQUEST['submit'] === 'Authenticate'){
    //var_dump(password_hash('password',PASSWORD_BCRYPT));
    if(password_verify($_REQUEST['password'],'$2y$10$U7qeBWNrbPuQklHnMSbAqe78mxQfYJO1kw7k9hcSx4G3/4bTgMYRW')){
      $_SESSION['authenticated'] = true;
      header('location: admin.php');
    }else{
      $error = true;
    }
  }else{
    session_destroy();
  }
}

// retrieve and decode data
if(file_exists('data.json')){
  $fileContent = file_get_contents('data.json');
  if($fileContent !== false){
    $decodedData = json_decode($fileContent,true);
    if(is_array($decodedData)){
      $profile = $decodedData;
    }else{
      die('error decoding data');
    }
  }else{
    die('error reading file');
  }
}else{
  die('file not found');
}

// check avatar
if(file_exists('avatar_custom.jpg')){
  $image = 'custom';
}else{
  $image = 'default';
}

// save new data
if(array_key_exists('submit',$_REQUEST) && $_REQUEST['submit'] === 'Save'){
  $profile = [
    'title' => $_REQUEST['title'],
    'description' => $_REQUEST['description'],
    'links' => []
  ];
  foreach($_REQUEST['linksName'] as $key => $name){
    if(!strlen($name)){continue;}
    if(!str_starts_with($_REQUEST['linksURL'][$key],'http')){continue;}
    $profile['links'][$name] = $_REQUEST['linksURL'][$key];
  }
  $bytes = file_put_contents('data.json',json_encode($profile,JSON_PRETTY_PRINT));
  if(!$bytes){
    $saved = false;
  }else{
    $saved = true;
  }
}else{
  $saved = null;
}

// upload new avatar
if(array_key_exists('avatar',$_FILES) && !$_FILES['avatar']['error']){
  if(file_exists('avatar_custom.jpg')){
    unlink('avatar_custom.jpg');
  }
  if($_FILES['avatar']['type'] === 'image/jpeg'){
    move_uploaded_file($_FILES['avatar']['tmp_name'],'avatar_custom.jpg');
  }
}
