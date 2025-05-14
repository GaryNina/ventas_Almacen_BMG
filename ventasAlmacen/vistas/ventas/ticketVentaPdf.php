<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ventas.php";

	$objv= new ventas();


	$c=new conectar();
	$conexion= $c->conexion();	
	$idventa=$_GET['idventa'];

 $sql="SELECT ve.id_venta,
		ve.fechaCompra,
		ve.id_cliente,
		art.nombre,
        art.precio,
        art.descripcion
	from ventas  as ve 
	inner join articulos as art
	on ve.id_producto=art.id_producto
	and ve.id_venta='$idventa'";

$result=mysqli_query($conexion,$sql);

	$ver=mysqli_fetch_row($result);

	$folio=$ver[0];
	$fecha=$ver[1];
	$idcliente=$ver[2];

 ?>	

<!DOCTYPE html>
<html>
<head>
    <title>Ticket de Venta</title>
    <style>
        @page {
            margin-top: 0.3em;
            margin-left: 0.6em;
        }
        body {
            font-size: xx-small;
            font-family: Arial, sans-serif;
        }
        .ticket {
            width: 250px;
            padding: 10px;
            border: 1px solid #000;
            margin: auto;
            background: #fff;
        }
        .ticket h2 {
            font-size: 16px;
            margin-bottom: 5px;
        }
        .ticket p {
            margin: 1px 0;
        }
        .table {
            width: 10%;
            border-collapse: collapse;
            margin-top: 1px;
        }
        .table th, .table td {
            border: 1px solid black;
            padding: 1px;
            font-size: xx-small;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <h2>Licorería BMG</h2>
        <p>Fecha: <?php echo $fecha; ?></p>
        <p>Folio: <?php echo $folio; ?></p>
        <p>Cliente: <?php echo $objv->nombreCliente($idcliente); ?></p>
        
        <table class="table">
            <tr>
                <th>Nombre</th>
                <th>Precio (Bs)</th>
            </tr>
            <?php 
                $sql="SELECT ve.id_venta, ve.fechaCompra, ve.id_cliente, art.nombre, art.precio, art.descripcion
                      FROM ventas AS ve 
                      INNER JOIN articulos AS art ON ve.id_producto = art.id_producto
                      WHERE ve.id_venta='$idventa'";
                $result=mysqli_query($conexion, $sql);
                $total=0;
                while($mostrar=mysqli_fetch_row($result)) {
            ?>
            <tr>
                <td><?php echo $mostrar[3]; ?></td>
                <td><?php echo number_format($mostrar[4], 2); ?></td>
            </tr>
            <?php
                $total += $mostrar[4];
                }
            ?>
            <tr>
                <td class="total">Total:</td>
                <td class="total">Bs <?php echo number_format($total, 2); ?></td>
            </tr>
        </table>
        <p>¡Gracias por su compra!</p>
    </div>
</body>
</html>
