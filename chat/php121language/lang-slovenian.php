<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)                                                  **
 **  File:              lang-slovenian.php                                              **
 **  Date modified:     12/07/06 (v2.2)                                                 **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Slovenian translation                                           **
 **  Translated by:	Igor Isak                                                       **
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

define("_CLEAR_CHAT","Odstrani zgodovino klepeta"); 
define("_CHARS_LEFT","ostalo znakov");

define("_AUTO_EMAIL_TRANSCRIPT","Avtomatsko posreduj kopija klepeta ko zaklju?ku"); 
define("_FORCE_AUTO_EMAIL_TRANSCRIPT","Popravi uporabnikove nastavitve za prejemanje kopij klepeta na email"); 
define("_YOUR_CHATS","Tvoji klepeti"); 
define("_EMAIL_TRANSCRIPT","Po?lji mi email zapis tega klepeta"); 
define("_EMAIL_TRANSCRIPT_CONFIRM","Kliknite OK za prejem vesbina klepeta na va? registrirani email naslov. <a href=\"php121edituser.php\" target=\"_blank\">Spremeni</a>");
define("_ADMIN_FORCING_EMAIL_TRANSCRIPTS","Opomba, ta stran je konfigurirana za avtomatsko prejemanje kopij klepeta na email."); 
define("_AUTO_EMAIL_TRANSCRIPTS","Imate ?e aktivno kopiranje klepeta na email."); 
define("_DUPE_EMAIL_WARNING","Z nadaljevanjem boste prejeli ve? kot 1 kopijo na va? email."); 
define("_TRANSCRIPT_EMAILED","Kopija trenutnega klepeta je bila poslana na email."); 
define("_USER_CAN_CREATE_ACCOUNT","Dovoli kreiranje novega uporabnika?"); 
define("_USER_CAN_DELETE_ACCOUNT","Dovoli uporabniku, da odstrani svoj ra?un?"); 
define("_ADD_USER","Dodaj uporabnika"); 
define("_USER_ADDED","Uporabnik dodan."); 
define("_IMPORTANT_NOTE","(Pomembno obvestilo)"); 
define("_AUTO_EMAIL_NOTE","Opomba, da bodo kopije klepeta avtomatsko poslane na email, ob zahtevi, <u>da je klepet odprt <b>2 minuti</b> oziroma da je klepet da je 'neaktiven'</u>.  <p>Nekativen klepet je stanje, ko nih?e neklepeta.  ?e ni odprtih pogovorov,email <b>ne bo</b> poslan.  <p>Ta opcija bo pomagala tehni?nemu osebju pri nadgradnjah alikacije PHP121."); 
define("_HPBUTTON_CHAT_NOW","Trenutno klepetajo: "); 
define("_HPBUTTON_OPEN_MESSENGER","Odpri klepet"); 
define("_FIX_SMILIES","Uredi sme?ke");
define("_HERE_IS_YOUR_CHAT_TRANSCRIPT","Tukaj je tvoja kopija klepeta."); 

define("_MESSAGE","Message");
define("_SEND","Send");
define("_LANGUAGE","Jezik");
define("_DEFAULT_LANGUAGE","Privzeti jezik");
define("_WARN_UPDATE","Nova možnost je bila dodana v Messenger, katera zahteva posdobitev.\nKlikni na OPCIJE v seznamuin nato UREDI PODATKE.\nTo sporoèilo se ne bo veè pojavilo do naslednje nadgradnje.");
define("_TABLE_BLANK_ROW","<tr><td>&nbsp;</td></tr>");
define("_YES","DA");
define("_NO","NE");
define("_PON","Vkljuèeno");
define("_OFF","Izkljuèeno");
define("_TITLE_EDIT_CONFIGURATION","Uredi nastavitve");
define("_CONFIGURATION_UPDATED","Nastavitve posodobljene");
define("_GO_BACK","Pojdi nazaj na");
define("_ADMIN_OPTIONS","Admin opcije");
define("_BELOW","spodaj");
define("_EDIT_CONFIGURATION","Uredi nastavitve");
define("_SYSTEM_CLOCK_TIMEZONE","Èasovni pas sistema");
define("_HOURS","Ur");
define("_SAVE_CHANGES","Shrani spremembe");
define("_CANCEL","Preklièi");
define("_ACCESS_DENIED","Nimaš dostopa do te strani");

