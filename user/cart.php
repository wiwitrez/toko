<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
// Mulai sesi
session_start();
require 'connect.php';
require 'item.php';

if(isset($_GET['id']) && !isset($_POST['update']))  { 
	$sql = "SELECT * FROM produk WHERE id=".$_GET['id'];
	$result = mysqli_query($con, $sql);
	$produk = mysqli_fetch_object($result); 
	$item = new Item();
	$item->id = $produk->id;
	$item->nama = $produk->nama;
	$item->harga = $produk->harga;
    $iteminstock = $produk->keterangan;
	$item->keterangan = 1;
	//Periksa produk dalam keranjang
	$index = -1;
	$cart = unserialize(serialize($_SESSION['cart']));
	for($i=0; $i<count($cart);$i++)
		if ($cart[$i]->id == $_GET['id']){
			$index = $i;
			break;
		}
		if($index == -1) 
			$_SESSION['cart'][] = $item; //$ _SESSION ['cart']: set $ cart sebagai variabel _session
		else {
			
			if (($cart[$index]->keterangan) < $iteminstock)
				 $cart[$index]->keterangan ++;
			     $_SESSION['cart'] = $cart;
		}
}
//Menghapus produk dalam keranjang
if(isset($_GET['index']) && !isset($_POST['update'])) {
	$cart = unserialize(serialize($_SESSION['cart']));
	unset($cart[$_GET['index']]);
	$cart = array_values($cart);
	$_SESSION['cart'] = $cart;
}
// Perbarui jumlah dalam keranjang
if(isset($_POST['update'])) {
  $arrQuantity = $_POST['keterangan'];
  $cart = unserialize(serialize($_SESSION['cart']));
  for($i=0; $i<count($cart);$i++) {
     $cart[$i]->quantity = $arrQuantity[$i];
  }
  $_SESSION['cart'] = $cart;
}
?>
<h2> Items in your cart: </h2> 
<form method="POST">
<table id="t01">
<tr>
	<th>Option</th>
	<th>Id</th>
	<th>nama</th>
	<th>harga</th>
	<th>Quantity</th>
	 
	<th>Total</th>
</tr>
<?php 
     $cart = unserialize(serialize($_SESSION['cart']));
 	 $s = 0;
 	 $index = 0;
 	for($i=0; $i<count($cart); $i++){
 		$s += $cart[$i]->harga * $cart[$i]->quantity;
 ?>	
   <tr>
    	<td><a href="cart.php?index=<?php echo $index; ?>" onclick="return confirm('Are you sure?')" >Delete</a> </td>
   		<td> <?php echo $cart[$i]->id; ?> </td>
   		<td> <?php echo $cart[$i]->nama; ?> </td>
   		<td>Rp. <?php echo $cart[$i]->harga; ?> </td>
        <td> <input type="number" min="1" value="<?php echo $cart[$i]->keterangan; ?>" nama="quantity[]"> </td>  
        <td> Rp.<?php echo $cart[$i]->harga * $cart[$i]->keterangan; ?> </td> 
   </tr>
 	<?php 
	 	$index++;
 	} ?>
 	<tr>
 		<td colspan="5" style="text-align:right; font-weight:bold">Sum 
         <input id="saveimg" type="image" src="images/save.png" nama="update" alt="Save Button">
         <input type="hidden" nama="update">
 		</td>
 		<td> Rp.<?php echo $s; ?> </td>
 	</tr>
</table>
</form>
<br>
<a href="index.php">Continue Shopping</a> | <a href="checkout.php">Checkout</a>
<?php 
if(isset($_GET["id"]) || isset($_GET["index"])){
 header('Location: cart.php');
} 
?>
</body>
 </html>