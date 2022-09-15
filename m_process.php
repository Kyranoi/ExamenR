<?php 


include_once('db_config.php');

$menu_id = 0;
$update = false;
$eten = '';
$drinken = '';
$prijs = '';	

//save knop menu
if (isset($_POST['save'])){
    $eten= $_POST['eten'];
    $drinken= $_POST['drinken'];
    $prijs= $_POST['prijs'];

    pdo($pdo,"INSERT INTO menu (eten, drinken, prijs) VALUES( '$eten', '$drinken', '$prijs')");

    header("location: menu.php");

}
//delete knop menu
if (isset($_GET['delete'])) {
    $menu_id = $_GET['delete'];
    pdo($pdo,"DELETE FROM menu WHERE menu_id=$menu_id");

    header("location: menu.php");
}

//edit data menu
if (isset($_GET['edit'])) {
    $menu_id = $_GET['edit'];
    $update = true;
    $row = pdo($pdo,"SELECT * FROM menu WHERE $menu_id=menu_id");
    if (!empty($result)) {
        $row = $result->fetch_array();
        $eten= $row['eten'];
        $drinken= $row['drinken'];
        $prijs= $row['prijs'];
    }
    
    }
    //update data menu
if (isset($_POST['update'])) {
    $menu_id = $_POST['menu_id'];
    $eten= $_POST['eten'];
    $drinken= $_POST['drinken'];
    $prijs= $_POST['prijs'];
    
    pdo($pdo,"UPDATE menu SET eten='$eten', drinken='$drinken', prijs='$prijs' WHERE menu_id=$menu_id");
    
    
    header("location: menu.php");
    }