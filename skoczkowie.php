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
        <h2 style="text-align: center;">Sylwetki skoczków - Drużyny</h2>  
        <div class="pod" style="text-align: center; margin-left: auto; margin-right: auto;">
            <ul style="display: flex; justify-content: space-evenly; list-style: none;">
                <li><a href="skoczkowie2.php?nationality=Austria"><img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Flag_of_Austria.svg" width="150" height="80"></a><br>Austria</li> 
                <li><a href="skoczkowie2.php?nationality=Bułgaria"><img src="https://img.freepik.com/darmowe-zdjecie/flaga-bulgarii-tkanina-narodowa_113767-1586.jpg?size=626&ext=jpg" width="150" height="80"></a><br>Bułgaria</li> 
                <li><a href="skoczkowie2.php?nationality=Czechy" ><img src="https://iflagi.pl/userdata/public/gfx/ec51b79ecb692fef5c43735158cb0af4.jpg" width="150" height="80"><br></a>Czechy</li>
                <li><a href="skoczkowie2.php?nationality=Estonia" ><img src="https://archiwum.allegro.pl/image//imagesNEW/big/4c22c8e38d04846f5d925425e826d2f3679a919c85617a1178a071575a9a2723" width="150" height="80"></a><br>Estonia</li>
                <li><a href="skoczkowie2.php?nationality=Finlandia" ><img src="https://upload.wikimedia.org/wikipedia/commons/b/bc/Flag_of_Finland.svg" width="150" height="80"></a><br> Finlandia </li>
                <li><a href="skoczkowie2.php?nationality=Francja" ><img src="https://upload.wikimedia.org/wikipedia/commons/c/c3/Flag_of_France.svg" width="150" height="80"></a><br>Francja</li>

            </ul>
            <ul style="display: flex; justify-content: space-evenly; list-style: none;">
                <li><a href="skoczkowie2.php?nationality=Japonia" ><img src="https://upload.wikimedia.org/wikipedia/commons/9/9e/Flag_of_Japan.svg" width="150" height="80"> </a><br>Japonia</li>
                <li><a href="skoczkowie2.php?nationality=Kanada" ><img src="https://www.libea.cz/wp-content/uploads/2018/10/Kanada.jpg" width="150" height="80"> </a><br>Kanada</li>
                <li><a href="skoczkowie2.php?nationality=Kazachstan" ><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2e/Flag_of_Kazakhstan_%283-2%29.svg/1280px-Flag_of_Kazakhstan_%283-2%29.svg.png" width="150" height="80"> </a><br>Kazachstan</li>
                <li><a href="skoczkowie2.php?nationality=Niemcy" ><img src="https://mzs1gorlice.bho.pl/skeuropejski/wp-content/uploads/2015/02/11.jpg" width="150" height="80"></a><br>Niemcy</li>
                <li><a href="skoczkowie2.php?nationality=Norwegia" ><img src="https://upload.wikimedia.org/wikipedia/commons/d/d9/Flag_of_Norway.svg" width="150" height="80"> </a><br>Norwegia</li>
                <li><a href="skoczkowie2.php?nationality=Polska" ><img src="https://upload.wikimedia.org/wikipedia/en/thumb/1/12/Flag_of_Poland.svg/1200px-Flag_of_Poland.svg.png" width="150" height="80"></a><br>Polska</li>
            </ul>

            <ul style="display: flex; justify-content: space-evenly; list-style: none;">
                <li><a href="skoczkowie2.php?nationality=Rosja" ><img src="https://upload.wikimedia.org/wikipedia/en/thumb/f/f3/Flag_of_Russia.svg/1200px-Flag_of_Russia.svg.png" width="150" height="80"></a><br>Rosja</li>   
                <li><a href="skoczkowie2.php?nationality=Słowenia" ><img src="https://flagipanstw.info.pl/flagi-panstw/flaga-slowenii.png" width="150" height="80"> </a><br>Słowenia</li>
                <li><a href="skoczkowie2.php?nationality=Szwajcaria" ><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f2/Civil_Ensign_of_Switzerland.svg/1280px-Civil_Ensign_of_Switzerland.svg.png" width="150" height="80"> </a><br>Szwajcaria</li> 
                <li><a href="skoczkowie2.php?nationality=Ukraina" ><img src="https://upload.wikimedia.org/wikipedia/commons/4/49/Flag_of_Ukraine.svg" width="150" height="80"> </a><br>Ukraina</li>
                <li><a href="skoczkowie2.php?nationality=USA" ><img src="https://images-na.ssl-images-amazon.com/images/I/61gnrswHuBL._AC_SL1024_.jpg" width="150" height="80"> </a><br>USA</li>
                <li><a href="skoczkowie2.php?nationality=Włochy" ><img src="https://upload.wikimedia.org/wikipedia/en/thumb/0/03/Flag_of_Italy.svg/1200px-Flag_of_Italy.svg.png" width="150" height="80"> </a><br>Włochy</li>
            </ul>

         </div>

    <?php

   /* require_once "dbconnect.php";
    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if($polaczenie->connect_errno!=0){
        echo "Error: ".$polaczenie->connect_errno;
    }
    else{
        $sql = "SELECT * FROM skocznia";
        
        if($result = @$polaczenie->query($sql)){
            $liczba_skoczni = $result->num_rows;
            if($liczba_skoczni>0){
                $wiersz = $result->fetch_assoc();
                $name = $wiersz['name'];

                $result->free_result();
                echo $name;

            }
            else{

            }
        }

        $polaczenie->close();
    }*/

    ?>
  


</body>
</html>
