
<?php
    //load header
    include("views/header.php");

	//load content
		if(isset($_GET['news']))
			include("single-item.php");
		
					
		elseif(isset($_REQUEST['page']))
			if(!is_numeric($_REQUEST['page']))
				include($_REQUEST['page'].".php");
			elseif($_GET['page'] != $pageinfo->id_menu)
			include "404.php";
			else
				include $pageinfo->url;
		
		else
			include $pageinfo->url;
		
	include "php/close.php";

    include ("views/footer.php");
