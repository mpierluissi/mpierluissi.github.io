<?php
	if (isset($_POST['Email'])) {

		// EDIT THE FOLLOWING TWO LINES:
		$email_to = "mjpierluissi@gmail.com";
		$email_subject = "WEBSITE CONTACT FORM";

		function problem($error)
		{
			echo "We're sorry, but there were error(s) found with the form you submitted. ";
			echo "These errors appear below.<br><br>";
			echo $error . "<br><br>";
			echo "Please go back and fix these errors.<br><br>";
			die();
		}

		// validation expected data exists
		if (
			!isset($_POST['Name']) ||
			!isset($_POST['Email']) ||
			!isset($_POST['Message'])
		)

		{
			problem("We're sorry, but there appears to be a problem with the form you submitted.");
		}

		$name = $_POST['Name']; // required
		$email = $_POST['Email']; // required
		$message = $_POST['Message']; // required

		$error_message = "";
		$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

		if (!preg_match($email_exp, $email)) {
			$error_message .= 'The Email address you entered does not appear to be valid.<br>';
		}

		if (strlen($error_message) > 0) {
			problem($error_message);
		}

		$email_message = "Form details below.\n\n";

		function clean_string($string)
		{
			$bad = array("content-type", "bcc:", "to:", "cc:", "href");
			return str_replace($bad, "", $string);
		}

		$email_message .= "Name: " . clean_string($name) . "\n";
		$email_message .= "Email: " . clean_string($email) . "\n" . "\n";
		$email_message .= "Message: " . "\n" . clean_string($message) . "\n";

		// create email headers
		$headers = 'From: ' . $email . "\r\n" .
			'Reply-To: ' . $email . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		@mail($email_to, $email_subject, $email_message, $headers);
	}

	header("refresh:5,url=https://www.michaelpierluissi.com/contact.html");
?>

<body style="background-color:black;text-align: center;font-family: 'Open Sans', sans-serif;">
	<img src="images/banner.png" style="width:100%">
	<div style="position:relative;color:white;font-size:200%">
		Thank you for contacting me! I will respond as soon as possible.
	</div>

	<div style="color:white;font-size:100%">
		You will be redirected in 5 seconds...
	</div><br><br>
	<a href="home.html"><img src="images/logos/logoFull.svg" style="width:20%"></a>
</body>