<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)                                                  **
 **  File:              lang-english.php                                                **
 **  Date modified:     29/06/06 (PHP121 v2.2)                                          **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     English language file                                           **
 *****************************************************************************************/

/**************************************************************************/
/* This is the language module with all the system messages               */
/*                                                                        */
/* If you made a translation, please go to the site and send to me        */
/* the translated file. Please keep the original text order by modules,   */
/* and just one message per line, also double check your translation!     */
/*                                                                        */
/* You need to change the second quoted phrase, not the capital one!      */
/*                                                                        */
/* If you need to use double quotes (") remember to add a backslash (\),  */
/* so your entry will look like: This is \"double quoted\" text.          */
/* And, if you use HTML code, please double check it.                     */
/**************************************************************************/

define("_CLEAR_CHAT","Clear chat history");
define("_CHARS_LEFT","characters left");

define("_AUTO_EMAIL_TRANSCRIPT","Auto email transcript after chat finishes");
define("_FORCE_AUTO_EMAIL_TRANSCRIPT","Override user's auto email transcript setting and send regardless");
define("_YOUR_CHATS","Your Chats");
define("_EMAIL_TRANSCRIPT","Email this chat log");
define("_EMAIL_TRANSCRIPT_CONFIRM","Click OK to email the contents of this chat to your registered email address below.");
define("_ADMIN_FORCING_EMAIL_TRANSCRIPTS","Please note, this website is configured to email chat transcripts automatically.");
define("_AUTO_EMAIL_TRANSCRIPTS","You are already requesting chat transcripts to be emailed automatically."); 
define("_DUPE_EMAIL_WARNING","By proceeding, you will receive more than 1 copy of the email.");
define("_TRANSCRIPT_EMAILED","The current chat transcript has been emailed to you.");
define("_USER_CAN_CREATE_ACCOUNT","Allow creation of new accounts?");
define("_USER_CAN_DELETE_ACCOUNT","Allow users to delete their account?");
define("_ADD_USER","Add User");
define("_USER_ADDED","User added.");
define("_IMPORTANT_NOTE","(Important Note)");
define("_AUTO_EMAIL_NOTE","Please note, for a chat transcript to be emailed automatically, at least <u>one contact list must be open <b>2 minutes</b> after the chat is considered 'inactive'</u>.  <p>An inactive chat is one where there is noone in the chat.  If no contact lists are open at this stage, the email <b>will not</b> be sent.  <p>It is expected that this feature will be used by technical support departments using PHP121 to help customers and that a support engineer will have a contact list open after the customer leaves.  This feature may be improved in a later version of PHP121.");
define("_HPBUTTON_CHAT_NOW","Users chatting right now: ");
define("_HPBUTTON_OPEN_MESSENGER","Open Instant Messenger");
define("_FIX_SMILIES","Fix Smilies");
define("_HERE_IS_YOUR_CHAT_TRANSCRIPT","here is your chat transcript.");

define("_MESSAGE","Message");
define("_SEND","Send");
define("_LANGUAGE","Language");
define("_DEFAULT_LANGUAGE","Default language");
define("_WARN_UPDATE","New features have been added to the instant messenger that require you to update your preferences.\nTo do this, click on OPTIONS on the contact list and then EDIT ACCOUNT.\nThis message will not appear again until the next instant messenger update that requires you to update your preferences.");
define("_TABLE_BLANK_ROW","<tr><td>&nbsp;</td></tr>");
define("_YES","Yes");
define("_NO","No");
define("_PON","On");
define("_OFF","Off");
define("_TITLE_EDIT_CONFIGURATION","Edit Configuration");
define("_CONFIGURATION_UPDATED","Configuration Updated");
define("_GO_BACK","Go back to");
define("_ADMIN_OPTIONS","Admin Options");
define("_BELOW","below");
define("_EDIT_CONFIGURATION","Edit configuration");
define("_SYSTEM_CLOCK_TIMEZONE","System clock timezone");
define("_HOURS","hours");
define("_SAVE_CHANGES","Save Changes");
define("_CANCEL","Cancel");
define("_ACCESS_DENIED","You are not allowed to access this page");

define("_DELETE_USER_DENIED","You are not allowed to delete this user");
define("_USER_NOT_EXIST","User does not exist");
define("_ERROR","<b><font color=\"FF0000\">Error: </font></b>");
define("_USER_DELETED","User deleted.");
define("_DELETE_CANCELLED","Cancelled Deletion");
define("_ARE_YOU_SURE","Are you sure you want to");
define("_DELETE_THIS_USER","delete this user");
define("_SELECT_USER","Select user");
define("_DELETE_USER","Delete User");

