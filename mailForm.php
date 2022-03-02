<?php
// EDIT THE 2 LINES BELOW AS REQUIRED
 // EDIT THE 2 LINES BELOW AS REQUIRED
$email_to = "lissyuloh8@gmail.com";
$email_subject = "Your email subject line";


function died($error) {
    // your error code can go here
    echo "We are very sorry, but there were error(s) found with the form you submitted. ";
    echo "These errors appear below.<br /><br />";
    echo $error."<br /><br />";
    echo "Please go back and fix these errors.<br /><br />";
    die();
}

// validation expected data exists
if(!isset($_POST['name']) ||
    !isset($_POST['phone']) ||
    !isset($_POST['email']) ||
    !isset($_POST['residence']) ||
    !isset($_POST['message'])) {
    died('We are sorry, but there appears to be a problem with the form you submitted.');       
}

$full_name = $_POST['name']; // required
$telephone = $_POST['phone']; // not required
$email_from = $_POST['email']; // required
$stateofresidence = $_POST['residence']; // not required
$comments = $_POST['message']; // required

$error_message = "";
$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
if(!preg_match($email_exp,$email_from)) {
$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
}
$string_exp = "/^[A-Za-z .'-]+$/";
if(!preg_match($string_exp,$full_name)) {
$error_message .= 'The Name you entered does not appear to be valid.<br />';
}
if(strlen($comments) < 2) {
$error_message .= 'The message you entered do not appear to be valid.<br />';
}
if(strlen($error_message) > 0) {
died($error_message);
}
$email_message = "Form details below.\n\n";

function clean_string($string) {
  $bad = array("content-type","bcc:","to:","cc:","href");
  return str_replace($bad,"",$string);
}

$email_message .= "Last Name: ".clean_string($full_name)."\n";
$email_message .= "Telephone: ".clean_string($telephone)."\n";
$email_message .= "Email: ".clean_string($email_from)."\n";
$email_message .= "State of Residence: ".clean_string($stateofresidence)."\n";
$email_message .= "Comments: ".clean_string($comments)."\n";

// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
 @mail($email_to, $email_subject, $email_message, $headers); 
 
 header('Location: Thanks.html');
exit;
?>


<?php
}
?>