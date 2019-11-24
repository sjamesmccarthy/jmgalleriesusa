<style>
  #login { 
    padding: 40px 0;
  }
</style>

<section id="login" class="form">
  <div class="grid-3-center">
  <div class="col">
  <h1 style="padding-bottom: 20px;">Login. </h1>
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
      <a href="/admin/console/"><button style="margin-top: 20px;" id="submit">Login</button></a>
    </div>

    <!-- <p style="margin-top: 10px; text-align: left"><a href="/">Forgot password</a></p> -->
  </form>
</div>
  </div>
</section>