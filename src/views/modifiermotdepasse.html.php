<section id="about-section" class="about-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    <?php 
                    echo $title;
                    ?>
                </h1>
            </div>
            
            <form action="?controller=user&action=updatepassword" method="POST">
                <label for="password">Mot de Passe (6 à 12 caractères) : </label><br>
                <input id="password" type="password" name="password" onblur="verifMdp(this)" required/><br><br>

                <label for="confirmPassword">Confirmer Mot de Passe : </label><br>
                <input id="confirmPassword" type="password" name="confirmPassword" onblur="verifMdp2()" required/><br><br>

                <input type="submit" name="VALIDER"/>
            </form>
        </div>
    </div>
</section>

<script>
    function verifMdp(champ) {
        var regex = /[a-zA-Z0-9]{6,12}/;
        if (regex.test(champ.value)) {
            $("#password").css("border", "3px solid green");
        }
        else {
            $("#password").css("border", "3px solid red");
        }
    }
    
    function verifMdp2() {
        var p1 = $("#password").val();
        var p2 = $("#confirmPassword").val();
        
        if (p1 === p2) {
            $("#confirmPassword").css("border", "3px solid green");
        }
        else {
            $("#confirmPassword").css("border", "3px solid red");
        }
    }
    
</script>