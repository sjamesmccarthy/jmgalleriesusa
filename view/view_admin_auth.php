<section id="login" class="form">
  <div style="width: 50%; margin: auto; margin-top: 40px; margin-bottom: 40px;">

  <h1 style="padding-bottom: 20px;">Portfolio. Inventory. Collector. </h1>
  <form action="/admin" class="" autocomplete="off" method="post">
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

    <p style="margin-top: 10px; text-align: left"><a href="/">Forgot password</a></p>
  </form>
  </div>
</section>