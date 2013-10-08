<?php

$label = '
/***************************************************
	Maashakti Marriage Bureau DB backup
	by Sushant Prasad Ramani
****************************************************/
';


/* * *************************************************
  Database settings
 * ************************************************** */
$db_server = 'maashakti.db.11559038.hostedresource.com';    // Database server, usually "localhost", 
// on (mt) servers something like internal-db.s12345.gridserver.com
$db_name = 'maashakti';    // Database name, leave empty for 'all databases'
$db_user = 'maashakti';    // Database username
$db_pass = 'Sonam123@';    // Database password



/* * *************************************************
  E-mail settings
 * ************************************************** */
$website = 'maashaktimarriage.com';      // Your site's domain (without www. part)
$send_to = 'ceb.sushant@gmail.com';          // backup file will be sent to?
$from = 'info@' . $website; // some hosting providers won’t let you send backups from invalid e-mail address



/* * *************************************************
  Misc options
 * ************************************************** */

$full_path = '/var/chroot/home/content/38/11559038/html';
// Full path to folder where you are running the script, usually "/home/username/public_html"
// (mt) servers have something like "/nfs/c01/h01/mnt/12345/domains/yourdomain.mobi/html/tools/backup2mail"


$delete_backup = true;
// delete gziped database from server after sending?

$send_log = true;
// send follow-up report?
// - true = send log file to an e-mail after each backup transfer
// - false = don't send log file, just leave it on the server



/* * *************************************************
  If everything goes well, you shouldn't
  modify anything below.
 * ************************************************** */
