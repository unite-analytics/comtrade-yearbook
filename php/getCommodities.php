<?php

    //Read the get params
    $type = $_GET['type'];
    $reporter = $_GET['reporter'];
    $partner = $_GET['partner'];

    //Connect to the database
    $dbConnection = mysqli_connect("localhost", //location of DB Server
                                   "dbuser",    //User Name
                                   "dbuser",    //Pswd
                                   "concptdb1"   //DB name
                                  );

    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    //Decide which table to query
    if($type == "import")
        $tableName = " sitc4_by_partner_imports ";
    else if ($type == "export")
        $tableName = " sitc4_by_partner_exports ";

    //generate a query to fetch the data
    $query = "SELECT * FROM " . $tableName . " WHERE rtTitle='" . $reporter . "' AND ptTitle='" . $partner . "'";
    //$query = "SELECT * FROM " . $tableName . " LIMIT 0 , 30";
    $result = mysqli_query($dbConnection, $query);

    //echo($query);

    //Response object
    $response = '';

    //Generate Response JSON
    $response = array();
    while($row = mysqli_fetch_array($result))
    {
        array_push($response, $row);
    }

    //Close the DB connection
    mysqli_close($dbConnection);

    echo json_encode($response);
?>