
<?php

header("Content-type: text/css");
require '../PHP/conexao.php';
global $pdo;

$sql2 = $pdo->query("SELECT * FROM empresas");
$empresas = $sql2->fetchAll(PDO::FETCH_ASSOC);

?>

.container2 {
    width: 83mm !important;
    height: 129mm !important;
    background-image: url('<?php echo $empresas[1]['background']; ?>');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.dados {
    position: relative !important;
    top: 164px !important;
    left: 0px !important;
    text-align: center !important;
    color: #fff !important;
}

#nome {
    font-size: 24px !important;
    font-weight: 500 !important;
    text-transform: uppercase;
}

#cargo {
    font-size: 20px !important;
}

#foto {
    position: relative !important;
    top: 148px !important;
    left: 0px !important;
    text-align: center !important;
}

input {
    box-shadow: 0 0 0 0 !important;
    width: 250px !important;
    border: 0 none !important;
    outline: 0 !important;
    margin: 18px !important;
    position: relative !important;
    top: -538px !important;
    left: 825px !important;
    text-align: center !important;
    font-weight: 500 !important;
}

@media print {
    @page {
        size: 55mm 86mm;
        margin: 0;
    }
}