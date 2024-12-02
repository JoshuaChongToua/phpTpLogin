<?php
echo '
<div class="login-container">
    <h2>Se connecter</h2>
    <form id="loginForm" action="/tp/index.php?ctrl=login&action=login" method="POST">
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" placeholder="Votre email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn">Se connecter</button>
        </div>
    </form>
</div>

';