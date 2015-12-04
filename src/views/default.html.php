<h1>
    <?php echo $title; ?>
</h1>

<p>
    <?php 
    foreach ($data as $oneData) {
        echo '<li>';
        echo $oneData['id'] . " " . $oneData['email']; 
        echo '</li>';
    }
    ?>
</p>

<p>
	<a href='index.php?controller=user&action=logout'><button>Logout</button></a>
</p>