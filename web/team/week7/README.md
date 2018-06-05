# Team Activity

## Core Requirements

1. Create a sign-up page that asks for a username and password, and then inserts this into the database.

Make sure that you do not insert the password directly into the database, use the password_hash() function to generate a hash of it, and insert that into the database.

After inserting the user, redirect to the sign-in page.

##### Instructor Tip:

For redirects, you can specify the new location in the header: header('Location: ' . $newURL);. Then don't forget to include a "die()" command afterward, in case there are other things on the page that could be rendered when it is not desired.

2. Create a sign-in page that prompts for a username and a password. (Make sure to use a password HTML element, rather than a text box).

- If a correct username/password is entered, save the user id to the session and redirect to the welcome page.

- If an incorrect username/password is entered, stay on this page.

- Make sure to use the password_verify() function and compare against the hash in your database.

- This page should have a link to the sign-up page.

3. Create a welcome page that checks for a current logged-in user.

If a user is found, the welcome page should display, "Welcome [username]" (where [username] is the current user's username.)

If no user is logged in, the welcome page should automatically redirect to the sign-in page.

## Stretch Challenges

After finishing the core requirements, ensure that everyone is at that point and understands the material. When everyone has completed the core requirements, you can move on to these stretch challenges.

1. Add two password boxes to the sign-up page, and ensure that they match before inserting. If they do not, stay on that page, but display a message in red, and put red asterisks next to the boxes. For this requirement, please make this check in PHP.

2. Add to the previous stretch challenge the requirement that a password must be at least 7 characters and contain a number. Again, make this check in PHP.

3. Add a client-side check for stretch challenges 1 and 2 to detect these conditions without requiring a page submission.
