<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <title>Signin Template · Bootstrap v5.0</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
  <link href="./Signin Template · Bootstrap v5.0_files/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
  <link rel="manifest" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/manifest.json">
  <link rel="mask-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
  <link rel="icon" href="https://img.icons8.com/color/344/drone-with-camera.png">
  <meta name="theme-color" content="#7952b3">
  <link href="./album/Album example for Bootstrap_files/bootstrap.min.css" rel="stylesheet">
  <link href="./album/Album example for Bootstrap_files/album.css" rel="stylesheet">
  <?//print(basename($_SERVER['PHP_SELF'], ".php")); ?>
  <script>
    console.log(<?php echo $_SERVER['DOCUMENT_ROOT'] ?>);
  </script>
  <?php if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/photogram/css/' . basename($_SERVER['PHP_SELF'], ".php").".css")) { ?>
  <script>
    console.log("test passed")
    console.log(<?php print(basename($_SERVER['PHP_SELF'], ".php"))?>.css);
  </script>
  <link rel="stylesheet" href="css/<?=basename($_SERVER['PHP_SELF'], ".php")?>.css">
  <?php }else{ ?>
    <script>
      console.log("Test Failed!");
    </script><?php }?>
</head>