define("_DELETE_USER_DENIED","Ne moreš odstraniti tega uporabnika");
define("_USER_NOT_EXIST","Uporabnik ne obstaja");
define("_ERROR","<font color=\"FF0000\">NAPAKA: </font>");
define("_USER_DELETED","Uporabnik izbrisan.");
define("_DELETE_CANCELLED","Preklicano brisanje");
define("_ARE_YOU_SURE","Res želiš");
define("_DELETE_THIS_USER","izbrisati tega uporabnika");
define("_SELECT_USER","Izberi uporabnika");
define("_DELETE_USER","Odstrani uporabnika");

define("_INVALID_USERNAME","Prosim vnesi pravilen VZDEVEK");
define("_INVALID_EMAIL","Prosim vnesi pravilen EMAIL NASLOV");
define("_EMAIL_NO_SPACES","EMAIL naslov ne sme vsebovati presledkov");
define("_PASSWORD_LENGTH","GESLO mora biti med 6 in 10 znakov");
define("_PASSWORDS_MISMATCH","GESLI nista enaki - popravi");
define("_EDIT_USER_DENIED","Ne moreš urejati tega uporabnika.");
define("_EDIT_USER","Uredi uporabnika");
define("_USER_UPDATED","Uporabnik posodobljen.");
define("_EMAIL","Email");
define("_PASSWORD","Geslo");
define("_PASSWORD_LENGTH_INFO","6 do 10 znakov");
define("_LEAVE_BLANK_KEEP_EXISTING","pusti prazno za nespremenjeno");
define("_CONFIRM_PASSWORD","Potrdi geslo");
define("_IF_CHANGING_PASSWORD","èe spreminjaš geslo");
define("_EMOTICONS","Emocije");
define("_BAN_THIS_USER","Prepovej tega uporabnika?");
define("_USER_LEVEL","Nivo uporabnika");
define("_USER","Uporabnik");
define("_PADMIN","Administrator");
define("_OWNER","Lastnik");

