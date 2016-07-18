<?php
/*
 * \brief Information page for user
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


      <h1>How to check your emails?</h1>
      <p>To use your email account, numerous possibilities are provided:<br/>
      &nbsp;&nbsp;- <b>Use the <a target="_blank" href="<?php echo $email_server; ?>">webmail (<?php echo $email_server; ?>)</a></b> with any web browser.<br/>
      &nbsp;&nbsp;- <b>Use Windows/Android/Apple/Iphone apps</b> by filling those information:<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Id : Email address (yourname@<?php echo $domain; ?>)<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password: Your password<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IMAP (Incoming): <b><?php echo $imap_server; ?> (993 port with SSL security)</b><br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;POP (Incoming) : <b><?php echo $pop_server; ?> (995 port with SSL security)</b><br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SMTP (Outgoing) : <b><?php echo $smtp_server; ?> (465 with SSL security)</b><br/>
      It is possible to use the OVH webmail and Windows/Android/Apple/Iphone apps in the time.<br/>
      <br/>



      <h1>Which app should I use on my computer and smartphone?</h1>
      For <b>Windows, Mac et Linux</b>:<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;- Thunderbird : <a target="_blank" href="https://www.ovh.com/uk/g1297.configuration-thunderbird">Configuration</a> and <a target="_blank" href="https://www.mozilla.org/thunderbird/">download</a><br/>
      <br/>
      For <b>Windows</b>:<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;- Mail (Windows 10 only) : <a target="_blank" href="https://support.microsoft.com/en-us/help/17198/windows-10-set-up-email">Configuration</a> (the app is integrated on Windows 10)<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;- Windows Mail : <a target="_blank" href="https://www.ovh.com/uk/g1300.configuration-windows-mail">Configuration</a> and <a target="_blank" href="http://www.clubic.com/telecharger-fiche37760-windows-live-mail.html">download</a><br/>
      &nbsp;&nbsp;&nbsp;&nbsp;- Outlook : <a target="_blank" href="https://www.ovh.com/uk/g1299.configuration-outlook-2010">Configuration</a> (Microsoft Office is maybe already installed on your computer)<br/>

      <br/>
      For <b>Mac</b>:<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;- Mail : <a target="_blank" href="https://www.ovh.com/uk/g1287.configuration-mail-macos">Configuration</a> (the app is integrated on Mac)<br/>

      <br/>
      For <b>Android</b>:<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;- E-Mail (default Email app) : <a target="_blank" href="https://www.ovh.com/uk/g1347.mail_mutualise_guide_configuration_dun_telephone_mobile_sous_android_version_44">Configuration</a> (the app is integratred on Android)<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;- K9 Mail : <a target="_blank" href="http://quick-tutoriel.com/k-9-mail-le-gardien-de-vos-mails/">Configuration</a> and <a target="_blank" href="https://play.google.com/store/apps/details?id=com.fsck.k9">download</a><br/>

      <br/>
      For <b>iPhone, iPad and iPod Touch</b>:<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;- Mail : <a target="_blank" href="https://support.apple.com/en-us/HT201320">Configuration</a> (the app is integrated)<br/>

      <br/>
      For <b>Blackberry</b>:<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;- Parameters (default app) : <a target="_blank" href="https://www.ovh.com/uk/g1381.configuration-blackberry">Configuration</a><br/>
      <br/><br/>


      <h1>Which limits are applied to my email account?</h1>
      Here is a partial list of the limits for the use of your email account:<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;- <b>Maximum storage of 5GB</b> (delete emails from webmail to free up space in case of saturation)<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;- <b>Maximum attachment size: 20MB with webmail, 100MB with applications</b> (Windows/Android/Apple/... applications)<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;- <b>Each email can be sent to up to 20 email addresses</b><br/>
      &nbsp;&nbsp;&nbsp;&nbsp;- In case of abuse, <b>the administrator and OVH may cut the access to your email account</b><br/>
      <br/>
      For more information on this subject, you can consult the OVH information page: <a target="_blank" href="https://www.ovh.co.uk/g1474.mutualise_generalite_mail_mutualise_ovh#limitation_de_loffre">https://www.ovh.co.uk/g1474.mutualise_generalite_mail_mutualise_ovh#limitation_de_loffre</a><br/>
      <br/><br/>


      <h1>How to change my email account password?</h1>
      Go to the <a href="index.php">homepage</a>, connect with your credential and change your password.<br/>
      <br/><br/>


      <h1>How to copy all messages from another email address to my <?php echo $domain; ?> email address?</h1>
      A tool has been designed by OVH to make your life easier: <a target="_blank" href="https://www.ovh.com/fr/g1310.imap-copy">Imap Copy</a><br/>
      <br/><br/>


      <h1>How the website has been achieved?</h1>
      This project was carried out by purchasing the domain name <?php echo $domain; ?> and subscribing to an email management offer from OVH.<br/>
      Leaving OVH to manage email accounts permits a good stability in the email server and thus a good user experience.<br/>
      However, password management is poorly handled by OVH which made the design of this site needed to allow users the ability to change their passwords.<br/>
      This website has been designed by <a target="_blank" href="http://quentin.comte-gaz.com/en">Quentin Comte-Gaz</a>.<br/>
      <br/><br/>

      </p>
    </div>
  </div>

<?php

include 'footer.php';

?>
