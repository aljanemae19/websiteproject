<?php include_once("include/header.php")?>
<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Login & Signup Form</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <section class="wrapper">
      <div class="form signup">
        <header>Registration Form</header>
        <form action="process_registration.php" method="post">
          <input type="text" placeholder="First name" required name="firstname"/>
		  <input type="text" placeholder="Last name" required name="lastname"/>
          <input type="number" placeholder="Age" required name="age"/>
          <input type="email" placeholder="Email" required name="email"/>
		  <input type="password" placeholder="Password" required name="password"/>
		  <select name="role" id="">
			<option value="">Role</option>
			<option value="staff">staff</option>
			<option value="admin">admin</option>
		  </select>
		  <select name="gender" id="">
			<option value="">Gender</option>
			<option value="male">Male</option>
			<option value="female">Female</option>
			<option value="others">Others</option>
		  </select>
          <input type="submit" value="Register" />
        </form>
      </div>

      <div class="form login">
        <header>Login</header>
        <form action="authenticate.php" method="post">
          <input type="email" placeholder="Email address" name="email"required />
          <input type="password" placeholder="Password" name="password"required />
          <a href="#">Forgot password?</a>
          <input type="submit" value="Login" />
        </form>
      </div>

      <script>
        const wrapper = document.querySelector(".wrapper"),
          signupHeader = document.querySelector(".signup header"),
          loginHeader = document.querySelector(".login header");

        loginHeader.addEventListener("click", () => {
          wrapper.classList.add("active");
        });
        signupHeader.addEventListener("click", () => {
          wrapper.classList.remove("active");
        });
      </script>
    </section>
  </body>
</html>
