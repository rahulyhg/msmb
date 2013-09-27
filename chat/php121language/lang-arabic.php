<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)                                                  **
 **  File:              lang-english.php                                                **
 **  Date modified:     12 July 2006                                                      **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Arabic language file                                           **
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

define("_MESSAGE","النص");
define("_SEND","إرسال");
define("_LANGUAGE","اللغة");
define("_DEFAULT_LANGUAGE","اللغة الرئيسية");
define("_WARN_UPDATE","هناك بعض الخواص الجديدة التي تم إضافتها لبرنامج الدردشة و التي توجب عليك تعديل إعداداتك، لتقم بذلك، الرجاء  الضغط على الخيارات، ثم الضغط على تعديل الإعدادات، لن تظهر هذه الرسالة مرة أخرى حتى يكون هناك خواص جديدة و التي تتطلب منك التجديد ");
define("_TABLE_BLANK_ROW","<tr><td>&nbsp;</td></tr>");

/* Arabic font direction is from right to left*/
define("_NO","نعم"); // Translated in this way to overcome font direction issue
define("_YES","لا"); // Translated in this way to overcome font direction issue
define("_PON","لا"); // Translated in this way to overcome font direction issue
define("_OFF","نعم"); // Translated in this way to overcome font direction issue
define("_TITLE_EDIT_CONFIGURATION","تعديل الإعدادات");
define("_CONFIGURATION_UPDATED","تجديد الإعدادات");
define("_GO_BACK","العودة إلى");
define("_ADMIN_OPTIONS","الإعدادات");
define("_BELOW","إلى الأسفل");
define("_EDIT_CONFIGURATION","تعديل الإعدادات");
define("_SYSTEM_CLOCK_TIMEZONE","نطاق الوقت للنظام");
define("_HOURS","ساعة");
define("_SAVE_CHANGES","حفظ التعديلات");
define("_CANCEL","إلغاء");
define("_ACCESS_DENIED","الدخول لهذه الصفحة غير مسموح");
define("_DELETE_USER_DENIED","لا يمكنك مسح هذا المستخدم");
define("_USER_NOT_EXIST","مستخدم غير موجود");
define("_ERROR","<b><font color=\"FF0000\">خطأ : </font></b>");
define("_USER_DELETED","تم مسح المستخدم");
define("_DELETE_CANCELLED","تم إلغاء المسح");
define("_ARE_YOU_SURE","هل أنت متأكد من انك تريد");
define("_DELETE_THIS_USER","مسح هذا المستخدم");
define("_SELECT_USER","اختيار مستخدم");
define("_DELETE_USER","مسح مستخدم");
define("_INVALID_USERNAME","الرجاء اختيار اسم مستخدم صحيح");
define("_INVALID_EMAIL","الرجاء إدخال بريد إلكتروني صحيح");
define("_EMAIL_NO_SPACES"," يجب أن لا يحتوى عنوان البريد الإلكتروني على فراغات");
define("_PASSWORD_LENGTH","كلمة السر يجب أن تكون من 6 إلى 10 حروف");
define("_PASSWORDS_MISMATCH","كلمتا السر غير متطابقتان الرجاء إعادة المحاولة");
define("_EDIT_USER_DENIED","لا يسمح لك بتعديل هذا المستخدم");
define("_EDIT_USER","تعديل المستخدم");
define("_USER_UPDATED","تم تعديل المستخدم");
define("_EMAIL","البريد الإلكتروني");
define("_PASSWORD","كلمة السر");
define("_PASSWORD_LENGTH_INFO","من 6 إلى 10 حروف");
define("_LEAVE_BLANK_KEEP_EXISTING","الرجاء ترك الحقل فارغ لابقاء القيمة الحالية");
define("_CONFIRM_PASSWORD","تأكيد كلمة السر");
define("_IF_CHANGING_PASSWORD","إذا كانت كلمة السر تتغير");
define("_EMOTICONS","سمايليز");
define("_BAN_THIS_USER","صد هذا المستخدم؟");
define("_USER_LEVEL","مستوى صلاحية المستخدم");
define("_USER","مستخدم");
define("_PADMIN","مشرف");
define("_OWNER","مالك الموقع");
define("_ADD_EMOTICONS","إضافة سمايلي");
define("_ADD_EMOTICON_INSTRUCTIONS","<b><u>التعليمات</u></b>
	1. قم بتنزيل ملف السمايليز و ملف الباك من
<br>http://www.php121.com.
	2. ضع السمايليز و ملف الباك الخاص بهم في حافظة
<br><i>php121smilies</i> 
	3.  قم بالضغط على تحميل<br>");
define("_FILE","ملف");
define("_ADD_EMOTICON_SAMPLE","(e.g. cutesmilies/smiles.pak)");
define("_ADD_PAK","تحميل");
define("_CANT_READ_PAK","لا يمكن إضافة ملف المجموعة، هل الملف موجود؟");
define("_SMILIES_UPDATE_ERROR","لم تتم عملية تحديث السمايليز");
define("_SMILIES_ADDED","تمت عملية الإضافة بنجاح");
define("_DELETE_EMOTICONS","مسح سمايليز");
define("_SELECT_PAK","اختيار مجموعة");
define("_DELETE_PAK","مسح مجموعة");
define("_PAK_DELETED","تمت عملية المسح بنجاح");
define("_CONFIGURATION","الإعدادات");
define("_USER_ADMIN","التحكم و تعديل المستخدمين");
define("_EDIT_SYSTEM_CONFIG","تعديل إعدادات النظام");
define("_CANCEL_IM_REQUEST","إلغاء طلب الدردشة");
define("_IM_REQUEST_CANCELLED","تم إلغاء الطلب");
define("_CLOSE","إغلاق النافذة");
define("_CHAT_HISTORY","التاريخ");
define("_INSTANT_MESSAGE","دردشة مباشرة");
define("_INSTANT_MESSENGER","نظام الدردشة المباشرة");
define("_DATABASE_PROBLEM","هناك خطا في قاعدة البيانات، الرجاء إعادة المحاولة لاحقا");
define("_DELETE_ACCOUNT","مسح الاشتراك");
define("_ACCOUNT_DELETED","تمت عملية مسح الاشتراك بنجاح");
define("_ACCOUNT_OPTIONS","الاختيارات");
define("_DELETE_YOUR_ACCOUNT","مسح اشتراكي؟");
define("_REENTER_U_AND_P","لاعتبارات الحماية، الرجاء إعادة إدخال اسم المستخدم و كلمة السر");
define("_USERNAME","اسم المستخدم");
define("_EDIT_ACCOUNT","تعديل الاشتراك");
define("_ACCOUNT_UPDATED","تمت التعديل بنجاح");
define("_WELCOME","أهلا و سهلا");
define("_CAN_EDIT_YOUR_DETAILS_BELOW","يمكنك تعديل بياناتك الخاصة هنا");
define("_PASSWORD_CHANGE_LOGIN_AGAIN","إذا قمت بتغيير كلمة السر، يجب عليك الخروج و إعادة التسجيل من جديد");
define("_AUTO_ACCEPT_CHAT_REQUESTS","اقبل طلب الدردشة أتوماتيكيا");
define("_BEEP_ON_NEW_MESSAGE","اصدر نغمة عند و صول رسالة جديدة");
define("_BRING_WINDOW_TO_FRONT","احضر النافذة إلى الأمام عند و صول رسالة");
define("_TIMEZONE","نطاق الوقت");
define("_SHOW_TIMESTAMPS","إظهار الوقت أثناء الدردشة؟");
define("_EMOTICON_PACK","مجموعة سمايليز");
define("_INCOMING_REQUEST","طلب دردشة وارد");
define("_REQUEST_FROM","لديك  طلب");
define("_ACCEPT_REQUEST","هل تقبل به؟");
define("_AUTO_OPEN_IM_ATTEMPT","محاولة فتح نافذة دردشة جديدة، إذا لم يكن بإمكانك مشاهدتها، يكون البوب بلوكر لديك فعال، الرجاء جعل البوب ابز تقبل أتوماتيكيا، و إلا قم بتعطيل هذه الخاصية من قائمة إعدادات المستخدمين");
define("_UPDATED","تجديد");
define("_ONLINE_AS","تم تسجيل الدخول منذ");
define("_OPTIONS","الاختيارات");
define("_LOGOUT","الخروج");
define("_CURRENT_CHATS","الدردشات الحالية");
define("_LEFT_CHAT","ترك التخاطب");
define("_YOU","أنت");
define("_REJOIN_CHAT","انضممت إلى الدردشة مرة أخرى");
define("_RECENT_CHATS","الدردشات الحالية");
define("_UNBLOCK","إلغاء الصد");
define("_BLOCK","صد");
define("_WHOS_ONLINE","المستخدمون المتواجدون ");
define("_USER_NOT_AVAILABLE","المستخدم غير موجود");
define("_SORRY_USER_NOT_AVAILABLE","عذرا المستخدم غير موجود");
define("_PLEASE","لو سمحت");
define("_LOGIN","الدخول");
define("_REGISTER","التسجيل");
define("_JOINED_CHAT","انضم إلى الدردشة");
define("_USER_DIDNT_RESPOND","المستخدم لم يجب");
define("_SORRY_USER_DIDNT_RESPOND","عذرا المستخدم لم يجب الرجاء إعادة المحاولة مرة اخرى");
define("_USERNAME_NOT_FOUND","اسم المستخدم غير موجود");
define("_INCORRECT_PASSWORD","كلمة السر غير صحيحة");
define("_PLEASE_LOGIN_OR_REGISTER","الرجاء تسجيل الدخول او تسجيل مستخدم جديد");
define("_PLEASE_LOGIN","الرجاء تسجيل الدخول");
define("_REGISTERED_USERS","المستخدمين المسجلين");
define("_CREATE_NEW_ACCOUNT","تسجيل اشتراك جديد");
define("_LOST_LOGIN","اضعت معلومات الدخول");
define("_NEW_ACCOUNT","اشتراك جديد");
define("_USERNAME_NO_SPACES","يجب أن لا يحتوي اسم المستخدم على فراغات");
define("_USERNAME_IN_USE","الرجاء اختيار اسم مستخدم آخر");
define("_EMAIL_REGGED","هذا البريد الإلكتروني مسجل لدينا");
define("_PASSWORD_TOO_SHORT","كلمة السر قصيرة");
define("_NEW_USER","مستخدم جديد");
define("_YOU_ARE_OWNER","لديك صلاحيات مالك النظام");
define("_THANKS_REGISTERING","شكرا لتسجيلكم");
define("_BETWEEN","بين");
define("_AND","و");
define("_CHARACTERS","حرف");
define("_COULD_NOT_READ_CONFIG","لم تتم عملية استرجاع ملف الإعدادات، من الممكن أن تكون هناك مشكلة في عملية الاتصال بقاعدة البيانات، الرجاء قراءة ملفي التنصيب و التحديث بعناية للحصول على التعليمات المناسبة");
define("_YOU_ARE_BANNED","لقد تم صدك، الرجاء الاتصال بالمشرف إذا كنت تعتقد أن الصد تم بالخطاء");
define("_TITLE_LOST_LOGIN","اضغط معلومات التسجيل");
define("_ENTER_EITHER_U_OR_E","الرجاء إدخال اسم المستخدم أو البريد الإلكتروني");
define("_EMAIL_NOT_FOUND","البريد الإلكتروني غير موجود");
define("_TO_RECOVER_PASSWORD","حتى تستطيع تغيير كلمة السر ل ب ه ب 121 الرجاء الضغط على هذا الرابط للذهاب إلى صفحة التعليمات، ثم اتبع التعليمات");
define("_RESET_LOGIN_DETAILS","تجديد معلومات تسجيل الدخول");
define("_INSTRUCTIONS_MAILED","لقد تم إرسال تعليمات تغيير كلمة السر لك بالبريد الإلكتروني، الرجاء الاطلاع عليها");
define("_OR","أو");
define("_RESET_PASSWORD","تجديد كلمة السر");
define("_INCOMPLETE_URL","رابط غير مكتمل، الرجاء إدخال الرابط المذكور في بريدك الإلكتروني كاملا و دون فراغات");
define("_RESET_PASS_ENTER_PASS_BELOW","ادخل كلمة السر الجديدة، ثم أكدها، ثم اضغط على تغيير كلمة السر");
define("_NEW_PASSWORD","كلمة السر الجديدة");
define("_CHANGE_PASSWORD","تغيير كلمة السر");
define("_INCORRECT_CODE","معلومات غير صحيحة، هل أنت متأكد من انك ألصقت الرابط الصحيح في متصفحك");
define("_PASSWORD_CHANGED","لقد تمت عملية تغيير كلمة السر");
define("_YOU_CAN_NOW","باستطاعتك الآن");
define("_CANT_IM_SELF","لا تستطيع إرسال رسالة لنفسك");
define("_USER_IS_BLOCKED","لقد قمت بصد هذا المستخدم، لا يمكنك التحدث إليه إلا بعد إلغاء الصد");
define("_YOU_ARE_BLOCKED","لقد قام هذا المستخدم بصدك، لا تستطيع التحدث معه حتى يقوم بإلغاء الصد");
define("_SEND_IM","أرسل رسالة مباشرة");
define("_REQUEST_SENT_TO","تم إرسال الطلب إلى");
define("_WAITING","بانتظار رد فعل");
define("_VIEW_CHAT_HISTORY","عرض تاريخ الدردشة");
define("_USERS_IN_ROOM","المستخدمون المتواجدون حاليا في هذه الغرفة");
define("_NO_MESSAGE","لم تقم بإدخال رسالة");
define("_INVITE_THIS_CHAT", "دعوة إلى الدردشة");
define("_NO_AJAX", "معذرة متصفحك لا يدعم اجاكس، الرجاء اخذ تجديد المتصفح بعين الاعتبار، او استعمال متصفح اخر مثل فاير فوكس
<a target='blank' href='http://www.mozilla.com/firefox'>فاير فوكس</a>. ");
define("_JOINING", "...يشترك...");
define("_INVITE_SELECT", "اختر مستخدم ليتم دعوته للمشاركة في الدردشة");
define("_INVITE_ALL_HERE", "معذرة جميع المستخدمين الموجودين حاليا تم ضمهم إلى هذه الغرفة");


?>
