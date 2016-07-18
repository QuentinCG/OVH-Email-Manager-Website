<?php
/*
 * \brief OVH utility (using OVH API)
 *
 * \author Quentin Comte-Gaz <quentin@comte-gaz.com>
 * \date 18 July 2016
 * \license MIT License (contact me if too restrictive)
 * \copyright Copyright (c) 2016 Quentin Comte-Gaz
 * \version 1.0
 */
?>

<?php

require_once(dirname(__FILE__).'/vendor/autoload.php');

use Ovh\Api;
use GuzzleHttp\Client;

/*!
 *@function getEmailDomainInfo Get basic informations on the email domain
 *
 *@param api (\Ovh\Api) Ovh Api
 *@param domain (string) Name of the email domain
 *
 *@return {
 *      domain (string), // Name of domain
 *      creationDate (datatime), // Creation date of domain
 *      allowedAccountSize (long[]), // List of allowed sizes for this domain in bytes
 *      status (domain.DomainStatusEnum ["ok"]), // Domain Status
 *      offer (string), // Offer of email service
 *      linkTo (string), // Name of servicelinked with this domain
 *      filerz (long) // Filerz (file server) of domain
 *    }
 *
 *@more https://api.ovh.com/console/#/email/domain/{domain}#GET
 */
function getEmailDomainInfo($api, $domain)
{
  $domain_info = $api->get("/email/domain/".$domain);

  if ($domain_info['domain'] != $domain) {
    trigger_error("Wrong domain: ".$domain_info['domain']." is different from requested domain ".$domain);
  }

  return $domain_info;
}

/*!
 *@function getEmailAccountInfo Get information on account_name@domain email account
 *
 *@param api (\Ovh\Api) Ovh Api
 *@param domain (string) Name of the email domain
 *@param account_name (string) Name of the email account
 *
 *@return {
 *      isBlocked (boolean), // If true, account is blocked
 *      email (string) // Email
 *      domain (string), // Name of domain
 *      description (string), // Account description
 *      accountName (string), // Name of account
 *      size (long) // Size of your account in bytes
 *    }
 *
 *@more https://api.ovh.com/console/#/email/domain/{domain}/account/{accountName}#GET
 */
function getEmailAccountInfo($api, $domain, $account_name)
{
  $account_info =  $api->get("/email/domain/".$domain."/account/".$account_name);

  if ($account_info['accountName'] != $account_name) {
    trigger_error("Wrong account: ".$account_info['accountName']."@".$account_info['domain']." is different from requested account ".$account_name."@".$domain);
  }

  return $account_info;
}

/*!
 *@function changeEmailAccountPassword Change the password of a specific email account in a domain
 *
 *@param api (\Ovh\Api) Ovh Api
 *@param domain (string) Name of the email domain
 *@param account_name (string) Name of the email account
 *@param new_password (string) New password
 *
 *@return (boolean) Password successfully changed
 *
 *@more https://api.ovh.com/console/#/email/domain/{domain}/account/{accountName}/changePassword#POST
 */
function changeEmailAccountPassword($api, $domain, $account_name, $new_password) {

  if (strlen($new_password) < 6 || $domain == '' || $account_name == '') {
    return false;
  }

  try {
    $change_password = $api->post("/email/domain/".$domain."/account/".$account_name."/changePassword",
              array('password' => $new_password));
  } catch (Exception $e) {
    //echo $e->getMessage();
    return false;
  }

  if ($change_password['name'] == $account_name &&
  $change_password['domain'] == $domain &&
  $change_password['action'] == "changePassword" &&
  $change_password['id'] > 0) {
    return true;
  }

  return false;
}

/*!
 *@function getEmailAccountUsage
 *
 *@param api (\Ovh\Api) Ovh Api
 *@param domain (string) Name of the email domain
 *@param account_name (string) Name of the email account
 *
 *@return {
 *      quota (long), // Size of mailbox (bytes)
 *      emailCount (long), // Number of message in mailbox
 *      date (datetime) // Timestamp
 *    }
 *
 *@more https://api.ovh.com/console/#/email/domain/{domain}/account/{accountName}/usage#GET
 */
function getEmailAccountUsage($api, $domain, $account_name) {
  $usage_info = $api->get("/email/domain/".$domain."/account/".$account_name."/usage");

  return $usage_info;
}

?>
