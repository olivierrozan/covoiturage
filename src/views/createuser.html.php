<section id="about-section" class="about-section">
    <div class="container">
        <div class="row">
            <h1>
                <?php 
                echo $title;
                ?>
            </h1>
            <a href='index.php?controller=user&action=login'><button class="btn btn-sm btn-primary">Je suis déjà membre</button></a>
            <h4>
                <?php
                if (isset($_REQUEST["error"])) {
                    echo "Formats incorrects";
                }
                ?>
            </h4>

            <form action="?controller=user&action=insert" method="POST">

                <label for="nom">Nom : </label><br>
                <input id="nom" class="input" type="text" name="Nom" onblur="verifNom(this)" required/><br><br>
                <label for="prenom">Prenom : </label><br>
                <input id="prenom" class="input" type="text" name="Prenom" onblur="verifPrenom(this)" required/><br><br>
                <label for="email">Email : </label><br>
                <input id="email" class="input" type="email" name="Email" onblur="verifMail(this)" required/><br><br>
                <label for="tel">Telephone : </label><br>
                <input id="tel" class="input" type="tel" name="Telephone" placeholder="xx.xx.xx.xx.xx" onblur="verifTel(this)" required/><br><br>

                <input type="submit" class="btn btn-sm btn-primary" value="ok"/>
                <input type="button" class="btn btn-sm btn-primary" onclick="window.location='index.php?controller=offers&action=mesoffres'" value="annuler"/>
                
            </form>
            <br>
            
        </div>
    </div>
</section>

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