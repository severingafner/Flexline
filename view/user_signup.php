<div class="container">
  <div class="error-container"></div>
  <form action="/user/createAccount" method="post">
    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
      	<div class="input-group">
		  <span class="input-group-addon" id="email-addon"><i class=" fa fa-user"></i></span>
        	<input type="email" class="form-control" id="email" name="email" placeholder="Email">
		</div>
      </div>
    </div>
    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
      <div class="col-sm-10">
      	<div class="input-group">
		  <span class="input-group-addon" id="pwd-addon"><i class=" fa fa-lock"></i></span>
        	<input type="password" class="form-control" id="password" name="password" placeholder="Password">
		</div>
      </div>
    </div>
    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Passwort wiederholen</label>
      <div class="col-sm-10">
      	<div class="input-group">
		  <span class="input-group-addon" id="pwd-repeat-addon"><i class=" fa fa-lock"></i></span>
        	<input type="password" class="form-control" id="password-repeat" name="password-repeat" placeholder="Password">
		</div>
      </div>
    </div>
    <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <input type="submit" name="register" value="Registrieren" class="btn btn-primary">
      </div>
    </div>
  </form>
</div>

