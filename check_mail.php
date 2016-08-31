<?php
/*
 * \brief Check and show/edit email account data
 *
 * \author Quentin Comte-Gaz <quentin@comte-gaz.com>
 * \date 18 July 2016
 * \license MIT License (contact me if too restrictive)
 * \copyright Copyright (c) 2016 Quentin Comte-Gaz
 * \version 1.0
 */
?>

<?php

require_once(dirname(__FILE__).'/config.php');
require_once(dirname(__FILE__).'/imap_utility.php');
require_once(dirname(__FILE__).'/ovh_utility.php');

$errors = array();
$passwordmail = '';
$email_name = '';
$email = '';
$need_login = true;
$success = '';

if (!empty($_POST) && isset($_POST['passwordmail']) && isset($_POST['email']) && isset($_POST['domain'])) {
  $passwordmail = htmlentities($_POST['passwordmail']) ;
  $email_name = htmlentities($_POST['email']);
  $domain = htmlentities($_POST['domain']);
}

$email = $email_name .'@'. $domain;

if ($imap_server != "" && $email_name != "" && $domain != "" && $passwordmail != "") {
  if (!canLoginEmailAccount($imap_server, $email, $passwordmail)) {
    $need_login = true;
    if (!empty($_POST)) {
      $errors[] = "Impossible to connect, please try again";
    }
  } else {
    $need_login = false;

    // Filter data
    foreach ($_REQUEST as $key => $val) {
      $val = preg_replace("/[\'\"\\\?\~]/i",'', $val);
      $_REQUEST[$key] = $val;
    }

    $newpass = '';
    $newpass2 = '';
    if (isset($_POST['newpass'])) {
      $newpass = htmlentities($_POST["newpass"]);
    }
    if (isset($_POST['newpass2'])) {
      $newpass2 = htmlentities($_POST["newpass2"]);
    }

    if (strlen($newpass) >= 8 && strlen($newpass) <= 12 && $newpass == $newpass2 && htmlentities($_POST["newpass"])==$newpass) {
      // Check new password is valid for OVH API use and send password change request to OVH server
      $password_changed = changeEmailAccountPassword($api, $domain, $email_name, $newpass);
      if (!$password_changed) {
        $errors[] = "Error : Can't change the password, try again later";
      } else {
        $success = "<span style=\"color:green\">Your ".$email." password is updated. It will be taken into account in less than five minutes.</span>";
      }
    } elseif (strlen($newpass) > 0 && $newpass != $newpass2) {
      $errors[] = "Both passwords are not the same.";
    } elseif (strlen($newpass) > 0 && (strlen($newpass) < 8 || strlen($newpass) > 12)) {
      $errors[] = "Password must have between 8 and 12 characters.";
    } elseif (isset($_POST['newpass'])) {
      if (htmlentities($_POST["newpass"])!=$newpass) {
        $errors[] = "The password contains at least one invalid character from this list: <ul><li>'</li><li>\"</li><li>\\</li><li>?</li><li>~</li></ul>";
      }
    }
  }
}
?>

<div id="login-form">
  <div class="boxcontent">
    <?php
  if ($need_login) {
  //---------NOT LOGGED IN-----------
    ?>
    <h1>Manage your email account</h1>
    Please connect to check or configure your email account:<br/>
    <?php
      // Show login errors
      if (!empty($errors)) {
        $error_text = '<span style="color:red">Identification error:<br/><ul class="error-list">';
        foreach($errors as $err) {
          $error_text .= '<li>'.$err.'</li>';
        }
        $error_text .= '</ul></span>';
        echo $error_text;
      }
    ?>
    <form name="form" action="index.php" method="post">
    <table summary="" border="0">
      <tbody>
    <tr>
      <td class="title"><label for="email">Email address</label></td>
      <td>
		<input name="email" id="email" type="text" />@
		<select name="domain" id="domain" onchange="this.form.submit()">
			<? foreach ($domains as $d) { ?>
			<option value=<? echo $d ?> <? if ($domain==$d) echo "selected" ?> ><? echo $d ?>
			<? } ?>
		</select>
	  </td>
    </tr>
    <tr>
      <td class="title"><label for="password">Password</label></td>
      <td><input type="password" name="passwordmail" id="password" /></td>
    </tr>
      </tbody>
    </table>
    <p style="text-align:center;"><input type="submit" class="medium blue button" value="Login" /></p>
  </form>
    <?php
  } else {
    // ----------LOGGED IN-------------
    echo "<h1>Manage your ".$email." email account</h1>";

    try {
      // Retrieve data from the account
      $account_info = getEmailAccountInfo($api, $domain, $email_name);

      if ($account_info['isBlocked']) {
        echo '<a class="medium orange button" href="contact.php">Blocked email address, contact admin to unblock it ('.$admin_email_address.')</a>';
      } else {
        echo '<a class="medium green button">Your email address is not blocked</a>';
      }
      echo "<br/>";

      $account_usage_info = getEmailAccountUsage($api, $domain, $email_name);

      // Show account quota
      $remaining_size = $account_info['size'] - $account_usage_info['quota'];
      $percent_remaining = 100 * $remaining_size / $account_info['size'];
      $color_bar = "green";
      if ($percent_remaining > 40 && $percent_remaining < 60) {
        $color_bar = "orange";
      } elseif ($percent_remaining < 40) {
        $color_bar = "red";
      }
      echo "<b>Mailbox usage (free space):</b>
        <div class='loading win' id='progressbar1'>
        <div class='text'><span>0%</span></div>
        <div class='process vista".$color_bar." lightanimated'>&nbsp;</div>
        </div>
        <script>processbar('progressbar1', ".$percent_remaining.");</script>";
      echo " ".number_format(($account_usage_info['quota']/1000000), 2)." MB / ".($account_info['size']/1000000)." MB used<br/>";
      echo "<br/>";

      echo "<b>Total emails in your mailbox:</b> ".$account_usage_info['emailCount']."<br/>";
      echo "<br/>";

    } catch (Exception $e) {
      echo "<span style=\"color:red\">Impossible to get ".$email_name." account information: Please try later.</span><br/>";
    }

		// Change password
    echo "<b>Change your password:</b><br/>";
    if (strlen($success) > 0 && empty($errors)) {
      echo "<br/>".$success."<br/><br/>";
    }

    if (!empty($errors)) {
      $error_text = '<br/><span style="color:red">Impossible to change the password:<br/><ul class="error-list">';
      foreach($errors as $err) {
        $error_text .= '<li>'.$err.'</li>';
      }
      $error_text .= '</ul></span>';
      echo $error_text;
    }
    ?>
    <form name="form "action="index.php" method="post">
      <input type="hidden" name="passwordmail" value="<?php echo $passwordmail; ?>">
      <input type="hidden" name="email" value="<?php echo $email_name; ?>">
      <table summary="" border="0">
        <tbody>
          <tr>
            <td class="title"><label for="newpass">New password</label></td>
            <td><input pattern=".{8,12}" name="newpass" id="newpass" type="password" /></td>
          </tr>
          <tr>
            <td class="title"><label for="newpass2">Confirm new password</label></td>
            <td><input pattern=".{8,12}" name="newpass2" id="newpass2" type="password" /></td>
          </tr>
        </tbody>
      </table>
      <p style="text-align:center;"><input type="submit" class="medium blue button" value="Send" /></p>
    </form>

    <form name="form "action="index.php" method="post">
      <input type="submit" class="medium blue button" value="Quit session" />
    </form>
    <?php
  }
    ?>
  </div>
</div>
