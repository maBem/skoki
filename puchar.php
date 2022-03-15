<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel='stylesheet' href='style.css' type='text/css'/>
    <title>Skoki narciarskie</title>
</head>

<body>
   <!-- <h1>Statystyki skoków narciarskich</h1><br /><br /> -->
     
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
    <h2 style="text-align: center;">Wyniki konkursów</h2>
    <form action="puchar.php" method="post" style="text-align: center;">
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
            
            $sql = "SELECT t1.date, t2.place, t2.country, t2.point_k, t2.hill_size, t1.competition_type
            FROM terminarz AS t1, skocznia as t2 where t1.id_skocznia=t2.id_skocznia and t1.season='$season'";
           // $sql = "SELECT * from terminarz";
            if($result = @$polaczenie->query($sql)){
                $number_of_dates = $result->num_rows;
                if($number_of_dates>0){
                    echo "<h3 style='text-align: center;'>Sezon $season</h2>";
                    "<table id='terminarz'>";
                   // echo "<table border='0'>
                   // echo "<table border='0' style='margin-left: auto; margin-right: auto; text-align: center;'>
                   echo "<table border='10' style='margin-left: auto; margin-right: auto; text-align: center; background-color: black; opacity: 0.65'>

                    <tr>
                        <th>Data</th>
                        <th>Miejsce</th>
                        <th>Kraj</th>
                        <th>Punkt K</th>
                        <th>Rozmiar skoczni</th>
                        <th>Rodzaj konkursu</th>
                    </tr>";
                    while($row=mysqli_fetch_array($result)){
                        echo "<tr>";
                        $date = $row['date'];
                        $link = "_puchar.php?date='$date'";
                        echo "<td>" . "<a href=" .$link ." style='color: #ff3c2e; text-decoration: none;'>" . $row['date'] . "</a>" . "</td>";
                        echo "<td>" . $row['place'] . "</td>";
                        echo "<td>" . $row['country'] . "</td>";
                        echo "<td>" . $row['point_k']."m" . "</td>";
                        echo "<td>" . $row['hill_size']."m" . "</td>";
                        echo "<td>" . $row['competition_type']."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    
                    /*while($row = mysqli_fetch_assoc($result)){
                        foreach($row as $field => $value){
                            echo "  ".$value;
                            
                        }
                        echo "<br>";
                    }*/
    
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
