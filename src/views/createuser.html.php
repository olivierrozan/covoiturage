<h1>
    <?php echo $data['title']; ?>
</h1>

<form action="<?php echo $data['formAction']; ?>" method="POST">
    <?php
    foreach ($data['fields'] as $fieldname => $fieldtype) {
        echo "<label>" . $fieldname . " : </label><br>";
        echo '<input type"' . $fieldtype . '" name="' . $fieldname . '"/><br><br>';
    }
    ?>
    
    <input type="submit" value="ok"/>
</form>