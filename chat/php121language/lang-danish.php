<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)                                                  **
 **  File:              lang-danish.php                                                 **
 **  Date modified:     07/07/06 (PHP121 v2.2)                                          **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     danish language file                                            **
 **  Translated by:     Ren� Capion, Dit-Web.dk, rene@dit-web.dk                        **
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

define("_AUTO_EMAIL_TRANSCRIPT","Auto email chatindhold/log efter chat afsluttes");
define("_FORCE_AUTO_EMAIL_TRANSCRIPT","Overskriv brugernes valg af Auto email chatindhold indstilling og send hver gang");
define("_YOUR_CHATS","Dine chats");
define("_EMAIL_TRANSCRIPT","Email denne chat log");
define("_EMAIL_TRANSCRIPT_CONFIRM","Klik OK for at emaile indholdet af denne chat til din registrede emailadresse herunder.  <a href=\"php121edituser.php\" target=\"_blank\">Skift</a>");
define("_ADMIN_FORCING_EMAIL_TRANSCRIPTS","V�r opm�rksom p�, at denne sites chat er indstillet at sende email med chatloggen, automatisk.");
define("_AUTO_EMAIL_TRANSCRIPTS","Du har allerede bedt om at f� tilsendt chatloggen pr. email, automatisk.");
define("_DUPE_EMAIL_WARNING","hvis du forts�tter, modtager du mere end 1 kopi af emailen.");
define("_TRANSCRIPT_EMAILED","Den nuv�rende chatlog er sendt til din email.");
define("_USER_CAN_CREATE_ACCOUNT","Tillad oprettelse af nye konti?");
define("_USER_CAN_DELETE_ACCOUNT","Tillad brugere at slette deres egen konto?");
define("_ADD_USER","Tilf�j bruger");
define("_USER_ADDED","Bruger tilf�jet.");
define("_IMPORTANT_NOTE","(VIGTIG BESKED)");
define("_AUTO_EMAIL_NOTE","V�r opm�rksom p� at chatloggen kun sendes automatisk hvis der er mindst<u>1 kontaktliste �ben <b>2 minutter</b> efter chatten regnes for 'inaktiv'</u>.  <p>En inaktive chat er en hvor ingen deltager i chatten. Hvis der ikke er en kontaktliste �ben p� det tidspunkt, bliver der <b>ikke</b> sendt noget.  <p>Det forventes at denne feature bliver anvendt af de tekniske support afdelinger som via PHP121 hj�lper kunder og at en supporter vil have kontaktlisten �ben efter en kunde forlader chatten.  Denne feature regnes med at blive forbedret i senere udgaver af PHP121.");
define("_HPBUTTON_CHAT_NOW","Brugere i chatten: ");
define("_HPBUTTON_OPEN_MESSENGER","�bn Instant Messenger");
define("_FIX_SMILIES","Fix Smilies");
define("_HERE_IS_YOUR_CHAT_TRANSCRIPT","her er din chatlog.");

define("_MESSAGE","Besked");
define("_SEND","Send");
define("_LANGUAGE","Sprog");
define("_DEFAULT_LANGUAGE","Standard sprog");
define("_WARN_UPDATE","Nye features er tilf�jet i instant messenger som kr�ver at du opdaterer dine indstillinger.\nFor at g�re det, klik p� Indstillinger i kontaktlisten og v�lg Ret konto.\nDenne besked vil ikke ses igen, f�r nye opdateringer af instant messenger kr�ver at du retter i dine indstillinger.");
define("_TABLE_BLANK_ROW","<tr><td>&nbsp;</td></tr>");
define("_YES","Ja");
define("_NO","Nej");
define("_PON","Til");
define("_OFF","Fra");
define("_TITLE_EDIT_CONFIGURATION","Ret indstillinger");
define("_CONFIGURATION_UPDATED","Indstillinger opdateret");
define("_GO_BACK","G� tilbage");
define("_ADMIN_OPTIONS","Admin indstillinger");
define("_BELOW","under");
define("_EDIT_CONFIGURATION","ret indstillinger");
define("_SYSTEM_CLOCK_TIMEZONE","System Urs tidszone");
define("_HOURS","timer");
define("_SAVE_CHANGES","gem �ndringer");
define("_CANCEL","fortryd");
define("_ACCESS_DENIED","Du har ikke tilladelse til at komme p� denne side");

