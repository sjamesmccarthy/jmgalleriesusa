<style>
  #login { 
    padding: 40px 0;
  }
</style>

<section id="login" class="form">
  <div class="grid-3-center signin--container">
  <div class="col">
  <h1 style="padding-bottom: 20px;">Sign In </h1>
  <form action="/studio/auth" class="" autocomplete="off" method="post">
    <input type="hidden" name="state" value="auth" />

    <div>
    <label>username</label>
    <input placeholder="Username" type="text" id="username" name="username"></input>
    </div>

    <div>
    <label>password</label>
    <input placeholder="Password" type="password" id="password" name="password"></input>
    </div>

    <div style="text-align: right">
      <a href="/admin/console/"><button style="width: 100%; margin-top: 20px;" id="submit">Login</button></a>
    </div>

    <p class="error <?= $showError ?>"><i class="fas fa-bomb large"></i><br />
    you bombed that sign-in, try again (<?= $_SESSION['login_attempt'] ?>)</p>

    <p class="signout <?= $showSignOut ?>"><i class="fas fa-user-slash larger"></i><br />
    you are now signed out</p>

  </form>
</div>
  </div>
</section>