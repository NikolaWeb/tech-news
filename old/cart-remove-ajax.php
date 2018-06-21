<?php
@session_start();
if(isset($_POST["id"]))
{
    foreach($_SESSION["shopping_cart"] as $keys => $values)
    {
        if($values["id_product"] == $_POST["id"])
        {
            unset($_SESSION["shopping_cart"][$keys]);
        }
    }
}