<!doctype html>
<!-- dieses Emailformular benötigt keine PHP Seite. Das Verschicken erfolgt auf dieser Seite -->
<html>
<head>
	<meta charset="utf-8">
	<title>Sendmail</title>
	<style>
body {
	font-family: Calibri, Arial, Helvetica, Sans-Serif;
}
input[type=text] {
	width: 250px;
	padding: 3px;
	border: 1px solid #5F0000;
	margin: 3px 0;
}
textarea {
	width: 250px;
}
label, .anrede {
	color: #5F0000;
	display: inline-block;
	width: 8em;
	cursor: pointer;
	vertical-align: top;
}
label[for^="gender"] {
	width: 3rem;
}
input[type="radio"] {
	margin-right: 0.3rem;
}
fieldset, #sendInfo {
	max-width: 500px;
	margin: auto;
}
.error {
	color: red;
}

</style>
</head>

<body>
	<?php
	$email_from = "mail@deineEmailAdresse.de";
	$email_subject = "Kontakt Historische Dokumente";
	
	// define variables and set to empty values
	$firstnameErr = $surnameErr = $commentErr = "";
	$surname = $firstname = $email = $gender = $comment = $phone = "";

	if ( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {

		if ( empty( $_POST[ "Vorname" ] ) ) {
			$firstnameErr = "is required";
		} else {
			$firstname = test_input( $_POST[ "Vorname" ] );
		}

		if ( empty( $_POST[ "Nachname" ] ) ) {
			$surnameErr = "is required";
		} else {
			$surname = test_input( $_POST[ "Nachname" ] );
		}

		if ( empty( $_POST[ "Nachricht" ] ) ) {
			$commentErr = "is required";
		} else {
			$comment = test_input( $_POST[ "Nachricht" ] );
		}

		if ( empty( $_POST[ "Email" ] ) ) {
			$email = "";
		} else {
			$email = test_input( $_POST[ "Email" ] );
		}

		if ( empty( $_POST[ "Telefon" ] ) ) {
			$phone = "";
		} else {
			$phone = test_input( $_POST[ "Telefon" ] );
		}

		if ( empty( $_POST[ "Geschlecht" ] ) ) {
			$gender = "";
		} else {
			$gender = test_input( $_POST[ "Geschlecht" ] );
		}
	}

	function test_input( $data ) {
		$data = trim( $data );
		$data = stripslashes( $data );
		$data = htmlspecialchars( $data );
		return $data;
	}
?>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<fieldset>
			<p> <span class="anrede">Title</span>
				<input name="Geschlecht" type="radio" 
				<?php if (isset($gender) && $gender=="male") echo "checked";?>
					   value="male" id="gender_male">
				<label for="gender_male">Mr.</label>
				<input name="Geschlecht" type="radio"
				<?php if (isset($gender) && $gender=="female") echo "checked";?>
					   value="female" id="gender_female">
				<label for="gender_female">Ms.</label>
				<input name="Geschlecht" type="radio" 
				<?php if (isset($gender) && $gender=="other") echo "checked";?> 
					   value="other" id="gender_other">
				<label for="gender_other">other</label>
			</p>
			<p>
				<label for="Vorname">First Name:</label>
				<input type="text" id="Vorname" name="Vorname" value="<?php echo $firstname;?>">
				<span class="error">* <?php echo $firstnameErr;?></span> </p>
			<p>
				<label for="Nachname">Last Name:</label>
				<input type="text" id="Nachname" name="Nachname" value="<?php echo $surname;?>">
				<span class="error">* <?php echo $surnameErr;?></span> </p>
			<p>
				<label for="Email">E-Mail:</label>
				<input type="text" id="Email" name="Email" value="<?php echo $email;?>">
			</p>
			<p>
				<label for="Telefon">Phone/ Mobile:</label>
				<input type="text" id="Telefon" name="Telefon" value="<?php echo $phone;?>">
			</p>
			<p>
				<label for="Nachricht">Nachricht:</label>
				<textarea id="Nachricht" name="Nachricht" rows="10" cols="50"><?php echo $comment;?></textarea>
				<span class="error">* <?php echo $commentErr;?></span> </p>
			<input type="submit" name="submit" value="Send">
		
		</fieldset>
	</form>
	<div id="sendInfo">
	<?php
	//Datum, wann die Mail erstellt wurde
	$name_tag = array( "Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag" );
	$num_tag = date( "w" );
	$tag = $name_tag[ $num_tag ];
	$jahr = date( "Y" );
	$n = date( "d" );
	$monat = date( "m" );
	$time = date( "H:i" );

	
	$msg = "Gesendet am $tag, den $n.$monat.$jahr - $time Uhr<br>";
	$msg .= "Anrede: $gender <br>";
	$msg .= "Vorname: $firstname <br>";
	$msg .= "Nachname: $surname <br>";
	$msg .= "Email: $email <br>";
	$msg .= "Telefon: $phone <br>";
	$msg .= "Nachricht: $comment";

	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: $email_from";

	//echo $msg;

	if ( !empty( $_POST[ "Vorname" ] ) && !empty( $_POST[ "Nachname" ] ) && !empty( $_POST[ "Nachricht" ] ) ) {
				
		$mail_senden = mail( $email_from, $email_subject, $msg, $headers );
				
		if ( $mail_senden ) {
			echo "Die Email wurde erfolgreich versendet. Wir melden uns.";
			exit();
		} else {
			echo "Beim Übertragen der Email ist ein Fehler aufgetreten.";
		//	header( "Location: " . $url_fehler ); //Fehler beim Senden
			exit();
		}
	}
	?>
</div>
</body>
</html>