define("_INVALID_USERNAME","Please enter a valid USERNAME");
define("_INVALID_EMAIL","Please enter a valid EMAIL ADDRESS");
define("_EMAIL_NO_SPACES","EMAIL addresses cannot contain spaces");
define("_PASSWORD_LENGTH","PASSWORD must be between 6 and 10 characters");
define("_PASSWORDS_MISMATCH","PASSWORDs do not match - please re-enter");
define("_EDIT_USER_DENIED","You are not allowed to edit this user.");
define("_EDIT_USER","Edit User");
define("_USER_UPDATED","User updated.");
define("_EMAIL","Email");
define("_PASSWORD","Password");
define("_PASSWORD_LENGTH_INFO","6 to 10 characters");
define("_LEAVE_BLANK_KEEP_EXISTING","leave blank to keep existing");
define("_CONFIRM_PASSWORD","Confirm Password");
define("_IF_CHANGING_PASSWORD","if changing password");
define("_EMOTICONS","Emoticons");
define("_BAN_THIS_USER","Ban this User?");
define("_USER_LEVEL","User Level");
define("_USER","User");
define("_PADMIN","Admin");
define("_OWNER","Owner");

define("_ADD_EMOTICONS","Add Emoticons");
//define("_ADD_EMOTICON_INSTRUCTIONS","<b><u>Instructions</u></b><p> 1. Download a PHPBB emoticon set including the .pak file.<br> You can get some from http://www.php121.com.<p>	2. Put the new emoticons and their pak into a new directory under your <i>php121smilies</i> directory<br>	E.g. phpsmilies/cutesmilies/ <br>The <b>directory name</b> will be the name of your new pak.<p>	3.  Next, submit the form below:<br>");
define("_ADD_EMOTICON_INSTRUCTIONS","");
define("_FILE","file");
define("_ADD_EMOTICON_SAMPLE","(e.g. cutesmilies/smiles.pak)");
define("_ADD_PAK","Add PAK");
define("_CANT_READ_PAK","Couldn't read pak file.  Does it exist?");
define("_SMILIES_UPDATE_ERROR","Couldn't update smilies!");
define("_SMILIES_ADDED","Smilies added!");

define("_DELETE_EMOTICONS","Delete Emoticons");
define("_SELECT_PAK","Select PAK");
define("_DELETE_PAK","Delete PAK");
define("_PAK_DELETED","PAK Deleted!");

define("_CONFIGURATION","Configuration");
define("_USER_ADMIN","User Admin");
define("_EDIT_SYSTEM_CONFIG","Edit PHP121 System Config");

define("_CANCEL_IM_REQUEST","Cancel IM Request");
define("_IM_REQUEST_CANCELLED","Request Cancelled.");
define("_CLOSE","Close Window");

define("_CHAT_HISTORY","Chat History");

define("_INSTANT_MESSAGE","Instant Message");
define("_INSTANT_MESSENGER","Instant Messenger");

define("_DATABASE_PROBLEM","There was a problem with the database, please try back later");

define("_DELETE_ACCOUNT","Delete Account");
define("_ACCOUNT_DELETED","Account deleted.");
define("_ACCOUNT_OPTIONS","Account Options");
define("_DELETE_YOUR_ACCOUNT","delete your account?");
define("_REENTER_U_AND_P","For security, please re-enter your username and password:");
define("_USERNAME","Username");

define("_EDIT_ACCOUNT","Edit Account");
define("_ACCOUNT_UPDATED","Account updated");
define("_WELCOME","Welcome");
define("_CAN_EDIT_YOUR_DETAILS_BELOW","you can edit your details below.");
define("_PASSWORD_CHANGE_LOGIN_AGAIN","If you change your password, you will need to login again.");
define("_AUTO_ACCEPT_CHAT_REQUESTS","Auto accept chat requests?");
define("_BEEP_ON_NEW_MESSAGE","Beep on new message");
define("_BRING_WINDOW_TO_FRONT","Bring window to front on new message");
define("_TIMEZONE","Timezone");
define("_SHOW_TIMESTAMPS","Show timestamps in chats?");

define("_EMOTICON_PACK","Emoticon Pack");

define("_INCOMING_REQUEST","INCOMING REQUEST");
define("_REQUEST_FROM","You have a request from");
define("_ACCEPT_REQUEST","Do you want to accept it?");
define("_AUTO_OPEN_IM_ATTEMPT","Attempting to automatically open new chat window... <p>If it does not appear, then you have a <b>POPUP BLOCKER</b>.  <p>Please allow <b>unrequested popups</b> to automatically accept chat requests.<p>Otherwise, turn off this option in your User <b>Options</b> screen.");
define("_UPDATED","Updated");
define("_ONLINE_AS","Online as");
define("_OPTIONS","Options");
define("_LOGOUT","Logout");
define("_CURRENT_CHATS","Current Chats");
define("_LEFT_CHAT","left the chat.");
define("_YOU","You");
define("_REJOIN_CHAT","rejoined the chat.");
define("_Resent_CHATS","Resent Chats");
define("_UNBLOCK","Unblock");
define("_BLOCK","Block");
define("_WHOS_ONLINE","Who's Online ");

