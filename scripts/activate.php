<?php

include_once 'dbh.inc.php';

// Check if the email and code exists
if (isset($_GET['email'], $_GET['code'])) {
	if ($stmt = $connection->prepare('SELECT * FROM users WHERE email=? AND activationCode=?')) {
		$stmt->bind_param('ss', $_GET['email'], $_GET['code']);
		$stmt->execute();
		// Store the result so we can check if the account exists in the database.
		$stmt->store_result();
		if ($stmt->num_rows > 0) {
			// Account exists with the requested email and code.
			if ($stmt = $connection->prepare('UPDATE users SET activationCode = ? WHERE email = ? AND activationCode = ?')) {
				// Set the new activation code to 'activated', this is how we can check if the user has activated their account.
				$newcode = 'activated';
				$stmt->bind_param('sss', $newcode, $_GET['email'], $_GET['code']);
				$stmt->execute();

				$_SESSION['activationCode'] = 'activated';
			};
		} else {
			echo 'The account is already activated or doesn\'t exist!';
		};
	};
};
