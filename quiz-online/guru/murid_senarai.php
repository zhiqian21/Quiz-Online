<?PHP
# Memanggil fail header_guru.php
include('header_guru.php');

# menyemak kewujudan data POST bagi mendaftar murid baru
if(!empty($_POST))
{
	# mengambil data murid baru yang dihantar melalui borang pada senarai 
	$nama			=	mysqli_real_escape_string($condb,$_POST['nama_baru']);
	$nokp			=	mysqli_real_escape_string($condb,$_POST['nokp_baru']);
	$katalaluan		=	mysqli_real_escape_string($condb,$_POST['katalaluan_baru']);
	$id_kelas		=	$_POST['id_kelas'];
	
	# menyemak kewujudan data yang dihantar
	if(empty($nama) or empty($nokp) or empty($katalaluan) or empty($id_kelas))
	{
		# jika ada 1 data yang tidak diisi, aturcara akan terhenti disini
		die("<script>alert('Sila lengkapkan maklumat');
		window.history.back();</script>");
	}
    
	# Had atas & had bawah. data validation bagi nokp guru
	if(strlen($nokp)!=12 or !is_numeric($nokp))
	{
		die("<script>alert('Ralat No K/P.');
		window.history.back();</script>");
	}
	
	# arahan untuk menyimpan data murid
	$arahan_simpan="insert into murid
		(nama_murid, nokp_murid, katalaluan_murid, id_kelas)
		values
		('$nama','$nokp','$katalaluan','$id_kelas')";
		
	# Melaksanakan arahan simpan data murid
	if(mysqli_query($condb,$arahan_simpan))
	{
		#data berjaya disimpan
		echo "<script>alert('Pendaftaran BERJAYA.');
		window.location.href='murid_senarai.php';</script>";
	}
	else
	{
		#data gagal disimpan
		echo "<script>alert('Pendaftaran GAGAL.');
		window.location.href='murid_senarai.php';</script>";
	}
}
?>

<!-- link untuk membesarkan saiz tulisan bagi aspek kepelbagaian pengguna-->
<?PHP include ('../butang_saiz.php'); ?>
<br>

<div class="w3-container w3-card w3-panel w3-leftbar w3-border-black w3-metro-light-blue">
    <p><b class="w3-large w3-margin-left">Senarai Murid</b>
    <br>
    <a class="w3-button w3-margin-top w3-card" href='senarai_nama_murid.php'><i class="fas fa-print w3-large"></i> Cetak Senarai Nama</a>
    <a class="w3-right w3-margin-top w3-card w3-button" href="murid_upload.php"><i class="fas fa-upload w3-large"></i> Upload Data Murid</a>
    </p>
</div>

<div class="w3-responsive">
<table width='100%' border='1' id='besar' class="w3-table-all w3-card-4">
    <tr class="w3-indigo">
        <td class="w3-center" style="width:25%"><b>Nama Murid</b></td>
        <td class="w3-center" style="width:20%"><b>No K/P Murid</b></td>
        <td class="w3-center" style="width:20%"><b>Katalaluan Murid</b></td>
        <td class="w3-center" style="width:20%"><b>Kelas</b></td>
        <td class="w3-center" style="width:15%"><b>Tindakan</b></td>
	</tr>
    
	<tr>
	<!-- borang untuk mendaftar murid baru -->
		<form action='' method='POST'>
			<td class="w3-center"><input class="w3-input w3-border w3-animate-input" type='text'		name='nama_baru'></td>
			<td class="w3-center"><input class="w3-input w3-border w3-animate-input" type='text'		name='nokp_baru'></td>
			<td class="w3-center"><input class="w3-input w3-border w3-animate-input" type='password'	name='katalaluan_baru'></td>
			<td class="w3-center">
			<select class='w3-select' name='id_kelas'>
            <option value selected disable>Pilih</option>
	<?PHP
	# arahan untuk mencari semua data dari jadual kelas
	$sql="select* from kelas";
	
	# Melaksanakan arahan mencari data
	$laksana_arahan_cari=mysqli_query($condb,$sql);
	
	# pemboleh ubah $rekod_bilik mengambil data yang ditemui baris demi baris 
	while ($rekod_bilik=mysqli_fetch_array($laksana_arahan_cari))
	{
		# memaparkan data yang ditemui dalam element <option></option>
		echo "<option value=".$rekod_bilik['id_kelas'].">
		".$rekod_bilik['tingkatan']." ".$rekod_bilik['nama_kelas']."</option>";
	}
	
	?>
	
    </select>
    </td>
        <td class="w3-center">
            <button class="w3-button w3-block w3-border w3-round w3-blue" type="submit">Tambah <i class="fa fa-user-plus" aria-hidden="true"></i></button>
        </td>
    </form>
</tr>
		
	<?PHP
	# arahan untuk mencari semua data murid yang berdaftar
	$arahan_cari_murid="select* from murid, kelas
	where
	murid.id_kelas		=		kelas.id_kelas
	order by kelas.tingkatan, kelas.nama_kelas, murid.nama_murid ASC";
	
	#melaksanakan arahan untuk mencari
	$laksana_cari_murid=mysqli_query($condb,$arahan_cari_murid);
	
	# pembolehubah $data mengambil semua data yang ditemui
	while ($data=mysqli_fetch_array($laksana_cari_murid))
	{
		# Mengumpukan data murid kedalam tatasusunan data_murid
		$data_murid=array(
			'nama_murid'			=>		$data['nama_murid'],
			'nokp_murid'			=>		$data['nokp_murid'],
			'katalaluan_murid'		=>		$data['katalaluan_murid']
		);
		# memaparkan data murid baris demi baris
		echo "
		<tr>
			<td class='w3-center'>".$data['nama_murid']."</td>
			<td class='w3-center'>".$data['nokp_murid']."</td>
			<td class='w3-center'>".$data['katalaluan_murid']."</td>
			<td class='w3-center'>".$data['tingkatan']." ".$data['nama_kelas']."</td>
			<td class='w3-center'>
			
	<a href='murid_kemaskini.php?".http_build_query($data_murid)."' title='Kemaskini' > <i class='fas fa-user-edit w3-text-teal w3-xlarge w3-margin-right'></i></a>

	<a href='padam.php?jadual=murid&medan=nokp_murid&kp=".$data['nokp_murid']."'onClick=\"return confirm('Anda pasti anda ingin memadam data ini.')\" title='Padam' ><i class='fas fa-trash-alt w3-text-red w3-xlarge w3-margin-left' aria-hidden='true'></i></a>
			</td>
		</tr>";
	}
	?>
    </table></div>
	<?PHP include('footer_guru.php'); ?> 