<?php
/*****************************************************************************************
 **  PHP121 Instant Messenger (PHP121)                                                  **
 **  File:              lang-turkish.php                                                **
 **  Date modified:     29/06/06 (v2.2)                                                 **
 **  Copyright:         (C) 2005 Paul Synnott                                           **
 **  Email:             support@php121.com                                              **
 **  Web:               http://www.php121.com                                           **
 **  File function:     Turkish language file                                           **
 **  Translated by:     ilbay sengun <ilbay@ilbaysengun.com>                            **
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

define("_CLEAR_CHAT","sohbet geçmişini temizle");
define("_CHARS_LEFT","karakter kaldı");

define("_AUTO_EMAIL_TRANSCRIPT","Sohbet bitiminde sohbet mesajlarını otomatik olarak gönder");
define("_FORCE_AUTO_EMAIL_TRANSCRIPT","Kullanıcıların otomatik sohbet e-mail gönderimini yeniden düzenle");
define("_YOUR_CHATS","Sohbetleriniz");
define("_EMAIL_TRANSCRIPT","Bu sohbeti mail ile gönder");
define("_EMAIL_TRANSCRIPT_CONFIRM","Bu sohbetteki ayrıntıları e-mail adresinize göndermek için Tamam düğmesine basınız.  <a href=\"php121edituser.php\" target=\"_blank\">Değiştir</a>");
define("_ADMIN_FORCING_EMAIL_TRANSCRIPTS","Lütfen dikkat. Bu site sohbetleri otomatik olarak mailleyecek şekilde yapılandırılmıştır.");
define("_AUTO_EMAIL_TRANSCRIPTS","Zaten sohbetler e-maille otomatik olarak gönderilmekte."); 
define("_DUPE_EMAIL_WARNING","Devam ederseniz 1 den fazla e-mail alacaksınız.");
define("_TRANSCRIPT_EMAILED","Mevcut sohbet mesajı size e-maille gönderildi.");
define("_USER_CAN_CREATE_ACCOUNT","Yeni hesap yaratılmasına izin ver?");
define("_USER_CAN_DELETE_ACCOUNT","Kullanıcıların hesaplarını silmesine izin ver?");
define("_ADD_USER","kullanıcı ekle");
define("_USER_ADDED","Kullanıcı eklendi.");
define("_IMPORTANT_NOTE","(Önemli Not)");
define("_AUTO_EMAIL_NOTE","Lütfen dikkat, sohbet metninin sohbetin aktif olmamasından sonra maille gönderilebilmesi için en az 1 kotakt listesinin açık olması gereklidir. <p>Aktif olmayan sohbet kimsenin sohbette olmadığı durumu kapsar. Eğer herhangi bir kontakt listesi açık değilse e-mail gönderilmeyecektir. Bu özelllik PHP121 in yeni sürümlerinde iyileştirilecektir.");
define("_HPBUTTON_CHAT_NOW","Şu anda sohbet eden kullanıcılar: ");
define("_HPBUTTON_OPEN_MESSENGER","Sohbet Penceresini aç");
define("_FIX_SMILIES","Gülücükleri tamir et.");
define("_HERE_IS_YOUR_CHAT_TRANSCRIPT","Sohbet metniniz burada.");

define("_MESSAGE","Mesaj");
define("_SEND","Gönder");
define("_LANGUAGE","Dil");
define("_DEFAULT_LANGUAGE","Varsayılan Dil");
define("_WARN_UPDATE","Sohbete yeni özellikler katıldıNew features have been added to the instant messenger that require you to update your preferences.\nTo do this, click on OPTIONS on the contact list and then EDIT ACCOUNT.\nThis message will not appear again until the next instant messenger update that requires you to update your preferences.");
define("_TABLE_BLANK_ROW","<tr><td>&nbsp;</td></tr>");
define("_YES","Evet");
define("_NO","Hayır");
define("_PON","Açık");
define("_OFF","Kapalı");
define("_TITLE_EDIT_CONFIGURATION","Konfigürasyonu düzenle");
define("_CONFIGURATION_UPDATED","Konfigürasyon Değiştirildi");
define("_GO_BACK","Geri dön");
define("_ADMIN_OPTIONS","Admin Özellikleri");
define("_BELOW","altta");
define("_EDIT_CONFIGURATION","Konfigürasyonu düzenle");
define("_SYSTEM_CLOCK_TIMEZONE","Sistem saat dilimi");
define("_HOURS","saat");
define("_SAVE_CHANGES","Değişiklikleri Kaydet");
define("_CANCEL","iptal");
define("_ACCESS_DENIED","Bu pencereyi görüntülemeye izniniz yok");

define("_DELETE_USER_DENIED","Bu kullanıcıyı silmeye yetkiniz yok");
define("_USER_NOT_EXIST","Kullanıcı bulunamadı");
define("_ERROR","<b><font color=\"FF0000\">Hata: </font></b>");
define("_USER_DELETED","kullanıcı Silindi.");
define("_DELETE_CANCELLED","Silme iptal edildi");
define("_ARE_YOU_SURE","Bu eylemi gerçekleştirmek istediğinizden emin misiniz");
define("_DELETE_THIS_USER","bu kuuanıcıyı sil");
define("_SELECT_USER","Kullanıcı Seç");
define("_DELETE_USER","Kullanıcıyı Sil");

define("_INVALID_USERNAME","Lütfen geçerli bir KULLANICI ADI girin");
define("_INVALID_EMAIL","Lütfen geçerli bir E-MAIL adresi girin");
define("_EMAIL_NO_SPACES","E-MAIL adresi boşluk içeremez");
define("_PASSWORD_LENGTH","PAROLA 6 ile 10 karakter arasında olmalıdır.");
define("_PASSWORDS_MISMATCH","PAROLALAR uyuşmuyor - Lütfen yeniden giriniz.");
define("_EDIT_USER_DENIED","Bu kullanıcıyı düzenlemeye yetkiniz yok.");
define("_EDIT_USER","Kullanıcıyı düzenle");
define("_USER_UPDATED","Kullanıcı düzenlendi.");
define("_EMAIL","E-mail");
define("_PASSWORD","Parola");
define("_PASSWORD_LENGTH_INFO","6 ile 10 karakter");
define("_LEAVE_BLANK_KEEP_EXISTING","mevcut olanı korumak için boş bırakınız");
define("_CONFIRM_PASSWORD","Parolayı onaylayın");
define("_IF_CHANGING_PASSWORD","Eğer parolayı değiştirirseniz");
define("_EMOTICONS","Gülücükler");
define("_BAN_THIS_USER","Bu kullanıcıyı engelle?");
define("_USER_LEVEL","Kullanıcı seviyesi");
define("_USER","Kullanıcı");
define("_PADMIN","Admin");
define("_OWNER","Sahip");

define("_ADD_EMOTICONS","Gülücük ekle");
define("_ADD_EMOTICON_INSTRUCTIONS","<b><u>Açıklamalar</u></b><p>
	1. PHPBB gülücük seti indirin (.pak dosyası).<br> 
	http://www.php121.com adresinde birkaç gülücük seti bulabilirsiniz.<p>
	2. Yeni gülücüklerinizi <i>php121smilies</i> kalsörünüzün içine yerleştirin<br>
	mesela phpsmilies/cutesmilies/ <br><b>Klasör ismi</b> pak dosyasının adı olacaktır.<p>
	3. Aşağıdaki formu gönderin:<br>");
define("_FILE","dosya");
define("_ADD_EMOTICON_SAMPLE","(mesela cutesmilies/smiles.pak)");
define("_ADD_PAK","Paket ekle");
define("_CANT_READ_PAK","Paket okunamadı. Dosyanın varlığından emin olun.");
define("_SMILIES_UPDATE_ERROR","Gülücükler yüklenemedi!");
define("_SMILIES_ADDED","Gülücükler eklendi!");

define("_DELETE_EMOTICONS","Gülücükleri Sil");
define("_SELECT_PAK","Paket Seçin");
define("_DELETE_PAK","Paket silin");
define("_PAK_DELETED","Paket Silindi!");

define("_CONFIGURATION","Konfigürasyon");
define("_USER_ADMIN","Kullanıcı Yönetim Paneli");
define("_EDIT_SYSTEM_CONFIG","PHP121 Sistem Konfigürasyonunu Düzenleyin");

define("_CANCEL_IM_REQUEST","Sohbet isteğini iptal et");
define("_IM_REQUEST_CANCELLED","İstek İptal Edildi.");
define("_CLOSE","Pencereyi Kapat");

define("_CHAT_HISTORY","Sohbet Geçmişi");

define("_INSTANT_MESSAGE","Mesaj");
define("_INSTANT_MESSENGER","Sohbet Progamı");

define("_DATABASE_PROBLEM","Veritabanı hatası oluştu, lütfen daha sonra tekrar deneyin");

define("_DELETE_ACCOUNT","Hesabı Sil");
define("_ACCOUNT_DELETED","Hesap Silindi.");
define("_ACCOUNT_OPTIONS","Hesap Özellikleri");
define("_DELETE_YOUR_ACCOUNT","Hesabınızı silmek istiyor musunuz?");
define("_REENTER_U_AND_P","Güvenlik açısından kullanıcı adınızı ve parolanızı tekrar giriniz.:");
define("_USERNAME","Kullanıcı Adı");

define("_EDIT_ACCOUNT","Hesabı Düzenle");
define("_ACCOUNT_UPDATED","Hesap Güncelleştirildi");
define("_WELCOME","Hoşgeldinz");
define("_CAN_EDIT_YOUR_DETAILS_BELOW","aşağıda detaylarınızı değiştirebilirsiniz.");
define("_PASSWORD_CHANGE_LOGIN_AGAIN","Eğer parolanızı değiştirirseniz yeniden giriş yapmak zorunda kalırsınız.");
define("_AUTO_ACCEPT_CHAT_REQUESTS","Sohbet isteklerini otomatik olarak kabul et?");
define("_BEEP_ON_NEW_MESSAGE","Yeni mesajda uyarı sesi çıkar");
define("_BRING_WINDOW_TO_FRONT","Yeni mesajda pencereye öne çıkar");
define("_TIMEZONE","Zaman dilimi");
define("_SHOW_TIMESTAMPS","Sohbette zamanları göster?");

define("_EMOTICON_PACK","Gülücük Paketi");

define("_INCOMING_REQUEST","GELEN İSTEK");
define("_REQUEST_FROM","Bir davet aldınız");
define("_ACCEPT_REQUEST","Kabul etmek istiyor musunuz?");
define("_AUTO_OPEN_IM_ATTEMPT","Otomatik olarak yeni bir sohbet penceresi açılmaya çalışılıyor...<p>Eğer açılmıyorsa <b>POPUP</b> pencere izni yok veya bloke ediliyor.  <p>Lütfen pencere açılmasına izin verin. Veya popup bloğunu kaldırın.");
define("_UPDATED","En son güncelleme");
define("_ONLINE_AS","çevrimiçi");
define("_OPTIONS","Özellikler");
define("_LOGOUT","Çıkış");
define("_CURRENT_CHATS","Mevcut sohbetler");
define("_LEFT_CHAT","sohbeti terk etti.");
define("_YOU","Siz");
define("_REJOIN_CHAT","tekrar sohbete katıldı.");
define("_RECENT_CHATS","Geçmiş Sohbetler");
define("_UNBLOCK","Bloku kaldır");
define("_BLOCK","Blok");
define("_WHOS_ONLINE","Kimler çevrimiçi ");

define("_USER_NOT_AVAILABLE","Kullanıcı mevcut değil");
define("_SORRY_USER_NOT_AVAILABLE","Özür Dileriz, kullanıcı mevcut değil.");

define("_PLEASE","Lütfen");
define("_LOGIN","Giriş");
define("_REGISTER","Kayıt Ol");

define("_JOINED_CHAT","sohbete katıldı.");

define("_USER_DIDNT_RESPOND","Kullanıcı cevap vermedi");
define("_SORRY_USER_DIDNT_RESPOND","Özür dileriz, kullanıcı cevap vermedi. Daha sonra tekrar deneyiniz.");

define("_USERNAME_NOT_FOUND","Kullanıcı adı bulunamdı.");
define("_INCORRECT_PASSWORD","PAROLA geçersiz.");

define("_PLEASE_LOGIN_OR_REGISTER","Lütfen giriş yapın veya kayıt olun");
define("_PLEASE_LOGIN","Lütfen Giriş Yapınız");
define("_REGISTERED_USERS","kayıtlı kullanıcı");
define("_CREATE_NEW_ACCOUNT","Yeni hesap yarat");
define("_LOST_LOGIN","Giriş bilgilerini kaybettim");

define("_NEW_ACCOUNT","Yeni Hesap");
define("_USERNAME_NO_SPACES","Kullanıcı adı boşluk içeremez");
define("_USERNAME_IN_USE","Lütfen farklı bir Kullanıcı adı seçiniz.");
define("_EMAIL_REGGED","Bu mail adresi zaten kayıt ettirilmiş");
define("_PASSWORD_TOO_SHORT","PAROLA çok kısa");
define("_NEW_USER","Yeni Kullanıcı");

define("_YOU_ARE_OWNER","OWNER admin seviyeniz var!");
define("_THANKS_REGISTERING","Kayıt olduğunuz için teşekkür ederiz!");
define("_BETWEEN","arasında");
define("_AND","ve");
define("_CHARACTERS","karakterler");

define("_COULD_NOT_READ_CONFIG","Konfigürasyon alınamdı - veritabanı hatası. Eğer PHP121 i ilk kez çalıştırıyorsanız, önce SQL dosyanızı çalıştırın. Lütfen BENİOKU (ilk kurulum için) veya UPDATE (yükseltme için) dosyasını okuyunuz.");

define("_YOU_ARE_BANNED","<b>Engellendiniz.</b> Bunun bir hata olduğunu düşünüyorsanız admine başvurunuz.");

define("_TITLE_LOST_LOGIN","Giriş kaybedildi");

define("_ENTER_EITHER_U_OR_E","Lütfen kullanıcı adınızı veya e-mailinizi giriniz");

define("_EMAIL_NOT_FOUND","E-MAIL adresi bulunamadı.");


define("_TO_RECOVER_PASSWORD","PHP121 parolanızı sıfırlamak için lütfen  aşağıdaki web sayfasına gidip oradaki yönergeleri uygulayınız. Eğer web sitesi adresi iki veya daha çok satıra bölünmüşse tarayıcınız bunu yapıştırırken tekrar birleştirmeniz gerekecek.");
define("_RESET_LOGIN_DETAILS","Giriş detaylarını sıfırla");
define("_INSTRUCTIONS_MAILED","Parolanızı nasıl sıfırlayacağınızla ilgili bilgi mailinize gönderilmiştir. Lütfen birkaç dakika sonra mailinizi kontrol ediniz.");
define("_OR","Veya");
define("_RESET_PASSWORD","Parolayı sıfırla");
define("_INCOMPLETE_URL","Yetersiz URL: Lütfen mail ile gelen URL yi satır sonlarındaki atlamaları kaldırarak yeniden yapıştırın.");
define("_RESET_PASS_ENTER_PASS_BELOW","Aşağıya yeni parolanızı ve onay parolanızı girin ve Parola Değiştir düğmesine basınız");
define("_NEW_PASSWORD","Yeni Parola");
define("_CHANGE_PASSWORD","Parola değiştir");
define("_INCORRECT_CODE","Kod yanlış. Lütfen tüm kısayolu tarayıcınıza yapıştırdığınızdan emin olun.");

define("_PASSWORD_CHANGED","Parola değiştirildi.");
define("_YOU_CAN_NOW","Artık yapabilirsiniz.");

define("_CANT_IM_SELF","Kendinize mesaj gönderemezsiniz!");
define("_USER_IS_BLOCKED","Bu kullanıcıyı bloke ettiniz. Blok etmeyi kaldırmadığınız sürese onunla sohbet edemeyeceksiniz!");
define("_YOU_ARE_BLOCKED","Bu kullanıcı sizi bloke etmiş. Bloke kaldırılmadıkça onunla sohbet edemeyeceksiniz!");
define("_SEND_IM","Mesaj gönder");
define("_REQUEST_SENT_TO","İsteğin gönderildiği kullanıcı");
define("_WAITING","cevap bekleniyor...");

define("_VIEW_CHAT_HISTORY","Sohbet geçmişini göster (no refreshes)");

define("_USERS_IN_ROOM","Bu odadaki kullanıcılar: ");
define("_NO_MESSAGE","Mesaj girmediniz");
define("_INVITE_THIS_CHAT", "Bu sohbete davet et...");
define("_NO_AJAX", "Özür Dileriz, internet tarayıcınızın, bu uygulama için gerekli, AJAX desteği yok. Tarayıcınızın sürümünü yükseltmeyi deneyin, veya <a target='blank' href='http://www.mozilla.com/firefox'>Firefox</a> gibi farklı bir tarayıcı kullanmayı deneyin.");
define("_JOINING", "...açılıyor...");
define("_INVITE_SELECT", "Bu sohbete davet etmek için kullanıcı seçiniz: ");
define("_INVITE_ALL_HERE", "Özür Dileriz,Bütün kullanıcılar şu anda bu odada!");

?>