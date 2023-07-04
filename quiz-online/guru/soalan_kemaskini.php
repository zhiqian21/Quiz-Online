<?PHP
# memanggil fail header_guru.php
include('header_guru.php');

# bahagian untuk menyimpan data yang telah dikemaskini
# menyemak kewujudan data GET
if(empty($_GET))
{
die("<script>alert('Akses tanpa kebenaran.');
window.location.href='soalan_daftar.php?no_set=".$_GET['no_set']."&topik=".$_GET['topik']."';</script> ");
}

# menyemak kewujudan data POST
if(!empty($_POST))
{
	# Mengambil data POST
	$soalan		=	mysqli_real_escape_string($condb,$_POST['soalan']);
	$jawapan_a	=	mysqli_real_escape_string($condb,$_POST['jawapan_a']);
	$jawapan_b	=	mysqli_real_escape_string($condb,$_POST['jawapan_b']);
	$jawapan_c	=	mysqli_real_escape_string($condb,$_POST['jawapan_c']);
	$jawapan_d	=	mysqli_real_escape_string($condb,$_POST['jawapan_d']);
	
	# Menyemak kewujudan data yang telah diambil
	if(empty($soalan) or empty($jawapan_a) or empty($jawapan_b) or empty($jawapan_c) or empty($jawapan_d))
	{
		die("<script>alert('Sila lengkapkan maklumat');
		window.history.back();</script>");
	}
	# Arahan untuk mengemaskini soalan dan jawapan
	$arahan_kemaskini="update soalan
	set
	soalan		=	'".$_POST['soalan']."',
	jawapan_a	=	'".$_POST['jawapan_a']."',
	jawapan_b	=	'".$_POST['jawapan_b']."',
	jawapan_c	=	'".$_POST['jawapan_c']."',
	jawapan_d	=	'".$_POST['jawapan_d']."'
	where
	no_soalan	=	'".$_GET['no_soalan']."' ";
	
	# Melaksanakan arahan untuk mengemaskini soalan
	if(mysqli_query($condb,$arahan_kemaskini))
	{
		# Soalan berjaya dikemaskini
		echo "<script>alert('Kemaskini BERJAYA.');
		window.location.href='soalan_daftar.php?no_set=".$_GET['no_set']."&topik=".$_GET['topik']."';</script>";
	}
	else
	{
		# Soalan gagal dikemaskini
		echo "<script>alert('Kemaskini GAGAL.');
		window.location.href='soalan_daftar.php?no_set=".$_GET['no_set']."&topik=".$_GET['topik']."';</script>";
	}
}
?>
<!-- Bahagian untuk memaparkan soalan yang telah didaftarkan-->
<?PHP include ('../butang_saiz.php'); ?>
<br>
<div class="w3-container w3-card w3-panel w3-leftbar w3-border-black w3-metro-light-blue">
    <p><b class="w3-large">Kemaskini Soalan</b>
</p>
</div>
<div class="w3-responsive">
<table width='100%' border='1' id='besar' class="w3-table-all w3-card-4">
	<tr class="w3-indigo">
		<td class="w3-center"><b>Soalan</b></td>
		<td class="w3-center"><b>Jawapan A <i class="fas fa-check-circle"></i></b></td>
		<td class="w3-center"><b>Pilihan B <i class="fas fa-times-circle"></i></b></td>
		<td class="w3-center"><b>Pilihan C <i class="fas fa-times-circle"></i></b></td>
		<td class="w3-center"><b>Pilihan D <i class="fas fa-times-circle"></i></b></td>
		<td class="w3-center"><b>Tindakan</b></td>
	</tr>
	<tr>
	<!-- Bahagian borang untuk mengemaskini soalan dan jawapan-->
	<form action='' method='POST'>
	
	<td><textarea class='w3-input' name='soalan' rows="4" cols="25">
	<?PHP echo $_GET['soalan']; ?></textarea></td>
	
	<td bgcolor='cyan'><textarea class='w3-input' name='jawapan_a' rows="4" cols="25">
	<?PHP echo $_GET['jawapan_a']; ?></textarea></td>
	
	<td bgcolor='pink'><textarea class='w3-input' name='jawapan_b' rows="4" cols="25">
	<?PHP echo $_GET['jawapan_b']; ?></textarea></td>
	
	<td bgcolor='pink'><textarea class='w3-input' name='jawapan_c' rows="4" cols="25">
	<?PHP echo $_GET['jawapan_c']; ?></textarea></td>
	
	<td bgcolor='pink'><textarea class='w3-input' name='jawapan_d' rows="4" cols="25">
	<?PHP echo $_GET['jawapan_d']; ?></textarea></td>
	
	<td class="w3-center">
        <button class="w3-button w3-block w3-border w3-round w3-blue" type="submit">Kemaskini <i class="fas fa-edit"></i></button>
     </td>
	
	</form>
	</tr>

<?PHP

# arahan untuk mencari soalan yang berkaitan dengan set soalan yang telah dipilih
$arahan_soalan="select* from soalan
where no_set	=	'".$_GET['no_set']."'
order by no_soalan DESC";

# melaksanakan arahan untuk mencari soalan
$laksana_soalan=mysqli_query($condb,$arahan_soalan);

# pembolehubah $data mengambil data yang ditemui
while ($data=mysqli_fetch_array($laksana_soalan))
{
	# mengumpukkan data yan ditemui kepada tatasusunan $data_get
	$data_get=array(
		'no_set'	=>	$data['no_set'],
		'no_soalan'	=>	$data['no_soalan'],
		'topik'		=>	$data['topik'],
		'soalan'	=>	$data['soalan'],
		'jawapan_a'	=>	$data['jawapan_a'],
		'jawapan_b'	=>	$data['jawapan_b'],
		'jawapan_c'	=>	$data['jawapan_c'],
		'jawapan_d'	=>	$data['jawapan_d']
	);
	# Memaparkan data yang ditemui baris demi baris
	echo "<tr>
		<td>".$data['soalan']."</td>
		<td class='w3-center'>".$data['jawapan_a']."</td>
		<td class='w3-center'>".$data['jawapan_b']."</td>
		<td class='w3-center'>".$data['jawapan_c']."</td>
		<td class='w3-center'>".$data['jawapan_d']."</td>
		<td class='w3-center'>
		
		<a href='soalan_kemaskini.php?".http_build_query($data_get)."' title='Kemaskini' > <i class='fas fa-edit w3-text-teal w3-xlarge w3-margin-left w3-margin-right'></i></a>
		<a href='padam.php?jadual=soalan&medan=no_soalan&kp=".$data['no_soalan']."' onClick=\"return confirm('Anda pasti anda ingin memadam data ini.')\"title='Padam' ><i class='fas fa-trash-alt w3-text-red w3-xlarge w3-margin-right' aria-hidden='true'></i></a>
		
		</td>
	</tr>";
}
    ?>
</table></div>
<?PHP include('footer_guru.php'); ?>