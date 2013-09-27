<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)                                                  **
 **  File:              lang-portuguese-brazil.php                                      **
 **  Date modified:     27 December 2005                                                **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Portuguese (Brazil) language file                               **
 **  Translated by:     F�bio P. Santos							**
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

define("_MESSAGE","Mensagem");
define("_SEND","Enviar");
define("_LANGUAGE","Linguagem");
define("_DEFAULT_LANGUAGE","Linguagem padr�o");
define("_WARN_UPDATE","Novas caracteristicas foram adicionadas ao sistema que requerem a atualiza��o das suas prefer�ncias.\nPara atualizar, clique em OP��ES nas lista do contato e Clique em EDITAR o CLIENTE.\nEsta mensagem ir� aparecer enquanto voc� n�o atualizar as suas prefer�ncias.
.");
define("_TABLE_BLANK_ROW","<tr><td>&nbsp;</td></tr>");
define("_YES","Sim");
define("_NO","N�o");
define("_PON","Liga");
define("_OFF","Desliga");
define("_TITLE_EDIT_CONFIGURATION","Editar Configura��o");
define("_CONFIGURATION_UPDATED","Configura��o Atualizada");
define("_GO_BACK","Voltar para");
define("_ADMIN_OPTIONS","Op��es Admin");
define("_BELOW","abaixo");
define("_EDIT_CONFIGURATION","Editar configura��o");
define("_SYSTEM_CLOCK_TIMEZONE","Sistema Fuso-Hor�rio"); 
define("_HOURS","horas");
define("_SAVE_CHANGES","Salvar Mundan�as");
define("_CANCEL","Cancelar");
define("_ACCESS_DENIED","Voc� n�o t�m permiss�o para acessar esta p�gina");

define("_DELETE_USER_DENIED","Voc� n�o t�m permiss�o para excluir este usu�rio");
define("_USER_NOT_EXIST","Usu�rio n�o existe");
define("_ERROR","<font color=\"FF0000\">Erro: </font>");
define("_USER_DELETED","Usu�rio excluido.");
define("_DELETE_CANCELLED","Exclus�o Cancelada");
define("_ARE_YOU_SURE","Voc� t�m certeza");
define("_DELETE_THIS_USER","Exclua este usu�rio");
define("_SELECT_USER","Selecione usu�rio");
define("_DELETE_USER","Excluir Usu�rio");

define("_INVALID_USERNAME","Entre com um USUARIO v�lido");
define("_INVALID_EMAIL","Entre com um endere�o EMAIL v�lido");
define("_EMAIL_NO_SPACES","O EMAIL n�o pode conter espa�o em branco");
define("_PASSWORD_LENGTH","A SENHA deve conter entre 6 e 10 car�teres");
define("_PASSWORDS_MISMATCH","As senhas n�o conferem - digite novamente por favor");
define("_EDIT_USER_DENIED","N�o � permitido voc� editar este usu�rio.");
define("_EDIT_USER","Editar Usu�rio");
define("_USER_UPDATED","Usu�rio atualizado.");
define("_EMAIL","Email");
define("_PASSWORD","Senhas");
define("_PASSWORD_LENGTH_INFO","6 a 10 caracteres");
define("_LEAVE_BLANK_KEEP_EXISTING","existe espa�o em branco"); 
define("_CONFIRM_PASSWORD","Confirme senha");
define("_IF_CHANGING_PASSWORD","a senha est� sendo alterada");
define("_EMOTICONS","Emoticons");
define("_BAN_THIS_USER","Banir este usu�rio?");
define("_USER_LEVEL","N�vel usu�rio");
define("_USER","Usu�rio");
define("_PADMIN","Admin");
define("_OWNER","Propriet�rio");

define("_ADD_EMOTICONS","Adicionar Emoticons");
define("_ADD_EMOTICON_INSTRUCTIONS","<b><u>Instru��es</u></b><p> 
	1. Baixe o PHPBB emoticon incluindo o arquivo .pak.<br> 
	Voc� pode come�ar algum de http://www.php121.com.<p>
	2. Coloque os emoticons novos e se pak em um diret�rio nobo sob seu diret�rio <i>php121smilies</i><br>
	E.g. phpsmilies/cutesmilies/ <br>O<b>nome do diret�rio</b> ser� o nome de seu pak novo.<p>
	3.  Em seguida, submeta o formul�rio abaixo:<br>");
define("_FILE","Arquivo");
define("_ADD_EMOTICON_SAMPLE","(e.g. cutesmilies/smiles.pak)");
define("_ADD_PAK","Adicionar PAK");
define("_CANT_READ_PAK","N�o consigo ler arqujivo pak.  Verifique se ele existe");
define("_SMILIES_UPDATE_ERROR","N�o consigo atualizar smilies!");
define("_SMILIES_ADDED","Smilies adicionados!");

define("_DELETE_EMOTICONS","Apagar Emoticons");
define("_SELECT_PAK","Selecionar PAK");
define("_DELETE_PAK","Apagar PAK");
define("_PAK_DELETED","PAK exclu�do!");

define("_CONFIGURATION","Configura��o");
define("_USER_ADMIN","Administra��o Usu�rio");
define("_EDIT_SYSTEM_CONFIG","Editar Configura��o Sistema do PHP121");

define("_CANCEL_IM_REQUEST","Cancelar Requisi��o"); 
define("_IM_REQUEST_CANCELLED","Requisi��o Cancelada.");
define("_CLOSE","Fechar Janela");

define("_CHAT_HISTORY","Hist�rico conversas");

define("_INSTANT_MESSAGE","Mensagem Instant�nea");
define("_INSTANT_MESSENGER","Mensagem Instant�nea");

define("_DATABASE_PROBLEM","Existe um problema com o banco de dados, por favor tente mais tarde");

define("_DELETE_ACCOUNT","Excluir conta");
define("_ACCOUNT_DELETED","Conta Excluida.");
define("_ACCOUNT_OPTIONS","Op��es conta");
define("_DELETE_YOUR_ACCOUNT","Excluir sua conta?");
define("_REENTER_U_AND_P","Para sua seguran�a, digite novamente seu nome de usu�rio e sua senha:");
define("_USERNAME","Nome Usu�rio");

define("_EDIT_ACCOUNT","Editar Conta");
define("_ACCOUNT_UPDATED","Cliente atualizado");
define("_WELCOME","Bem vindo");
define("_CAN_EDIT_YOUR_DETAILS_BELOW","Edite seu detalhes abaixo.");
define("_PASSWORD_CHANGE_LOGIN_AGAIN","Se voc� mudar sua senha, voc� dever� reiniciar sua sess�o.");
define("_AUTO_ACCEPT_CHAT_REQUESTS","Aceitar pedidos de bate-papo automaticamente?");
define("_BEEP_ON_NEW_MESSAGE","Beep para mensagem nova");
define("_BRING_WINDOW_TO_FRONT","Trazer janela mensagem nova para frente");
define("_TIMEZONE","Fuso Hor�rio");
define("_SHOW_TIMESTAMPS","Mostre data/hora nos bate-papos?");

define("_EMOTICON_PACK","Bloco do Emoticon");

define("_INCOMING_REQUEST","ENTRADA PEDIDOS");
define("_REQUEST_FROM","Voc� t�m um pedido de");
define("_ACCEPT_REQUEST","Voc� quer aceit�-lo?");
define("_AUTO_OPEN_IM_ATTEMPT","Tentar abrir automaticamente a janela nova do bate-papo... <p>Se n�o aparecer, ent�o voc� tem a <b>POPUP BLOCKER</b>.  <p>Permita por favor popups n�o requeridos</b> para aceitar automaticamente pedidos do bate-papo.<p>Se n�o, desligue esta op��o em seu usu�rio <b>Op��es</b> tela.");
define("_UPDATED","Atualizado");
define("_ONLINE_AS","Online como");
define("_OPTIONS","Op��es");
define("_LOGOUT","Logout");
define("_CURRENT_CHATS","Bate-papos Atuais");
define("_LEFT_CHAT","chat a esquerda."); 
define("_YOU","Voc�");
define("_REJOIN_CHAT","tornou a reunir o bate-papo.");
define("_RECENT_CHATS","Bate-papos Recentes"); 
define("_UNBLOCK","Desbloquear"); 
define("_BLOCK","Bloquear"); 
define("_WHOS_ONLINE","Quem est� Online ");

define("_USER_NOT_AVAILABLE","Usu�rio n�o disponivel");
define("_SORRY_USER_NOT_AVAILABLE","Desculpe, o usu�rio n�o est� dispon�vel.");

define("_PLEASE","Por favor");
define("_LOGIN","Login");
define("_REGISTER","Registrar");

define("_JOINED_CHAT","juntar-se ao bate-papo.");

define("_USER_DIDNT_RESPOND","O usu�rio n�o respondeu");
define("_SORRY_USER_DIDNT_RESPOND","Desculpe, o usu�rio n�o respondeu.  Tente outra vez mais tarde.");

define("_USERNAME_NOT_FOUND","NOME USUARIO n�o encontrado.");
define("_INCORRECT_PASSWORD","SENHA Incorreta.");

define("_PLEASE_LOGIN_OR_REGISTER","Por favor entre com login ou registro");
define("_PLEASE_LOGIN","Por favor entre login"); 
define("_REGISTERED_USERS","usu�rios registrados");
define("_CREATE_NEW_ACCOUNT","Criar uma nova conta");
define("_LOST_LOGIN","Detalhes �ltimo login?");

define("_NEW_ACCOUNT","Nova conta");
define("_USERNAME_NO_SPACES","NOME USUARIO n�o pode conter espa�os");
define("_USERNAME_IN_USE","Escolha por favor um NOME USUARIO diferente");
define("_EMAIL_REGGED","Este endere�o de email j� est� registrado");
define("_PASSWORD_TOO_SHORT","SENHA muito curta");
define("_NEW_USER","Novo Usu�rio");

define("_YOU_ARE_OWNER","Voc� tem o n�vel do admin do dono!");
define("_THANKS_REGISTERING","Obrigado por se registrar!");
define("_BETWEEN","entre");
define("_AND","e");
define("_CHARACTERS","caracteres");

define("_COULD_NOT_READ_CONFIG","N�o consegui obter a configura��o - muito prov�vel um problema da base de dados.  Se voc� est� funcionando o PHP121 pela primeira vez, voc� executou o comando do SQL primeiramente?  Por favor leia o README (para primeira instala��o) ou para ATUALIZA��O. No diret�rio doc voc� encontrar� maiores instru��es.");

define("_YOU_ARE_BANNED","Voc� foi <b>banido</b>.  Se voc� acha que isto foi um erro, por favor entre em contato com os administradores.");

define("_TITLE_LOST_LOGIN","Login Perdido");

define("_ENTER_EITHER_U_OR_E","Incorpore por favor seu nome de usu�rio ou endere�o de email");

define("_EMAIL_NOT_FOUND","Endere�o de EMAIL n�o existe.");

define("_TO_RECOVER_PASSWORD","Para resetar sua senha PHP121, por favor entre na p�gina abaixo para maiores instru��es.  Se o endere�o for quebrado em 2 linhas, voc� necessitar� junt�-lo na barra do endere�o de seu browser.");
define("_RESET_LOGIN_DETAILS","Resetar Detalhes Login");
define("_INSTRUCTIONS_MAILED","As instru��es em como restaurar sua senha foram enviadas para o seu email.  Verifique por favor seu email em alguns minutos.");
define("_OR","OR");
define("_RESET_PASSWORD","Restaure a Senha");
define("_INCOMPLETE_URL","URL Incompleta: Cole por favor o URL de seu email no browser, removendo todas as linha quebradas.");
define("_RESET_PASS_ENTER_PASS_BELOW","Entre com a sua nova senha abaixo, confirme, e pressione ent�o a SENHA para MUDAN�A"); 
define("_NEW_PASSWORD","Nova Senha");
define("_CHANGE_PASSWORD","Mude a Senha");
define("_INCORRECT_CODE","C�digo incorreto. Certifique-se por favor se voc� colou a URL correta em seu browser.");

define("_PASSWORD_CHANGED","A senha mudou.");
define("_YOU_CAN_NOW","Voc� pode agora");

define("_CANT_IM_SELF","Voc� n�o pode enviar mensagem para voc� mesmo!"); 
define("_USER_IS_BLOCKED","Voc� bloqueou este usu�rio.  Voc� n�o pode entrar em contrato com ele at� que seja desbloqueado!"); 
define("_YOU_ARE_BLOCKED","Voc� bloqueou este usu�rio.  YVoc� n�o pode entrar em contrato com ele at� que seja desbloqueado!"); 
define("_SEND_IM","Enviar IM");
define("_REQUEST_SENT_TO","Pedido emitido a");
define("_WAITING","Esperando uma reposta...");

define("_VIEW_CHAT_HISTORY","Historico do bate-papo (sem refresh)");

define("_USERS_IN_ROOM","Usu�rios na sala: ");
define("_NO_MESSAGE","Voc� n�o adicionou uma mensagem");
define("_INVITE_THIS_CHAT", "Convide a este bate-papo...");
define("_NO_AJAX", "Desculpe, seu navegador n�o suporta AJAX,  que � necess�rio para executar esta aplica��o. Atualize o seu navegador, ou utilize outro como <a target='blank' href='http://www.mozilla.com/firefox'>Firefox</a>.");
define("_JOINING", "...Juntando...");
define("_INVITE_SELECT", "Selecione um usu�rio para convidar ao bate-papo: ");
define("_INVITE_ALL_HERE", "Desculpe, todos os usu�rios est�o atualmente nesta sala!"); 

?>
