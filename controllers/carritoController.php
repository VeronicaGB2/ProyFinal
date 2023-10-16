<?php

session_start();


if (isset($_SESSION['cart'])) {
    $cart_id = array_column($_SESSION['cart'], "id");

    if (in_array($_POST['id'], $cart_id)) {
        // El producto ya existe en el carrito, actualiza la cantidad
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $_POST['id']) {
                $item['cantidad'] += $_POST['cantidad'];
            }
        }
    } else {
        // El producto no existe en el carrito, agrégalo
        $item_array = array(
            "id" => $_POST['id'],
            "nombre" => $_POST['nombre'],
            "precio" => $_POST['precio'],
            "cantidad" => $_POST['cantidad']
        );

        $_SESSION['cart'][] = $item_array;
    }
} else {
    // El carrito no existe, crea uno nuevo
    $item_array = array(
        "id" => $_POST['id'],
        "nombre" => $_POST['nombre'],
        "precio" => $_POST['precio'],
        "cantidad" => $_POST['cantidad']
    );

    $_SESSION['cart'][] = $item_array;
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == "clear") {
        unset($_SESSION['cart']);
    }

    if ($_POST['action'] == "remove") {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['id'] == $_POST['id']) {
                unset($_SESSION['cart'][$key]);
            }
        }
    }

    if ($_POST['action'] == "get_count") {
        echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
        exit;
    }

    if ($_POST['action'] == "updateQuantity") {
        $id = $_POST['id'];
        $newQuantity = $_POST['quantity'];
    
        // Encuentra el producto en el carrito y actualiza la cantidad
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $id) {
                $item['cantidad'] = $newQuantity;
            }
        }
    }
  
}

if (isset($_SESSION['cart'])) {
    $cartItemCount = count($_SESSION['cart']);
} else {
    $cartItemCount = 0;
}

echo $cartItemCount;

?>
