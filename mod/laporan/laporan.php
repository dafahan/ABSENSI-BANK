<?php 
if ($mod ==''){
    header('location:../404');
    echo'kosong';
}else{
    include_once 'mod/sw-header.php';
    require_once'./library/phpqrcode/qrlib.php'; 
if(!isset($_COOKIE['COOKIES_MEMBER'])){
            setcookie('COOKIES_MEMBER', '', 0, '/');
            setcookie('COOKIES_COOKIES', '', 0, '/');
            // Login tidak ditemukan
            setcookie("COOKIES_MEMBER", "", time()-$expired_cookie);
            setcookie("COOKIES_COOKIES", "", time()-$expired_cookie);
            session_destroy();
            header("location:./index");
    }else{
echo'
        <div class="form-group">
        <label class="col-sm-2 control-label">Foto</label>
        <div class="col-sm-6">
          <img width="80" class="preview" src="./assets/img/boxed-bg.jpg"><br><br>
          <input type="file" id="imgInp" class="btn btn-default" id="file" name="photo" required="" accept="image/jpeg, image/jpg, image/gif" capture>
        </div>
      </div>';
  }
  include_once 'mod/sw-footer.php';
} ?>