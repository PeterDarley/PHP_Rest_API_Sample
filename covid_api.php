<?php 
    // Get basic information
    $error = [];
    $function = substr($_SERVER['REQUEST_URI'], 1); 
    $method = $_SERVER['REQUEST_METHOD'];

    $data = @file_get_contents("https://disease.sh/v3/covid-19/all");

    // Detect errors
    if (! $data) {
        $error = ["error"=>"Could not fetch from disease.sh"];
    }
    else {
        $data = json_decode($data);

        if ($method != "GET") {
            $error = ["error"=>"Method not allowed", "value"=>$method];
        }
        else if ($function!="all" and $function!="" and ! property_exists($data, $function)) {
            $error = ["error"=>"Invalid function", "value"=>$function];
        }
    }

    // Display information
    if ($error) {
        http_response_code(404);
        echo json_encode($error);
    }
    else {
        if ($function != "all" and $function != "") {
            $data = [$function=>$data->$function];
        }
        
        echo json_encode($data);
    }
?>