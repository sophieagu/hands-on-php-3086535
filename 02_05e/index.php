<?php

function log_form()
{
	$timestamp = date("Ymd-His");
	$filename = "formlog-" . $timestamp . ".txt";
	$file = fopen($filename, "w");
	fwrite($file, print_r($_POST, true));
	fclose($file);
}

function print_array($a)
{
	echo '<pre>';
	var_dump($a);
	echo '</pre>';
}

function sanitize_form()
{
	//print_array($_POST);
	foreach ($_POST as $name => $value) {
		switch ($name) {
			case 'email':
				//echo 'in email';
				$value = filter_var($value, FILTER_SANITIZE_EMAIL);
				break;
			case 'message':
				//echo 'in email';
				$value = filter_var(htmlspecialchars($value), FILTER_SANITIZE_ADD_SLASHES);
				break;
			case 'phone':
				//echo 'in phone';
				$value = filter_var(htmlspecialchars($value));
				break;
			default:
				$value = filter_var(preg_replace('/[^A-Za-z0-9 \-]/', '', $value), FILTER_SANITIZE_ADD_SLASHES);
		}
		$_POST[$name] = $value;
	}

	return true;
}

if (isset($_POST['submit'])) {
	sanitize_form();
	//print_array($_POST);
	log_form();
}

if (isset($_COOKIE['form_submitted'])) {
	echo 'Oops! Looks like you have already submitted this form.';
	unset($_COOKIE['form_submitted']);
} else {
	sanitize_form();
	//print_array($_POST);
	log_form();
	setcookie('form_submitted', 'true');
}


?>

<!DOCTYPE html>
<html>

<head>
	<title>Validate my Form</title>
	<meta name="author" value="Joe Casabona" />
	<style>
		body {
			background: #EFEFEF;
		}

		main {
			max-width: 800px;
			padding: 20px;
			margin: 0 auto;
			background: #FFFFFF;
			font-size: 1.5rem;
		}

		div {
			margin: 35px;
		}

		input,
		textarea {
			font-size: 1.25rem;
			padding: 5px;
			width: 95%;
			border: 1px solid #DDDDDD;
		}
	</style>
</head>

<body>
	<main>
		<h1>Contact Me</h1>
		<form name="contact" method="POST" id="contact">
			<div>
				<label for="name">Your Name*:</label><br />
				<input type="text" name="name" required />
			</div>
			<div>
				<label for="email">Your Email*:</label><br />
				<input type="email" name="email" required />
			</div>
			<div>
				<label for="phone number">Your Phone Number*:</label><br />
				<input type="text" name="phone" pattern="\(\d{3}\) \d{3}-\d{4}" title="Enter a phone number in the format (xxx) xxx-xxxx" required />
			</div>
			<div>
				<label for="message">Your Message*:</label><br />
				<textarea name="message" required></textarea>
			</div>
			<div><input type="submit" name="submit" value="Contact Me" /></div>
		</form>
	</main>
</body>

</html>