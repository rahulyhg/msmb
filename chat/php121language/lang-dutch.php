<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)                                                  **
 **  File:              lang-dutch.php							**
 **  Date modified:     25 June 2006	                                                **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Dutch   language file                                           **
 **  Translated by:     Ralf Kruishaar, Nederline Internet, nederline.nl         	**
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
define("_EMAIL_TRANSCRIPT_CONFIRM","Click OK to email the contents of this chat to your registered email address below.  <a href=\"php121edituser.php\" target=\"_blank\">Change</a>");
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

define("_MESSAGE","Bericht");
define("_SEND","Zend");
define("_LANGUAGE","Taal");
define("_DEFAULT_LANGUAGE","Standaard taal");
define("_WARN_UPDATE","Er zijn nieuwe functies beschikbaar voor de PHP121 messenger waardoor uw instellingen bijgewerkt dienen te worden.\nOm dit te doen, klik op opties en dan op bewerk account.\nDit bericht zal niet meer verschijnen totdat je geupdate hebt.");
define("_TABLE_BLANK_ROW","<tr><td>&nbsp;</td></tr>");
define("_YES","Ja");
define("_NO","Nee");
define("_PON","Aan");
define("_OFF","Uit");
define("_TITLE_EDIT_CONFIGURATION","Bewerk instellingen");
define("_CONFIGURATION_UPDATED","Instellingen opgeslagen");
define("_GO_BACK","Ga terug naar");
define("_ADMIN_OPTIONS","Managmenent instellingen");
define("_BELOW","Beneden");
define("_EDIT_CONFIGURATION","Bewerk instellingen");
define("_SYSTEM_CLOCK_TIMEZONE","Tijdzone");
define("_HOURS","uren");
define("_SAVE_CHANGES","Opslaan");
define("_CANCEL","Annuleren");
define("_ACCESS_DENIED","Sorry, je hebt geen toegang tot deze bestanden");

define("_DELETE_USER_DENIED","Sorry, je kunt deze persoon niet wissen");
define("_USER_NOT_EXIST","Persoon bestaat niet");
define("_ERROR","<font color=\"FF0000\">Error: </font>");
define("_USER_DELETED","Persoon verwijderd");
define("_DELETE_CANCELLED","Annuleer actie");
define("_ARE_YOU_SURE","Weet je zeker dat je");
define("_DELETE_THIS_USER","dit wilt");
define("_SELECT_USER","Selecteer gebruiker");
define("_DELETE_USER","Delete gebruiker");

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

