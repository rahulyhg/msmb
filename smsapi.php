<?php
/* HaariSoft sms api...............Way2sms api.......... *//* harishjose007@rediffmail.com */

if (isset($_POST['tomobile']) && isset($_POST['message'])) {
#    if (false) {
        $cookie_file_path = "/cookie.txt";
        $username = "8050085007";
        $password = "nishant";
        #$tomobno = "8050085007";
        $tomobno = $_POST['tomobile'];
        #$message = "hai...";
        $message = $_POST['message'];
        $agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://site4.way2sms.com/Login1.action");
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_fie_path);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "mobileNo=&message=&username=$username&password=$password");
        $html1 = curl_exec($ch);
        curl_setopt($ch, CURLOPT_URL, "http://site4.way2sms.com/quicksms.action");
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_fie_path);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "HiddenAction=instantsms&catnamedis=Sushant&Action=sa65sdf656fdfd&chkall=on&MobNo=$tomobno&textArea=$message");
        $html2 = curl_exec($ch);
        if(preg_match("/200 OK/", $html2)) {
            $success = "<font color='green'>Message sent successfully to $tomobno </font><br/><br/>";
        } else {
            print_r($html2);
        }
        
    } else {
            $success = null;
    }
?>

<html>
    <head></head>
    <body>
        <center>
            <?php echo isset($success)? $success : '';?>
            <form action="" method="post">
                <table>
                    <tr>
                        <td>To Number:</td>
                        <td><input type="text" length="10" name="tomobile"/></td>
                    </tr>
                    <tr>
                        <td>Message</td>
                        <td>
                            <textarea name="message" col="5" row="3"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Send" /></td>
                    </tr>
                </table>
            </form>
        </center>
    </body>
</html>