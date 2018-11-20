<?php require_once '../__.php';

$us = chuoiid(20);
$pa = chuoiid(21);
session_start();

$helper = array_keys($_SESSION);
foreach ($helper as $key){
    unset($_SESSION[$key]);
}
$_SESSION['_idus'] = $us;
$_SESSION['_idpa'] = $pa;
function sanitize_output($buffer) {

    $search = array(
        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
        '/( )+/s',         // shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/' // Remove HTML comments
    );

    $replace = array(
        '>',
        '<',
        '\\1',
        ''
    );
    $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
}
ob_start("sanitize_output");
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="<?php echo $ttth['HOST']; ?>">
    <link rel="icon" href="">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="./lab/css/bootstrap.min.css">
<style>body {background: #efefef;}.login-box {background: #fff;width: 800px;height: 530px;margin-top: 10%;border-radius: 6px;}.picture-box {background: url('./lab/i/signup-bg.jpg');width: 400px;height: 100%;background-size: cover;border-radius: 10px 0 0 10px;float: left;}.form-box {width: 400px;padding: 55px 40px;border-radius: 0 10px 10px 0;float: left;}.form-box i {font-size: 50px;margin-bottom: 15px;}.form-box h2 {margin-bottom: 25px;}</style>
    </head>
    <body>
<div class="container">
      <div class="login-box mx-auto">
    <div class="picture-box float-md-left"></div>
    <div class="form-box float-md-left text-md-center">
          <img src="./lab/i/logo.jpg" width="100" height="100"><br><br>
          <h2>Center for Informatics</h2>
          <form action="./lg/login.php" method="POST">
            <div class="form-group">
                  <label class="sr-only">Username</label>
                  <input type="text" class="form-control" placeholder="Username" name="<?php echo $_SESSION['_idus']; ?>" required="required" pattern=".{5,}" title="Tên đăng nhập trên 5 ký tự">
                </div>
            <div class="form-group">
                  <label for="exampleInputPassword1" class="sr-only">Password</label>
                  <input type="password" class="form-control" name="<?php echo $_SESSION['_idpa']; ?>" placeholder="Password" required="required" pattern=".{4,}" title="Mật khẩu trên 4 ký tự">
              </div>
            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button><br>
            <p><small class="text-muted"><a href="#">Quên mật khẩu?</a></small></p>
          </form>
        </div>
  </div>
    </div>
</body>
</html>
