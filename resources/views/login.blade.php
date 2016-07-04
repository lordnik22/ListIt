<form method="POST" action="/login">
    <h3>Login</h3>
    <div class="input-field col s12">
        <input id="loginname" name="user" type="text" value="{{ $name }}" />
        <label for="loginname">Benutzername</label>
    </div>
    <div class="input-field col s12">
        <input id="loginpassword" name="password" type="password" value="{{ $password }}" >
        <label for="loginpassword">Passwort</label>
    </div>

    <button class="btn waves-effect waves-light" type="submit" name="action">
        Login
    </button>
</form>
