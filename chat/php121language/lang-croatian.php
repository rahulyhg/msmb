<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)                                                  **
 **  File:              lang-croatian.php                                               **
 **  Date modified:     26 November 2005                                                **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Croatian translation                                            **
 **  Translated by:	Nevio Veisc                                                     **
 *****************************************************************************************/

/**************************************************************************/
/* PHP121: PHP Based Instant Messenger                                    */
/* ===================================                                    */
/*                                                                        */
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

define("_MESSAGE","Poruka");
define("_SEND","Po&scaron;alji");
define("_LANGUAGE","Jezik");
define("_DEFAULT_LANGUAGE","Glavni jezik");
define("_WARN_UPDATE","Instant Messenger-u dodane su nove mogu&#263;nosti koje zahtjevaju da ponovno podesite svoje korisni&#269;ke podatke.\nDa bi ste to u&#269;inili, kliknite na Izbornik Liste kontakta te potom Uredi korisni&#269;ki ra&#269;un.\n Ova poruka se ne&#263;e pojavljivati sve dokle novi aplikacijski dodatci nebudu to zahtjvali.");
define("_TABLE_BLANK_ROW","<tr><td>&nbsp;</td></tr>");
define("_YES","Da");
define("_NO","Ne");
define("_PON","Upali");
define("_OFF","Ugasi");
define("_TITLE_EDIT_CONFIGURATION","Uredi konfiguraciju");
define("_CONFIGURATION_UPDATED","Konfiguracija je dodana postoje&#263;oj");
define("_GO_BACK","Vratite se na");
define("_ADMIN_OPTIONS","Administracijski Izbornik");
define("_BELOW","ispod");
define("_EDIT_CONFIGURATION","Uredi konfiguraciju");
define("_SYSTEM_CLOCK_TIMEZONE","Vremenska zona sistema");
define("_HOURS","sati");
define("_SAVE_CHANGES","Sa&#269;uvaj promjene");
define("_CANCEL","Poni&scaron;ti");
define("_ACCESS_DENIED","nemate dozvolu ulaska na stranicu");

define("_DELETE_USER_DENIED","Nemate dozvolu da izbri&scaron;ete korisnika");
define("_USER_NOT_EXIST","Korisnik ne postoji");
define("_ERROR","<font color=\"FF0000\">Gre&scaron;ka: </font>");
define("_USER_DELETED","Korisnik je izbrisan.");
define("_DELETE_CANCELLED","Brisanje je poni&scaron;teno");
define("_ARE_YOU_SURE","Da li ste sigurni da &#382;elite");
define("_DELETE_THIS_USER","Izbri&scaron;ite korisnika");
define("_SELECT_USER","Ozna&#269;i korisnika");
define("_DELETE_USER","Izbri&scaron;i korisnika");

define("_INVALID_USERNAME","Molim unesite ispravno koris&#269;ko ime");
define("_INVALID_EMAIL","Molim unesite ispravnu e-mail adresu");
define("_EMAIL_NO_SPACES","E-mail adrresa ne mo&#382;e sadr&#382;avati prazninu");
define("_PASSWORD_LENGTH","Zaporka mora biti izme&#273;u 6 i 10 znamenki");
define("_PASSWORDS_MISMATCH","Zaporke se ne podudaraju - molimo ponovite unos.");
define("_EDIT_USER_DENIED","Nemate dozvolu da uredite korisnika");
define("_EDIT_USER","Uredi korisnika");
define("_USER_UPDATED","Korisnik dodan");
define("_EMAIL","E-mail");
define("_PASSWORD","Zaporka");
define("_PASSWORD_LENGTH_INFO","6 i 10 znamenki");
define("_LEAVE_BLANK_KEEP_EXISTING","ostavite prazno kako bi ste sa&#269;uvali postoje&#263;e");
define("_CONFIRM_PASSWORD","Potvrdi zaporku");
define("_IF_CHANGING_PASSWORD","ako mjenjate zaporku");
define("_EMOTICONS","Ikone emocija");
define("_BAN_THIS_USER","Izbacite korisnika?");
define("_USER_LEVEL","Korisni&#269;ki level");
define("_USER","Korisnik");
define("_PADMIN","Administrator");
define("_OWNER","Vlasnik");

