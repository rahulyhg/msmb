<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)                                                  **
 **  File:              lang-french.php                                                 **
 **  Date modified:     12/07/06 (v2.2)                                                 **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     French translation                                              **
 **  Translated by:	Rachid M. and Sophie S.                                         **
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

define("_CLEAR_CHAT","Effacer l'historique.");
define("_CHARS_LEFT","Caract�res restants.");

define("_AUTO_EMAIL_TRANSCRIPT","Envoyer le log du tchat � la fin de chaque conversation termin�.");
define("_FORCE_AUTO_EMAIL_TRANSCRIPT"," Mettre � jour les param�tres d'envoi des logs automatique par courriel de l'utilisateur et l'envoyez sans se soucier");
define("_YOUR_CHATS","Votre tchat");
define("_EMAIL_TRANSCRIPT","Envoyer ce log");
define("_EMAIL_TRANSCRIPT_CONFIRM","Cliquer OK pour envoyer le contenu du tchat � votre boite courriel suivante.  <a href=\"php121edituser.php\" target=\"_blank\">Changer</a>");
define("_ADMIN_FORCING_EMAIL_TRANSCRIPTS","Veuillez noter que le site web est configur� afin d'envoyer les logs automatiquement.");
define("_AUTO_EMAIL_TRANSCRIPTS","Vous avez d�j� demand� l'envoi automatique du log.");
define("_DUPE_EMAIL_WARNING","Vous allez recevoir plus d'une copie du log.");
define("_TRANSCRIPT_EMAILED","Le log actuel vient d'�tre envoy� par courriel.");
define("_USER_CAN_CREATE_ACCOUNT","Autoris� la cr�ation d'un nouveau compte?");
define("_USER_CAN_DELETE_ACCOUNT","Autoris� un utilisateur a efface son compte?");
define("_ADD_USER","Ajouter utilisateur");
define("_USER_ADDED","Utilisateur ajout�.");
define("_IMPORTANT_NOTE","(Note Importante)");
define("_AUTO_EMAIL_NOTE"," Veuillez noter, afin que le log de vos messages soit envoy� par courriel automatiquement, vous devez avoir <u>une personne de contact ouverte au moins depuis <b>2 minutes</b> apr�s que le tchat soit consid�r� comme inactif</u>. <p>Un tchat inactif est un tchat ou il n'y a plus de discussion. Si aucun contact est ouvert � ce moment, <b>l'email ne sera pas envoy�</b>..<p> Cette fonctionnalit� est utilis�e lors du support technique. Cette fonctionnalit� sera am�lior�e lors d'une version future.");
define("_HPBUTTON_CHAT_NOW"," Utilisateurs en train de tacher actuellement: ");
define("_HPBUTTON_OPEN_MESSENGER"," Ouvrir le messenger ");
define("_FIX_SMILIES","Fixer l'�motic�ne");

define("_MESSAGE","Message");
define("_SEND","Envoyer");
define("_LANGUAGE","Language");
define("_DEFAULT_LANGUAGE","Language par defaut");
define("_WARN_UPDATE","Des nouvelles fonctions ont �t� ajout�es au messenger et vous devez changer vos pr�f�rences.\n Vous devez cliquer sur OPTIONS dans la liste des contacts et EDITER LE COMPTE.\n Ce message n'appara�tra pas lors de votre prochaine mise � jour.");
define("_TABLE_BLANK_ROW","<tr><td>&nbsp;</td></tr>");
define("_YES","Oui");
define("_NO","Non");
define("_PON","Allumer");
define("_OFF","Etteind");
define("_TITLE_EDIT_CONFIGURATION","Editer Configuration");
define("_CONFIGURATION_UPDATED","Configuration mise � jour");
define("_GO_BACK","Retour �");
define("_ADMIN_OPTIONS","Options Admin");
define("_BELOW","En dessous");
define("_EDIT_CONFIGURATION","Editer la Configuration");
define("_SYSTEM_CLOCK_TIMEZONE","Fuseau horaire");
define("_HOURS","heures");
define("_SAVE_CHANGES","Sauvegarder les changements");
define("_CANCEL","Annuler");
define("_ACCESS_DENIED","Vous n'�tes pas autoris� � acc�der � cette page");

