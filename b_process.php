<?php
include("db_config.php");

$bestelling_id = 0;
$update = false;
$tafel_nr = '';
$eten = '';
$drinken = '';
$eten_aantal = '';
$drinken_aantal = '';
$bestel_tijd = '';	

//save knop bestelling
if (isset($_POST['save'])) {

    $tafel_nr = $_POST['tafel_nr'];
    $eten = $_POST['eten'];
    $drinken = $_POST['drinken'];
    $eten_aantal = $_POST['eten_aantal'];
    $drinken_aantal = $_POST['drinken_aantal'];
    $bestel_tijd = $_POST['bestel_tijd'];
    pdo($pdo, "INSERT INTO bestelling (tafel_nr, eten, drinken, eten_aantal, drinken_aantal, bestel_tijd) 
    VALUES(:tafel_nr, :eten, :drinken, :eten_aantal, :drinken_aantal, :bestel_tijd)", 
    [
        'tafel_nr'=> $tafel_nr, 
        'eten'=> $eten, 
        'drinken'=> $drinken,
        'eten_aantal'=> $eten_aantal,
        'drinken_aantal'=> $drinken_aantal,
        'bestel_tijd'=> $bestel_tijd
    ]);

    if ($pdo->lastInsertId()) {
        //header("Location: bar.php"); //success data insertion
        header("Location: bestelling.php?message=Record has been inserted successfully");
    }
}

//delete knop bestelling
if (isset($_GET['delete'])) {
    $bestelling_id = $_GET['delete'];
    $pdo->query("DELETE FROM bestelling WHERE bestelling_id=$bestelling_id");

    header("location: bestelling.php");
}

//edit data bestelling
if (isset($_GET['edit'])) {
    $bestelling_id = $_GET['edit'];
    $update = true;
    $row = pdo($pdo, "SELECT * FROM bestelling WHERE bestelling_id = $bestelling_id")->fetchAll();
    if (!empty($result)) {
        $tafel_nr= $row['tafel_nr'];
        $eten= $row['eten'];
        $drinken= $row['drinken'];
        $eten_aantal = $_POST['eten_aantal'];
        $drinken_aantal = $_POST['drinken_aantal'];
        $Bestel_tijd= $row['bestel_tijd'];
    }
    
    }
    //update data bestelling
    if (isset($_POST['update'])) {
    $bestelling_id = $_POST['bestelling_id'];
    $tafel_nr= $_POST['tafel_nr'];
    $eten= $_POST['eten'];
    $drinken= $_POST['drinken'];
    $eten_aantal = $_POST['eten_aantal'];
    $drinken_aantal = $_POST['drinken_aantal'];
    $Bestel_tijd= $_POST['bestel_tijd'];
        
    pdo($pdo,"UPDATE bestelling SET tafel_nr='$tafel_nr', eten='$eten', drinken='$drinken', eten_aantal='$eten_aantal', drinken_aantal ='$drinken_aantal', bestel_tijd='$Bestel_tijd' WHERE bestelling_id=$bestelling_id ");
        
        
    header("location: bestelling.php");
    }

//excel export bon
$output = '';
if (isset($_POST["bon"])) {
    $query = "SELECT * FROM bestelling ORDER BY bestelling_id DESC LIMIT 1";
    $result = pdo($pdo, $query);
    if (pdo($result) > 0) {
        $output .= '
   <table class="table" bordered="1">  
   <thead>
   <tr>
       <th>tafel nr</th>
       <th>eten</th>
       <th>drinken</th>
       <th>prijs eten</th>
       <th>prijs drinken</th>
       <th>totaal_prijs</th>
       <th>bestel tijd</th>
   </tr>
   </thead>
  ';
        $row = $result->fetch_assoc(); {
            $output .= '
   <tr>
   <td>' . $row['tafel_nr'] . '</td>
   <td>' . $row['eten'] . '</td>
   <td>' . $row['drinken'] . '</td>
   <td>' . $row['prijs_eten'] . '</td>
   <td>' . $row['prijs_drinken'] . '</td>
   <td>' . $row['totaal_prijs'] . '</td>
   <td>' . $row['bestel_tijd'] . '</td>      
   ';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=bon.xls');
        echo $output;
    }
}
?>