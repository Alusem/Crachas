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
    background-image: url('<?php echo $empresas[0]['background']; ?>');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.dados {
    position: relative !important;
    top: 45px !important;
    left: 0px !important;
    text-align: center !important;
    color: #2E2E2E !important;
    line-height: 1;
}

#nome {
    font-size: 22px !important;
    font-weight: 700;
    text-align: center;
    position: relative;
    top: 12px !important;
    text-transform: uppercase;
}

#cargo {
    font-size: 16px !important;
    font-weight: 300%;
    text-align: center;
    position: relative;
    top: 20px;
}

#foto {
    position: relative !important;
    top: 68px !important;
    left: 57px !important;
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