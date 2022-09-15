<?php 
require_once 'b_process.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>bestellingen</title>
    <center>
    <img src="img\logo.png" width="120" height="120">
        <h3>Welkom op bestellings pagina</h3>
        <p>Neem hier de bestellingen van de klanten op.</p>
        <a href="bestelling.php">bestellingen</a>
        <a href="reservering.php">reserveren</a>
        <a href="bar.php">bar</a>
        <a href="keuken.php">keuken</a>
        <a href="menu.php">menu</a>
</center>
</head>
<body>
    <?php 
    $result = pdo($pdo, "SELECT * FROM bestelling");
    ?>
    <center>
    <Table>
        <thead>
            <?php while ($row = $result->fetch()): ?>
            <tr>
                <th>Tafel Nummer:</th>
                <td><?php echo $row['tafel_nr'];?></td>
                <th>eten:</th>
                <td><?php echo $row['eten'];?></td>
                <th>drinken:</th>
                <td><?php echo $row['drinken'];?></td>
                <th>Eten aantal:</th>
                <td><?php echo $row['eten_aantal'];?></td>
                <th>Drinken aantal:</th>
                <td><?php echo $row['drinken_aantal'];?></td>
                <th>bestel tijd:</th>
                <td><?php echo $row['bestel_tijd'];?></td>
                <th colspan="2">Action</th>
                <td>
                    <a href="bestelling.php?edit=<?php echo $row['bestelling_id']; ?>">edit</a>
                    <a href="b_process.php?delete=<?php echo $row['bestelling_id']; ?>">delete</a>
                </td>
            </tr>
        </thead>
        <?php endwhile; ?>
    </Table>
        </center>
    <form action="b_process.php" method="post">
        <input type='submit' name='bon' value='bon to excel file' />
        <input type="hidden" name="bestelling_id" value="<?php echo $bestelling_id;?>">
    <center>
        <label>Tafel Nummer</label>
        <input type="text" name="tafel_nr" value="<?php echo $tafel_nr;?>" placeholder="tafel Nummer"><br>

        <label>Eten</label>
        <select name="eten">
            <option value="Geen">Geen</option>
            <option value="Hamburger">Hamburger</option>
            <option value="kip">Kip</option>
            <option value="biefstuk">Biefstuk</option>
        </select><br>

        <label>Eten aantal</label>
        <input type="text" name="eten_aantal" value="0" placeholder="0"><br>

        <label>Drinken</label>
        <select name="drinken">
            <option value="Geen">Geen</option>
            <option value="Cola">Cola</option>
            <option value="Fanta">Fanta</option>
            <option value="Water">Water</option>
        </select><br>

        <label>Drinken aantal</label>
        <input type="text" name="drinken_aantal" value="0" placeholder="0"><br>


        <label>bestel tijd</label>
        <input type="text" name="bestel_tijd" value="<?php echo date('H:i:s');?>">
        <?php if ($update == true) :?>
        <button type="submit" name="update">Update</button>
        <?php else : ?>
        <button type=" submit" name="save">save</button>
        <?php endif; ?>
    </center>
    </form>
   </body>
</html>