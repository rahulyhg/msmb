<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)                                                  **
 **  File:              lang-german_formal.php                                          **
 **  Date modified:     09/07/06 (PHP121 v2.2)                                          **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     German translation (SIE)                                        **
 **  Translated by:	legolas (frank bur --> ali at frank minus bur dot de)           **
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

define("_CLEAR_CHAT","Chat-Fenster leeren");
define("_CHARS_LEFT","Zeichen noch übrig");

define("_AUTO_EMAIL_TRANSCRIPT","Automatische Chat-Kopie per Email nach Chat-Ende");
define("_FORCE_AUTO_EMAIL_TRANSCRIPT","Die Benutzereinstellungen bzgl. 
der automatischen Zusendung der Chat-Kopie uberschreiben und immer senden");
define("_YOUR_CHATS","Ihre Chats");
define("_EMAIL_TRANSCRIPT","Diesen Chat-Log per Email zusenden");
define("_EMAIL_TRANSCRIPT_CONFIRM","Klicken Sie bitte auf OK um sich eine Kopie dieses Chats an Ihre registrierte Email-Adresse senden zu lassen. <a href=\"php121edituser.php\" target=\"_blank\">Andern</a>");
define("_ADMIN_FORCING_EMAIL_TRANSCRIPTS","Bitte beachten: 
Standardmassig wird immer eine Kopie der Chats per Email versendet.");
define("_AUTO_EMAIL_TRANSCRIPTS","Sie haben bereits eingestellt, dass Sie Kopien der Chats per Email zugeschickt bekommen.");
define("_DUPE_EMAIL_WARNING","Wenn Sie fortfahren, dann werden Sie mehrere Kopien des Chats per Email erhalten");
define("_TRANSCRIPT_EMAILED","Eine Kopie des laufenden Chats wurde Ihnen per Email zugeschickt.");
define("_USER_CAN_CREATE_ACCOUNT","Das Anlegen neuer Accounts erlauben?");
define("_USER_CAN_DELETE_ACCOUNT","Den Benutzern das Loschen eigener Accounts erlauben?");
define("_ADD_USER","Benutzer hinzufugen");
define("_USER_ADDED","Benutzer hinzugefugt.");
define("_IMPORTANT_NOTE","(Wichtiger Hinweis)");
define("_AUTO_EMAIL_NOTE","Bitte beachten: wenn automatisch eine Kopie des Chats per Email versendet werden soll, dann muss wenigstens <u>eine Kontaktliste fur<b>2 Minuten</b> geoffnet sein <b>nachdem</b> der Chat auf 'inaktiv' gesetzt wurde</u>. <p>Ein Chat wird dann inaktiv, wenn sich niemand mehr im Chatraum befindet. Wenn zu diesem Zeitpunkt keine Kontaktliste geoffnet ist, wird die Email <b>nicht</b> versendet. <p>Dieses Feature ist gedacht fur technische Support-Abteilungen, die PHP121 benutzen, um den Kunden zu helfen. Zu dem Zweck muss ein Mitarbeiter des technischen Supports eine Kontaktliste geoffnet haben, nachdem der Kunde die Kontaktliste verlassen hat. Dieses Feature wird wahrscheinlich in einer spateren Version von PHP121 verbessert werden.");
define("_HPBUTTON_CHAT_NOW","Folgende Benutzer chatten gerade: ");
define("_HPBUTTON_OPEN_MESSENGER","Instant Messenger offnen");
define("_FIX_SMILIES","Smilies reorganisieren");
define("_HERE_IS_YOUR_CHAT_TRANSCRIPT","Hier ist Ihre Chat-Kopie.");

define("_MESSAGE","Nachricht");
define("_SEND","Senden");
define("_LANGUAGE","Sprache");
define("_DEFAULT_LANGUAGE","Standard Sprache");
define("_WARN_UPDATE","Der Instant Messenger bekam neue Funktionalität. Bitte überprüfen Sie ihre Einstellungen\nUm dies zu tun, bitte auf *Optionen* in der Kontaktliste drücken und dann *Account bearbeiten* drücken.\nDiese Nachricht erscheint erst wieder beim Updaten zu einer neuen Version, wenn wieder ein Abgleich der Einstellungen nötig wird.");
define("_TABLE_BLANK_ROW","<tr><td>&nbsp;</td></tr>");
define("_YES","Ja");
define("_NO","Nein");
define("_PON","An");
define("_OFF","Aus");
define("_TITLE_EDIT_CONFIGURATION","Konfiguration bearbeiten");
define("_CONFIGURATION_UPDATED","Konfiguration aktualisiert");
define("_GO_BACK","Gehe zurück zu");
define("_ADMIN_OPTIONS","Admin Einstellungen");
define("_BELOW","");	// blank is ok, not needed in german
define("_EDIT_CONFIGURATION","Konfiguration bearbeiten");
define("_SYSTEM_CLOCK_TIMEZONE","Zeitzone");
define("_HOURS","Stunden");
define("_SAVE_CHANGES","Änderungen speichern");
define("_CANCEL","abbrechen");
define("_ACCESS_DENIED","Sie haben keine Berechtigung diese Seite zu sehen");

define("_DELETE_USER_DENIED","Sie dürfen diesen Benutzer nicht löschen");
define("_USER_NOT_EXIST","Dieser Benutzer existiert nicht");
define("_ERROR","<font color=\"FF0000\">Fehler: </font>");
define("_USER_DELETED","Benutzer gelöscht.");
define("_DELETE_CANCELLED","Löschvorgang abgebrochen");
define("_ARE_YOU_SURE","Sind Sie wirklich sicher, dass Sie");
define("_DELETE_THIS_USER","diesen Benutzer löschen wollen");
define("_SELECT_USER","Benutzer auswählen");
define("_DELETE_USER","Benutzer löschen");

define("_INVALID_USERNAME","Bitte geben Sie einen gültigen <b>Benutzernamen</b> ein");
define("_INVALID_EMAIL","Bitte geben Sie eine gültige <b>Email-Adresse</b> ein");
define("_EMAIL_NO_SPACES","In einer <b>Email-Adresse</b> dürfen keine Leerzeichen vorkommen");
define("_PASSWORD_LENGTH","Das <b>Passwort</b> muss zwischen 6 und 10 Zeichen lang sein");
define("_PASSWORDS_MISMATCH","Die <b>Passwörter</b> stimmen nicht überein. Bitte Passwörter neu eingeben");
define("_EDIT_USER_DENIED","Sie dürfen diesen Benutzer nicht bearbeiten.");
define("_EDIT_USER","Benutzer bearbeiten");
define("_USER_UPDATED","Benutzer aktualisiert.");
define("_EMAIL","Email");
define("_PASSWORD","Passwort");
define("_PASSWORD_LENGTH_INFO","zwischen 6 und 10 Zeichen");
define("_LEAVE_BLANK_KEEP_EXISTING","bitte frei lassen, um das existierende beizubehalten");
define("_CONFIRM_PASSWORD","Passwort bestätigen");
define("_IF_CHANGING_PASSWORD","wenn Sie das Passwort ändern");
define("_EMOTICONS","Emoticons");
define("_BAN_THIS_USER","Diesen Benutzer sperren?");
define("_USER_LEVEL","Benutzerrang");
define("_USER","Benutzer");
define("_PADMIN","Admin");
define("_OWNER","Super User");

define("_ADD_EMOTICONS","Emoticons hinzufügen");
define("_ADD_EMOTICON_INSTRUCTIONS","<b><u>Anleitung</u></b><p>
	1. Laden Sie ein PHPBB Emoticon-Set einschliesslich des .pak file herunter.<br> 
	Solche Sets können Sie auch bei http://www.php121.com herunterladen.<p>
	2. Packen Sie die neuen Emoticons und die pak-datei in ein neues Verzeichnis unter Ihrem 
	<i>php121smilies</i> Verzeichnis<br>
	Z.B.: phpsmilies/cutesmilies/ <br>Der <b>Verzeichnis Name</b> ist der Name ihres neuen Pakets.<p>
	3.  Bitte schicken Sie das nachfolgende Formular ab:<br>");
define("_FILE","Datei");
define("_ADD_EMOTICON_SAMPLE","(z.B.: cutesmilies/smiles.pak)");
define("_ADD_PAK","Paket hinzufügen");
define("_CANT_READ_PAK","Die pak-Datei konnte nicht gefunden werden. Existiert diese auch wirklich?");
define("_SMILIES_UPDATE_ERROR","Die Smilies konnten nicht aktualisiert werden!");
define("_SMILIES_ADDED","Smilies hinzugefügt!");

define("_DELETE_EMOTICONS","Emoticons löschen");
define("_SELECT_PAK","Paket auswählen");
define("_DELETE_PAK","Paket löschen");
define("_PAK_DELETED","Paket gelöscht!");

define("_CONFIGURATION","Konfiguration");
define("_USER_ADMIN","Benutzer Administration");
define("_EDIT_SYSTEM_CONFIG","PHP121 System-Konfiguration ändern");

define("_CANCEL_IM_REQUEST","IM Anfrage abbrechen");
define("_IM_REQUEST_CANCELLED","Anfrage abgebrochen.");
define("_CLOSE","Fenster schliessen");

define("_CHAT_HISTORY","Chat Verlauf");

define("_INSTANT_MESSAGE","Instant Message");
define("_INSTANT_MESSENGER","Instant Messenger");

define("_DATABASE_PROBLEM","Es ist ein Datenbankfehler aufgetreten, bitte versuchen Sie es später nochmal");

define("_DELETE_ACCOUNT","Account löschen");
define("_ACCOUNT_DELETED","Account gelöscht.");
define("_ACCOUNT_OPTIONS","Account Einstellungen");
define("_DELETE_YOUR_ACCOUNT","Ihren Account wirklich löschen wollen?");
define("_REENTER_U_AND_P","Aus Sicherheitsgründen müssen Sie ihren Benutzernamen und ihr Passwort erneut eingeben:");
define("_USERNAME","Benutzername");

define("_EDIT_ACCOUNT","Account bearbeiten");
define("_ACCOUNT_UPDATED","Account aktualisiert");
define("_WELCOME","Willkommen");
define("_CAN_EDIT_YOUR_DETAILS_BELOW","hier können Sie ihre Einstellungen ändern.");
define("_PASSWORD_CHANGE_LOGIN_AGAIN","Wenn Sie ihr Passwort ändern müssen Sie sich erneut einloggen.");
define("_AUTO_ACCEPT_CHAT_REQUESTS","Automatische Annahme von Chat-Anfragen");
define("_BEEP_ON_NEW_MESSAGE","Signalton beim Erhalt einer neuen Nachricht");
define("_BRING_WINDOW_TO_FRONT","Fenster in den Vordergrund bringen nach Erhalt einer neuen Nachricht");
define("_TIMEZONE","Zeitzone");
define("_SHOW_TIMESTAMPS","Zeitstempel im Chat anzeigen?");

define("_EMOTICON_PACK","Emoticon Paket");

define("_INCOMING_REQUEST","<b>Neue Chat-Anfrage</b>");
define("_REQUEST_FROM","Sie haben eine Anfrage von");
define("_ACCEPT_REQUEST","Möchten Sie annehmen?");
define("_AUTO_OPEN_IM_ATTEMPT","Es wird versucht automatisch ein neues Chat-Fenster zu öffnen... <p>Falls dieses Fenster nicht erscheint, dann haben Sie einen <b>POPUP BLOCKER</b> aktiviert.  <p>Bitte erlauben Sie <b>Popups</b> um automatisch Chat-Anfragen annehmen zu können.<p>Alternativ können Sie diese Option in den <b>Benutzereinstellungen</b> abschalten.");
define("_UPDATED","Aktualisiert");
define("_ONLINE_AS","eingeloggt als");
define("_OPTIONS","Einstellungen");
define("_LOGOUT","Logout");
define("_CURRENT_CHATS","Laufende Chats");
define("_LEFT_CHAT","hat den Chat verlassen.");
define("_YOU","Sie");
define("_REJOIN_CHAT","betritt wieder den Chat.");
define("_RECENT_CHATS","Ältere Chats");
define("_UNBLOCK","entsperren");
define("_BLOCK","sperren");
define("_WHOS_ONLINE","Wer ist online:");

define("_USER_NOT_AVAILABLE","Benutzer nicht erreichbar");
define("_SORRY_USER_NOT_AVAILABLE","Leider wurde Ihre Anfrage abgelehnt.");

define("_PLEASE","Bitte");
define("_LOGIN","Login");
define("_REGISTER","Anmelden");

define("_JOINED_CHAT","betritt den Chat.");

define("_USER_DIDNT_RESPOND","Benutzer antwortet nicht");
define("_SORRY_USER_DIDNT_RESPOND","Sorry, der Benutzer antwortet nicht. Bitte versuchen Sie es später nochmal.");

define("_USERNAME_NOT_FOUND","<b>Benutzername</b> nicht gefunden.");
define("_INCORRECT_PASSWORD","Sie haben ein falsches <b>Passwort</b> angegeben.");

define("_PLEASE_LOGIN_OR_REGISTER","Bitte einloggen oder anmelden");
define("_PLEASE_LOGIN","Bitte einloggen");
define("_REGISTERED_USERS","angemeldete Benutzer");
define("_CREATE_NEW_ACCOUNT","Neuen Account erstellen");
define("_LOST_LOGIN","Login Daten vergessen?");

define("_NEW_ACCOUNT","Neuer Account");
define("_USERNAME_NO_SPACES","Der <b>Benutzername</b> darf keine Leerzeichen enthalten");
define("_USERNAME_IN_USE","Bitte wählen Sie einen anderen <b>Benutzernamen</b>");
define("_EMAIL_REGGED","Ihre angegebene Email-Adresse ist bereits registriert");
define("_PASSWORD_TOO_SHORT","Ihr eingegebenes <b>Passwort</b> ist zu kurz");
define("_NEW_USER","Neuer Benutzer");

define("_YOU_ARE_OWNER","Sie haben <b>Super User</b> Rang!");
define("_THANKS_REGISTERING","Danke für Ihre Anmeldung!");
define("_BETWEEN","zwischen");
define("_AND","und");
define("_CHARACTERS","Buchstaben");

define("_COULD_NOT_READ_CONFIG","Die Konfigurationsdaten konnten nicht eingelesen werden - in den meisten Fällen aufgrund eines Datenbank-Problems.  Wenn Sie PHP121 zum ersten Mal benutzen vergewissern Sie sich, dass Sie das SQL-Script, welches die benötigten Tabellen in der Datenbank anlegt, ausgeführt haben.  Bitte lesen Sie die <b>README</b> Datei (bei Erstinstallation) oder die <b>UPDATE</b> Datei (bei Upgrades) im <b>docs</b> Verzeichnis und folgen Sie den Anweisungen.");

define("_YOU_ARE_BANNED","Sie wurden <b>gesperrt</b>. Um weitere Informationen zu erhalten wenden Sie Sich bitte an einen Admin.");

define("_TITLE_LOST_LOGIN","Letztes Login");

define("_ENTER_EITHER_U_OR_E","Bitte geben Sie entweder Ihren <b>Benutzernamen</b> oder Ihre <b>Email-Adresse</b> ein");

define("_EMAIL_NOT_FOUND","Die <b>Email-Adresse</b> konnte nicht gefunden werden.");

define("_TO_RECOVER_PASSWORD","Um Ihr Passwort bei PHP121 zurückzusetzen, besuchen Sie bitte die nachfolgende Webseite und folgen Sie den Anweisungen. Falls die Adresse in zwei Zeilen gesplittet sein sollte, so fügen Sie diese bitte aneinander zur Eingabe in die Adresszeile ihres Browser.");
define("_RESET_LOGIN_DETAILS","Login Daten zurücksetzen");
define("_INSTRUCTIONS_MAILED","Die Anweisungen zum Zurücksetzen Ihres Passworts wurden Ihnen per Email zugeschickt. Bitte rufen Sie ihre Mails ab.");
define("_OR","ODER");
define("_RESET_PASSWORD","Passwort zurücksetzen");
define("_INCOMPLETE_URL","Unvollständiger URL: Bitte kopieren Sie den URL aus der Email in ihren Browser, entfernen Sie alle Zeilenumbrüche.");
define("_RESET_PASS_ENTER_PASS_BELOW","Geben Sie nachfolgend ihr neues Passwort ein, bestätigen Sie Dieses, und drücken dann <b>Passwort ändern</b>");
define("_NEW_PASSWORD","Neues Passwort");
define("_CHANGE_PASSWORD","Passwort ändern");
define("_INCORRECT_CODE","Falscher URL. Bitte stellen Sie sicher, dass Sie den <b>kompletten</b> URL in ihren Browser eingegeben haben.");

define("_PASSWORD_CHANGED","Passwort geändert.");
define("_YOU_CAN_NOW","Sie können sich nun");

define("_CANT_IM_SELF","Sie können keine Nachricht an sich selbst schicken!");
define("_USER_IS_BLOCKED","Sie haben diesen Benutzer <b>gesperrt</b>. Sie können erst wieder mit dem Benutzer kommunizieren, wenn Sie ihn <b>entsperrt</b> haben!");
define("_YOU_ARE_BLOCKED","Dieser Benutzer hat Sie <b>gesperrt</b>. Sie können erst wieder mit dem Benutzer kommunizieren, wenn Dieser Sie <b>entsperrt</b> hat!");
define("_SEND_IM","Nachricht senden");
define("_REQUEST_SENT_TO","Anfrage wird gesendet zu<b>");
define("_WAITING","</b><br/>Warte auf Antwort...");

define("_VIEW_CHAT_HISTORY","Zeige Chatverlauf (ohne Aktualisierung)");

define("_USERS_IN_ROOM","Benutzer in diesem Raum: ");
define("_NO_MESSAGE","Sie haben keine Nachricht eingegeben");
define("_INVITE_THIS_CHAT", "Einladung zu diesem Chat...");
define("_NO_AJAX", "Sorry, Ihr Browser ünterstützt AJAX nicht, was für diese Anwendung aber benötigt wird. Bitte upgraden Sie Ihren Browser oder benutzen Sie alternativ einen anderen Browser, wie z.B. den <a target='blank' href='http://www.mozilla.com/firefox'>Firefox</a>.");
define("_JOINING", "...Neues Chat Mitglied...");
define("_INVITE_SELECT", "Laden Sie einen Benutzer zu diesem Chat ein: ");
define("_INVITE_ALL_HERE", "Sorry, alle Benutzer, die online sind, sind bereits in diesem Raum!");

?>
