#Web Backend
This is the repository for the web end of the app of HvA Team 8 in the project Wattbike for IOT

##API
Call the rest.php file to get information from the system.
Due to the nature of the password you send for logging in, it is advised to call all these through the HTTPS protocol.

####Get the complete log for the logged in user
Do a _GET_ request to the file with the following variables:

* "time" - This should be a mysql compatible datetime. From which point in time the database has to query the heartrate records of the logged in user.

####Post the beats per minute you are getting to the users account
Do a _GET_ request to the file with the following variables:

* "bpm" - This is the value your heartrate sensor is recieving.

* "UUID" - The UUID of the device you are using. This should be registered by logging in.

####Log in a device for a user
Do a _POST_ request to the file with the following variables:

* "email" - The email of the user you want to log in.

* "pass" - The password for the user without any hashing. (Might change in the future)

* "UUID" - The UUID of the device you are using. If it hasn't done so already, this will register the device to the user.
