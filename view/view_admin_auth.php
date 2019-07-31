<style>
/* Design based on Blue Login Field of Kevin Sleger https://codepen.io/MurmeltierS/pen/macKb */

.form {
  position: relative;
  /* top: 50%; */
  /* left: 50%; */
  background: #fff;
  width: 285px;
  /* margin: -140px 0 0 -182px; */
  padding: 40px;
  box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
  margin-bottom: 40px;
}
.form h2 {
  margin: 0 0 20px;
  line-height: 1;
  color: #44c4e7;
  font-size: 18px;
  font-weight: 400;
}
.form input {
  outline: none;
  display: block;
  width: 100%;
  margin: 0 0 20px;
  padding: 10px 15px;
  border: 1px solid #ccc;
  color: #ccc;
  font-family: "Roboto";
  box-sizing: border-box;
  font-size: 14px;
  font-wieght: 400;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  transition: 0.2s linear;
}
.form inputinput:focus {
  color: #333;
  border: 1px solid #44c4e7;
}
.form button {
  cursor: pointer;
  background: #44c4e7;
  width: 100%;
  padding: 10px 15px;
  border: 0;
  color: #fff;
  font-family: "Roboto";
  font-size: 14px;
  font-weight: 400;
}
.form button:hover {
  background: #369cb8;
}
.error,
.valid {
  display: none;
}
</style>

<section class="form">
  <h1>Sign In</h1>
  <p class="valid">Valid. Please wait a moment.</p>
  <p class="error">Error. Please enter correct Username &amp; password.</p>
  <form class="loginbox" autocomplete="off">
    <input placeholder="Username" type="text" id="username"></input>
    <input placeholder="Password" type="password" id="password"></input>
<button id="submit">Login</button>
</form>
</section>

<hr />
<a href="/">logout</a>