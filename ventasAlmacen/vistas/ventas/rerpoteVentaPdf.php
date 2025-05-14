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
 	<title>Reporte de venta</title>
 	<link rel="stylesheet" type="text/css" href="../../librerias/bootstrap/css/bootstrap.css">
	 <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .title {
            font-size: 2.5rem;
            font-weight: bold;
            color: gold;
            text-shadow: -2px -2px 0 black, 2px -2px 0 black, -2px 2px 0 black, 2px 2px 0 black;
            margin-bottom: 20px;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .total {
            font-weight: bold;
            background-color: #28a745;
            color: white;
        }
    </style>
</head>

 <body>
 <div class="container">
 		<div class="title">Licorería BMG</div>
        <h2 class="text-center text-primary">Reporte de Venta</h2>
        <hr>
        <table class="table table-bordered">
            <tr>
                <td><strong>Fecha:</strong> <?php echo $fecha; ?></td>
            </tr>
            <tr>
                <td><strong>Folio:</strong> <?php echo $folio; ?></td>
            </tr>
            <tr>
                <td><strong>Cliente:</strong> <?php echo $objv->nombreCliente($idcliente); ?></td>
            </tr>
        </table>
        
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nombre Producto</th>
                    <th>Precio (Bs)</th>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql = "SELECT ve.id_venta, ve.fechaCompra, ve.id_cliente, art.nombre, art.precio, art.descripcion 
                        FROM ventas AS ve 
                        INNER JOIN articulos AS art ON ve.id_producto = art.id_producto 
                        WHERE ve.id_venta = '$idventa'";
                $result = mysqli_query($conexion, $sql);
                $total = 0;
                while ($mostrar = mysqli_fetch_assoc($result)):
                ?>
                <tr>
                    <td><?php echo $mostrar['nombre']; ?></td>
                    <td><?php echo number_format($mostrar['precio'], 2); ?></td>
                    <td>1</td>
                    <td><?php echo $mostrar['descripcion']; ?></td>
                </tr>
                <?php 
                    $total += $mostrar['precio'];
                endwhile;
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="total text-end">Total: Bs <?php echo number_format($total, 2); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
 </body>
 </html>