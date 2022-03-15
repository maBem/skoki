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
        <h2 style="text-align: center;">Klasyfikacja generalna</h2>
      <!--  <h3 style="text-align: center;">Sezon</h3> -->
        <form action="puchar2.php" method="post" style="text-align:center;">
        <select name="season">
            <option value="" selected disabled hidden>Sezon</option>  
            <option value="2020/2021">2020/2021</option>
            <option value="2019/2020">2019/2020</option>  
            <option value="2018/2019">2018/2019</option>
        </select>
        <input type="submit" value="Pokaż"/>
        </form>

        <?php
        if(isset($_POST['season'])){
            if(!empty($_POST['season'])){
                require_once "dbconnect.php";
                $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
                $season = $_POST['season'];
                
               /* $sql = "SELECT t1.date, t2.place, t2.country, t2.point_k, t2.hill_size, t1.competition_type
                FROM terminarz AS t1, skocznia as t2 where t1.id_skocznia=t2.id_skocznia and t1.season='$season'";*/

                $sql = "SELECT skoczek.first_name, skoczek.last_name, skoczek.nationality, SUM(points) AS punkty 
                FROM `konkurs_punkty` LEFT JOIN skoczek ON skoczek.id_skoczek = konkurs_punkty.id_skoczek 
                WHERE konkurs_punkty.season = '$season' GROUP BY konkurs_punkty.id_skoczek ORDER BY punkty DESC";
            // $sql = "SELECT * from terminarz";
                if($result = @$polaczenie->query($sql)){
                    $number_of_jumpers = $result->num_rows;
                    if($number_of_jumpers>0){
                        echo "<h3 style='text-align: center; '>Sezon $season</h2>";
                      //  echo "<table id='puchar2' style='text-align: center;'>";
                        //echo "<table border='1' style='margin-left: auto; margin-right: auto; text-align: center'>
                        echo "<table border='10' style='margin-left: auto; margin-right: auto;  background-color: black; opacity: 0.65'>

                        <tr'>
                            <th>Pozycja</th>
                            <th>&nbsp Skoczek </th>
                            <th>Kraj </th>
                            <th>Punkty</th>
                        </tr>";
                        $position = 1;
                        $counter = 1;
                        $rowPrevPoints = -1;
                        $temp = 0;
                        while($row=mysqli_fetch_array($result)){
                            echo "<tr>";
                            if($rowPrevPoints == $row['punkty'] && $counter > 1){
                                $position = $position -1;
                                $temp = 1;
                            }
                         //   $date = $row['date'];
                         //   $link = "_puchar.php?date='$date'";
                            echo "<td style='text-align: center;'>" . $position . "</td>";
                            echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
                            echo "<td>" . $row['nationality'] . "</td>";
                            echo "<td style='text-align: center;'>" . $row['punkty'] . "</td>";
                            echo "</tr>";
                            $rowPrevPoints = $row['punkty'];
                            if($temp==1){
                                $temp = 0;
                                $position = $position + 1;
                            }
                            $position = $position + 1;
                            $counter = $counter + 1;
                        }
                        echo "</table>";
                    }
                    else{
                        echo "Brak danych w bazie";
                    }
                }

                $polaczenie->close();
            }
            else{
                echo "Nie wybrałeś nic";
            }
        
        }
    ?>


</body>
</html>