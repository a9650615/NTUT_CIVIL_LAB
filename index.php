
<?php 
/* Main page with two forms: sign up and log in */\
header("Content-Type:text/html; charset=utf-8");
require 'db.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>福住建設股份有限公司</title>
  <?php include 'css/css.html'; ?>
</head>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //user logging in

        require 'login.php';
        
    }
    
    elseif (isset($_POST['register'])) { //user registering
        
        require 'register.php';
        
    }
}
?>
<body>
  <div class="form">
      
      <ul class="tab-group">
        <li class="tab"><a href="#signup">註 冊</a></li>
        <li class="tab active"><a href="#login">登 入</a></li>
      </ul>
      
      <div class="tab-content">

         <div id="login">   
          <h1>歡迎回來！</h1>
          
          <form action="index.php" method="post" autocomplete="off">
          
            <div class="field-wrap">
            <label>
              員工 ID<span class="req">*</span>
            </label>
            <input type="text" required autocomplete="off" name='Employee_ID'/>
          </div>
          
          <div class="field-wrap">
            <label>
              請輸入密碼<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" name="password"/>
          </div>
          
          <p class="forgot"><a href="forgot.php">忘記密碼？</a></p>
          
          <button class="button button-block" name="login" />登 入</button>
          
          </form>

        </div>
          
        <div id="signup">   
          <h1>註 冊</h1>
          
          <form action="index.php" method="post" autocomplete="off">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                姓名<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='name' />
            </div>
        
            <div class="field-wrap">
              <label>
                員工ID<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='Employee_ID' />
            </div>
          </div>

          <div class="field-wrap">
            <label>
              電子信箱<span class="req">*</span>
            </label>
            <input type="email" required autocomplete="off" name='email' />
          </div>
          
          <div class="field-wrap">
            <label>
              輸入密碼<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" name='password'/>
          </div>
          
          <button type="submit" class="button button-block" name="register" />註 冊</button>
          
          </form>

        </div>  
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
