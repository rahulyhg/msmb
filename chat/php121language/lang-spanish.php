<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)                                                  **
 **  File:              lang-spanish.php                                                **
 **  Date modified:     09/07/06 (PHP121 v2.2)                                          **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Spanish translation                                             **
 **  Translated by:	Pilar Martin and Alberto R. Castro                              **
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

define("_CLEAR_CHAT","Borrar histórico de la conversación"); 
define("_CHARS_LEFT","caracteres restantes");

define("_AUTO_EMAIL_TRANSCRIPT","Enviar automáticamente por email la transcripción cuando acabe la conversación"); 
define("_FORCE_AUTO_EMAIL_TRANSCRIPT","Ignorar las opciones de envío automático de transcripciones por email del usuario y enviarlas en cualquier caso"); 
define("_YOUR_CHATS","Tus conversaciones"); 
define("_EMAIL_TRANSCRIPT","Enviar por email el log de esta conversación"); 
define("_EMAIL_TRANSCRIPT_CONFIRM","Pulsa OK para enviar por email los contenidos de esta conversación a la cuenta de correo registrada debajo <a href=\"php121edituser.php\" target=\"_blank\">Cambiar</a>"); 
define("_ADMIN_FORCING_EMAIL_TRANSCRIPTS","Atención, esta web esta configurada para enviar automáticamente por correo la transcripción de las conversaciones"); 
define("_AUTO_EMAIL_TRANSCRIPTS","Ya has solicitado que se te envíen automáticamente por email las transcripciones"); 
define("_DUPE_EMAIL_WARNING","Al proceder, recibirás más de una copia del email"); 
define("_TRANSCRIPT_EMAILED","La transcripción de la conversación actual se te ha enviado por email"); 
define("_USER_CAN_CREATE_ACCOUNT","¿Permitir la creación de nuevas cuentas?"); 
define("_USER_CAN_DELETE_ACCOUNT","¿Permitir a los usuarios borrar su cuenta?"); 
define("_ADD_USER","Añadir usuario"); 
define("_USER_ADDED","Usuario añadido."); 
define("_IMPORTANT_NOTE","(Aviso Importante)"); 
define("_AUTO_EMAIL_NOTE","Atención, para que se envíe por email automáticamente la transcripción de la conversación, al menos <u>tiene que haber abierta una lista de contactos <b>2  minutos</b> después de que la conversación se considere 'inactiva'</u>.  <p>Una conversación inactiva es aquella en la que no hay nadie en la conversación. Si no hay listas de contactos abiertas en este punto, el email <b>no será</b> enviado.  <p>Se espera que esta funcionalidad sea usada por el departamento de soporte técnico que utiliza PHP121 para ayudar a los clientes, y que un ingeniero de soporte mantendrá una lista de contactos abierta cuando el cliente abandone la conversación. Esta funcionalidad puede ser mejorada en una versión posterior de PHP121."); 
define("_HPBUTTON_CHAT_NOW","Usuarios conversando en este momento: "); 
define("_HPBUTTON_OPEN_MESSENGER","Abrir Instant Messenger"); 
define("_FIX_SMILIES","Corregir Emoticones");
define("_HERE_IS_YOUR_CHAT_TRANSCRIPT","aqui tienes la transcripcion de tu conversacion.");

define("_MESSAGE","Mensaje");
define("_SEND","Enviar");
define("_LANGUAGE","Idioma");
define("_DEFAULT_LANGUAGE","Idioma por defecto");
define("_WARN_UPDATE","Se han añadido nuevas funciones al messenger que necesitan que actualices tus preferencias.\nPara hacerlo, pulsa OPCIONES en la lista de contactos y despues EDITAR CUENTA.\nEste mensaje no volvera a aparecer hasta que una nueva version del messenger que necesite que actualices tus preferencias.");
define("_TABLE_BLANK_ROW","<tr><td>&nbsp;</td></tr>");
define("_YES","Si");
define("_NO","No");
define("_PON","Si");
define("_OFF","No");
define("_TITLE_EDIT_CONFIGURATION","Editar Configuracion");
define("_CONFIGURATION_UPDATED","Configuracion Actualizada");
define("_GO_BACK","Volver a");
define("_ADMIN_OPTIONS","Opciones de Administracion");
define("_BELOW","abajo");
define("_EDIT_CONFIGURATION","Editar Configuracion");
define("_SYSTEM_CLOCK_TIMEZONE","Franja horaria del reloj del sistema");
define("_HOURS","horas");
define("_SAVE_CHANGES","Guardar cambios");
define("_CANCEL","Cancelar");
define("_ACCESS_DENIED","No tienes permiso para acceder a esta pagina");

