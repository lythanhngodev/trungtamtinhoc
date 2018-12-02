<?php require_once '../__.php';
error_reporting(0);
$us = chuoiid(20);
$pa = chuoiid(21);
session_start();
if (!isset($_SESSION['_cip']) || empty($_SESSION['_cip']) || $_SESSION['_cip']!=$_REQUEST['cip']) {echo "<h2>Đâu dễ phá vậy</2>";die();}
unset($_SESSION['cip']);
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

<style>.login-box {background: #fff;width: 400px;height: 500px;margin-top: 5%;border-radius: 6px;}.form-box {width: 400px;padding: 55px 40px;border-radius: 0 10px 10px 0;float: left;}.form-box i {font-size: 50px;margin-bottom: 15px;}.form-box h2 {margin-bottom: 25px;}</style>
  <div class="container">
    <div class="login-box mx-auto">
      <div class="form-box float-md-left text-md-center">
        <img src="../lab/i/logo.jpg" width="100" height="100"><br><br>
        <h2>Center for Informatics</h2>
        <form action="../lg/login.php" method="POST">
          <div class="form-group">
                <label class="sr-only">Username</label>
                <input type="text" class="form-control" placeholder="Username" name="<?php echo $_SESSION['_idus']; ?>" required="required" pattern=".{5,}" title="Tên đăng nhập trên 5 ký tự">
              </div>
          <div class="form-group">
                <label for="exampleInputPassword1" class="sr-only">Password</label>
                <input type="password" class="form-control" name="<?php echo $_SESSION['_idpa']; ?>" placeholder="Password" required="required" pattern=".{8,}" title="Mật khẩu trên 8 ký tự">
            </div>
          <button type="submit" class="btn btn-success btn-block">Đăng nhập</button><br>
          <p><small class="text-muted"><a>Quên mật khẩu?</a></small></p>
        </form>
      </div>
    </div>
  </div>
  <div style="position: fixed;bottom: 0;height: 20px;width: 100%;background: #28a745;color: #fff;line-height: 20px;font-size: 90%;padding-left: 1rem;font-family: monospace;text-align: center;">© Copyright of Ngô Thanh Lý (Faculty of Information Technology 2014) | Phone: (+84) 794 967 197</div>