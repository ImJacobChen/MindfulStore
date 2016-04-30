<?php 
	require_once('../includes/init.php');
	include(ROOT_PATH . "includes/partials/header.php");

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$admin_email = "jacobsenpai@outlook.com";
		$name = trim($_POST["name"]);
		$email = trim($_POST["email"]);
		$text = trim($_POST['text']);

		if ($name == "" OR $email == "" OR $text == "") {
			$error_message = "Please enter a value for name, email address and comments.";
		}

		if (!isset($error_message)) {
			foreach($_POST as $value){
				if(stripos($value, 'Content-Type:') !== FALSE){
					$error_message = "There was a problem with the information you entered.";
				}
			}
		}

		if (!isset($error_message) && $_POST['goonybot'] != "") {
			$error_message = "Your form submission has an error.";
		}

		require_once("phpmailer/class.phpmailer.php");
		$mail = new PHPMailer();

		if (!isset($error_message) && !$mail->ValidateAddress($email)) {
			$error_message = "Please specify a valid email address.";
		}

		if (!isset($error_message)) {
			$email_body = "";
			$email_body = $email_body . "Name: " . $name . "\n";
			$email_body = $email_body . "Email: " . $email . "\n";
			$email_body = $email_body . "Text: " . $text . "\n";

			$mail->SetFrom($email, $name);
			$address = $admin_email;
			$mail->AddAddress($address, "The Mindfullness Shop");
			$mail->Subject = "The Mindfullness Shop Contact Form Submission | " . $name;
			$mail->MsgHTML($email_body);

			if($mail->Send()) {
				header("Location: contact_thanks.php");
				exit;
			} else {
				$error_message = "There was a problem sending the email: " . $mail->ErrorInfo;
			}
		}
	}
?>
		<?php
			if (isset($error_message)) {
				echo '<div class="error-message">' . '<p>' . $error_message . '</p>' . '</div>';
			}
		?>

		<div id="contact-form">
			<form method="post" action="index.php">
				<fieldset>
					<legend>Contact Us</legend>
					Your name:
					<br>
					<input type="text" class="form-name" name="name" value="<?php if(isset($name)) { echo htmlspecialchars($name); } ?>">
					<br><br>

					Your email address:
					<br>
					<input type="email" class="form-email" name="email" value="<?php if(isset($email)) { echo htmlspecialchars($email); } ?>">
					<br><br>

					How can we help?
					<br>
					<textarea class="form-text" name="text"><?php if(isset($text)) { echo htmlspecialchars($text); } ?></textarea>
					<br><br>

					<input type="submit" class="form-submit" value="Send+">
					<input type="text" name="goonybot" class="goonybot" placeholder="Do not fill out :).">
				</fieldset>	
			</form>
		</div>
	<?php include(ROOT_PATH . "includes/partials/footer.php"); ?>
	</div>
</body>