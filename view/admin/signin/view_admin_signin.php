<section id="login" class="form">
  <div class="grid-center signin--container">
  
    <div class="col signin--area">
      <h1 class="pb-16 text-center light"><?= $title ?></h1>
      <form action="<?= $action_URI ?>" class="" autocomplete="off" method="post">
        <input type="hidden" name="state" value="auth" />
        <input type="hidden" name="redirect_BADLOGIN" value="<?= $redirect_BADLOGIN ?>" />

        <div>
        <label for="username">username</label>
        <input class="mb-0 text-center" placeholder="PLEASE SIGN-IN WITH YOUR USERNAME" type="text" id="username" name="username" value="<?= $username ?>" tabindex="1"></input>
        </div>

        <div class="mt-16">
        <label>password</label>
        <input class="text-center" placeholder="Password" type="password" id="p_1" name="p_1"></input>
        </div>

        <!-- <div class="form_pincode">
          <input class="" type="tel" name="p_1" maxlength="1"  tabindex="2" placeholder="-" autocomplete="off">
          <input class="" type="tel" name="p_2" maxlength="1"  tabindex="3" placeholder="-" autocomplete="off">
          <input class="" type="tel" name="p_3" maxlength="1"  tabindex="4" placeholder="-" autocomplete="off"> 
          <input class="" type="tel" name="p_4" maxlength="1"  tabindex="5" placeholder="-" autocomplete="off">
          <input class="" type="tel" name="p_5" maxlength="1"  tabindex="6" placeholder="-" autocomplete="off">
          <input class="" type="tel" name="p_6" maxlength="1"  tabindex="7" placeholder="-" autocomplete="off">
        </div> -->

        <div class="mt-16">
          <a href="/admin/console/"><button id="submit" class="make-wide">Login</button></a>
        </div>

        <div>
          <p class="pt-16">
            <input type="checkbox" id="remember_me" name="remember_me" value="1" <?= (isSet($_COOKIE['username']) ? "CHECKED" : ""); ?> /> 
            <label for="remember_me">always remember my username</label>
          </p>
        </div>


        <p class="error <?= $showError ?>"><i class="fas fa-bomb large"></i><br />
        you bombed that sign-in, try again (<?= $_SESSION['login_attempt'] ?>)</p>

        <!-- <p class="signout <?= $showSignOut ?>"><i class="fas fa-user-slash larger"></i><br />
        you are now signed out</p> -->

      </form>
    </div>
  </div>
</section>

<script>
jQuery(document).ready(function($){
    
    $(".form_pincode input").on("click",function() {
          $(this).val('');
          $(this).removeClass("mask");
    });

    $(".form_pincode input").on("keyup", function () {
        if (this.value.length == this.maxLength) {
          console.log(event.which);
          $(this).addClass('mask','toUpper');
          $(this).next('.form_pincode input').focus();
        }
    });

    $('#remember_me').on("click", function() {

        let username = $('#username').val();

        if(getCookie('username') == false) {
          setCookie('username',username,'30');
          console.log('cookie.Set(' + username + ')');
        } else {
          console.log('cookie.unSet(' + username + ')');
          setCookie('username',username,'0');
        }

      });
    
  });

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

</script>