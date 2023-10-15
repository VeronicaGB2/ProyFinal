<?php 

session_start();



  if (isset($_SESSION['cart'])) {
  	$cart_id = array_column($_SESSION['cart'], "id");
  	if (!in_array($_POST['id'], $_SESSION['cart'])) {
  		$item_array = array(
         "id" => $_POST['id'],
         "nombre" => $_POST['nombre'],
         "precio" => $_POST['precio'],
         "cantidad" => $_POST['cantidad']
  	);


  $_SESSION['cart'][] = $item_array;
  	}
  	
  }else{

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
}


if (isset($_SESSION['cart'])) {
    $cartItemCount = count($_SESSION['cart']);
} else {
    $cartItemCount = 0;
}

echo $cartItemCount;



 ?>