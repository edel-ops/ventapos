<?php 
session_start();
include_once "encabezado.php";
if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;

?>
	<div class="col-xs-12">
		<h1>Vender</h1>
		<?php
			if(isset($_GET["status"])){
				if($_GET["status"] === "1"){
					?>
						<div class="alert alert-success">
							<strong>¡Correcto!</strong> Venta realizada correctamente
						</div>
					<?php
				}else if($_GET["status"] === "2"){
					?>
					<div class="alert alert-info">
							<strong>Venta cancelada</strong>
						</div>
					<?php
				}else if($_GET["status"] === "3"){
					?>
					<div class="alert alert-info">
							<strong>Ok</strong> Producto quitado del carrito
						</div>
					<?php
				}else if($_GET["status"] === "4"){
					?>
					<div class="alert alert-warning">
							<strong>Error:</strong> El producto que buscas no existe
						</div>
					<?php
				}else if($_GET["status"] === "5"){
					?>
					<div class="alert alert-danger">
							<strong>Error: </strong>El producto está agotado
						</div>
					<?php
				}else{
					?>
					<div class="alert alert-danger">
							<strong>Error:</strong> Algo salió mal mientras se realizaba la venta
						</div>
					<?php
				}
			}
		?>
		<br>
		<form method="post" action="agregarAlCarrito.php">
			<label for="codigo">Código de barras:</label>
			<input autocomplete="off" autofocus class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">
		</form>
		<br><br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Código</th>
					<th>Descripción</th>
					<th>Precio de venta</th>
					<th>Cantidad</th>
					<th>Total</th>
					<th>Quitar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($_SESSION["carrito"] as $indice => $producto){ 
						$granTotal += $producto->total;
					?>
				<tr>
					<td><?php echo $producto->id ?></td>
					<td><?php echo $producto->codigo ?></td>
					<td><?php echo $producto->descripcion ?></td>
					<td><?php echo $producto->precioVenta ?></td>
					<td><?php echo $producto->cantidad ?></td>
					<td><?php echo $producto->total ?></td>
					<td><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		
		<div>
			<h3 class="detalle-pago">Total: <?php echo $granTotal; ?></h3>			
			<h3 class="detalle-pago">Pago: <?php echo $monto + 0; ?></h3> <!-- $monto es una variable nula o 
			vacia hasta q se introduzca un valor en el box monto_pagado por lo q en el documento 
			no aparecera nada a la par de pago: entonces sumamos + 0 
			para q el valor incial sea 0 y este se muestre como pago: 0 -->
			<!-- condicional para calcular lo que el clienta resta o falta por pagar si es menor o igual que 0 siempre se
			mostrara un cero si es mayor que cero mostrara lo que falta que el cliente pague -->
			<?php 
				if ($granTotal-$monto <= 0) {
					?>
					<h3 class="detalle-pago">Resta: 0
				<?php
				} else {
					?>
					<h3 class="detalle-pago">Resta: <?php echo $granTotal-$monto; ?></h3>
				<?php
				}				
			?>

			<?php 
				if ($monto - $granTotal <= 0) {
					?>
					<h3 class="detalle-pago">Cambio: 0
				<?php
				} else {
					?>
					<h3 class="detalle-pago">Cambio: <?php echo $monto-$granTotal; ?></h3>
				<?php
				}				
			?>			
			
		</div>					
				
		<!--<select name="metodo" class="btn btn-metodo_pago" onChange="redireccionar(this)">
			<option value="1">Metodo de pago</option>
			<option value="2">Efectivo</option>
			<option value="3">Tarjeta</option>
		</select> 
			

		<script>
		function redireccionar(obj) {
			var valorSeleccionado = obj.options[obj.selectedIndex].value; 
			if ( valorSeleccionado == 2 ) {
				document.location = 'http://www.google.com';
			}
			if ( valorSeleccionado == 3 ) {
				document.location = 'http://www.eva.uni.edu.ni';
			}
			// etc..
		}
		</script>-->

		
		<div class="indicador-pago">
			<form method="POST" action="pagoConEfectivo.php">							
				<input type="hidden" name="numero" value="<?php echo $monto?>">
				<input autocomplete="off" name="monto_efectivo" type="text" placeholder="Monto Efectivo">
				

			</form>
		</div>
	
		<div class="indicador-pago">
			<form method="POST" action="pagoConTarjeta.php">
				<input type="hidden" name="numero" value="<?php echo $monto?>">
				<input autocomplete="off" name="monto_tarjeta" type="text" placeholder="Monto Tarjeta">
				
			</form> 
		</div>
		

		<form action="./terminarVenta.php" method="POST" class="botonera">
			<input name="total" type="hidden" value="<?php echo $granTotal;?>">			
			<button type="submit" class="btn btn-success">Terminar venta</button>			
			<a href="./cancelarVenta.php" class="btn btn-danger">Cancelar venta</a>
		</form>

		
	</div>
	
<?php include_once "pie.php" ?>