define("_DELETE_USER_DENIED","Vous n'�tes pas autoris� � effacer cet utilisateur");
define("_USER_NOT_EXIST","Utilisateur inconnu");
define("_ERROR","<font color=\"FF0000\">Erreur: </font>");
define("_USER_DELETED","Utilisateur effac�.");
define("_DELETE_CANCELLED","Action annul�e");
define("_ARE_YOU_SURE","Etes-vous s�r de vouloir");
define("_DELETE_THIS_USER","Effacer cette utilisateur");
define("_SELECT_USER","S�lectionner utilisateur");
define("_DELETE_USER","Effacer Utilisateur");

define("_INVALID_USERNAME","Veuillez entrer un nom d'utilisateur valide");
define("_INVALID_EMAIL","Veuillez entrer une adresse courriel valide");
define("_EMAIL_NO_SPACES","L'adresse courriel ne peut pas contenir des espaces");
define("_PASSWORD_LENGTH","Le mot de passe doit contenir entre 6 et 10 caract�res");
define("_PASSWORDS_MISMATCH","Les mots de passe ne sont pas les m�mes, veuillez recommencer");
define("_EDIT_USER_DENIED","Vous n'�tes pas autoris� � �diter cet utilisateur.");
define("_EDIT_USER","Editer un utilisateur");
define("_USER_UPDATED","Utilisateur mis � jour.");
define("_EMAIL","Courriel");
define("_PASSWORD","Mot de passe");
define("_PASSWORD_LENGTH_INFO","6 � 10 caract�res");
define("_LEAVE_BLANK_KEEP_EXISTING","Veuillez ne pas remplir afin de ne pas modifier");
define("_CONFIRM_PASSWORD","Confirmer le mot de passe");
define("_IF_CHANGING_PASSWORD","Si vous changez le mot de passe");
define("_EMOTICONS","Emoticons");
define("_BAN_THIS_USER","Bannir cette utilisateur?");
define("_USER_LEVEL","Niveau de l'utilisateur");
define("_USER","Utilisateur");
define("_PADMIN","Admin");
define("_OWNER","Propri�taire");

