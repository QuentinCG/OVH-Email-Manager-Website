<?php
/*
 * \brief Index page (integrating the main part of the website: config email account)
 *
 * \author Quentin Comte-Gaz <quentin@comte-gaz.com>
 * \date 18 July 2016
 * \license MIT License (contact me if too restrictive)
 * \copyright Copyright (c) 2016 Quentin Comte-Gaz
 * \version 1.0
 */
?>
<?php

// Get page name (for header and footer)
$page_name = basename($_SERVER['PHP_SELF']);

include 'header.php';

?>

  <div id="content">
    <div class="content_item">
      <h1>Check your emails</h1>
      <p>Go to the <a target="_blank" href="<?php echo $email_server; ?>">webmail</a> to check your emails
         (or <a target="_blank" href="informations.php">configure your computer or phone</a>).</p>
      <br/>

      <?php
      include 'check_mail.php';
      ?>
    </div>
  </div>

<?php

include 'footer.php';

?>
