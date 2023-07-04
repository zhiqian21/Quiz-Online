<?PHP
# Memanggil header_guru.php
include('header_guru.php');

# ----- bahagian untuk menyimpan data set_solan baru

# Menyemak kewujudan data POST
if(!empty($_POST))
{
	# Mengambil data POST
	$topik		=	mysqli_real_escape_string($condb,$_POST['topik']);
	$arahan		=	mysqli_real_escape_string($condb,$_POST['arahan']);
	$jenis		=	$_POST['jenis'];
	$tarikh		=	$_POST['tarikh'];
    
	# Menetapkan masa kuiz
	if($jenis=='Latihan')
	$masa	=	"Tiada";
	else
	$masa	=	 mysqli_real_escape_string($condb,$_POST['masa']);

	# menyemak kewujudan data yang diambil
	if(empty($topik) or empty($arahan) or empty($jenis) or empty($tarikh) or empty($masa))
	{
		# jika terdapat pembolehubah yang tidak mempunyai nilai , aturcara akan dihentikan
		die("<script>alert('Sila lengkapkan maklumat.');
		window.location.href='soalan_set.php';</script>");
	}
	# Arahan untuk menyimpan data set_soalan baru
		$arahan_simpan="insert into set_soalan
		(topik,arahan,jenis,tarikh,masa,nokp_guru)
		values
		('$topik','$arahan','$jenis','$tarikh','$masa','".$_SESSION['nokp_guru']."')";
	
	# Melaksanakan arahan untuk menyimpan data 
	if(mysqli_query($condb,$arahan_simpan))
		{
		# data berjaya disimpan
		echo "<script>alert('Pendaftaran BERJAYA.');
		window.location.href='soalan_set.php';</script>";
		}
		else
		{
		# data gagal disimpan
		echo "<script>alert('Pendaftaran GAGAL.');
		window.location.href='soalan_set.php';
		</script>";
		}
}
?>

<!-- bahagian untuk memaparkan senarai set soalan -->
<?PHP include ('../butang_saiz.php'); ?>
<br>
<div class="w3-container w3-panel w3-card w3-leftbar w3-border-black w3-metro-light-blue">
    <p><b class="w3-large">Senarai Set Soalan</b>
</p>
</div>
<div class="w3-responsive">
<table width='100%' border='1' id='besar' class="w3-table-all w3-card-4">
	<tr class="w3-indigo">
        <td class="w3-center" style="width:25%"><b>Topik</b></td>
        <td class="w3-center" style="width:25%"><b>Arahan</b></td>
        <td class="w3-center" style="width:10%"><b>Jenis</b></td>
        <td class="w3-center" style="width:10%"><b>Tarikh</b></td>
        <td class="w3-center" style="width:15%"><b>Masa</b></td>
		<td class="w3-center" style="width:15%"></td>
	</tr>
	<tr>
	<!-- bahagian borang untuk mendaftar set soalan yang baru -->
		<form action='' method='POST'>
		<td><textarea class='w3-input' name='topik' rows="4" cols="25"></textarea></td>
		<td><textarea class='w3-input' name='arahan' rows="4" cols="25"></textarea></td>
		<td>
			<select class='w3-select' name='jenis'>
				<option value selected disabled>Pilih</option>
				<option value='Latihan'>Latihan</option>
				<option value='Kuiz'>Kuiz</option>
			</select>
		</td>
		<td><input class='w3-input' type='date' name='tarikh'></td>
		<td><input class='w3-input' type='number' name='masa' placeholder='Dalam minit'></td>
		<td class="w3-center">
            <button class="w3-button w3-block w3-border w3-round w3-blue" type="submit">Simpan <i class="fas fa-save"></i></button>
        </td>
		</form>
	</tr>
<?PHP
# arahan untuk memilih data dari jadual set soalan 
$arahan_set		=	"select* from set_soalan order by no_set DESC";

# melaksanakan arahan untuk memilih data
$laksana_set	=	mysqli_query($condb,$arahan_set);

# pembolehubah $data mengambil data yang ditemui
while ($data=mysqli_fetch_array($laksana_set))
{
	# mengumpukkan data yang ditemui ke dalam tatasusunan $data_get
	$data_get=array(
		'no_set'	=>	$data['no_set'],
		'topik'		=>	$data['topik'],
		'arahan'	=>	$data['arahan'],
		'jenis'		=>	$data['jenis'],
		'tarikh'	=>	$data['tarikh'],
		'masa'		=>	$data['masa'],
		'nokp_guru'	=>	$data['nokp_guru']
	);
	# Memaparkan data yang diambil baris demi baris
		echo "<tr>
			<td class='w3-center'>	".$data['topik']."	</td>
			<td>	".$data['arahan']."	</td>
			<td class='w3-center'>	".$data['jenis']."	</td>
			<td class='w3-center'>	".$data['tarikh']."	</td>
			<td class='w3-center'>	".$data['masa']."	</td>
			<td class='w3-center'>	
			
			<a href='soalan_daftar.php?no_set=".$data['no_set']."&topik=".$data['topik']."'title='Soalan' > <i class='fas fa-external-link-alt w3-xlarge w3-margin-right'></i></a>
            
			<a href='soalan_set_kemaskini.php?".http_build_query($data_get)."'title='Kemaskini' > <i class='fas fa-edit w3-margin-right w3-margin-left w3-xlarge w3-text-teal'></i></a>
            
			<a href='padam.php?jadual=set_soalan&medan=no_set&kp=".$data['no_set']."'onClick=\"return confirm('Anda pasti anda ingin memadam data ini.')\" title='Padam' ><i class='fas fa-trash-alt w3-text-red w3-xlarge w3-margin-left' aria-hidden='true'></i></a>
			
			</td>
		</tr>";
}
?>
    </table></div>
<?PHP include('footer_guru.php'); ?>