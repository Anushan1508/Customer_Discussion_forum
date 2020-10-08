<?php?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>iDiscuss - Forum to Discuss Everything</title>
    <style>
    #maincontainer {
        min-height: 82vh;
    }
    </style>
</head>

<body>
    <!-- including header to this page  -->
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>


    <!-- Search results fetching starts here  -->
    <div class="container my-3" id="maincontainer">
        <h1>Search Results For <em>"<?php echo $_GET['search']?>"</em></h1>
        <div class="results my-2">
            <?php
        $query = $_GET['search'];
        $sql = "SELECT * FROM threads WHERE MATCH (`thread_title`,`thread_desc`) against ('$query')";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $thread_id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $url = "thread.php?threadid=".$thread_id;
            echo '<h4 class="my-2"><a href="'.$url.'" class="text-dark">'.$title.'</a></h4>
                  <p>'.$desc.'</p>';

        }  
        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <p class="display-4">No Results Found</p>
              <p class="lead">
                <ul>
                    <li>Make sure that all words are spelled correctly.</li>
                    <li>Try different keywords.</li>
                    <li>Try more general keywords.</li>
                    <li>Try fewer keywords.</li>
                </ul>
              </p>
            </div>
          </div>';
        }      
        ?>


        </div>
    </div>


    <?php include 'partials/_footer.php'; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
</body>

</html>