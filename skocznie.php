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
    <h2 style="text-align: center;">Skocznie narciarskie - Państwa</h2>  
        <div class="pod" style="text-align: center; margin-left: auto; margin-right: auto;">
            <ul style="display: flex; justify-content: space-evenly; list-style: none;">
                <li><a href="skocznie2.php?country=Austria"><img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Flag_of_Austria.svg" width="150" height="80"></a><br>Austria</li> 
                <li><a href="skocznie2.php?country=Chiny"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fa/Flag_of_the_People%27s_Republic_of_China.svg/255px-Flag_of_the_People%27s_Republic_of_China.svg.png" width="150" height="80"></a><br>Chiny</li> 
                <li><a href="skocznie2.php?country=Czechy" ><img src="https://iflagi.pl/userdata/public/gfx/ec51b79ecb692fef5c43735158cb0af4.jpg" width="150" height="80"><br></a>Czechy</li>
                <li><a href="skocznie2.php?country=Finlandia" ><img src="https://upload.wikimedia.org/wikipedia/commons/b/bc/Flag_of_Finland.svg" width="150" height="80"></a><br>Finlandia</li>
                <li><a href="skocznie2.php?country=Japonia" ><img src="https://upload.wikimedia.org/wikipedia/commons/9/9e/Flag_of_Japan.svg" width="150" height="80"></a><br>Japonia</li>
            </ul>
            <ul style="display: flex; justify-content: space-evenly; list-style: none;">
                <li><a href="skocznie2.php?country=Kanada" ><img src="https://www.libea.cz/wp-content/uploads/2018/10/Kanada.jpg" width="150" height="80"> </a><br>Kanada</li>
                <li><a href="skocznie2.php?country=Kazachstan" ><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2e/Flag_of_Kazakhstan_%283-2%29.svg/1280px-Flag_of_Kazakhstan_%283-2%29.svg.png" width="150" height="80"> </a><br>Kazachstan</li>
                <li><a href="skocznie2.php?country=Niemcy" ><img src="https://mzs1gorlice.bho.pl/skeuropejski/wp-content/uploads/2015/02/11.jpg" width="150" height="80"> </a><br>Niemcy</li>
                <li><a href="skocznie2.php?country=Norwegia" ><img src="https://upload.wikimedia.org/wikipedia/commons/d/d9/Flag_of_Norway.svg" width="150" height="80"></a><br>Norwegia</li>
                <li><a href="skocznie2.php?country=Polska" ><img src="https://upload.wikimedia.org/wikipedia/en/thumb/1/12/Flag_of_Poland.svg/1200px-Flag_of_Poland.svg.png" width="150" height="80"> </a><br>Polska</li>
            </ul>
            <ul style="display: flex; justify-content: space-evenly; list-style: none;">
                <li><a href="skocznie2.php?country=Rumunia" ><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Flag_of_Romania.svg/1200px-Flag_of_Romania.svg.png" width="150" height="80"> </a><br>Rumunia</li>
                <li><a href="skocznie2.php?country=Słowenia" ><img src="https://flagipanstw.info.pl/flagi-panstw/flaga-slowenii.png" width="150" height="80"> </a><br>Słowenia</li> 
                <li><a href="skocznie2.php?country=Szwajcaria" ><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f2/Civil_Ensign_of_Switzerland.svg/1280px-Civil_Ensign_of_Switzerland.svg.png" width="150" height="80"> </a><br>Szwajcaria</li>
                <li><a href="skocznie2.php?country=Szwecja" ><img src="https://upload.wikimedia.org/wikipedia/en/thumb/4/4c/Flag_of_Sweden.svg/1200px-Flag_of_Sweden.svg.png" width="150" height="80"> </a><br>Szwecja</li>
                <li><a href="skocznie2.php?country=Włochy" ><img src="https://upload.wikimedia.org/wikipedia/en/thumb/0/03/Flag_of_Italy.svg/1200px-Flag_of_Italy.svg.png" width="150" height="80"> </a><br>Włochy</li>
            </ul>

         </div>
   
   <?php

   /* require_once "dbconnect.php";
    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
    $country = "Polska";
    if($polaczenie->connect_errno!=0){
        echo "Error: ".$polaczenie->connect_errno;
    }
    else{
        $sql = "SELECT name, place, country, point_k, hill_size, hill_record FROM skocznia WHERE country='$country'";
        
        if($result = @$polaczenie->query($sql)){
            $liczba_skoczni = $result->num_rows;
            if($liczba_skoczni>0){*/
                /*$wiersz = $result->fetch_assoc();
                $name = $wiersz['name'];

                $result->free_result();
                echo $name;*/
    /*            while($row = mysqli_fetch_assoc($result)){
                    print_r($row);
                }

            }
            else{

            }
        }

        $polaczenie->close();
    }*/

    ?>
  


</body>
</html>
