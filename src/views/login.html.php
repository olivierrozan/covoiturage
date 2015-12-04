<h1>
    <?php echo $title; ?>
</h1>

<p>
	<a href='index.php?controller=user&action=createuser'><button>Nouvel Utilisateur</button></a>
</p>

<form action="?controller=user&action=login" method="POST">
    <label>Login : </label><br>
    <input type="text" name="login"/><br><br>
    
    <label>Mot de Passe : </label><br>
    <input type="password" name="password"/><br><br>
    
    <input type="submit" name="LOGIN"/>
</form>