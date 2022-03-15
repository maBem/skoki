<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel='stylesheet' href='style.css' type='text/css'/>
    <title>Skoki narciarskie</title>
</head>

<body>
   
    <div id="wrapper">
        <div id="header">
            <div id="logo">
                Skoki<span style="color: #a80f0f">Narciarskie</span></div>
                <div style="clear: both;"></div>
        </div>
        <div id="menu">
            <ul>
                <li><a href="index.php" > Strona główna </a></li>
                <li><a href="skocznie.php" > Skocznie</a></li>
                <li><a href="skoczkowie.php"> Skoczkowie </a></li>
                <li><a href="trenerzy.php"> Trenerzy </a></li>
                <li><a href="terminarz.php"> Terminarz </a></li>
                <li><a href="#"> Wyniki </a>
                    <ul>
                        <li><a href="puchar2.php" > Puchar świata </a></li>
                        <li><a href="puchar.php" > Wyniki konkursów </a></li>
                    </ul> 
                
                </li>

            </ul>

        </div>
    </div>

    <?php
    require_once "dbconnect.php";
    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
    $nationality = $_GET['nationality'];
    if($polaczenie->connect_errno!=0){
        echo "Error: ".$polaczenie->connect_errno;
    }
    else{
       /* $sql = "SELECT skoczek1.last_name AS skoczek.last_name, skoczek1.first_name AS skoczek.first_name , skoczek1.birth_date, skoczek1.nationality, skoczek1.record, 
        trener1.last_name AS trener.last_name, trener1.first_name AS trener.first_name FROM skoczek AS skoczek1, trener AS trener1 
        WHERE skoczek1.id_trener = trener1.id_trener AND skoczek1.nationality ='$nationality'";*/
       // $sql = "SELECT skoczek.first_name, skoczek.last_name, skoczek.birth_date, skoczek.nationality, skoczek.record, trener.first_name, trener.last_name from skoczek join trener where skoczek.id_trener=trener.id_trener and skoczek.nationality='$nationality'";
       $sql ="Select t1.first_name, t1.last_name, t1.birth_date, t1.nationality, t1.record, t2.first_name_t, t2.last_name_t FROM skoczek AS t1, trener as t2 where t1.id_trener=t2.id_trener and t1.nationality='$nationality' ORDER BY t1.last_name ASC";
      //  $sqlTrener ="SELECT trener.first_name, trener.last_name FROM trener join skoczek where skoczek.id_trener = trener.id_trener";
        if($result = @$polaczenie->query($sql)){
            $liczba_skoczkow = $result->num_rows;
            if($liczba_skoczkow>0){
                echo "<h3 style='text-align: center;'>$nationality</h3>";
                //echo "<table border='1' style='margin-left: auto; margin-right: auto; text-align: justify;'>
                echo "<table border='10' style='margin-left: auto; margin-right: auto; text-align: center; background-color: black; opacity: 0.65'>

                <tr style='text-align: center;'>
                    <th>&nbsp Skoczek &nbsp</th>
                    <th>&nbsp Data urodzenia &nbsp</th>
                    <th>&nbsp Rekord &nbsp</th>
                </tr>";
                while($row=mysqli_fetch_array($result)){
                    echo "<tr>";
                  //  echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td style='text-align: left;'>" . '&nbsp'. $row['first_name'] . " ". $row['last_name'] .'&nbsp' . "</td>";
                    echo "<td style='text-align: center;'>" . $row['birth_date'] . "</td>";
                    echo "<td style='text-align: center;'>" . $row['record'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";

            }
            else{
                echo "Brak danych w bazie";
            }
        }

        $polaczenie->close();
    }
    ?>
    

</body>
</html>