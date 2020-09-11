<style>
:root {
  --input-padding-x: 1.5rem;
  --input-padding-y: .75rem;
}

body {
  background: #007bff;
  background: linear-gradient(to right, #0062E6, #33AEFF);
}

.card-signin {
  border: 0;
  border-radius: 1rem;
  box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
}

.card-signin .card-title {
  margin-bottom: 2rem;
  font-weight: 300;
  font-size: 1.5rem;
}

.card-signin .card-body {
  padding: 2rem;
}

.form-signin {
  width: 100%;
}

.form-signin .btn {
  font-size: 80%;
  border-radius: 5rem;
  letter-spacing: .1rem;
  font-weight: bold;
  padding: 1rem;
  transition: all 0.2s;
}

.form-label-group {
  position: relative;
  margin-bottom: 1rem;
}

.form-label-group input {
  height: auto;
  border-radius: 2rem;
}

.form-label-group>input,
.form-label-group>label {
  padding: var(--input-padding-y) var(--input-padding-x);
}

.form-label-group>label {
  position: absolute;
  top: 0;
  left: 0;
  display: block;
  width: 100%;
  margin-bottom: 0;
  /* Override default `<label>` margin */
  line-height: 1.5;
  color: #495057;
  border: 1px solid transparent;
  border-radius: .25rem;
  transition: all .1s ease-in-out;
}

.form-label-group input::-webkit-input-placeholder {
  color: transparent;
}

.form-label-group input:-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-moz-placeholder {
  color: transparent;
}

.form-label-group input::placeholder {
  color: transparent;
}

.form-label-group input:not(:placeholder-shown) {
  padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
  padding-bottom: calc(var(--input-padding-y) / 3);
}

.form-label-group input:not(:placeholder-shown)~label {
  padding-top: calc(var(--input-padding-y) / 3);
  padding-bottom: calc(var(--input-padding-y) / 3);
  font-size: 12px;
  color: #777;
}

.btn-google {
  color: white;
  background-color: #ea4335;
}

.btn-facebook {
  color: white;
  background-color: #3b5998;
}
</style>





	<p>		
	<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
		  <center>
			  <span class="avatar"><img src="/assets/image.png" alt="" width="200px" /></span>
			</center>
			<br>
			<h5 class="card-title text-center">Se connecter</h5>
            <form class="form-signin" name="inscription" action="/Controleur/ctrl_connexion_membre.php" method="POST">
              <div class="form-label-group">
                <input type="text" name="conn_login" id="conn_login" class="form-control" placeholder="Email address" required autofocus>
                <label for="conn_login">Login</label>
              </div>

              <div class="form-label-group">
                <input type="password" name="conn_pass" id="conn_pass" class="form-control" placeholder="Password" required>
                <label for="conn_pass">Mot de passe</label>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="conn_savepwd" name="conn_savepwd">
                <label class="custom-control-label" for="conn_savepwd">Retenir mot de passe</label>
                
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="loginForm">Se connecter</button>

              <hr class="my-4">
              <button onclick="location.href = '/Controleur/ctrl_inscription_membre.php';" class="btn btn-lg btn-danger btn-block text-uppercase" id="inscription">S'inscrire</button>
              
              
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

	
	</p>

