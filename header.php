<?php
/*
 * \brief header page integrated in all pages
 *
 * \author Quentin Comte-Gaz <quentin@comte-gaz.com>
 * \date 18 July 2016
 * \license MIT License (contact me if too restrictive)
 * \copyright Copyright (c) 2016 Quentin Comte-Gaz
 * \version 1.0
 */
?>
<!----------------------BEGIN HEADER------------------->
<?php

require_once(dirname(__FILE__).'/config.php');
require_once(dirname(__FILE__).'/ovh_utility.php');

$is_api_valid = true;
try {
  $domain_info = getEmailDomainInfo($api, $domain);
} catch (Exception $e) {
  $is_api_valid = false;
  //echo "Impossible to get the email server info: ".$e->getMessage();
}

$title = "Email management system for ".$domain." domain";
$slogan = "Manage your <span class='highlight'>".$domain."</span> email account";
switch ($page_name) {
  case "index.php":
    break;
  case "informations.php":
    $title = "How to use your email account";
    break;
  case "contact.php":
    $title = "Contact";
    break;
  default:
    break;
}

?>

<!DOCTYPE html>
<html>

<head>
  <title><?php echo $title; ?></title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="robots" content="noindex, nofollow">

  <link rel="icon" type="image/png" href="favicon.ico" />

  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="css/buttons.css" />
  <link rel="stylesheet" type="text/css" href="css/progress_bar.css" />

  <script type="text/javascript" src="js/progress_bar.js"></script>
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
</head>

<body>
  <div id="main">
    <header>
      <div id="strapline">
        <div id="welcome_slogan">
          <h3><?php echo $slogan; ?></h3>
        </div>
      </div>
      <nav>
        <div id="menubar">
          <ul id="nav">
            <li <?php if($page_name == "index.php") { echo "class=\"current\""; } ?>><a href="index.php">Home</a></li>
            <li <?php if($page_name == "informations.php") { echo "class=\"current\""; } ?>><a href="informations.php">Information</a></li>
            <li <?php if($page_name == "contact.php") { echo "class=\"current\""; } ?>><a href="contact.php">Contact</a></li>
          </ul>
        </div>
      </nav>
    </header>

    <div id="site_content">
      <div class="sidebar_container">
        <div class="sidebar">
          <div class="sidebar_item">
            <h2>Email server status</h2>
            <p>
            <?php
              if($domain_info['status'] == "ok") {
                echo '<a class="medium green button" target="_blank" href="'.$email_server.'">Active email server</a>';
              } elseif ($is_api_valid == true) {
                echo '<a class="medium orange button" href="contact.php">Email server is down</a>';
              } else {
                echo '<a class="medium orange button" href="contact.php">Impossible to check server status</a>';
              }
            ?>
            <br/>
            Creation date:
            <?php
              if (!$is_api_valid) {
                echo "Impossible to get information";
              } else {
                $date = new DateTime($domain_info['creationDate']);
                echo $date->format('j-M-Y');
              }
            ?>
            <br/>
            </p>
          </div>
        </div>
      <!-- You may add additional side bars here: -->
      <!--
      <div class="sidebar">
        <div class="sidebar_item">
      <h2>Latest update</h2>
      <h3></h3>
      <p></p>
        </div>
      </div>
      -->
    </div>
    <!--site_content not closed-->
  <!--div id="main" not closed-->
<!--body not closed-->
<!--html not closed-->
<!----------------------END HEADER--------------------->
