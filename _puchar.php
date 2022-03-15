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
    $date = $_GET['date'];
    if($polaczenie->connect_errno!=0){
        echo "Error: ".$polaczenie->connect_errno;
    }
    else{
      $sql = "SELECT t1.first_name, t1.last_name, t2.distance, t2.nr_round, t2.wind_points, t2.gate_points, t2.jury_points,
      t2.comment, t2.id_skok, t2.comment, t3.place, t3.points_for_k, t3.points_for_metre, t3.point_k, t4.season, t4.date, t4.id_terminarz 
      FROM skoczek AS t1, skok AS t2, skocznia AS t3, terminarz AS t4
      where t1.id_skoczek=t2.id_skoczek AND t2.id_terminarz=t4.id_terminarz AND t3.id_skocznia=t2.id_skocznia AND t4.date=$date";
      global $season;
      global $date2;
      global $id_term;
      global $place;
        if($result = @$polaczenie->query($sql)){
            $liczba_skoczkow = $result->num_rows;
            if($liczba_skoczkow > 0){
                while($row=mysqli_fetch_array($result)){
                    $points_for_k = $row['points_for_k'];
                    $points_for_metre = $row['points_for_metre'];
                    $point_k = $row['point_k'];
                    $distance = $row['distance'];
                    $distance_points = $points_for_k + ($distance - $point_k) * $points_for_metre;
                    $id_skoku = $row['id_skok'];
                    $season = $row['season'];
                    $date2 = $row['date'];
                    $place = $row['place'];
                    $id_term = $row['id_terminarz'];
                    $gate_points = $row['gate_points'];
                    $wind_points = $row['wind_points'];
                    $jury_points = $row['jury_points'];
                    $points_for_jump = $distance_points + $wind_points + $jury_points + $gate_points; 
                    if($row['comment'] == "DSQ")
                        $points_for_jump = 0;
                    $update_sql = "UPDATE `skok` SET `distance_points` = $distance_points, points=$points_for_jump WHERE `skok`.`id_skok` = $id_skoku";
                    if ($polaczenie->query($update_sql) === FALSE) {
                        echo "Error updating record: " . $polaczenie->error;
                    }          
                }
                $echoSql = "SELECT skoczek.id_skoczek, skoczek.first_name, skoczek.last_name, skoczek.nationality, ROUND(skok.distance,1) AS dystans_1_seria, 
                ROUND(skok.points,1) AS punkty_1_seria, 
                ROUND(skok_dwa.distance,1) AS dystans_2_seria, 
                ROUND(skok_dwa.points,1) AS punkty_2_seria, 
                ROUND(skok.points + skok_dwa.points, 1) AS nota_laczna,
                skok.comment
                FROM skok LEFT JOIN skok AS skok_dwa ON 
                skok_dwa.id_skoczek = skok.id_skoczek AND 
                skok_dwa.id_terminarz = skok.id_terminarz AND 
                skok_dwa.id_skoczek = skok.id_skoczek AND 
                skok_dwa.nr_round = '2' LEFT JOIN skoczek ON 
                skok.id_skoczek = skoczek.id_skoczek WHERE skok.id_terminarz = '$id_term' AND
                skok.nr_round = '1' ORDER BY ROUND(skok.points + skok_dwa.points, 1) DESC";
                if($echoSqlResult = @$polaczenie->query($echoSql)){
                    $number_of_results = $echoSqlResult->num_rows;
                    if($number_of_results > 0){
                        echo "<h3 style='text-align: center;'>Wynik konkursu z dnia $date2 - $place</h3>";
                      "<table id='_puchar'>";
                        echo "<table border='10' style='margin-left: auto; margin-right: auto; text-align: center; background-color: black; opacity: 0.65'>
                        <tr>
                            <th>Pozycja</th>
                            <th>Skoczek</th>
                            <th>Kraj</th>
                            <th>&nbsp Odległość 1 &nbsp</th>
                            <th>&nbsp Punkty &nbsp</th>
                            <th>&nbsp Odległość 2 &nbsp</th>
                            <th>&nbsp Punkty &nbsp</th>
                            <th>&nbsp Nota łączna &nbsp</th>
                        </tr>";
                        $position = 1;
                        $counter = 1;
                        $rowPrevPoints = -1;
                        $temp = 0;
                        $temp2 = 0;
                        $rowPrevPoints2 = -1;
                        while($row=mysqli_fetch_array($echoSqlResult)){
                            echo "<tr>";
                            if($rowPrevPoints == $row['nota_laczna'] && $counter>1){
                                $position = $position -1;
                                $temp = 1;
                            }
                            if($row['dystans_2_seria']==NULL && $position==31){
                              //  $position = $position + 1;
                            }
                            $jumper = $row['id_skoczek'];
                            $select_jumper_sql = "SELECT id_konkurs_punkty, id_skoczek, data_konkursu, season, points from konkurs_punkty WHERE
                            id_skoczek = '$jumper' AND season='$season' AND data_konkursu = '$date2'";
                            if($result_select_jumper_sql = $polaczenie->query($select_jumper_sql)){
                               $number_of_select_jumper_sql = $result_select_jumper_sql->num_rows;
                               if($number_of_select_jumper_sql == 0){
                                    if($position == 1){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 100)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 2){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 80)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 3){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 60)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 4){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 50)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 5){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 45)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 6){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 40)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 7){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 36)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 8){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 32)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 9){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 29)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 10){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 26)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 11){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 24)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 12){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 22)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 13){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 20)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 14){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 18)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 15){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 16)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 16){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 15)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 17){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 14)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 18){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 13)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 19){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 12)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 20){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 11)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 21){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 10)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 22){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 9)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 23){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 8)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 24){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 7)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 25){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 6)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 26){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 5)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 27){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 4)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 28){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 3)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                    elseif($position == 29){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 2)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }
                                   /* elseif($position == 30){
                                        $insert_jumper = "INSERT INTO konkurs_punkty (id_konkurs_punkty, id_skoczek, data_konkursu, season, points) 
                                        VALUES (NULL, '$jumper','$date2','$season', 1)";
                                         if ($polaczenie->query($insert_jumper) === FALSE) {
                                            echo "Error inserting record: " . $polaczenie->error;
                                        }          
                                    }*/
                                   
                                }    
                            }   
                            echo "<td>" . $position . "</td>";
                            echo "<td style='text-align: left;'>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
                            echo "<td style='text-align: left;'>" . $row['nationality'] . "</td>";
                            echo "<td>" . $row['dystans_1_seria'] . "</td>";
                            if($row['comment']=="DSQ")
                                echo "<td>" . "DSQ" . "</td>";
                            else{
                                echo "<td>" . $row['punkty_1_seria'] . "</td>";
                                echo "<td>" . $row['dystans_2_seria'] . "</td>";
                                if($row['comment'] == "DSQ" && $row['dystans_2_seria']>0){
                                    echo "<td>" . "DSQ" . "</td>";
                                }
                                else{
                                    echo "<td>" . $row['punkty_2_seria'] . "</td>";
                                    echo "<td>" . $row['nota_laczna'] . "</td>";

                                }     
                            }
                            if($rowPrevPoints2 == $row['punkty_1_seria'] && $counter>1 && $position>30){
                                $position = $position -1;
                                $temp2 = 1;
                            }
                            $rowPrevPoints = $row['nota_laczna'];
                            echo "</tr>"; 
                            $rowPrevPoints2 = $row['punkty_1_seria'];
                            if($temp==1){
                                $temp=0;
                                $position = $position + 1;
                            }
                            if($position==31){
                                $position=$position+1;
                            }
                            
                            if($temp2==1){
                                $temp2=0;
                                $position = $position + 1;
                            }
                            $position = $position + 1;
                            $counter = $counter + 1;
                        }
                        echo "</table>";
                    }
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