define("_DELETE_USER_DENIED","Du har ikke rettigheder til at slette denne bruger");
define("_USER_NOT_EXIST","Brugeren findes ikke");
define("_ERROR","<b><font color=\"FF0000\">Fejl: </font></b>");
define("_USER_DELETED","Bruger slettet.");
define("_DELETE_CANCELLED","Sletning er fortrudt");
define("_ARE_YOU_SURE","Er diu sikker p� at ville");
define("_DELETE_THIS_USER","slette denne bruger");
define("_SELECT_USER","V�lg bruger");
define("_DELETE_USER","Slet bruger");

define("_INVALID_USERNAME","Indtast venligst et korrekt brugernavn");
define("_INVALID_EMAIL","Indtast venligst en korrekt email-adresse");
define("_EMAIL_NO_SPACES","Email-adresser kan ikke indeholde mellemrum");
define("_PASSWORD_LENGTH","Kodeord skal v�re mellem 6 og 10 tegn");
define("_PASSWORDS_MISMATCH","Kodeordene matcher ikke - indtast igen");
define("_EDIT_USER_DENIED","Du har ikke rettigheder til at rette denne bruger.");
define("_EDIT_USER","Ret bruger");
define("_USER_UPDATED","Bruger rettet.");
define("_EMAIL","Email");
define("_PASSWORD","Kodeord");
define("_PASSWORD_LENGTH_INFO","6 til 10 tegn");
define("_LEAVE_BLANK_KEEP_EXISTING","lad v�re tom for at beholde den nuv�rende");
define("_CONFIRM_PASSWORD","Bekr�ft kodeord");
define("_IF_CHANGING_PASSWORD","hvis du �ndrer kodeord");
define("_EMOTICONS","Emoticons");
define("_BAN_THIS_USER","Ban denne bruger?");
define("_USER_LEVEL","Bruger niveau");
define("_USER","Bruger");
define("_PADMIN","Admin");
define("_OWNER","Ejer");