define("_DELETE_USER_DENIED","No tienes permiso para borrar este usuario");
define("_USER_NOT_EXIST","El usuario no existe");
define("_ERROR","<font color=\"FF0000\">Error: </font>");
define("_USER_DELETED","Usuario borrado.");
define("_DELETE_CANCELLED","Borrado cancelado");
define("_ARE_YOU_SURE","¿Estas seguro de que quieres");
define("_DELETE_THIS_USER","borrar este usuario?");
define("_SELECT_USER","Seleccionar usuario");
define("_DELETE_USER","Borrar usuario");

define("_INVALID_USERNAME","Por favor, introduce un nombre de usuario valido");
define("_INVALID_EMAIL","Por favor, introduce una direccion de email valida");
define("_EMAIL_NO_SPACES","La direccion de email no puede contener espacios");
define("_PASSWORD_LENGTH","La contraseña debe tener entre 6 10 caracteres");
define("_PASSWORDS_MISMATCH","Las contraseñas no coinciden - por favor, introducelas de nuevo");
define("_EDIT_USER_DENIED","No tienes permiso para editar este usuario.");
define("_EDIT_USER","Editar usuario");
define("_USER_UPDATED","Usuario actualizado.");
define("_EMAIL","Email");
define("_PASSWORD","Password");
define("_PASSWORD_LENGTH_INFO","entre 6 y 10 caracteres");
define("_LEAVE_BLANK_KEEP_EXISTING","deja en blanco para conservar el actual");
define("_CONFIRM_PASSWORD","Confirmar contraseña");
define("_IF_CHANGING_PASSWORD","si cambias la contraseña");
define("_EMOTICONS","Emoticones");
define("_BAN_THIS_USER","Banear este usuario?");
define("_USER_LEVEL","Nivel del usuario");
define("_USER","Usuario");
define("_PADMIN","Administrador");
define("_OWNER","Propietario");

