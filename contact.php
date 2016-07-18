<?php
/*
 * \brief Contact page
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
      <h1>Contact me:</h1>
      <p>If you need more informations or have remarks about the way you use your email address, send a message to
         <a target="_blank" href="mailto:<?php echo $admin_email_address; ?>"><?php echo $admin_email_address; ?></a>
         <br/><br/>
      </p>
    </div>
  </div>

<?php

include 'footer.php';

?>
