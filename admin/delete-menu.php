<?php
include '../connection.inc';

if(isset($_REQUEST['page']) && isset($_REQUEST['order'])){

			if(is_numeric($_REQUEST['order'])){
				$order = $_REQUEST['order'];
				$q = "DELETE from menu WHERE id_menu =".$order;
				mysqli_query($conn, $q) or die("Error during deletion");
				echo "Deleted";
			}
			else{
				echo "Not deleted";
			}
}

?>



<?php
include '../close.php';
header("Location: admin.php?page=menu&deleted");
?>