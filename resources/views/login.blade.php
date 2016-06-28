<div id="loginBlock">
    <form method="POST" action="/login">
        <fieldset>
            <legend>Login</legend>
            <hr/>
            <label>
                <span>Benutzername</span>
                <input type="text" name="user" value="{{ $name }}" />
            </label>
            <label>
                <span>Passwort</span>
                <input type="password" name="password" value="{{ $password }}"/>
            </label>
            <input type="submit" value="Login"/>
        </fieldset>
    </form>
</div>