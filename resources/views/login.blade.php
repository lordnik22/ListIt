<div id="loginBlock">
    <form method="POST" action="/login">
        <fieldset>
            <legend>Login</legend>
            <label>
                <span>Benutzername</span>
                <input type="text" name="user" value="{{ $name }}" />
            </label>
            <label>
                <span>Passwort</span>
                <input type="password" name="password" value="{{ $password }}"/>
            </label>
            <input type="submit"/>
        </fieldset>
    </form>
</div>