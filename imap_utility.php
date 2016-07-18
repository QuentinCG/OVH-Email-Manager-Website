<?php
/*
 * \brief IMAP utility functions
 *
 * \author Quentin Comte-Gaz <quentin@comte-gaz.com>
 * \date 18 July 2016
 * \license MIT License (contact me if too restrictive)
 * \copyright Copyright (c) 2016 Quentin Comte-Gaz
 * \version 1.0
 */
?>

<?php

/*!
 *@function canLoginEmailAccount Check email credential validity
 *@param imap_server (string) Imap server (host or IP)
 *@param email (string) Email login
 *@param password (string) Email password
 *@return (boolean) Can connect to the email account in the imap server
 */
function canLoginEmailAccount($imap_server, $email, $password)
{
  // Open Imap connection
  try {
    $mbox = @imap_open('{'.$imap_server.':143}INBOX', "$email", "$password");

    if (!$mbox) {
      return false;
    }

    // Close IMAP connection if it was correctly opened
    imap_close($mbox);

    return true;
  } catch (Exception $e) {
    return false;
  }
}

?>
