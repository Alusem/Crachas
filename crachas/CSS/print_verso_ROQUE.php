
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
    background-image: url('<?php echo $empresas[1]['background2']; ?>');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.dados {
    position: relative !important;
    top: 65px !important;
    left: 0px !important;
    text-align: center !important;
}

input {
    box-shadow: 0 0 0 0 !important;
    width: 220px;
    border: 0 none !important;
    outline: 0 !important;
    margin-bottom: 5.5px !important;
    position: relative !important;
    top: 0px !important;
    left: 0px !important;
    text-align: center !important;
    font-weight: 500 !important;
    background: transparent;
}

@media print {
    @page {
        size: 55mm 86mm;
        margin: 0;
    }
}
