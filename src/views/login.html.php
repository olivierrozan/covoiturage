<h1>
    <?php 
    echo $title . "<br>";
    /*
     * jdurand : aaaaaa
     * jduval : bbbbbb
     * lahmad : cccccc
     * jbieber : OcXjds
     * orozan : OzTprP
     */
    ?>
</h1>

<h3>
    <?php
    if (isset($_REQUEST["error"])) {
        echo "Mot de passe incorrect";
    }
    ?>
</h3>

<p>
	<a href='index.php?controller=user&action=createuser'><button>Pas encore inscrit?</button></a>
</p>

<form action="?controller=user&action=login" method="POST">
    
    <label>Login ou Email : </label><br>
    <input type="text" name="login" value="orozan"/><br><br>
    
    <label>Mot de Passe : </label><br>
    <input type="password" name="password" value="OzTprP"/><br><br>
    
    <input type="submit" name="LOGIN"/>
</form>