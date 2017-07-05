<?php
// IMPORTANT: THIS FILE MUST BE RENAMED "config.php"

require_once(dirname(__FILE__).'/vendor/autoload.php');

use Ovh\Api;
use GuzzleHttp\Client;

// ----------------- API credential application -----------------
// You need to create an OVH API key at
// https://api.ovh.com/createToken/index.cgi allowing those elements :
// GET /email/domain/YOUR_DOMAIN_HERE
// GET /email/domain/YOUR_DOMAIN_HERE/account/*
// POST /email/domain/YOUR_DOMAIN_HERE/account/*/changePassword
// GET /email/domain/YOUR_DOMAIN_HERE/account/*/usage
// (Replace YOUR_DOMAIN_HERE by your domain name (example: my_domain.com))
$application_key = ""; /*!< Application key */
$application_secret = ""; /*!< Application secret */
$consumer_key = ""; /*!< Consumer key */

// ----------------- Domain specific information -----------------
$domains = array(""); /*!< Domains of your OVH email domain (example: "my_domain.com" or "my_domain1.com", "my_domain2.com") */
$admin_email_address = ""; /*!< Email used for support when a customer has issue on the website (example: support@my_domain.com) */

$email_server="https://mail.ovh.net/en/"; /*!< Server name used as email web client for user (don't edit if you don't know) */
$imap_server="ssl0.ovh.net"; /*!< IMAP server name (don't edit if you don't know) */
$smtp_server="ssl0.ovh.net"; /*!< IMAP server name (don't edit if you don't know) */
$pop_server="ssl0.ovh.net"; /*!< IMAP server name (don't edit if you don't know) */

// ------------------- OVH API (do not touch) -------------------
$end_point = 'ovh-eu'; /*!< OVH API end point (don't edit if you don't know) */

// Load the OVH API once config is done
$api = new Api(
         $application_key,
         $application_secret,
         $end_point,
         $consumer_key);

// ------------------- Domain loading (do not touch) -------------------
$domain = "";
if (!empty($_POST) && isset($_POST['domain'])) { /*Domain selected by select menu passed by POST*/
  $domain = htmlentities($_POST['domain']);
} else {
  $domain = $domains[0];
}

?>
