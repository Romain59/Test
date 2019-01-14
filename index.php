<?php
/**
 * Created by PhpStorm.
 * User: romainbon
 * Date: 2019-01-10
 * Time: 12:23
 */

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "jointure";
$conn = new mysqli($servername, $username, $password);
if ($conn -> connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {
    $conn->select_db($dbname);
}

function afficherEleves () {

    global $conn;

    $afficher = "SELECT * FROM eleves, eleves_informations WHERE eleves_informations.eleves_id = eleves.id";
    $resultat = $conn -> query($afficher);

    while ( $donnees = $resultat -> fetch_assoc()) {

        $image = $donnees['avatars'];

        echo "id : ".$donnees['id']." prenom : ".$donnees['prenom']." nom : ".$donnees['nom'].
            " login : ".$donnees['login']." password : ".$donnees['password']." age : ".$donnees['age'].
            " ville : ".$donnees['ville']." avatar : <img src='$image' width='75px' height='75px'> "."<br>";

    }

}

afficherEleves();

echo '<br><br><br><br>';

function afficherCompetences () {

    global $conn;

    $nombre = $donnee['niveau'];
    $string.= $nombre;

    global $nombre;

    $afficher = "SELECT * FROM eleves_competences,eleves,competences WHERE eleves_competences.eleves_id = eleves.id AND eleves_competences.competences_id = competences.id";
    $resultat = $conn->query($afficher);

    while ( $donnee = $resultat -> fetch_assoc()) {

        echo "id : ".$donnee['id']." : L'eleve ".$donnee['nom']." ".$donnee['prenom']." dans le domaine : ".$donnee['titre']." description : ".$donnee['description'].
            " sont niveau est de  ".$donnee['niveau']." et sont niveau en ae est de ".$donnee['niveau_ae']."<br>";

    }

}

afficherCompetences();

?>

    <!DOCTYPE html>
    <html>
    <head>
        <script src= "https://cdn.zingchart.com/zingchart.min.js"></script>
        <script> zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
            ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9","ee6b7db5b51705a13dc2339db3edaf6d"];</script></head>
    <body>
    <div id='myChart'></div>
    </body>
    </html>

    <style>
        html, body {
            height:100%;
            width:100%;
        }
        #myChart {
            height:100%;
            width:100%;
            min-height:250px;
        }
        .zc-ref {
            display:none;
        }
    </style>

    <script>
        var myConfig = {
            type : 'radar',
            plot : {
                aspect : 'area',
                animation: {
                    effect:3,
                    sequence:1,
                    speed:700
                }
            },
            scaleV : {
                visible : false
            },
            scaleK : {
                values : '0:5:1',
                labels : ['Niveaux','Niveaux Ae' ],
                item : {
                    fontColor : '#607D8B',
                    backgroundColor : "white",
                    borderColor : "#aeaeae",
                    borderWidth : 1,
                    padding : '5 10',
                    borderRadius : 10
                },
                refLine : {
                    lineColor : '#c10000'
                },
                tick : {
                    lineColor : '#59869c',
                    lineWidth : 2,
                    lineStyle : 'dotted',
                    size : 20
                },
                guide : {
                    lineColor : "#607D8B",
                    lineStyle : 'solid',
                    alpha : 0.3,
                    backgroundColor : "#c5c5c5 #718eb4"
                }
            },
            series : [
                {
                    values : [<?php $nombre;?>],
                    text:'farm'
                },
                {
                    values : [20, 20, 54, 41, 41, 35],
                    lineColor : '#53a534',
                    backgroundColor : '#689F38'
                }
            ]
        };

        zingchart.render({
            id : 'myChart',
            data : myConfig,
            height: '100%',
            width: '100%'
        });
    </script>




