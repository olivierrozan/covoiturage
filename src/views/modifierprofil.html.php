<h1>
    <?php 
    echo $data['title'];
    ?>
</h1>

<form action="?controller=user&action=updateprofil" method="POST">
    
    <label for="nom">Nom : </label><br>
    <input id="nom" type="text" name="Nom" value="<?php echo $profil["nom"]; ?>" onblur="verifNom(this)" required/><br><br>
    <label for="prenom">Prenom : </label><br>
    <input id="prenom" type="text" name="Prenom" value="<?php echo $profil["prenom"]; ?>" onblur="verifPrenom(this)" required/><br><br>
    <label for="email">Email : </label><br>
    <input id="email" type="email" name="Email" value="<?php echo $profil["email"]; ?>" onblur="verifMail(this)" required/><br><br>
    <label for="tel">Telephone : </label><br>
    <input id="tel" type="tel" name="Telephone" value="<?php echo $profil["tel"]; ?>" placeholder="xx.xx.xx.xx.xx" onblur="verifTel(this)" required/><br><br>
    
    <input type="submit" value="ok"/>
</form>

<p>
	<a href='index.php?controller=user&action=profil'><button>Annuler</button></a>
</p>

<script>
    function verifNom(champ) {
        var regex = /[a-zA-Z]{3,}/;
        if (regex.test(champ.value)) {
            $("#nom").css("border", "3px solid green");
        }
        else {
            $("#nom").css("border", "3px solid red");
        }
    }
    
    function verifPrenom(champ) {
        var regex = /[a-zA-Z]{3,}/;
        if (regex.test(champ.value)) {
            $("#prenom").css("border", "3px solid green");
        }
        else {
            $("#prenom").css("border", "3px solid red");
        }
    }
    
    function verifMail(champ) {
        var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
        if (regex.test(champ.value)) {
            $("#email").css("border", "3px solid green");
        }
        else {
            $("#email").css("border", "3px solid red");
        }
    }
    
    function verifTel(champ) {
        var regex = /^0[1-9]([.]?[0-9]{2}){4}$/;
        if (regex.test(champ.value)) {
            $("#tel").css("border", "3px solid green");
        }
        else {
            $("#tel").css("border", "3px solid red");
        }
    }
</script>