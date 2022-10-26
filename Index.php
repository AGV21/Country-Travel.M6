<?php
    $databaseConnection = mysqli_connect( "localhost", "root", "root", "country_travel" );
            $errors = [];
            session_start();

            if(mysqli_connect_errno()){
                exit("Database failed");
            }

    $userid = 1;

    $CountryName = mysqli_query($databaseConnection, "SELECT * FROM countries");
    if( !$CountryName ){
        echo( mysqli_error($databaseConnection) );
    } else{
        //echo("yes");
    }

    // exit();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['postButton'])){
        $content = mysqli_real_escape_string($databaseConnection, $_POST['content']);

        if(!isset($content) || trim($content) === ""){
            $errors[] = "Type Review";
        }
        if(empty($errors )){
            $sql = 'INSERT INTO post';
            $sql .= '(content, userid)';
            $sql .= 'VALUE(';
            $sql .= "'" . $content . "', ";
            $sql .= "'" . $userid . "'";
            $sql .= ')';

        $postSavedSuccess = mysqli_query($databaseConnection, $sql);

        if($postSavedSuccess){
         } else{
                echo(mysqli_error($databaseConnection));
                if($databaseConnection){
                    mysqli_close($databaseConnection);
                }
                exit();
            }
        }
        
    }

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
            <form action="index.php" method="post">
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
                <textarea name="content"></textarea><br>
                <input type='submit' value='Post' name='postButton'>
            </form>
            <?php
                $sql = "SELECT * FROM post";

                $allPost = mysqli_query($databaseConnection, $sql);

                while($currentPost = mysqli_fetch_assoc($allPost)){
            ?>
                <article> 
                    <?php //echo($currentPost['Date']);?> :
                    <?php echo(htmlspecialchars($currentPost['content'])); ?> by
                    <?php
                       $sql = "SELECT * FROM users ";
                       $sql .= "WHERE id='" . $currentPost['userid'] . "'";
 
                       $userOfPost = mysqli_query($databaseConnection, $sql);
                       $userOfPost = mysqli_fetch_assoc($userOfPost);
                    ?>  
                    <?php echo($userOfPost['nickname']); ?>
                    <?php
                    if($userOfPost['id'] == $userid){
                    ?>
                    <?php
                    }
                    ?>
                </article>
            <?php
                }
            ?>
        </div>
    </body> 
</html>
<?php
    if($databaseConnection){
        mysqli_close($databaseConnection);
    }
?>