define("_ADD_EMOTICONS","Dodaj emocijo");
define("_ADD_EMOTICON_INSTRUCTIONS","<b><u>Navodila</u></b><p>
	1. Prenesi PHPBB emocije, ki vsebujejo .pak datoteko.<br> 
	Lahko jih preneseš tudi iz http://www.php121.com.<p>
	2. Dodaj emocije v novo mapo pod <i>php121smilies</i> mapo<br>
	E.g. phpsmilies/mojixxx/ <br>Ime <b>mape</b> bo ime novega pak.<p>
	3.  Nato, potrdi spodnje podatke:<br>");
define("_FILE","datoteka");
define("_ADD_EMOTICON_SAMPLE","(e.g. cutesmilies/smiles.pak)");
define("_ADD_PAK","Dodaj PAK");
define("_CANT_READ_PAK","Ne morem prebrati read pak datoteke.  Sploh obstaja?");
define("_SMILIES_UPDATE_ERROR","Ne morem posodobiti smeškov!");
define("_SMILIES_ADDED","Smeški dodani!");

define("_DELETE_EMOTICONS","Odstrani emocije");
define("_SELECT_PAK","Izberi PAK");
define("_DELETE_PAK","Odstrani PAK");
define("_PAK_DELETED","PAK odstranjen!");

define("_CONFIGURATION","Nastavitve");
define("_USER_ADMIN","Urejanje uporabnikov");
define("_EDIT_SYSTEM_CONFIG","Uredi PHP121 Sistmske podatke");

define("_CANCEL_IM_REQUEST","Preklièi IM zahtevo");
define("_IM_REQUEST_CANCELLED","Zahteva preklicana.");
define("_CLOSE","Zapri okno");

define("_CHAT_HISTORY","Zgodovina klepeta");

define("_INSTANT_MESSAGE","Instant Message");
define("_INSTANT_MESSENGER","Instant Messenger");

define("_DATABASE_PROBLEM","Problem z bazo podatkov, poizkusi kasneje");

define("_DELETE_ACCOUNT","Odstrani raèun");
define("_ACCOUNT_DELETED","Raèun odstranjen.");
define("_ACCOUNT_OPTIONS","Možnosti raèuna");
define("_DELETE_YOUR_ACCOUNT","odstrani tvoj raèun?");
define("_REENTER_U_AND_P","Zaradi varnosti, prosim ponovi vzdevek in geslo:");
define("_USERNAME","Vzdevek");

define("_EDIT_ACCOUNT","Uredi raèun");
define("_ACCOUNT_UPDATED","Raèun nadgrajen");
define("_WELCOME","Pozdrav");
define("_CAN_EDIT_YOUR_DETAILS_BELOW","lahko urejaš spodnje podatke.");
define("_PASSWORD_CHANGE_LOGIN_AGAIN","Èe spremeniš geslo, se moraš ponovno prijaviti.");
define("_AUTO_ACCEPT_CHAT_REQUESTS","Avtomatska potrditev zahteve za klepet.");
define("_BEEP_ON_NEW_MESSAGE","Zvok ob novem sporoèilu");
define("_BRING_WINDOW_TO_FRONT","Odpri okno pred ostala ob novem sporoèilu");
define("_TIMEZONE","Èasovni pas");
define("_SHOW_TIMESTAMPS","Prikaži èas v klepetu?");

define("_EMOTICON_PACK","Emocijski PAK");

define("_INCOMING_REQUEST","DOHODNA ZAHTEVA");
define("_REQUEST_FROM","Imaš zahtevo od");
define("_ACCEPT_REQUEST","Sprejmeš zahtevo?");
define("_AUTO_OPEN_IM_ATTEMPT","Poikušam avtomatsko odpreti novo okno za klepet... <p>Èe se ne prikaže, imaš vkljuèeno <b>POPUP BLOKADO</b>.  <p>Prosim dovoli <b>neregsitrarane popups</b> za avtomatsko potrditev okna za klepet.");
define("_UPDATED","Posodobljeno");
define("_ONLINE_AS","Prijavljen kot");
define("_OPTIONS","Opcije");
define("_LOGOUT","Odjava");
define("_CURRENT_CHATS","Trenutni klepeti");
define("_LEFT_CHAT","je zapustil klepet.");
define("_YOU","Ti");
define("_REJOIN_CHAT","vrnitev v klepet.");
define("_RECENT_CHATS","Predhodni klepeti");
define("_UNBLOCK","Odblokiraj");
define("_BLOCK","Blokiraj");
define("_WHOS_ONLINE","Kdo je z nmai:");

define("_USER_NOT_AVAILABLE","Uporabnik ni dostopen");
define("_SORRY_USER_NOT_AVAILABLE","Oprosti, uporabnik ni dostopen.");

define("_PLEASE","Prosim");
define("_LOGIN","Prijava");
define("_REGISTER","Registracija");

define("_JOINED_CHAT","prikljuèen v klepet.");

define("_USER_DIDNT_RESPOND","Uporabnik ni odgovoril");
define("_SORRY_USER_DIDNT_RESPOND","Oprosti, uporabnik ni odgovoril, poizkusi kasneje.");

define("_USERNAME_NOT_FOUND","VZDEVEK ni najden.");
define("_INCORRECT_PASSWORD","Napaèno GESLO.");

define("_PLEASE_LOGIN_OR_REGISTER","Prosim, prijavi se ali registriraj");
define("_PLEASE_LOGIN","Prosim prijavi se");
define("_REGISTERED_USERS","registriranih uporabnikov");
define("_CREATE_NEW_ACCOUNT","Ustvari nov raèun");
define("_LOST_LOGIN","Izgubljeni podatki?");

define("_NEW_ACCOUNT","Nov raèun");
define("_USERNAME_NO_SPACES","VZDEVEK ne sme vsebovati presledkov");
define("_USERNAME_IN_USE","Prosim izberi drugaèen VZDEVEK");
define("_EMAIL_REGGED","Ta email naslov že obstaja");
define("_PASSWORD_TOO_SHORT","GESLO je prekratko");
define("_NEW_USER","Nov uporabnik");

define("_YOU_ARE_OWNER","Sedaj imaš pravice administratorja!");
define("_THANKS_REGISTERING","Hvala za registracijo!");
define("_BETWEEN","med");
define("_AND","in");
define("_CHARACTERS","znakov");

define("_COULD_NOT_READ_CONFIG","Ne morem prebrati nastavitev - verjetno problem z bazo podatkov - SQL, preveri oz. poglej v README.");

define("_YOU_ARE_BANNED","Izvræen si bil iz sistema.  Prosim kontaktiraj administratorja, èe smatraš, da je to napaka.");

define("_TITLE_LOST_LOGIN","Izgubljena prijava");

define("_ENTER_EITHER_U_OR_E","Prosim vnesi VZDEVEK aliEMAIL naslov");

define("_EMAIL_NOT_FOUND","EMAIL naslov ni najden.");

define("_TO_RECOVER_PASSWORD","Za resetiranje tvojega gesla, prosim sledi spodnjim navodilom.");
define("_RESET_LOGIN_DETAILS","Resetiraj Login Details");
define("_INSTRUCTIONS_MAILED","Instructions on how to reset your password have been emailed to you.  Please check your email in a few minutes.");
define("_OR","ALI");
define("_RESET_PASSWORD","Resetiraj geslo");
define("_INCOMPLETE_URL","Nepopolen URL: Prosim prilepi URL iz tvojega emaila v brsklanik brez ostalega teksta.");
define("_RESET_PASS_ENTER_PASS_BELOW","Vnesi nov geslo, ga ponovi in nao klikni SPREMENI GESLO");
define("_NEW_PASSWORD","Nogo geslo");
define("_CHANGE_PASSWORD","Spremeni geslo");
define("_INCORRECT_CODE","Napaèna koda.  Prosim preveri prilepljen URL v tvoj brskalniku.");

define("_PASSWORD_CHANGED","Geslo spremenjneo.");
define("_YOU_CAN_NOW","Sedaj lahko");

define("_CANT_IM_SELF","You can't send an IM to yourself!");
define("_USER_IS_BLOCKED","Tega uporabnika si blokiral.  Ne moreta kontaktirati, dokler je BLOKIRAN!");
define("_YOU_ARE_BLOCKED","Ta uporabnik te je BLOKIRAL.  Ne moreta kontaktirati, dokler si BLOKIRAN!");
define("_SEND_IM","Pošlji IM");
define("_REQUEST_SENT_TO","Zahteva poslana za");
define("_WAITING","èakam na odgovor...");

define("_VIEW_CHAT_HISTORY","Pregled zgodovine klepeta (ni osvežitve)");

define("_USERS_IN_ROOM","Uporabniki v sobi: ");
define("_NO_MESSAGE","Nisi vnesel sporocila");
define("_INVITE_THIS_CHAT", "Povabi v ta klepet...");
define("_NO_AJAX", "Ops, tvoj brskalnik ne podpira AJAX, kateri je potreben za to aplikacijo.  Nadgradi brskalnik ali uporabie such as <a target='blank' href='http://www.mozilla.com/firefox'>Firefox</a>.");
define("_JOINING", "...Pridruzevanje...");
define("_INVITE_SELECT", "Izberi uporabnika za povabilo v klepet: ");
define("_INVITE_ALL_HERE", "Oprosti, vsi prijavljeni uporabniki so sedaj v tej sobi!");


?>
