<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>


<form id="form1" name="form1" enctype="multipart/form-data" method="post" >
  <input type="file" name="community" id="community" /><input type="submit" name="sub" />
</form>
<?
if($_POST['sub']){
$community1=basename($_FILES['community']['name']);
if($community1!=""){

$dir='userthumbnail';
$community_certificate="CC_".$community1;
$new2 = $dir."/".$community_certificate;
$result1 = move_uploaded_file($_FILES['community']['tmp_name'],$new2);

}
}
?>


</body>
</html>
