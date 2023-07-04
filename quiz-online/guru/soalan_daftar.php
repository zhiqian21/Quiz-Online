<?PHP
# Memanggil fail header_guru.php
include('header_guru.php');

# --------- bahagian menyimpan data soalan baru --------
if(!empty($_POST))
{
	# Mengambil data POST
	$soalan		=	mysqli_real_escape_string($condb,$_POST['soalan']);
	$jawapan_a	=	mysqli_real_escape_string($condb,$_POST['jawapan_a']);
	$jawapan_b	=	mysqli_real_escape_string($condb,$_POST['jawapan_b']);
	$jawapan_c	=	mysqli_real_escape_string($condb,$_POST['jawapan_c']);
	$jawapan_d	=	mysqli_real_escape_string($condb,$_POST['jawapan_d']);
	
	# Menguji jika soalan yang dihasilkan mempunyai gambar
	if($_FILES['gambar']['size'] !=0)
	{
		# Bahagian memuat naik gambar soalan
		$timestmp			=	date("Y-m-dhisA");
		$saiz_fail			=	$_FILES['gambar']['size'];
		$nama_fail			=	basename($_FILES["gambar"]["name"]);
		$jenis_gambar		=	pathinfo($nama_fail,PATHINFO_EXTENSION);
		$lokasi				=	$_FILES['gambar']['tmp_name'];
		$nama_baru_gambar	=	"../images/".$timestmp.".".$jenis_gambar;
		move_uploaded_file($lokasi,$nama_baru_gambar);
		
		# Arahan untuk menyimpan soalan yang mempunyai gambar
		$arahan_simpan="insert into soalan
		(no_set,soalan,gambar,jawapan_a,jawapan_b,jawapan_c,jawapan_d)
		values
		('".$_GET['no_set']."','$soalan','$nama_baru_gambar','$jawapan_a','$jawapan_b','$jawapan_c','$jawapan_d')";
	}
	else
	{
		# arahan untuk menyimpan soalan yang tidak mempunyai gambar
		$arahan_simpan="insert into soalan
		(no_set,soalan,gambar,jawapan_a,jawapan_b,jawapan_c,jawapan_d)
		values
		('".$_GET['no_set']."','$soalan',' ','$jawapan_a','$jawapan_b','$jawapan_c','$jawapan_d')";
	}
	# Menyemak kewujudan data soalan dan jawapan
	if(empty($soalan) or empty($jawapan_a) or empty($jawapan_b) or empty($jawapan_c) or empty($jawapan_d))
	{
		die("<script>alert('Sila lengkapkan maklumat');
		window.history.back();</script>");
	}
	# Melaksanakan arahan untuk menyimpan soalan
		if(mysqli_query($condb,$arahan_simpan))
		{
			# Data soalan berjaya disimpan
			echo "<script>alert('Pendaftaran BERJAYA.');
			window.location.href='soalan_daftar.php?no_set=".$_GET['no_set']."&topik=".$_GET['topik']."';
			</script>";
		}
		else
		{
			# data soalan gagal disimpan
			echo "<script>alert('Pendaftaran GAGAL.');
			window.location.href='soalan_daftar.php?no_set=".$_GET['no_set']."&topik=".$_GET['topik']."';
			</script>";
		}
}
?>
<!-- Bahagian untuk memaparkan soalan yang telah didaftarkan-->
<?PHP include ('../butang_saiz.php'); ?>
<br>
<div class="w3-container w3-card w3-panel w3-leftbar w3-border-black w3-metro-light-blue">
    <p><b class="w3-large">Daftar Soalan Baru</b>
</p>
</div>
<div class="w3-responsive">
<table width='100%' border='1' id='besar' class="w3-table-all w3-card-4">
	<tr class="w3-indigo">
		<td class="w3-center"><b>Soalan</b></td>
		<td class="w3-center"><b>Gambar Soalan</b></td>
		<td class="w3-center"><b>Jawapan A <i class="fas fa-check-circle"></i></b></td>
		<td class="w3-center"><b>Pilihan B <i class="fas fa-times-circle"></i></b></td>
		<td class="w3-center"><b>Pilihan C <i class="fas fa-times-circle"></i></b></td>
		<td class="w3-center"><b>Pilihan D <i class="fas fa-times-circle"></i></b></td>
		
		<td class="w3-center"><b>Tindakan</b></td>
	</tr>
	<tr>
	<!-- Borang untuk mendaftar soalan baru-->
		<form action='' method='POST' enctype='multipart/form-data'>
			<td><textarea class='w3-input' name='soalan' rows="4" cols="25"></textarea></td>
			<td><input class='w3-file' type='file' name='gambar'></td>
			<td bgcolor='cyan'><textarea class='w3-input' name='jawapan_a' rows="4" cols="25"></textarea></td>
			<td bgcolor='pink'><textarea class='w3-input' name='jawapan_b' rows="4" cols="25"></textarea></td>
			<td bgcolor='pink'><textarea class='w3-input' name='jawapan_c' rows="4" cols="25"></textarea></td>
			<td bgcolor='pink'><textarea class='w3-input' name='jawapan_d' rows="4" cols="25"></textarea></td>
			<td class="w3-center">
            <button class="w3-button w3-block w3-border w3-round w3-blue" type="submit">Tambah <i class="fas fa-plus-circle"></i></button>
        </td>
		</form>
	</tr>

<?PHP
# arahan untuk mencari soalan berdasarkan set soalan
$arahan_soalan="select* from soalan
where no_set	=	'".$_GET['no_set']."'
order by no_soalan DESC";
# melaksanakan arahan untuk mencari soalan
$laksana_soalan=mysqli_query($condb,$arahan_soalan);

# mengambil data soalan yang ditemui
while ($data=mysqli_fetch_array($laksana_soalan))
{
	# Mengumpukkan data soalan kepada tatasusunan $data_get
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
	# Memaparkan soalan yang ditemui
	echo "<tr>
		<td>".$data['soalan']."</td>
		<td class='w3-center'><img src='".$data['gambar']."' width='50%'></td>
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
</table>
</div>
<?PHP include('footer_guru.php'); ?>