define("_ADD_EMOTICONS","Dodaj ikonu emocija");
define("_ADD_EMOTICON_INSTRUCTIONS","<b><u>Upute</u></b><p>
	1. Skinite PHPBB komplet ikona emocija koje sadr&#382;avaju .pak fajlove.<br> 
	Mo&#382;ete ih skinuti sa http://www.php121.com.<p>
	2. Dodajte nove ikone emocija te njihove pakete u novi direktorij <i>php121smiles</i> direktorija<br>
	npr. phpsmilies/cutesmilies/ <br> <b>Ime direktorija</b> neka bude ime Vašeg novog paketa ikona emocija<p> 
	3.  Nakon dodavanja novih ikona emocija kliknite na Potvrdi<br> ");
define("_FILE","fajl");
define("_ADD_EMOTICON_SAMPLE","(npr. cutesmilies/smiles.pak)");
define("_ADD_PAK","Dodaj paket");
define("_CANT_READ_PAK","Nemoguce je procitati paket. Provjerite dali paket postoji! ");
define("_SMILIES_UPDATE_ERROR","nemoguce je dodati nove ikone emocija! ");
define("_SMILIES_ADDED","Ikone emocija su dodane");

define("_DELETE_EMOTICONS","Izbriši ikone emocija ");
define("_SELECT_PAK","Oznaci paket");
define("_DELETE_PAK","Izbriši paket");
define("_PAK_DELETED","Paket je izbrisan!");

define("_CONFIGURATION","Konfiguracija");
define("_USER_ADMIN","Administracija korisnika");
define("_EDIT_SYSTEM_CONFIG","Uredi PHP121 sistemsku konfiguraciju");

define("_CANCEL_IM_REQUEST","Otka&#382;i IM zahtjev");
define("_IM_REQUEST_CANCELLED","Zahtjev otkazan.");
define("_CLOSE","Zatvori prozor");

define("_CHAT_HISTORY","Pro&scaron;lost brbljaonice");

define("_INSTANT_MESSAGE","Trenutna poruka");
define("_INSTANT_MESSENGER","Instant Messenger");

define("_DATABASE_PROBLEM","Dogodio se problem sa bazom podataka, molim poku&scaron;ajte kasnije ponovno");

define("_DELETE_ACCOUNT","Izbri&scaron;i korisni&#269;ki ra&#269;un");
define("_ACCOUNT_DELETED","Korisni&#269;ki ra&#269;un izbrisan!");
define("_ACCOUNT_OPTIONS","Izbornik korisni&#269;kog ra&#269;una");
define("_DELETE_YOUR_ACCOUNT","Da li &#382;elite Izbri&scaron;i svoj korisni&#269;ki ra&#269;un?");
define("_REENTER_U_AND_P","Iz sigurnosnih razloga, ponovite svoje korisni&#269;ko ime i zaporku:");
define("_USERNAME","korisni&#269;ko ime");

define("_EDIT_ACCOUNT","Uredi korisni&#269;ki ra&#269;un");
define("_ACCOUNT_UPDATED","korisni&#269;ki ra&#269;un je izmjenjen");
define("_WELCOME","Dobro do&scaron;li");
define("_CAN_EDIT_YOUR_DETAILS_BELOW","ispod možete urediti svoje podatke. ");
define("_PASSWORD_CHANGE_LOGIN_AGAIN","Promjenite li zaporku, morat &#263;ete se ponovno prijaviti.");
define("_AUTO_ACCEPT_CHAT_REQUESTS","Automatski prihvati zahtjev brbljaonice ");
define("_BEEP_ON_NEW_MESSAGE","Obavjesti o dolasku poruke kratkim zvukom");
define("_BRING_WINDOW_TO_FRONT","Dolaskom nove poruke postavi prozor kao primarni");
define("_TIMEZONE","Vremenska Zona");
define("_SHOW_TIMESTAMPS","Prika&#382;i vremenski prozor&#269;i&#263; na brbljaonici");

define("_EMOTICON_PACK","Ikone emocija");

define("_INCOMING_REQUEST","dolazni zahtjev");
define("_REQUEST_FROM","Dobili ste privatni zahtjev od: ");
define("_ACCEPT_REQUEST","Da li &#382;elite prihvatiti zahtjev?");
define("_AUTO_OPEN_IM_ATTEMPT","Pokušavam automatski otvoriti novi prozor brbljaonice...<p>Ako se prozor ne pojavi, onda imate <b>POPUP BLOCKER</b>.<p> Molim dozvolite nadolazece prozore, kako bi se prozor automatski pojavio.<p> Drugacije, ugasi opciju u panelu Korisnickog izbornika. ");
define("_UPDATED","dodati");
define("_ONLINE_AS","Spojen kao");
define("_OPTIONS","Izbornik");
define("_LOGOUT","Odjava");
define("_CURRENT_CHATS","Trenuta&#269;ne brbljaonice");
define("_LEFT_CHAT","je napustio brbljaonicu");
define("_YOU","Ti");
define("_REJOIN_CHAT","Ponovno se pridru&#382;io brbljaonici");
define("_RECENT_CHATS","Nedavne brbljaonice");
define("_UNBLOCK","Dopusti");
define("_BLOCK","Sprije&#269;i");
define("_WHOS_ONLINE","Trenutni korisnici ");

define("_USER_NOT_AVAILABLE","Korisnik nije dostupan.");
define("_SORRY_USER_NOT_AVAILABLE","Ispri&#269;avamo se, korisnik nije dostupan.");

define("_PLEASE","Molim");
define("_LOGIN","Prijava");
define("_REGISTER","Registriraj se");

define("_JOINED_CHAT","pridru&#382;io se brbljaonici ");

define("_USER_DIDNT_RESPOND","Korisnik nije odgovorio");
define("_SORRY_USER_DIDNT_RESPOND","Ispri&#269;avamo se, korisnik ne odgovara. Molim poku&scaron;ajte kasnije.");

define("_USERNAME_NOT_FOUND","Korisni&#269;ko ime ne postoji");
define("_INCORRECT_PASSWORD","Zaporka je neispravna");

define("_PLEASE_LOGIN_OR_REGISTER","Molimo Vas da se prijavite ili registrirate");
define("_PLEASE_LOGIN","Molim, prijavite se");
define("_REGISTERED_USERS","registrirani korisnici");
define("_CREATE_NEW_ACCOUNT","Napravi novi korisni&#269;ki ra&#269;un");
define("_LOST_LOGIN","Izgubili ste podatke prijave?");

define("_NEW_ACCOUNT","Novi korisni&#269;ki ra&#269;un");
define("_USERNAME_NO_SPACES","Korisni&#269;ko ime ne smije sadr&#382;avati razmak");
define("_USERNAME_IN_USE","Molim, izaberite druga&#269;ije korisni&#269;ko ime");
define("_EMAIL_REGGED","E-mail adresa je u upotrebi.");
define("_PASSWORD_TOO_SHORT","Zaporka je prekratka");
define("_NEW_USER","Novi korisnik");

define("_YOU_ARE_OWNER","Postali ste vlasnik administracijskih privilegija!");
define("_THANKS_REGISTERING","Hvala Vam na registraciji");
define("_BETWEEN","izme&#273;u");
define("_AND","i");
define("_CHARACTERS","znakovi");

define("_COULD_NOT_READ_CONFIG","Nemogu&#263;e je dobiti konfiguracijske podatke - ina&#269;e, ovakav problem je problem baze podataka. Ako koristite PHP121 prvi puta, provjerite dali ste pokrenuli sql fajl. Molimo Vas da pro&#269;itate README (ako instalaciju izvr&scaron;avate prvi put) ili UPDATE fajl ( ako nadopunjavate bazu ) u docs direktoriju.");

define("_YOU_ARE_BANNED","<strong>Izba&#269;eni ste  </strong>sa aplikacije. Molimo Vas da kontaktirate administratore ako smatrate da smo pogrije&scaron;ili.");

define("_TITLE_LOST_LOGIN","Lost Login");

define("_ENTER_EITHER_U_OR_E","Molim, unesite korisni&#269;ko ime ili e-mail adresu");

define("_EMAIL_NOT_FOUND","E-mail adresa nije prona&#273;ena");

define("_TO_RECOVER_PASSWORD","Da bi ste resetirali Va&scaron;u zaporku, molimo Vas da odete na internet stranicu izlistanu ispod te slijedite zadane upute. Ako se adresa dijeli na 2 linije, molimo Vas da ih sastavite te ih takve po&scaron;aljete kao lokaciju internet stranice!");
define("_RESET_LOGIN_DETAILS","Resetiraj detalje prijave");
define("_INSTRUCTIONS_MAILED","Upute kako resetirati zaporku su vam poslane. Molim, provjerite Va&scaron; e-mail za nekoliko minuta!");
define("_OR","OR");
define("_RESET_PASSWORD","Reset Password");
define("_INCOMPLETE_URL","Neto&#269;na web lokacija: Molimo vas da zaljepite lokaciju dobivenu u Va&scaron;em e-mailu na preglednik. pazite da lokacija nema praznine! ");
define("_RESET_PASS_ENTER_PASS_BELOW","Upi&scaron;ite va&scaron;u novu zaporku ispod, potvrdite je te potom pritisnite Promjeni Zaporku");
define("_NEW_PASSWORD","Nova zaporka");
define("_CHANGE_PASSWORD","Promjeni zaporku");
define("_INCORRECT_CODE","Neto&#269;an kod. Molimo vas da provjerite dali ste zaljepili cijelu lokaciju u preglednik.");

define("_PASSWORD_CHANGED","Zaporka je promjenjena.");
define("_YOU_CAN_NOW","Sada mo&#382;ete");

define("_CANT_IM_SELF","Ne mo&#382;ete poslati IM sebi");
define("_USER_IS_BLOCKED","Korisnik je sprije&#269;en. Ne&#263;ete ga mo&#263;i kontaktirati sve dokle mu Vi to ne dopustite.");
define("_YOU_ARE_BLOCKED","Korisnik vas je sprije&#269;io. Korisnika nemo&#382;ete kontaktirati sve dokle Vam on  nedopusti!");
define("_SEND_IM","Po&scaron;alji IM");
define("_REQUEST_SENT_TO","Zatra&#382;i poslano na");
define("_WAITING","&#268;ekam odgovor... ");

define("_VIEW_CHAT_HISTORY","Pogledaj pro&scaron;lost brbljaonice (nemojte osvje&#382;avati )");

define("_USERS_IN_ROOM","Trenutaèni korisnici u sobi: ");
define("_NO_MESSAGE","Molimo vas da upišete poruku!");
define("_INVITE_THIS_CHAT", "Pozovi u brbljaonicu...");
define("_NO_AJAX", "Isprièavamo se, ali Vaš preglednik ne podržava AJAX, koji je potreban da bi aplikacija radila bez greške.  Preporuèavamo vam da obnovite vašu verziju, ili da koristite <a target='blank' href=' http://www.mozilla.com/firefox'>Firefox</a>.");
define("_JOINING", "...Pridružuje se...");
define("_INVITE_SELECT", "Oznaèi korisnika te ga pozovi u brbljaonicu: ");
define("_INVITE_ALL_HERE", "Isprièavamo se, svi spojeni korisnici trenutaèno su u ovoj sobi!");

?>