define("_ADD_EMOTICONS","Voeg smileys toe");
define("_ADD_EMOTICON_INSTRUCTIONS","<b><u>Instructie</u></b><p>
	1. Download een phpbb emotie .pak file.<br> 
	Ze kunnen gedownload worden vanaf http://www.php121.com.<p>
	2. Plaats de nieuwe complete map in de file van je <i>php121smilies</i> map<br>
	E.g. phpsmilies/cutesmilies/ <br>de <b>map naam</b> zal de nieuwe naam worden van je emoties<p>
	3.  Daarna, verzend je dit formulier<br>");
define("_FILE","Bestand");
define("_ADD_EMOTICON_SAMPLE","(e.g. cutesmilies/smiles.pak)");
define("_ADD_PAK","Voeg pakket toe");
define("_CANT_READ_PAK","Sorry, ik kan het niet lezen, zit er iets in de map?");
define("_SMILIES_UPDATE_ERROR","Sorry, kan dit echt niet verwerken");
define("_SMILIES_ADDED","Er zijn smilies toegevoegd");

define("_DELETE_EMOTICONS","Delete smileys");
define("_SELECT_PAK","Select PAK");
define("_DELETE_PAK","Delete PAK");
define("_PAK_DELETED","PAK Deleted!");

define("_CONFIGURATION","Configuratie");
define("_USER_ADMIN","User Admin");
define("_EDIT_SYSTEM_CONFIG","Bewerk systeeminstellingen");

define("_CANCEL_IM_REQUEST","Annulleer verzoek");
define("_IM_REQUEST_CANCELLED","Verzoek geannuleerd.");
define("_CLOSE","Sluit venster");

define("_CHAT_HISTORY","Gespreksgeschiedenis");

define("_INSTANT_MESSAGE","Inkomend Bericht");
define("_INSTANT_MESSENGER","PHP121 Messenger");

define("_DATABASE_PROBLEM","Er is een probleem met de database, probeer het later nogmaals");

define("_DELETE_ACCOUNT","Verwijder account");
define("_ACCOUNT_DELETED","Account verwijderd.");
define("_ACCOUNT_OPTIONS","Account opties");
define("_DELETE_YOUR_ACCOUNT","Je account wissen?");
define("_REENTER_U_AND_P","Beveiliging: Geef je inlognaam en paswoord nogmaals op");
define("_USERNAME","Inlognaam");

define("_EDIT_ACCOUNT","Bewerk account");
define("_ACCOUNT_UPDATED","Account succesvol geupdate");
define("_WELCOME","Welkom");
define("_CAN_EDIT_YOUR_DETAILS_BELOW","je kunt je gegevens hieronder bewerken");
define("_PASSWORD_CHANGE_LOGIN_AGAIN","Als je je paswoord bewerkt moet je opnieuw inloggen");
define("_AUTO_ACCEPT_CHAT_REQUESTS","Automatisch chatverzoeken accepteren?");
define("_BEEP_ON_NEW_MESSAGE","Produceer pieptoon bij inkomend bericht?");
define("_BRING_WINDOW_TO_FRONT","Popup scherm bij nieuw inkomend bericht");
define("_TIMEZONE","Tijdzone");
define("_SHOW_TIMESTAMPS","Tijdstempel in berichten??");

define("_EMOTICON_PACK","Emotie pakket?");

define("_INCOMING_REQUEST","Inkomend verzoek");
define("_REQUEST_FROM","Er is een verzoek van");
define("_ACCEPT_REQUEST","Wil je dit accepteren?");
define("_AUTO_OPEN_IM_ATTEMPT","Er is een popup killer actief, schakel deze eerst uit of activeer dit intranet als goede omgeving. Dit kan uw systeembeheerder voor u regelen");
define("_UPDATED","Geupdate!");
define("_ONLINE_AS","Online als");
define("_OPTIONS","Optie");
define("_LOGOUT","Uitloggen");
define("_CURRENT_CHATS","Chats actief");
define("_LEFT_CHAT","heeft de chat verlaten");
define("_YOU","Jij");
define("_REJOIN_CHAT","is weer actief");
define("_RECENT_CHATS","Actuele chats");
define("_UNBLOCK","Deblokkeer");
define("_BLOCK","Blokkeer");
define("_WHOS_ONLINE","Wie is online:");

define("_USER_NOT_AVAILABLE","Persoon niet beschikbaar");
define("_SORRY_USER_NOT_AVAILABLE","Sorry, persoon is momenteel niet beschikbaar.");

define("_PLEASE","Alstublief");
define("_LOGIN","Login");
define("_REGISTER","Registreer");

define("_JOINED_CHAT","is de chat binnengekomen");

define("_USER_DIDNT_RESPOND","Persoon reageert niet");
define("_SORRY_USER_DIDNT_RESPOND","Sorry, de persoon reageert niet, probeer het later nogmaals");

define("_USERNAME_NOT_FOUND","Persoon niet gevonden");
define("_INCORRECT_PASSWORD","Paswoord is verkeerd");

define("_PLEASE_LOGIN_OR_REGISTER","AUB Inloggen of registreren");
define("_PLEASE_LOGIN","AUB Login");
define("_REGISTERED_USERS","Geregistreerde personen");
define("_CREATE_NEW_ACCOUNT","Maak een nieuw account aan");
define("_LOST_LOGIN","Accountgegevens verloren");

define("_NEW_ACCOUNT","Nieuw account");
define("_USERNAME_NO_SPACES","Nicknamen mogen geen spaties bevatten");
define("_USERNAME_IN_USE","Kies een nieuwe nicknaam");
define("_EMAIL_REGGED","Dit mailadres is al eens geregistreerd");
define("_PASSWORD_TOO_SHORT","Paswoord te kort");
define("_NEW_USER","Nieuwe gebruiker");

define("_YOU_ARE_OWNER","Je hebt administrator rechten!");
define("_THANKS_REGISTERING","Bedankt voor registratie!");
define("_BETWEEN","tussen");
define("_AND","en");
define("_CHARACTERS","tekens");

define("_COULD_NOT_READ_CONFIG","Database probleem, waarschuw uw systeembeheerder");

define("_YOU_ARE_BANNED","Je account is geblokkeerd. Waarschuw je systeembeheerder als je denkt dat dit een fout is");

define("_TITLE_LOST_LOGIN","Inloggegevens kwijt");

define("_ENTER_EITHER_U_OR_E","Geef of een emailadres of nicknaam in");

define("_EMAIL_NOT_FOUND","Mailadres niet gevonden in de database");

define("_TO_RECOVER_PASSWORD","Om je paswoord te wijzigen volg de instructies");
define("_RESET_LOGIN_DETAILS","Reset inloggegevens");
define("_INSTRUCTIONS_MAILED","Alle gegevens om je account te wijzigen zijn naar je toe gemaild. Controleer je e-mail.");
define("_OR","Of");
define("_RESET_PASSWORD","Reset paswoord");
define("_INCOMPLETE_URL","De link is niet goed gekopieerd");
define("_RESET_PASS_ENTER_PASS_BELOW","Voer je mailadres in, bevestig het en klik op verder");
define("_NEW_PASSWORD","Nieuw paswoord");
define("_CHANGE_PASSWORD","Wijzig wachtwoord");
define("_INCORRECT_CODE","De link is niet goed, probeer het opnieuw");

define("_PASSWORD_CHANGED","Paswoord gewijzigd");
define("_YOU_CAN_NOW","U kunt nu");

define("_CANT_IM_SELF","Hallo, slimmie, je kunt niet met jezelf chatten");
define("_USER_IS_BLOCKED","Je hebt deze persoon geblokkeerd!");
define("_YOU_ARE_BLOCKED","Deze persoon heeft je geblokkeerd");
define("_SEND_IM","Zend bericht");
define("_REQUEST_SENT_TO","Verzoek verzonden naar");
define("_WAITING","en rustig wachten we af....");

define("_VIEW_CHAT_HISTORY","Bekijk chatgeschiedenis");

define("_USERS_IN_ROOM","Aantal gebruikers in deze ruimte: "); 
define("_NO_MESSAGE","U heeft geen bericht geschreven");
define("_INVITE_THIS_CHAT", "Nodig uit in deze chat...");
define("_NO_AJAX", "Sorry, uw browser ondersteunt geen AJAX, dit is benodigd voor dit programma. Upgrade uw browser of download een nieuwe, bijvoorbeeld <a target='blank' href='http://www.mozilla.com/firefox'>Firefox</a>.");
define("_JOINING", "...komt binnen wandelen....");
define("_INVITE_SELECT", "Selecteer een gebruiker om mee te chatten: ");
define("_INVITE_ALL_HERE", "Sorry, alle gebruikers zijn nu in deze chatkamer!"); 

?>
