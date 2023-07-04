<?PHP
# memanggil fail header_guru.php
include('header_guru.php');

# menyemak kewujudan data GET untuk mengelak fail diakses tanpa data GET
if(empty($_GET))
{
	die("<script>alert('Akses tanpa kebenaran.');
		window.location.href='murid_senarai.php';</script>");
}

if(!empty($_POST))
{
	# mengambil data baru yang diubah suai melalui borang di bawah
	$nama			=	mysqli_real_escape_string($condb,$_POST['nama_baru']);
	$nokp			=	mysqli_real_escape_string($condb,$_POST['nokp_baru']);
	$katalaluan		=	mysqli_real_escape_string($condb,$_POST['katalaluan_baru']);
	$id_kelas		=	$_POST['id_kelas'];
	
	# menyemak kewujudan data yang diambil
		if(empty($nama) or empty($nokp) or empty($katalaluan) or empty($id_kelas))
		{
			# jika data tidak wujud, aturcara akan terhenti di sini.
			die("<script>alert('Sila lengkapkan maklumat.');
			window.history.back();</script>");
		}
		
		# Had atas & had bawah. data validation bagi nokp murid
		if(strlen($nokp)!=12 or !is_numeric($nokp))
		{
			die("<script>alert('Ralat No K/P.');
			window.history.back();</script>");
		}
		
		# arahan untuk Mengemaskini data murid
		$arahan_kemaskini="update murid set
		nama_murid			=	'$nama',
		nokp_murid			=	'$nokp',
		katalaluan_murid	=	'$katalaluan',
		id_kelas			=	'$id_kelas'
		where
		nokp_murid			=	'".$_GET['nokp_murid']."' ";
		
		# melaksanakan arahan untuk menyimpan data murid ke dalam jadual
		if(mysqli_query($condb,$arahan_kemaskini))
		{
			# data berjaya dikemaskini
			echo "<script>alert('Kemaskini BERJAYA.');
			window.location.href='murid_senarai.php';
			</script>";
		}
		else
		{
			# data gagal dikemaskini
			echo "<script>alert('Kemaskini GAGAL.');
			window.location.href='murid_senarai.php';
			</script>";
		}
}
?>

<!-- Bahagian untuk memaparkan senarai murid-->
<?PHP include ('../butang_saiz.php'); ?>
<br>
<div class="w3-container w3-card w3-panel w3-leftbar w3-border-black w3-metro-light-blue">
    <p><b class="w3-large">Kemaskini Maklumat Murid</b>
</p>
</div>
<div class="w3-responsive">
<table width='100%' border='1' id='besar' class="w3-table-all w3-card-4">
	<tr class="w3-indigo">
        <td class="w3-center" style="width:25%"><b>Nama Murid</b></td>
        <td class="w3-center" style="width:20%"><b>No K/P Murid</b></td>
        <td class="w3-center" style="width:20%"><b>Katalaluan</b></td>
        <td class="w3-center" style="width:20%"><b>Kelas</b></td>
        <td class="w3-center" style="width:15%"><b>Tindakan</b></td>
	</tr>

	<tr>
	<!-- borang untuk mendaftar murid baru-->
	<form action='' method='POST'>
	<td class="w3-center"><input		class="w3-input w3-border w3-animate-input" type='text' name='nama_baru' value='<?PHP echo $_GET['nama_murid']; ?>'></td>
        
	<td class="w3-center"><input		class="w3-input w3-border w3-animate-input" type='text' name='nokp_baru' value='<?PHP echo $_GET['nokp_murid']; ?>'></td>
	
	<td class="w3-center"><input		class="w3-input w3-border w3-animate-input" input type='password' name='katalaluan_baru' value='<?PHP echo $_GET['katalaluan_murid']; ?>'></td>
        
	<td class="w3-center">
        <select class='w3-select' name='id_kelas'>
        <option value selected disable>Pilih</option>
					<?PHP
					# arahan untuk mencari semua data dari jadual kelas
					$sql="select* from kelas";
					
					# Melaksanakan arahan mencari data
					$laksana_arahan_cari=mysqli_query($condb,$sql);
					
					# pembolehubah $rekod_bilik mengambil data yang ditemui baris demi baris
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
               <button class="w3-button w3-block w3-border w3-round w3-blue" type="submit">Kemaskini <i class="fas fa-user-check"></i></button>
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
	echo "<tr>
			<td class='w3-center'>".$data['nama_murid']."</td>
			<td class='w3-center'>".$data['nokp_murid']."</td>
			<td class='w3-center'>".$data['katalaluan_murid']."</td>
			<td class='w3-center'>".$data['tingkatan']." ".$data['nama_kelas']."</td>
			<td class='w3-center'>
			
<a href='murid_kemaskini.php?".http_build_query($data_murid)."'title='Kemaskini' > <i class='fas fa-user-edit w3-text-teal w3-xlarge w3-margin-right'></i></a>

<a href='padam.php?jadual=murid&medan=nokp_murid&kp=".$data['nokp_murid']."' title='Padam' ><i class='fas fa-trash-alt w3-text-red w3-xlarge w3-margin-left' aria-hidden='true'></i></a>
</td></tr>";
}
?>
    </table>
</div>
<?PHP include('footer_guru.php'); ?>