define("_ADD_EMOTICONS","Tilf�j Emoticons");
define("_ADD_EMOTICON_INSTRUCTIONS","<b><u>Instruktioner</u></b><p>
        1. Download en PHPBB emoticon s�t inklusiv .pak filen.<br>
        Du kan hente nogen fra http://www.php121.com.<p>
        2. L�g de nye emoticons og deres pak ind i et nyt katalog under dit <i>php121smilies</i> katalog<br>
        F.eks. phpsmilies/cutesmilies/ <br><b>katalognavnet</b> bliver navnet p� din nye pak.<p>
        3.  bagefter, send formularen herunder:<br>");
define("_FILE","fil");
define("_ADD_EMOTICON_SAMPLE","(f.eks. cutesmilies/smiles.pak)");
define("_ADD_PAK","Tilf�j PAK");
define("_CANT_READ_PAK","Kunne ikke l�se pak filen.  Findes den?");
define("_SMILIES_UPDATE_ERROR","Kunne ikke opdatere Emoticons!");
define("_SMILIES_ADDED","Emoticons tilf�jet!");

define("_DELETE_EMOTICONS","Slet Emoticons");
define("_SELECT_PAK","V�lg PAK");
define("_DELETE_PAK","Slet PAK");
define("_PAK_DELETED","PAK Slettet!");

define("_CONFIGURATION","Indstillinger");
define("_USER_ADMIN","Bruger Admin");
define("_EDIT_SYSTEM_CONFIG","Ret PHP121 System indstillinger");

define("_CANCEL_IM_REQUEST","Afbryd IM foresp�rgsel");
define("_IM_REQUEST_CANCELLED","Foresp�rgsel afbrudt.");
define("_CLOSE","Luk vinduet");

define("_CHAT_HISTORY","Chat Historie");

define("_INSTANT_MESSAGE","Instant Message");
define("_INSTANT_MESSENGER","Instant Messenger");

define("_DATABASE_PROBLEM","Der er et problem med databasen, Pr�v igen senere");

define("_DELETE_ACCOUNT","Slet konto");
define("_ACCOUNT_DELETED","Konto slettet.");
define("_ACCOUNT_OPTIONS","Konto indstillinger");
define("_DELETE_YOUR_ACCOUNT","Slet din konto?");
define("_REENTER_U_AND_P","Af sikkerhedshensyn, gentag venligst dit brugernavn og kodeord:");
define("_USERNAME","Username");

define("_EDIT_ACCOUNT","Ret konto");
define("_ACCOUNT_UPDATED","Konto opdateret");
define("_WELCOME","Velkommen");
define("_CAN_EDIT_YOUR_DETAILS_BELOW","Du kan rette detaljer om dig, herunder.");
define("_PASSWORD_CHANGE_LOGIN_AGAIN","Hvis du �ndrer kodeord, skal du logge ind igen.");
define("_AUTO_ACCEPT_CHAT_REQUESTS","Automatisk accepter chat-foresp�rgsler?");
define("_BEEP_ON_NEW_MESSAGE","Bip ved ny besked");
define("_BRING_WINDOW_TO_FRONT","Hent vinduet frem ved ny besked");
define("_TIMEZONE","Tidszone");
define("_SHOW_TIMESTAMPS","Vis tidsstempler i chatten?");

define("_EMOTICON_PACK","Emoticon Pak");

define("_INCOMING_REQUEST","Indkommende foresp�rgsel");
define("_REQUEST_FROM","Du har en foresp�rgsel fra");
define("_ACCEPT_REQUEST","Vil du chatte med personen?");
define("_AUTO_OPEN_IM_ATTEMPT","Fors�ger automatisk at �bne et nykt chatvindue... <p>Hvis ikke det vises har du m�ske en <b>POPUP BLOCKER</b>.  <p>Tillad venligst <b>automatiske popups</b> fra dette site for automatisk at acceptere chat foresp�rgsler.<p>�nsker du ikke denne funktion skal du sl� det fra under din kontos <b>Indstillinger</b>.");
define("_UPDATED","Opdateret");
define("_ONLINE_AS","Online som");
define("_OPTIONS","Indstillinger");
define("_LOGOUT","Log ud");
define("_CURRENT_CHATS","Nuv�rende Chats");
define("_LEFT_CHAT","forlod chatten.");
define("_YOU","Du");
define("_REJOIN_CHAT","kom ind igen.");
define("_RECENT_CHATS","Tidligere Chats");
define("_UNBLOCK","Fjern blokering");
define("_BLOCK","Bloker");
define("_WHOS_ONLINE","Hvem er p�? ");

define("_USER_NOT_AVAILABLE","Brugeren er ikke tilstede");
define("_SORRY_USER_NOT_AVAILABLE","Desv�rre, brugeren er ikke tilstede.");

define("_PLEASE","Venligst");
define("_LOGIN","Log ind");
define("_REGISTER","Register");

define("_JOINED_CHAT","kom p�.");

define("_USER_DIDNT_RESPOND","brugeren svarede ikke");
define("_SORRY_USER_DIDNT_RESPOND","Desv�rre, brugeren svarer ikke. Pr�v igen senere.");

define("_USERNAME_NOT_FOUND","Brugernavn ikke fundet.");
define("_INCORRECT_PASSWORD","forkert kodeord.");

define("_PLEASE_LOGIN_OR_REGISTER","Du skal logge ind eller registere dig");
define("_PLEASE_LOGIN","Log dig ind");
define("_REGISTERED_USERS","Registrede brugere");
define("_CREATE_NEW_ACCOUNT","Opret ny konto?");
define("_LOST_LOGIN","glemt log ind detaljer ?");

define("_NEW_ACCOUNT","Ny konto");
define("_USERNAME_NO_SPACES","Brugenavnet kan ikke indeholde mellemrum");
define("_USERNAME_IN_USE","V�lg venligst et andet brugernavn");
define("_EMAIL_REGGED","Denne email adresse er allerede registeret");
define("_PASSWORD_TOO_SHORT","Kodeordet er for kort");
define("_NEW_USER","Ny bruger");

define("_YOU_ARE_OWNER","Du har EJER admin niveau!");
define("_THANKS_REGISTERING","Tak for din tilmelding!");
define("_BETWEEN","mellem");
define("_AND","og");
define("_CHARACTERS","tegn");

define("_COULD_NOT_READ_CONFIG","Kunne ikke hente konfiguretionen - h�jst t�nkeligt et database problem.  Hvis det er f�rste gang du k�rer PHP121, check om du k�rte SQL filen f�rst?  L�s venligst README (for f�rste gangs installioner) eller UPDATE filen (for opgraderinger) under docs kataloget for instruktioner.");

define("_YOU_ARE_BANNED","Du er blevet <b>banned</b>.  Kontakt administratoren hvis du mener at det er en fejl.");

define("_TITLE_LOST_LOGIN","Glemt log ind");

define("_ENTER_EITHER_U_OR_E","Indtast dit brugernavn eller email-adresse");

define("_EMAIL_NOT_FOUND","Email-adressen blev ikke fundet.");

define("_TO_RECOVER_PASSWORD","For at nulstille dit PHP121 kodeord skal du browse til f�lgende webside og f�lge indstruktionerne.  Hvis adressen er splittet over 2 linier, m� du selv lige kopiere delene ind eller skrive adressen selv.");
define("_RESET_LOGIN_DETAILS","Nulstil Log ind detaljer");
define("_INSTRUCTIONS_MAILED","Instruktioner for nulstilling af dit kodeord som er mailet til dig. Check venligst din mail om et par minutter.");
define("_OR","ELLER");
define("_RESET_PASSWORD","Nulstil kodeodet");
define("_INCOMPLETE_URL","Forkert URL: Kopier venligst URL fra din email ogop i browserens adresselinie, husk at undg� linieskift.");
define("_RESET_PASS_ENTER_PASS_BELOW","Indtast dit nye kodeord herunder, bekr�ft det og tryk p� Skift kodeord");
define("_NEW_PASSWORD","Nyt kodeord");
define("_CHANGE_PASSWORD","Skift kodeord");
define("_INCORRECT_CODE","Forkert kode. Check venligst om du kopierede og indsatte den fulde URL i din browsers adresslinie.");

define("_PASSWORD_CHANGED","Kodeordet er �ndret.");
define("_YOU_CAN_NOW","Du kan nu");

define("_CANT_IM_SELF","Du kan ikke sendet en IM til dig selv!");
define("_USER_IS_BLOCKED","Du har blokeret denne bruger. Du kan ikke kontakte personen f�r du fjerner blokeringen!");
define("_YOU_ARE_BLOCKED","denne bruger har blokeret dig. Du kan ikke kontakte personen f�r blokeringen er fjernet!");
define("_SEND_IM","Send IM");
define("_REQUEST_SENT_TO","Besked sendt til");
define("_WAITING","venter p� svar...");

define("_VIEW_CHAT_HISTORY","Se chatloggen (ingen opfriskning af sk�rmen)");

define("_USERS_IN_ROOM","Brugere i dette rum: ");
define("_NO_MESSAGE","Du har ikke indtastet en besked");
define("_INVITE_THIS_CHAT", "Inviter til denne chat...");
define("_NO_AJAX", "Desv�rre, din browser underst�tter ikke AJAX, som er kr�vet af dette program. Overvej at opgradere eller udskifte din browser til f.eks. <a target='blank' href='http://www.mozilla.com/firefox'>Firefox</a>.");
define("_JOINING", "...p� vej ind...");
define("_INVITE_SELECT", "V�lg en bruger du vil invitere til denne chat: ");
define("_INVITE_ALL_HERE", "Desv�rre, alle online brugere er allerde i dette rum!");

?>
