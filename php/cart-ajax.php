<?php
@session_start();
if(isset($_POST["id"]))
{
    if(isset($_SESSION["shopping_cart"]))
    {
        $item_array_id = array_column($_SESSION["shopping_cart"], "id_product");

        if(!in_array($_POST["id"], $item_array_id))
        {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'id_product'               =>     $_POST["id"],
                'item_name'                =>     $_POST["hidden_name"],
                'item_price'               =>     $_POST["hidden_price"],
                'item_image'               =>     $_POST["hidden_image"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;

            echo $_POST["hidden_name"]." added to cart."."*".$count = count($_SESSION["shopping_cart"]);
        }
        else
        {

            echo $_POST["hidden_name"]." is already in cart.";

        }
    }
    else
    {
        $item_array = array(
            'id_product'               =>     $_POST["id"],
            'item_name'                =>     $_POST["hidden_name"],
            'item_price'               =>     $_POST["hidden_price"],
            'item_image'               =>     $_POST["hidden_image"]

        );
        $_SESSION["shopping_cart"][0] = $item_array;

        echo $_POST["hidden_name"]." added to cart.";
    }
}