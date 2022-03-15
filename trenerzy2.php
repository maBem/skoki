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
        $sql = "SELECT last_name_t, first_name_t, birth_date, birth_date, nationality, team FROM trener WHERE nationality='$nationality' ORDER BY last_name_t ASC";
        
        if($result = @$polaczenie->query($sql)){
            $liczba_trenerow = $result->num_rows;
            if($liczba_trenerow>0){
                /*$wiersz = $result->fetch_assoc();
                $name = $wiersz['name'];

                $result->free_result();
                echo $name;*/
               // echo "Nazwa     Miejsce     Kraj    Punkt K     HS      Rekord <br><br>";
               echo "<h3 style='text-align: center;'>$nationality</h3>";

               "<table id='skocznie'>";
               //echo "<table border='1'>
               echo "<table border='10' style='margin-left: auto; margin-right: auto; text-align: center; background-color: black; opacity: 0.65'>

               <tr>
                    <th>Trener</th>
                    <th>Data urodzenia</th>
                    <th>Prowadzona drużyna</th>
               </tr>";
               while($row = mysqli_fetch_array($result)){
                   echo "<tr>";
                   echo "<td style='text-align: left;'>" . $row['first_name_t'] . " " . $row['last_name_t']. "</td>";
                   echo "<td>" . $row['birth_date'] . "</td>";
                   echo "<td>" . $row['team'] . "</td>";
                   echo "</tr>";
               }
               echo "</table>";
                while($row = mysqli_fetch_assoc($result)){
                    foreach($row as $field => $value){
                        echo "  ".$value;
                        
                    }
                    echo "<br>";
                    echo "<br>";
                }

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
