<h1>
    <?php 
    echo $title;
    ?>
</h1>

<form action="?controller=default&action=updateoffrearrivee&id=<?php echo $_GET['id']; ?>" method="POST">
    
    <label for="jour">Jour : </label><br>
    <input id="jour" type="text" name="jour" value="<?php echo $data["jour"]; ?>" required/><br><br>
    <label for="date">Date : </label><br>
    <input id="date" type="text" name="date" value="<?php echo $data["date"]; ?>" required/><br><br>
    <label for="heure">Heure : </label><br>
    <input id="heure" type="text" name="heure" value="<?php echo $data["heure"]; ?>" required/><br><br>
    <label for="depart">Depart : </label><br>
    <input id="depart" type="text" name="depart" value="<?php echo $data["depart"]; ?>" required/><br><br>
    
    <input type="submit" value="ok"/>
</form>

<p>
	<a href='index.php?controller=default&action=mesoffres'><button>Annuler</button></a>
</p>