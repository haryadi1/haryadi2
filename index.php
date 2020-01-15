<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>..::: Login User :::..</title>
<link rel="stylesheet" type="text/css" href="style_login.css" />

<link rel="shortcut icon" href="images/images_admin/favicon.ico" />

<script type="text/javascript">
function validasi(form){
if (form.username.value == ""){
alert("Anda belum mengisikan Username");
form.username.focus();
return (false);
}
     
if (form.password.value == ""){
alert("Anda belum mengisikan Password");
form.password.focus();
return (false);
}
return (true);
}
</script>

</head>

<body OnLoad="document.login.username.focus();">
<div id="main">

<!-- Header -->
<div id="header">.:: LOGIN USER ::.</div>

<!-- Middle -->
<div id="middle">
<form id="form-login" name="login" method="post" action="cek_login.php" onSubmit="return validasi(this)">
  
  <img src="images/images_login/img_login_user.png" align="absmiddle" class="img_user" />
  <input type="text" name="username" size="29" id="input" />
  <br />
	
  <img src="images/images_login/img_login_pass.png" align="absmiddle" class="img_pass" />
  <input type="password" name="password" size="29" id="input" />
  <br />
  
  <input name="Submit" type="image" value="Submit" src="images/images_login/button_login2.png" id="submit" align="absmiddle" />
</form>
  * Pegawai yang belum mempunyai user untuk login silahkan registrasi disini <a style="color:#ffcf43" href='registrasi.php'>Registrasi Pegawai</a> , selanjutnya silahkan login menggunakan NIP dan password *
</div>

<!-- don't Change ;) -->
<div class="clear"></div>

<!-- Footer -->


<!-- vertical_effect -->
<div id="vertical_effect">&nbsp;</div>

</div>
</body>
</html>
