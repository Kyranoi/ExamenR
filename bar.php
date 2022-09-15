<?php 
    require_once 'b_process.php' 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bar</title>
    <center>
    <img src="img\logo.png" width="120" height="120">
        <h3>Welkom op de bar pagina</h3>
        <p>Bestelde dranken.</p>
        <a href="bestelling.php">bestellingen</a>
        <a href="reservering.php">reserveren</a>
        <a href="bar.php">bar</a>
        <a href="keuken.php">keuken</a>
        <a href="menu.php">menu</a> 
</center>
</head>
<body>
    <br></br>

    <?php 
    $result = $pdo->query("SELECT tafel_nr, drinken, drinken_aantal, bestel_tijd FROM bestelling ORDER BY bestel_tijd ASC"); ?>
    <center>
    <Table>
        <thead>
            <?php while ($row = $result->fetch()): ?>
            <tr>
                <th>Tafel Nummer:</th>
                <td><?php echo $row['tafel_nr'];?></td>
                <th>drinken:</th>
                <td><?php echo $row['drinken'];?></td>
                <th>aantal drinken:</th>
                <td><?php echo $row['drinken_aantal'];?></td>
                <th>bestel tijd:</th>
                <td><?php echo $row['bestel_tijd'];?></td>
                <td>
                    <a href="process.php?delete=<?php echo $row['reserver_id']; ?>">delete</a>
                </td>
            </tr>
        </thead>
        <?php endwhile; ?>
    </table>
    </center>    
    <?php
        //delete knop bestelling
        if (isset($_GET['delete'])) {
            $bestelling_id = $_GET['delete'];
            $pdo->query("DELETE FROM bestelling WHERE bestelling_id=$bestelling_id");

            header("location: bestelling.php");
        }   
?>
</body>
</html>