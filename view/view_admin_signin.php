<section id="login" class="form">
  <div class="grid-2-center signin--container">
  
    <div class="col">
      <h1 style="padding-bottom: 20px;">Sign In </h1>
      <form action="/studio/auth" class="" autocomplete="off" method="post">
        <input type="hidden" name="state" value="auth" />

        <div>
        <label for="username">username</label>
        <input placeholder="YOUR EMAIL IS YOUR USERNAME" type="text" id="username" name="username" value="<?= $username ?>" tabindex="1"></input>
        </div>

        <!-- <div>
        <label>password</label>
        <input placeholder="Password" type="password" id="password" name="password"></input>
        </div> -->

        <div class="form_pincode">
          <input class="" type="tel" name="p_1" maxlength="1"  tabindex="2" placeholder="-" autocomplete="off">
          <input class="" type="tel" name="p_2" maxlength="1"  tabindex="3" placeholder="-" autocomplete="off">
          <input class="" type="tel" name="p_3" maxlength="1"  tabindex="4" placeholder="-" autocomplete="off"> 
          <input class="" type="tel" name="p_4" maxlength="1"  tabindex="5" placeholder="-" autocomplete="off">
          <input class="" type="tel" name="p_5" maxlength="1"  tabindex="6" placeholder="-" autocomplete="off">
          <input class="" type="tel" name="p_6" maxlength="1"  tabindex="7" placeholder="-" autocomplete="off">
        </div>

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
    
    $(".form_pincode input").keyup(function () {
        if (this.value.length == this.maxLength) {
          console.log(this.name);
          $(this).addClass('toUpper');
          $(this).next('input').focus();
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