include_once 'includes/class.phpmailer.php';
error_reporting(E_ALL);

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Backup2mail status [' . $website . ']</title>
		<style type="text/css">body { background: #000; color: #0f0; font-family: \'Courier New\', Courier; }</style>
	</head>
	<body>';

function date_stamp() {
    global $html_output;
    $backup_date = date('Y-m-d-H-i');
    echo 'Database backup date: ' . $backup_date . '<br />';
    return $backup_date;
}

function backup_filename() {
    global $db_name, $date_stamp, $html_output;
    $db_backup_filename = ($db_name == '' ? 'all_databases' : $db_name) . '_' . $date_stamp . '.sql.gz';
    echo 'Database backup file: ' . $db_backup_filename . '<br />';
    return $db_backup_filename;
}

function db_dump() {
    global $db_server, $db_name, $db_user, $db_pass, $backup_filename, $html_output;
    $cmd = 'mysqldump -u ' . $db_user . ' -h ' . $db_server . ' --password=' . $db_pass . ' ' . ($db_name == '' ? '--all-databases' : $db_name) . ' | gzip > ' . $backup_filename;
    $dump_status = (passthru($cmd) === false) ? 'No' : 'Yes';
    echo 'Command: ' . $cmd . '<br />';
    echo 'Command executed? ' . $dump_status . '<br />';
    return $dump_status;
}

function send_attachment($file, $file_is_db = true) {
    global $send_to, $from, $website, $delete_backup, $html_output;

    $sent = 'No';

    $subject = 'MySQL backup - ' . ($file_is_db ? 'db dump' : 'report') . ' [' . $website . ']';
    $boundary = md5(uniqid(time()));
    $mailer = 'Sent by Backup2Mail';

    $body = 'Database backup file:' . "\n" . ' - ' . $file . "\n\n";
    $body .= '---' . "\n" . $mailer;

    $headers = 'From: ' . $from . "\n";
    $headers .= 'MIME-Version: 1.0' . "\n";
    $headers .= 'Content-type: multipart/mixed; boundary="' . $boundary . '";' . "\n";
    $headers .= 'This is a multi-part message in MIME format. ';
    $headers .= 'If you are reading this, then your e-mail client probably doesn\'t support MIME.' . "\n";
    $headers .= $mailer . "\n";
    $headers .= '--' . $boundary . "\n";

    $headers .= 'Content-Type: text/plain; charset="iso-8859-1"' . "\n";
    $headers .= 'Content-Transfer-Encoding: 7bit' . "\n";
    $headers .= $body . "\n";
    $headers .= '--' . $boundary . "\n";

    $headers .= 'Content-Disposition: attachment;' . "\n";
    $headers .= 'Content-Type: Application/Octet-Stream; name="' . $file . "\"\n";
    $headers .= 'Content-Transfer-Encoding: base64' . "\n\n";
    $headers .= chunk_split(base64_encode(implode('', file($file)))) . "\n";
    $headers .= '--' . $boundary . '--' . "\n";
    try {
        $mail = new PHPMailer(true); //New instance, with exceptions enabled
        $mail->IsSMTP();                           // tell the class to use SMTP
        $mail->AddReplyTo("noreply@maashaktimarriage.com", "MaaShaktiMarriage Bureau DB Backup");

        $mail->IsSendmail();  // tell the class to use Sendmail

        $mail->AddAddress('ceb.sushant@gmail.com');
        #$mail->AddBCC('prasad.sonam86@gmail.com');

        $mail->Subject = $subject;
        $mail->AddAttachment($file);
        $mail->AltBody = $headers; // optional, comment out and test
        $mail->WordWrap = 80; // set word wrap

        $mail->MsgHTML($body);

        $mail->IsHTML(true); // send as HTML

        if ($mail->Send()) {
            $sent = 'Yes';
            echo ($file_is_db ? 'Backup file' : 'Report') . ' sent to ' . $send_to . '.<br />';
            if ($file_is_db) {
                if ($delete_backup) {
                    unlink($file);
                    echo 'Backup file REMOVED from disk.<br />';
                } else {
                    echo 'Backup file LEFT on disk.<br />';
                }
            }
        } else {
            echo '<span style="color: #f00;">' . ($file_is_db ? 'Database' : 'Report') . ' not sent! Please check your mail settings.</span><br />';
        }
    } catch (phpmailerException $e) {
        //echo $e->errorMessage();
        die('Mail sending failed');
    }

    echo 'Sent? ' . $sent;

    return $sent;
}

function write_log() {
    global $backup_filename, $date_stamp, $send_log, $label, $full_path;

    $log_file = $full_path . '/backup_log.txt';
    if (!$handle = fopen($log_file, 'a+'))
        exit;
    if (chmod($log_file, 0644) && is_writable($log_file)) {

        echo '<h2>Mysqldump...</h2>';
        $dumped = db_dump();

        echo '<h2>Sending db...</h2>';
        $log_content = "\n" . $date_stamp . "\t\t\t" . $dumped . "\t\t\t" . send_attachment($backup_filename);

        echo '<h2>Writing log...</h2>';

        $log_header = '';
        if (filesize($log_file) == '0') {
            $log_header .= $label . "\n\n";
            $log_header .= 'Backup log' . "\n";
            $log_header .= '----------------------------------------------' . "\n";
            $log_header .= 'DATESTAMP:             DUMPED		MAILED' . "\n";
            $log_header .= '----------------------------------------------';

            if (fwrite($handle, $log_header) === false)
                exit;
        }

        echo 'Log header written: ';
        if (fwrite($handle, $log_header) === false) {
            echo 'no<br />' . "\n";
            exit;
        } else {
            echo 'yes<br />' . "\n";
        }

        echo 'Log status written: ';
        if (fwrite($handle, $log_content) === false) {
            echo 'no<br />' . "\n";
            exit;
        } else {
            echo 'yes<br />' . "\n";
        }
    }

    fclose($handle);

    if ($send_log) {
        echo '<h2>Sending log...</h2>';
        send_attachment($log_file, false);
    }
}

echo '<h2>Setup</h2>';
$date_stamp = date_stamp();
$backup_filename = backup_filename();
$init = write_log();

echo '<br /><br />...<br /><br />If all letters are green and you received the files, you\'re good to go!<br />Remove '#' from this folder’s .htaccess file NOW.</body></html>';
?>
