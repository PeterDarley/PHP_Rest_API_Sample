<?php 
    require __DIR__ . '/utils.php';

    // Get basic information
    $error = "";
    $function = substr($_SERVER['REQUEST_URI'], 1); 
    $method = $_SERVER['REQUEST_METHOD'];
    $data = getData();

    // Detect errors
    if ($method != "GET") {
        $error = "Method not allowed";
    }
    else if (substr_count($function, "/") >= 1 or ($function!="all" and $function!="" and ! array_key_exists($function, $data))) {
        $error = ["error"=>"Invalid function", "value"=>$function];
    }

    // Display information
    if ($error) {
        http_response_code(404);
        echo json_encode($error);
    }
    else {
        echo json_encode(getData());
    }
?>