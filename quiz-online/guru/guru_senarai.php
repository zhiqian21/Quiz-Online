<?PHP
# memanggil fail header_guru.php
include('header_guru.php');

#menyemak kewujudan data POST untuk proses mendaftar guru baru
if(!empty($_POST))
{
	#mengambil data dari form yang dimasukkan oleh admin
	$nama			=	mysqli_real_escape_string($condb,$_POST['nama_baru']);
	$nokp			=	mysqli_real_escape_string($condb,$_POST['nokp_baru']);
	$katalaluan		=     mysqli_real_escape_string($condb,$_POST['katalaluan_baru']);
	$tahap			=	$_POST['tahap'];
	
	#menyemak kewujudan data yang diambil
	if(empty($nama) or empty($nokp) or empty($katalaluan) or empty($tahap))
	{
		#jika data tidak wujud, aturcara akan terhenti disini.
		die("<script>alert('Sila lengkapkan maklumat');
		window.history.back();<?script>");
	}
    
	# Had atas & had bawah. data validation bagi nokp guru
	if(strlen($nokp)!=12 or !is_numeric($nokp))
	{
		die("<script>alert('Ralat No K/P.');
		window.history.back();</script>");
	}
    
	# arahan untuk menyimpan data guru
	$arahan_simpan="insert into guru
		(nama_guru,nokp_guru,katalaluan_guru,tahap)
		values
		('$nama','$nokp','$katalaluan','$tahap')";
		
	# melaksanakan arahan untuk menyimpan data guru ke dalam jadual
	if(mysqli_query($condb,$arahan_simpan))
	{
		#data berjaya disimpan
		echo "<script>alert('Pendaftaran BERJAYA.');
		window.location.href='guru_senarai.php';</script>";
	}
	else
	{
		#data gagal disimpan
		echo "<script>alert('Pendaftaran GAGAL.');
		window.location.href='guru_senarai.php';</script>";
	}
}
?>

<!-- Bahagian untuk memaparkan senarai guru-->
<?PHP include ('../butang_saiz.php'); ?>
<br>
<div class="w3-container w3-panel w3-card w3-leftbar w3-border-black w3-metro-light-blue">
    <p><b class="w3-large">Senarai Guru</b>
    <a class="w3-right w3-button" href="guru_upload.php"><i class="fas fa-upload w3-large"></i> Upload Data Guru</a>
    </p>
</div>
<div class="w3-responsive">
<table width='100%' border='1' id='besar' class="w3-table-all w3-card-4">
	<tr class="w3-indigo">
        <td class="w3-center" style="width:25%"><b>Nama</b></td>
        <td class="w3-center" style="width:20%"><b>No K/P</b></td>
        <td class="w3-center" style="width:20%"><b>Katalaluan</b></td>
        <td class="w3-center" style="width:20%"><b>Tahap</b></td>
        <td class="w3-center" style="width:15%"><b>Tindakan</b></td>
	</tr>
	<tr>
	<!-- borang untuk mendaftar guru baru -->
		<form action=' ' method='POST'>
            
			<td class="w3-center"><input		class="w3-input w3-border w3-animate-input"  type='text'			name='nama_baru'></td>
            
			<td class="w3-center"><input		class="w3-input w3-border w3-animate-input" type='text'			name='nokp_baru'></td>
            
			<td class="w3-center"><input		class="w3-input w3-border w3-animate-input" type='password'		name='katalaluan_baru'></td>
            
			<td class="w3-center">
				<select class='w3-select' name='tahap'>
					<option value selected disabled>Pilih</option>
					<option value='GURU'>GURU</option>
					<option value='ADMIN'>ADMIN</option>
				</select>
			</td>
            
			<td class="w3-center">
            <button class="w3-button w3-block w3-border w3-round w3-blue" type="submit">Tambah <i class="fa fa-user-plus" aria-hidden="true"></i></button>
            </td>
            
		</form>
	</tr>

<?PHP
# arahan SQL untuk memilih data dari jadual guru
$arahan_cari_guru="select* from guru order by tahap ASC";

#melaksanakan arahan SQL diatas
$laksana_cari_guru=mysqli_query($condb,$arahan_cari_guru);

#mengambil semua data yang ditemui
while ($data=mysqli_fetch_array($laksana_cari_guru))
{
	#umpuk data kedalam tatasusunan.
	$data_guru=array(
	'nama_guru'					=>		$data['nama_guru'],
	'nokp_guru'					=>		$data['nokp_guru'],
	'katalaluan_guru'			=>		$data['katalaluan_guru']
	);
	
# memaparkan data dalam bentuk jadual baris demi baris
	echo "<tr>
		<td class='w3-center'>".$data['nama_guru']."</td>
		<td class='w3-center'>".$data['nokp_guru']."</td>
		<td class='w3-center'>".$data['katalaluan_guru']."</td>
		<td class='w3-center'>".$data['tahap']."</td>
		<td class='w3-center'>
        
<a href='guru_kemaskini.php?".http_build_query($data_guru)."' title='Kemaskini' > <i class='fas fa-user-edit w3-text-teal w3-xlarge w3-margin-right'></i></a>
			
<a href='padam.php?jadual=guru&medan=nokp_guru&kp=".$data['nokp_guru']."'onClick=\"return confirm('Sebelum memadam data guru, pastikan beliau tidak mempunyai kelas terlebih dahulu')\" title='Padam' ><i class='fas fa-trash-alt w3-text-red w3-xlarge w3-margin-left' aria-hidden='true'></i></a>

</td>
	</tr>";
}
?>
</table>
</div>
<?PHP include('footer_guru.php');?>