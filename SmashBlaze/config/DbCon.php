<?php

require './vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Auth;

// Initialize Firebase Factory with ServiceAccount credentials for Realtime Database and Firebase Authentication
$factory = (new Factory)
    ->withServiceAccount(ServiceAccount::fromJsonFile('smashblaze-fe29f-firebase-adminsdk-5sj95-17ce2307d2.json'))
    ->withDatabaseUri('https://smashblaze-fe29f-default-rtdb.firebaseio.com/');

// Create a Firebase Database instance
$database = $factory->createDatabase();

// Check if the database reference is not null, indicating successful connection
if ($database !== null) {
    echo "Firebase Realtime Database connected successfully!<br>";
} else {
    echo "Failed to connect to Firebase Realtime Database.<br>";
}

// Create a Firebase Storage instance
$storage = $factory->createStorage();

// Check if the storage instance is not null, indicating successful connection
if ($storage !== null) {
    echo "Firebase Storage connected successfully!<br>";
} else {
    echo "Failed to connect to Firebase Storage.<br>";
}

// Create a Firebase Authentication instance
$auth = $factory->createAuth();

// Example: Create a custom token for a user (replace 'uid' with your user's unique ID)
$uid = 'some-uid';
$customToken = $auth->createCustomToken($uid);

// Check if the custom token was successfully created
if ($customToken !== null) {
    echo "Custom token created successfully!<br>";
} else {
    echo "Failed to create custom token.<br>";
}

?>
