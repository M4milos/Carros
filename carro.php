<!DOCTYPE html>
<?php 
   include_once "conf/default.inc.php";
   require_once "conf/Conexao.php";
   $title = "Carros";
   $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : "";
   $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : 1;
   $valor = "";
   $desconto = "";
   $valordesconto = "";
   $classeskm = "";
   $classesanos = "";
   ?>
<html>
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
</head>
<body>

    <form method="post">

    <fieldset>

        <legend><?php echo $title ?></legend>
        <input type="text"   name="procurar" id="procurar" size="37" value="<?php echo $procurar;?>">
        <input type="submit" name="acao"     id="acao">
        <br><br>
        <legend>Método de pesquisa: </legend>
        <input type="radio" name="tipo" value="1" <?php if ($tipo == 1){echo 'checked';}?>> 
        <label for="nome">Nome</label>
        <input type="radio" name="tipo" value="2" <?php if ($tipo == 2){echo 'checked';}?>>
        <label for="valor">Valor</label>
        <input type="radio" name="tipo" value="3" <?php if ($tipo == 3){echo 'checked';}?>>
        <label for="km">Quilometro</label>

        <table>
        
        <tr>
            <td><b>Id |</b></td>
            <td><b>Nome |</b></td>
            <td><b>Valor |</b></td>
            <td><b>Quilometragem |</b></td>
            <td><b>Fabricação |</b></td> 
            <td><b>Anos do veículo |</b></td> 
            <td><b>Média de km por ano |</b></td>
            <td><b>desconto |</b></td>
            <td><b>Valor pós desconto</b></td>
        </tr>

        <?php
         $pdo = Conexao::getInstance();
            if ($tipo == 1 ) 
           
            $consulta = $pdo->query("SELECT * FROM carro 
                                     WHERE nome LIKE '$procurar%' 
                                     ORDER BY nome");
            elseif($tipo == 2 )
            $consulta = $pdo->query("SELECT * FROM carro 
                                     WHERE valor <= $procurar
                                     ORDER BY valor");
            else
            $consulta = $pdo->query("SELECT * FROM carro 
                                     WHERE km <= $procurar
                                     ORDER BY km");

            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {

                $dias = date("Y");
                $datafabricacao=date("Y",strtotime($linha['datafabricacao']));
                $anosveic = $dias-$datafabricacao;
                
                if ($anosveic != 0) {
                   $media = $linha['km']/$anosveic;
                }else{
                    $media = 0;
                }

                if ($linha['km'] >= 100.000) {
                    $desconto = "10% de desconto";
                    $classeskm = "vermelho";
                    $valordesconto = $linha['valor'] - ($linha['valor'] * 10 * 0.01);
                }elseif ($anosveic >= 10) {
                    $desconto = "10% de desconto";
                    $classesanos = "vermelho";
                    $valordesconto = $linha['valor'] - ($linha['valor'] * 10 * 0.01);
                }else{
                    $desconto = "Sem desconto";
                    $classesanos = "";
                    $classeskm = "";
                    $valordesconto = "";
                }
                
                if ($linha['km'] >= 100.000 && $anosveic >= 10) {
                    $valordesconto = $linha['valor']-$linha['valor']*(20/100);
                    $desconto = "20% de desconto";
                    $classesanos = "vermelho";
                    $classeskm = "vermelho";
                }
               
        ?>
        <tr>
            <td><?php echo $linha['id'] ;?></td>
            <td><?php echo $linha['nome'];?></td>
            <td><?php echo number_format($linha['valor'], 3, '.' , ',');?></td>
            <td class="<?php echo $classeskm;?>">
                <?php echo number_format($linha['km'], 3, '.' , ',');?>
            </td>
            <td>
                <?php echo date("d/m/Y",strtotime($linha['datafabricacao']));?>
            </td>
            <td class="<?php echo $classesanos;?>"><?php echo $anosveic ."   ".$classesanos; ?></td>
            <td><?php echo number_format($media, 3, '.' , ','); ?></td>
            <td><?php echo $desconto; ?></td>
            <td><?php if ($valordesconto != 0) {
                echo " | ". number_format($valordesconto, 3, '.' , ',');".";
            } ?>
           </td>
        </tr>
            <?php } ?>       
        </table>
    </fieldset>
    </form>
</body>
</html>
