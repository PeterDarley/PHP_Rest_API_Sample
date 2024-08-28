<?php 
    // Get basic information
    $error = [];
    $request = substr($_SERVER['REQUEST_URI'], 1); 
    $method = $_SERVER['REQUEST_METHOD'];

    $data = @file_get_contents("https://disease.sh/v3/covid-19/all");

    // Detect errors
    if (! $data) {
        $error = ["error"=>"Could not fetch from disease.sh"];
    }
    else {
        $data = json_decode($data);

        if ($method != "GET") {
            $error = ["error"=>"Method not supported", "value"=>$method];
        }
        else if ($request!="all" and $request!="" and ! property_exists($data, $request)) {
            $error = ["error"=>"Invalid request", "value"=>$request];
        }
    }

    // Display information
    header('Content-Type: application/json; charset=utf-8');
    
    if ($error) {
        http_response_code(404);
        echo json_encode($error);
    }
    else {
        if ($request != "all" and $request != "") {
            $data = [$request=>$data->$request];
        }
    
        echo json_encode($data);
    }
?>