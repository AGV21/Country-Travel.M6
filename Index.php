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
    <body>
        <form>
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
            </select>
            <input type="text">
            <input type='submit' value='Post'>
        </form>
    </body> 
</html>