<div class="container">
  <form action="/user/login" method="post">
    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
      	<div class="input-group">
		  <span class="input-group-addon" id="basic-addon2"><i class=" fa fa-user"></i></span>
        	<input type="email" class="form-control" id="email" name="email" placeholder="Email">
		</div>
      </div>
    </div>
    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
      <div class="col-sm-10">
      	<div class="input-group">
		  <span class="input-group-addon" id="basic-addon2"><i class=" fa fa-lock"></i></span>
        	<input type="password" class="form-control" id="password" name="password" placeholder="Password">
		</div>
      </div>
    </div>
    <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <input type="submit" name="login" value="Login" class="btn btn-primary">
      </div>
    </div>
  </form>
</div>