define("_ADD_EMOTICONS","Añadir Emoticones");
define("_ADD_EMOTICON_INSTRUCTIONS","<b><u>Instrucciones</u></b><p>
	1. Descarga un paquete de emoticones PHPBB incluyendo el fichero .pak<br> 
	Puedes conseguir algunos en http://www.php121.com.<p>
	2. Pon los nuevos emoticones y su pak en un nuevo directorio bajo tu directorio <i>php121smilies</i><br>
	Por ejemplo: phpsmilies/cutesmilies/ <br>El <b>nombre del directorio</b> sera el nombre de tu nuevo paquete.<p>
	3.  Despues, envia el siguiente formulario:<br>");
define("_FILE","archivo");
define("_ADD_EMOTICON_SAMPLE","(por ejemplo, cutesmilies/smiles.pak)");
define("_ADD_PAK","Añadir Paquete");
define("_CANT_READ_PAK","No se pudo leer el archivo pak.  ¿Existe?");
define("_SMILIES_UPDATE_ERROR","No se pudo actualizar los emoticones!");
define("_SMILIES_ADDED","Emoticones añadidos!");

define("_DELETE_EMOTICONS","Borrar Emoticones");
define("_SELECT_PAK","Seleccionar PAK");
define("_DELETE_PAK","Borrar PAK");
define("_PAK_DELETED","PAK Borrado!");

define("_CONFIGURATION","Configuracion");
define("_USER_ADMIN","Administracion de usuarios");
define("_EDIT_SYSTEM_CONFIG","Editar Configuracion del Sistema PHP121");

define("_CANCEL_IM_REQUEST","Cancelar Solicitud de Conversacion");
define("_IM_REQUEST_CANCELLED","Solicitud Cancelada.");
define("_CLOSE","Cerrar ventana");

define("_CHAT_HISTORY","Historico de mensajes");

define("_INSTANT_MESSAGE","Mensaje Instantaneo");
define("_INSTANT_MESSENGER","Instant Messenger");

define("_DATABASE_PROBLEM","Hay un problema con la base de datos, por favor intentalo mas tarde");

define("_DELETE_ACCOUNT","Borrar cuenta");
define("_ACCOUNT_DELETED","Cuenta borrada.");
define("_ACCOUNT_OPTIONS","Opciones de Cuenta");
define("_DELETE_YOUR_ACCOUNT","¿Borrar cuenta?");
define("_REENTER_U_AND_P","Por seguridad, por favor introduce de nuevo tu nombre de usuario y contraseña:");
define("_USERNAME","Nombre de usuario");

define("_EDIT_ACCOUNT","Editar Cuenta");
define("_ACCOUNT_UPDATED","Cuenta actualizada");
define("_WELCOME","Bienvenido");
define("_CAN_EDIT_YOUR_DETAILS_BELOW","aqui puedes editar tus preferencias");
define("_PASSWORD_CHANGE_LOGIN_AGAIN","Si cambias la contraseña, tendrás que hacer login otra vez.");
define("_AUTO_ACCEPT_CHAT_REQUESTS","¿Aceptar automaticamente solcitudes de conversacion?");
define("_BEEP_ON_NEW_MESSAGE","Beep al recibir nuevos mensajes");
define("_BRING_WINDOW_TO_FRONT","Pasar ventana al frente al recibir nuevos mensajes");
define("_TIMEZONE","Franja horaria");
define("_SHOW_TIMESTAMPS","¿Mostrar hora en el chat?");

define("_EMOTICON_PACK","Paquete de Emoticones");

define("_INCOMING_REQUEST","SOLICITUD RECIBIDA");
define("_REQUEST_FROM","Tienes una nueva solicitud de");
define("_ACCEPT_REQUEST","¿Quieres aceptarla?");
define("_AUTO_OPEN_IM_ATTEMPT","Intentando abrir automaticamente una nueva ventana de chat... <p>Si no aparece, probablemente tengas un <b>BLOQUEADOR DE POPUPS</b>.  <p>Por favor permite <b>popups</b> para aceptar automaticamente las solicitudes de conversacion.<p>Si no, desactiva esta opción en tu pantalla de <b>Opciones</b> de Usuario.");
define("_UPDATED","Actualizado");
define("_ONLINE_AS","Conectado como");
define("_OPTIONS","Opciones");
define("_LOGOUT","Desconectar");
define("_CURRENT_CHATS","Conversaciones actuales");
define("_LEFT_CHAT","abandonar la conversacion.");
define("_YOU","Tu");
define("_REJOIN_CHAT","regresa a la conversacion.");
define("_RECENT_CHATS","Conversaciones recientes");
define("_UNBLOCK","Desbloquear");
define("_BLOCK","Bloquear");
define("_WHOS_ONLINE","Quien esta conectado ");

define("_USER_NOT_AVAILABLE","Usuario no disponible");
define("_SORRY_USER_NOT_AVAILABLE","Lo siento, el usuario no esta disponible.");

define("_PLEASE","Por favor");
define("_LOGIN","Login");
define("_REGISTER","Registrarse");

define("_JOINED_CHAT","se unio a la conversacion.");

define("_USER_DIDNT_RESPOND","El usuario no responde");
define("_SORRY_USER_DIDNT_RESPOND","Lo siento, el usuario no responde. Intentalo mas tarde.");

define("_USERNAME_NOT_FOUND","Nombre de Usuario no encontrado.");
define("_INCORRECT_PASSWORD","CONTRASEÑA incorrecta.");

define("_PLEASE_LOGIN_OR_REGISTER","Por favor haz login o registrate");
define("_PLEASE_LOGIN","Por favor haz login");
define("_REGISTERED_USERS","usuarios registrados");
define("_CREATE_NEW_ACCOUNT","Crear una nueva Cuenta");
define("_LOST_LOGIN","¿Olvidaste tus datos de registro?");

define("_NEW_ACCOUNT","Nueva Cuenta");
define("_USERNAME_NO_SPACES","El NOMBRE DE USUARIO no puede tener espacios en blanco");
define("_USERNAME_IN_USE","Por favor elige un NOMBRE DE USUARIO distinto");
define("_EMAIL_REGGED","Esta direccion de email ya ha sido registrada");
define("_PASSWORD_TOO_SHORT","PASSWORD demasiado corto");
define("_NEW_USER","Nuevo Usuario");

define("_YOU_ARE_OWNER","Tienes nivel PROPIETARIO!");
define("_THANKS_REGISTERING","Gracias por registrarte!");
define("_BETWEEN","entre");
define("_AND","y");
define("_CHARACTERS","caracteres");

define("_COULD_NOT_READ_CONFIG","No se pudo obtener la Configuracion - probablemente hay un problema con la base de datos.  Si es la primera vez que ejecutas PHP121, ¿ejecutaste primer el archivo SQL? Por favor lee el archivo README (para primeras instalaciones) o el archivo UPDATE (para actualizaciones) en el direcotio docs para ver las instrucciones.");

define("_YOU_ARE_BANNED","Has sido <b>baneado</b>.  Por favor contacta con los Administradores si piensas que ha habido algun error.");

define("_TITLE_LOST_LOGIN","Datos de Conexion perdidos");

define("_ENTER_EITHER_U_OR_E","Por favor introduce tu USERNAME o tu direccion de EMAIL");

define("_EMAIL_NOT_FOUND","Direccion de EMAIL no encontrada.");

define("_TO_RECOVER_PASSWORD","Para resetear tu contraseña de PHP121, por favor ve a la siguiente pagina web y sigue las instrucciones.  Si la direccion aparece dividida en dos lineas, deberás unirla en una sola en la barra de direcciones de tu navegador.");
define("_RESET_LOGIN_DETAILS","Resetear Datos de Login");
define("_INSTRUCTIONS_MAILED","Las instrucciones para resetear tu password se te han enviado por email. Por favor comprueba tu correo en unos minutos.");
define("_OR","O");
define("_RESET_PASSWORD","Resetear Password");
define("_INCOMPLETE_URL","URL Incompleta: Por favor pega la URL de tu email en el navegador, eliminando cualquier salto de linea.");
define("_RESET_PASS_ENTER_PASS_BELOW","Introduce tu nuevo password, confirmalo y pulsa CAMBIAR PASSWORD");
define("_NEW_PASSWORD","Nuevo Password");
define("_CHANGE_PASSWORD","Cambiar Password");
define("_INCORRECT_CODE","Codigo Incorrecto. Por favor asegurate de que pegaste la URL completa en tu navegador.");

define("_PASSWORD_CHANGED","Password cambiado.");
define("_YOU_CAN_NOW","Ahora puedes");

define("_CANT_IM_SELF","No puedes enviarte un mensaje a tu mismo!");
define("_USER_IS_BLOCKED","Has BLOQUEADO este usuario. No podras contactar con el hasta que lo DESBLOQUEES!");
define("_YOU_ARE_BLOCKED","Este usuario te ha BLOQUEADO. No podras contactar con el hasta que te DESBLOQUEE!");
define("_SEND_IM","Enviar Mensaje");
define("_REQUEST_SENT_TO","Solicitud enviada a");
define("_WAITING","esperando respuesta...");

define("_VIEW_CHAT_HISTORY","Ver historico de mensajes (no se actualiza)");

define("_USERS_IN_ROOM","Usuarios en esta sala: ");
define("_NO_MESSAGE","Ud. no ha ingresado ningún mensaje");
define("_INVITE_THIS_CHAT", "Invitar a este chat...");
define("_NO_AJAX", "Su navegador no soporta AJAX, el cual es necesario para ésta aplicación. Considere actualizar su navegador o bien utilizar algún otro como  <a target='blank' href='http://www.mozilla.com/firefox'>Firefox</a>.");
define("_JOINING", "...Adjuntando...");
define("_INVITE_SELECT", "Seleccione un usuario para invitar a este chat: ");
define("_INVITE_ALL_HERE", "Lo siento, todos los usuarios en línea están actualmente en ésta sala!");

?>
