<?php
    $databaseConnection = mysqli_connect( "localhost", "root", "root", "country_travel" );
            $errors = [];
            session_start();

            if(mysqli_connect_errno()){
                exit("Database failed");
            }

    $CountryName = mysqli_query($databaseConnection, "SELECT * FROM countries");
    if( !$CountryName ){
        echo( mysqli_error($databaseConnection) );
    } else{
        //echo("yes");
    }

    // exit();

?>
<DOC! html>
<html>
    <head>
        <title>Travel</title>
        <link href="css/script.css" rel="stylesheet">
    </head>
    <body id="mainContainer">
        <div class="trans.box">
            <p>Visited? Leave a review</p>
            <form method="post">
                <select>
                    <option value='$name'>Pick Country</option>

                    <?php
                    while($rows = $CountryName->fetch_assoc()){
                        $name = $rows['name'];
                    ?>
                    <option value= <?php echo($name) ?>>
                        <?php
                        echo($name);
                        ?>
                    </option>
                    <?php
                    }
                    ?>
                </select><br>
                <input type="text"><br>
                <input type='submit' value='Post'>
            </form>
        </div>
    </body> 
</html>