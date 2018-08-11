<?php
print("<pre>");
print_r($_GET);
print("</pre>");
print('callback.php said facebook is login');
/*
make your session, load your creds, facebook sdk, and make the facebook object
*/

/*check for errors!  maybe make use of a fancy try/catch block!*/

//did we get the access token?  better check!

// we are now officially Logged in


// The OAuth 2.0 client handler helps us manage access tokens
//let's make an oAuth client to help manage the tokens

// Get the access token metadata from /debug_token


// Validation (these will throw FacebookSDKException's when they fail)
// validate the token
// If you know the user ID this access token belongs to, you can validate it here
// validate the expiration, don't want to use an expired token.  These will all throw exceptions which you can use try/catch blocks

/* next we're going to exchange the short-lived token for a long-lived token (2 hours versus 60 days)*/

/*store the token for later use*/
// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.

?>