define("_USER_NOT_AVAILABLE","User not available");
define("_SORRY_USER_NOT_AVAILABLE","Sorry, the user is not available.");

define("_PLEASE","Please");
define("_LOGIN","Login");
define("_REGISTER","Register");

define("_JOINED_CHAT","joined the chat.");

define("_USER_DIDNT_RESPOND","User didn't respond");
define("_SORRY_USER_DIDNT_RESPOND","Sorry, the user didn't respond.  Try again later.");

define("_USERNAME_NOT_FOUND","USERNAME not found.");
define("_INCORRECT_PASSWORD","Incorrect PASSWORD.");

define("_PLEASE_LOGIN_OR_REGISTER","Please login or register");
define("_PLEASE_LOGIN","Please login");
define("_REGISTERED_USERS","registered users");
define("_CREATE_NEW_ACCOUNT","Create a new account");
define("_LOST_LOGIN","Lost login details?");

define("_NEW_ACCOUNT","New Account");
define("_USERNAME_NO_SPACES","USERNAMES cannot contain spaces");
define("_USERNAME_IN_USE","Please choose a different USERNAME");
define("_EMAIL_REGGED","This email address has already been registered");
define("_PASSWORD_TOO_SHORT","PASSWORD too short");
define("_NEW_USER","New User");

define("_YOU_ARE_OWNER","You have OWNER admin level!");
define("_THANKS_REGISTERING","Thanks for registering!");
define("_BETWEEN","between");
define("_AND","and");
define("_CHARACTERS","characters");

define("_COULD_NOT_READ_CONFIG","Could not obtain configuration - most likely a database problem.  If running PHP121 for the first time, did you execute the SQL file first?  Please read the README (for first time installs) or UPDATE file (for upgrades) in the docs directory for instructions.");

define("_YOU_ARE_BANNED","You have been <b>banned</b>.  Please contact the admin if you think this has been a mistake.");

define("_TITLE_LOST_LOGIN","Lost Login");

define("_ENTER_EITHER_U_OR_E","Please enter either your USERNAME or EMAIL address");

define("_EMAIL_NOT_FOUND","EMAIL address not found.");

define("_TO_RECOVER_PASSWORD","To reset your PHP121 password, please go to the webpage below and follow the instructions.  If the address is split over 2 lines, you will need to join it in the address bar of your browser.");
define("_RESET_LOGIN_DETAILS","Reset Login Details");
define("_INSTRUCTIONS_MAILED","Instructions on how to reset your password have been emailed to you.  Please check your email in a few minutes.");
define("_OR","OR");
define("_RESET_PASSWORD","Reset Password");
define("_INCOMPLETE_URL","Incomplete URL: Please paste the URL from your email into the browser, removing any line breaks.");
define("_RESET_PASS_ENTER_PASS_BELOW","Enter your new password below, confirm it, and then press CHANGE PASSWORD");
define("_NEW_PASSWORD","New Password");
define("_CHANGE_PASSWORD","Change Password");
define("_INCORRECT_CODE","Incorrect code.  Please make sure you pasted the full URL into your browser.");

define("_PASSWORD_CHANGED","Password changed.");
define("_YOU_CAN_NOW","You can now");

define("_CANT_IM_SELF","You can't send an IM to yourself!");
define("_USER_IS_BLOCKED","You have blocked this user.  You may not contact them until you UNBLOCK them!");
define("_YOU_ARE_BLOCKED","This user has BLOCKED you.  You may not contact them until they UNBLOCK you!");
define("_SEND_IM","Send IM");
define("_REQUEST_SENT_TO","Request sent to");
define("_WAITING","waiting for a response...");

define("_VIEW_CHAT_HISTORY","View chat history (no refreshes)");

define("_USERS_IN_ROOM","Users in this room: ");
define("_NO_MESSAGE","You have not entered a message");
define("_INVITE_THIS_CHAT", "Invite to this chat...");
define("_NO_AJAX", "Sorry, your browser does not support AJAX, which is required for this application.  Consider upgrading your browser, or using another one such as <a target='blank' href='http://www.mozilla.com/firefox'>Firefox</a>.");
define("_JOINING", "...Joining...");
define("_INVITE_SELECT", "Select a user to invite to this chat: ");
define("_INVITE_ALL_HERE", "Sorry, all online users are currently in this room!");

?>
