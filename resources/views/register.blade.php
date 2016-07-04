<form method="POST" action="/users">
    <h3>Registration</h3>
    <div class="input-field col s12">
        <input id="registername" name="user" type="text" value="" />
        <label for="registername">Benutzername</label>
    </div>
    <div class="input-field col s12">
        <input id="registerpassword" name="password" type="password" value="" />
        <label for="registerpassword">Passwort</label>
    </div>    
    <div class="input-field col s12">
        <input id="registerpassword2" name="password2" type="password" value="" />
        <label for="registerpassword2">Passwort wiederholen</label>
    </div> 
    <div class="input-field col s12">
        <input id="registeremail" name="email" type="text" value="" >
        <label for="registeremail">Email</label>
    </div> 
    <button class="btn waves-effect waves-light light-blue" type="submit" name="action">
        Registrieren
    </button>
</form>