define("_ADD_EMOTICONS","Ajouter des Emoticons");
define("_ADD_EMOTICON_INSTRUCTIONS","<b><u>Instructions</u></b><p>
	1. T�l�charger un fichier �moticon PHPBB en incluant le fichier .pak.<br> 
	Vous pouvez en trouver sur le site http://www.php121.com.<p>
	2. Mettre les nouveaux �moticons et leur pak dans le r�pertoire <i>php121smilies</i><br>
	E.g. phpsmilies/cutesmilies/ <br>Le <b>nom du r�pertoire</b> sera le m�me que celui de votre pak.<p>
	3.  Ensuite, Veuillez appuyer sur le bouton ci-dessous:<br>");
define("_FILE","fichier");
define("_ADD_EMOTICON_SAMPLE","(e.g. cutesmilies/smiles.pak)");
define("_ADD_PAK","Ajouter un PAK");
define("_CANT_READ_PAK","Impossible de lire le fichier pak.  Est-il existant?");
define("_SMILIES_UPDATE_ERROR","Impossible de mettre � jour les �moticons!");
define("_SMILIES_ADDED","Emoticons ajouter!");

define("_DELETE_EMOTICONS","Effacer les Emoticons");
define("_SELECT_PAK","S�lectionner un PAK");
define("_DELETE_PAK","Effacer un PAK");
define("_PAK_DELETED","PAK effac�!");

define("_CONFIGURATION","Configuration");
define("_USER_ADMIN","Admininistrateur");
define("_EDIT_SYSTEM_CONFIG","Editer la Configuration syst�me de PHP121");

define("_CANCEL_IM_REQUEST","Annuler la requ�te IM");
define("_IM_REQUEST_CANCELLED","Requ�te annul�e.");
define("_CLOSE","Fermer la fen�tre");

define("_CHAT_HISTORY","Historique du tchat");

define("_INSTANT_MESSAGE","Instant Message");
define("_INSTANT_MESSENGER","Instant Messenger");

define("_DATABASE_PROBLEM","Il y a un probl�me de connexion � la base de donn�es, veuillez r�essayer ult�rieurement");

define("_DELETE_ACCOUNT","Effacer un compte");
define("_ACCOUNT_DELETED","Compte effac�.");
define("_ACCOUNT_OPTIONS","Options du compte");
define("_DELETE_YOUR_ACCOUNT","Effacer votre compte?");
define("_REENTER_U_AND_P","Par mesure de securit�, veuillez entrer de nouveau votre nom d'utilisateur et votre mot de passe:");
define("_USERNAME","Utilisateur");

define("_EDIT_ACCOUNT","Editer un compte");
define("_ACCOUNT_UPDATED","Compte �dit�");
define("_WELCOME","Bienvenue");
define("_CAN_EDIT_YOUR_DETAILS_BELOW","Vous pouvez �diter vos d�tails ci-dessous.");
define("_PASSWORD_CHANGE_LOGIN_AGAIN","Si vous changez votre mot de passe, vous devez vous reconnecter.");
define("_AUTO_ACCEPT_CHAT_REQUESTS","Accepter automatiquement les requ�tes de tchat?");
define("_BEEP_ON_NEW_MESSAGE","Bruit sonore lors d'un nouveau message");
define("_BRING_WINDOW_TO_FRONT","Lors d'un nouveau message mettre la fen�tre en avant");
define("_TIMEZONE","Fuseau horaire");
define("_SHOW_TIMESTAMPS","Voir les heures dans le tchat?");

define("_EMOTICON_PACK","Emoticon Pack");

define("_INCOMING_REQUEST","REQUETE ENTRANTE");
define("_REQUEST_FROM","Vous avez une requ�te de");
define("_ACCEPT_REQUEST","Voulez-vous accepter?");
define("_AUTO_OPEN_IM_ATTEMPT","Ouverture d'une nouvelle fen�tre tchat... <p>Si elle n'appara�t pas, vous devez avoir un<b>BLOQUEUR DE FENETRE POPUP</b>.  <p>Veuillez <b>autoriser les popups</b> afin de pouvoir tchater.<p>Sinon, veuillez changer cette option dans le menu <b>Options</b> .");
define("_UPDATED","Mise � jour");
define("_ONLINE_AS","En ligne comme");
define("_OPTIONS","Options");
define("_LOGOUT","D�connecter");
define("_CURRENT_CHATS","Tchat actuel");
define("_LEFT_CHAT","Parti(e) du tchat.");
define("_YOU","Vous");
define("_REJOIN_CHAT","rejoindre le tchat.");
define("_RECENT_CHATS","Tchat r�cent");
define("_UNBLOCK","D�bloquer");
define("_BLOCK","Bloquer");
define("_WHOS_ONLINE","Qui est en ligne:");

define("_USER_NOT_AVAILABLE","Utilisateur n'est pas en ligne");
define("_SORRY_USER_NOT_AVAILABLE","D�sol�, l'utilisateur n'est pas en ligne.");

define("_PLEASE","S'il-vous-pla�t");
define("_LOGIN","Se connecter");
define("_REGISTER","S'enregistrer");

define("_JOINED_CHAT","a rejoint le tchat.");

define("_USER_DIDNT_RESPOND","L'utilisateur n'a pas r�pondu");
define("_SORRY_USER_DIDNT_RESPOND","D�sol�, mais l'utilisateur n'a pas r�pondu. Veuillez essayer plus tard.");

define("_USERNAME_NOT_FOUND","UTILISATEUR n'a pas �t� trouv�.");
define("_INCORRECT_PASSWORD","MOT DE PASSE incorrect.");

define("_PLEASE_LOGIN_OR_REGISTER","Veuillez vous connecter ou vous enregistrer");
define("_PLEASE_LOGIN","Veuillez vous connecter");
define("_REGISTERED_USERS","Utilisateurs enregistr�s");
define("_CREATE_NEW_ACCOUNT","Cr�er un nouveau compte");
define("_LOST_LOGIN","Perdu mon identifiant?");

define("_NEW_ACCOUNT","Nouveau compte");
define("_USERNAME_NO_SPACES","UTILISATEUR ne peut pas contenir des espaces");
define("_USERNAME_IN_USE","Veuillez choisir un nom d'utilisateur diff�rent");
define("_EMAIL_REGGED","Cette adresse courriel est d�j� enregistr�e");
define("_PASSWORD_TOO_SHORT","MOT DE PASSE trop court");
define("_NEW_USER","Nouvel utilisateur");

define("_YOU_ARE_OWNER","Vous avez les droits admnistrateur!");
define("_THANKS_REGISTERING","Merci de votre inscription!");
define("_BETWEEN","entre");
define("_AND","et");
define("_CHARACTERS","caract�res");

define("_COULD_NOT_READ_CONFIG","Impossible d'obtenir la configuration - due � un probl�me de base de donn�es.  Si vous avez install� PHP121 pour la premi�re fois, avez-vous execut� le fichier SQL?  Veuille lire la documentation README (for first time installs) OU UPDATE file (for upgrades).");

define("_YOU_ARE_BANNED","Vous avez �t� <b>banni(e)</b>.  Si cela est une erreur veullez contacter l'administrateur.");

define("_TITLE_LOST_LOGIN","Identifiant perdu");

define("_ENTER_EITHER_U_OR_E","Veuillez entrer soit votre nom d'utilisateur ou mot de passe");

define("_EMAIL_NOT_FOUND","Adresse courriel inconnue.");

define("_TO_RECOVER_PASSWORD","Pour modifier le mot de passe PHP121, Veuillez aller sur la page web ci-dessous et suivre les instructions.  Le lien web ne doit pas etre coup� en deux parties.");
define("_RESET_LOGIN_DETAILS","Modification de l'identifiant");
define("_INSTRUCTIONS_MAILED","Les instructions pour modifier votre mot de passe ont �t� envoy�es.  Veuillez v�rifier votre adresse courriel dans quelques minutes.");
define("_OR","OU");
define("_RESET_PASSWORD","Modifier le mot de passe");
define("_INCOMPLETE_URL","Lien erron�.  Veuillez �tre s�r d'avoir fait un copie du lien dans votre navigateur");
define("_RESET_PASS_ENTER_PASS_BELOW","Veuillez entrer le nouveau mot de passe en dessous, confirmez-le, et appuyer sur CHANGER LE MOTE DE PASSE");
define("_NEW_PASSWORD","Nouveau mot de passe");
define("_CHANGE_PASSWORD","Changer le mot de passe");
define("_INCORRECT_CODE","Code erron�. Veuillez �tre s�r d'avoir fait une copie du lien dans votre navigateur.");

define("_PASSWORD_CHANGED","Mot de passe chang�.");
define("_YOU_CAN_NOW","Maintenant vous pouvez");

define("_CANT_IM_SELF","Vous ne pouvez pas envoyer de message IM � vous m�me!");
define("_USER_IS_BLOCKED","Vous avez bloqu� cet utilisateur.  Vous ne pouvez pas le joindre sauf si vous le DEBLOQUEZ!");
define("_YOU_ARE_BLOCKED","Cet utilisateur est bloqu�. Vous ne pouvez pas le joindre sauf si vous le DEBLOQUEZ!");
define("_SEND_IM","Envoyer IM");
define("_REQUEST_SENT_TO","Requ�te envoyer �");
define("_WAITING","En attente d'une r�ponse...");

define("_VIEW_CHAT_HISTORY","Voir l'historique du tchat");
define("_USERS_IN_ROOM"," Utilisateur dans cette salle: ");
define("_NO_MESSAGE"," Vous n�avez pas entr� de message");
define("_INVITE_THIS_CHAT", " Inviter � ce tchat...");
define("_NO_AJAX", " D�sol�, votre navigateur ne supporte pas l�AJAX, cette technologie est requise pour cette application. Veuillez mettre � jour votre navigateur ou utiliser un navigateur tel que<a href='http://www.mozilla.com/firefox' >Firefox</a>.");
define("_JOINING", "�en cours�");
define("_INVITE_SELECT", " S�lectionner un utilisateur pour ce tchat: ");
define("_INVITE_ALL_HERE", " D�sol�, tous les utilisateurs sont d�j� en lignes");

?>
