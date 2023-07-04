<?PHP
# memanggil header_guru.php
include('header_guru.php');

#------------- bahagian menambah data baru -------------

# menyemak kewujudan data POST
if(!empty($_POST))
{
	# Mengambil data POST
	$nama_kelas		=	mysqli_real_escape_string($condb,$_POST['nama_kelas']);
	$tingkatan		=	mysqli_real_escape_string($condb,$_POST['tingkatan']);
	$nokp_guru		=	$_POST['nokp_guru'];
	
	# Menyemak kewujudan data yang di ambil
	if(empty($nama_kelas) or empty($nokp_guru) or empty($tingkatan))
	{
		die("<script>alert('Sila lengkapkan maklumat');
		window.history.back();</script>");
	}
	
	# arahan untuk memasukkan data ke dalam kelas.
	$arahan_simpan="insert into kelas
		(tingkatan,nama_kelas,nokp_guru)
		values
		('$tingkatan','$nama_kelas','$nokp_guru')";
		
	# Melaksanakan arahan untuk memasukkan data
	if(mysqli_query($condb,$arahan_simpan))
	{
		# Data berjaya disimpan
		echo "<script>alert('Pendaftaran BERJAYA.');
		window.location.href='senarai_kelas.php';</script>";
	}
	else
	{
		# Data gagal disimpan
		echo "<script>alert('Pendaftaran GAGAL.');
		window.location.href='senarai_kelas.php';</script>";
	}
}

# ---------- bahagian mengemaskini guru kelas ------------
# menyemak kewujudan data GET
if(!empty($_GET))
{
	# mengambil data GET
	$id_kelas		=	$_GET['id_kelas'];
	$nokp_guru		=	$_GET['nokp_guru_baru'];
	
	# menyemak kewujudan data yang diambil
	if(empty($id_kelas) or empty($nokp_guru))
	{
		die("<script>alert('Sila lengkapkan maklumat2');
		window.history.back();</script>");
	}
# arahan untuk mengemaskini guru kelas
	$arahan_kemaskini="update kelas set
	nokp_guru='$nokp_guru'
	where
	id_kelas='$id_kelas' ";
	
	# melaksanakan arahan untuk mengemaskini guru kelas
	if(mysqli_query($condb,$arahan_kemaskini))
	{
		# Kemaskini BERJAYA
		echo "<script>alert('Kemaskini BERJAYA.');
		window.location.href='senarai_kelas.php';</script>";
	}
	else
	{
		# Kemaskini GAGAL
		echo "<script>alert('Kemaskini GAGAL.');
		window.location.href='senarai_kelas.php';</script>";
	}
}
?>

<!------------ bahagian untuk memaparkan senarai kelas dan guru -------------->
<?PHP include ('../butang_saiz.php'); ?>
<br>
<div class="w3-container w3-panel w3-card w3-leftbar w3-border-black w3-metro-light-blue">
    <p><b class="w3-large">Senarai Kelas</b>
</p>
</div>
<div class="w3-responsive">
<table width='100%' border='1' id='besar' class="w3-table-all w3-card-4">
	<tr class="w3-indigo">
        <td class="w3-center" style="width:15%"><b>Tingkatan</b></td>
        <td class="w3-center" style="width:20%"><b>Kelas</b></td>
        <td class="w3-center" style="width:20%"><b>Guru Subjek</b></td>
        <td class="w3-center" style="width:15%"><b>Tukar Guru</b></td>
        <td class="w3-center" style="width:20%"><b>Tindakan</b></td>
	</tr>
	<tr>
	<!-- borang untuk mendaftar kelas baru -->
		<form name='tambah_kelas' action='' method='POST'>
			<td class="w3-center"><select class='w3-select' name='tingkatan'>
                <option value selected disable>Pilih</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                </select>
            </td>
            
			<td class="w3-center"><select class='w3-select' name='nama_kelas'>
                <option value selected disable>Pilih</option>
                <option value="Jerai">Jerai</option>
                <option value="Tahan">Tahan</option>
                <option value="Kinabalu">Kinabalu</option>
                <option value="Ledang">Ledang</option>
                <option value="Santubong">Santubong</option>
                <option value="Gayong">Gayong</option>
                <option value="Chamah">Chamah</option>
                <option value="Nuang">Nuang</option>
                <option value="Angsi">Angsi</option>
                <option value="Murud">Murud</option>
                <option value="Brinchang">Brinchang</option>
                </select>
            </td>
			
			<td class="w3-center"><select class='w3-select' name='nokp_guru'>
				<option value selected disable>Pilih</option>
				<?PHP
				# arahan untuk mencari semua data dari jadual jenis_guru
				$sql="select* from guru";
				
				# Melaksanakan arahan mencari data 
				$laksana_arahan_cari=mysqli_query($condb,$sql);
				
				# pemboleh ubah $rekod_guru mengambil data yang ditemui baris demi baris
				while ($rekod_guru=mysqli_fetch_array($laksana_arahan_cari))
				{
					# memaparkan data yang ditemui dalam element <option></option>
					echo "<option value=".$rekod_guru['nokp_guru'].">".$rekod_guru['nama_guru']."</option>";
				}
				
				?>
			</select>
			</td>
			
			<td></td>
			<td class="w3-center">
            <button class="w3-button w3-block w3-border w3-round w3-blue" type="submit">Tambah <i class="fas fa-chalkboard-teacher"></i></button>
        </td>
		</form>
	</tr>
	
<?PHP
# Arahan untuk mencari data yang sepadan dari jadual kelas dan guru
$arahan_cari_kelas="select* from kelas, guru
where
kelas.nokp_guru		=		guru.nokp_guru
order by id_kelas ASC";

# melaksanakan arahan untuk mencari data
$laksana_cari_kelas=mysqli_query($condb,$arahan_cari_kelas);

# Pembolehubah $data mengambil data yang ditemui
while ($data=mysqli_fetch_array($laksana_cari_kelas))
{
	# Memaparkan data baris demi baris 
	echo "<tr>
				<td class='w3-center'>".$data['tingkatan']."</td>
				<td class='w3-center'>".$data['nama_kelas']."</td>
				<td class='w3-center'>".$data['nama_guru']."</td>
				<td class='w3-center'>
				<form action='' method='GET'>
				<input type='hidden' name='id_kelas' value='".$data['id_kelas']."'>
				<select class='w3-select' name='nokp_guru_baru'>
						<option value selected disable>Pilih</option>";
						
		# arahan untuk mencari semua data dari jadual jenis_guru
		$sql2="select* from guru";
		
		# Melaksanakan arahan mencari data
		$laksana_arahan_cari2=mysqli_query($condb,$sql2);
		
		# pemboleh ubah $rekod_guru mengambil data yang ditemui baris demi baris
		while ($rekod_guru2=mysqli_fetch_array($laksana_arahan_cari2))
		{
			# memaparkan data yang ditemui dalam element <option></option>
			echo "<option value=".$rekod_guru2['nokp_guru'].">".$rekod_guru2['nama_guru']."</option>";
		}
		
		echo"</select></td>
		<td class='w3-center'>
		
		<button class='w3-button w3-border w3-margin-right w3-round w3-teal' type='submit'><i class='fas fa-user-edit'></i> Kemaksini</button>
        
		<button class='w3-button w3-border w3-margin-left w3-round w3-red' onclick=\"location.href='padam.php?jadual=kelas&medan=id_kelas&kp=".$data['id_kelas']."'\" type='button'><i class='fas fa-trash-alt' aria-hidden='true'></i> Padam</button>
        
		</td>
		
	</tr>
	</form>";
}
?>
    </table></div>
<?PHP include('footer_guru.php'); ?>