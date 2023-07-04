<?PHP
# Memanggil fail header_guru.php
include('header_guru.php');
?>

<!-- sub tajuk laman -->
<?PHP include ('../butang_saiz.php'); ?>
<br>
<div class="w3-container w3-card w3-panel w3-leftbar w3-border-black w3-metro-light-blue">
    <h3><b>Senarai Nama Murid</b></h3>
</div>


<div class="w3-row">
<div class="w3-third w3-container"></div>
	
<div class="w3-third w3-margin w3-container w3-card w3-white">

<!-- Borang untuk memilih senarai nama murid dalam kelas tertentu-->
<form action='' method='POST'>

<!-- Memaparkan senarai kelas yang diajar oleh guru yang sedang login-->
    <p><b>Kelas</b>
<select class='w3-select' name='id_kelas'>
<option value selected disable>Pilih</option>
	<?PHP
	if($_SESSION['tahap']=='ADMIN')
	{
		# Jika guru yang sedang login adalah admin
		# arahan untuk mrncari semua kelas
		$sql="select* from kelas, guru
		where 
		kelas.nokp_guru		=		guru.nokp_guru ";
	}
	else
	{
		# Sebaliknya Jika guru yang sedang login bukan admin
		# arahan untuk mencari semua kelas yang diajar oleh guru tersebut sahaja
		$sql="select* from kelas, guru
		where
				kelas.nokp_guru		=		guru.nokp_guru
		and		kelas.nokp_guru		=		'".$_SESSION['nokp_guru']."' ";
	}
	
	# Melaksanakan arahan mencari data
	$laksana_arahan_cari=mysqli_query($condb,$sql);
	
	# pemboleh ubah $rekod mengambil data yang ditemui baris demi baris
	while ($rekod=mysqli_fetch_array($laksana_arahan_cari))
	{
		# memaparkan data yang ditemui dalam element <option></option>
		echo "<option value=".$rekod['id_kelas'].">
			".$rekod['tingkatan']." ".$rekod['nama_kelas']."</option> ";
	}
	
	?>
</select></p>
    
<!-- memaparkan senarai nama murid dalam kelas tertentu-->
<div class='w3-center'>
<button class="w3-button w3-block w3-border w3-round w3-blue w3-margin-bottom" type="submit">Papar Senarai Nama</button>
</div>
</form>

    </div>
    
    <div class="w3-third w3-container">
	
	</div>
</div>

<?PHP
#------------bahagian untuk memaparkan senarai nama murid, skor dan jumlah markah.

# menyemak kewujudan data POST (kelas) yang di hantar melalui borang diatas
if(!empty($_POST))
{
	# mengambil nilai POST
	$id_kelas		=		$_POST['id_kelas'];
	
	# ----- bahagian untuk mendapatkan nama kelas berdasarkan id_kelas yang dihantar
	# arahan untuk mencari semua data kelas berdasarkan id_kelas yang dipilih
	$arahan_kelas="select* from kelas where id_kelas='$id_kelas'";
	
	# melaksanakan arahan carian di atas
	$laksana_kelas		=		mysqli_query($condb,$arahan_kelas);
	
	# pembolehubah data1 mengambil data yang ditemui
	$data1				=		mysqli_fetch_array($laksana_kelas);
	
	# Umpukan gabungan data tingkatan dan nama kelas
	$nama_kelas			=		$data1['tingkatan'] . $data1['nama_kelas'];
	
	#------- bahagian untuk mendapatkan nama murid berdasarkan id_kelas yang dihantar
	# arahan untuk mencari semua data set_soalan berdasarkan no_set yang dipilih
	$arahan_senarai="select* from murid where id_kelas='$id_kelas'";
	
	# Melaksanakan arahan untuk mencari di atas
	$laksana_senarai	=	mysqli_query($condb,$arahan_senarai);
	
	# Mengambil data yang ditemui
	$data2			=			mysqli_fetch_array($laksana_senarai);
	
	# Umpukan data topik
	$nama_murid		=			$data2['nama_murid'];
	$i=0;
    
	# arahan sql untuk memilih pelajar berdasarkan id_kelas yang dihantar
	$arahan_pilih="select*
				from murid, kelas
				where
							murid.id_kelas				=		kelas.id_kelas
				and			murid.id_kelas				=		'$id_kelas'
				order by 	murid.nama_murid ASC";
				
	# melaksanakan arahan untuk memilih pelajar
	$laksana_pilih		=		mysqli_query($condb,$arahan_pilih);
	
	# Jika bilangan rekod yang ditemui lebih besar atau sama dengan 1
	if(mysqli_num_rows($laksana_pilih)>=1)
	{
		# papar maklumat carian nama kelas
		echo"
        
		<br><h5 class='w3-margn-left'><b>Kelas : $nama_kelas</b>
		<button class='w3-button w3-right w3-border w3-round w3-blue w3-margin-bottom' onclick='window.print()'><i class='fas fa-print'></i> Cetak Senarai Nama</button></h5>";
        
		echo"<hr>
		<div class='w3-responsive'>
		<table border='1' id='besar' class='w3-table-all w3-hoverable w3-margin-top w3-card'>
		<tr class='w3-indigo'>
            <td class='w3-center'><b>Bil</b></td>
			<td class='w3-center'><b>Nama Murid</b></td>
			<td class='w3-center'><b>No K/P Murid</b></td>
            <td class='w3-center'><b>Katalaluan Murid</b></td>
		</tr>";
	}
	else
	{
		echo "tiada data yang ditemui bagi kelas tersebut";
	}


# mengambil data yang ditemui 
	while($data=mysqli_fetch_array($laksana_pilih))
	{
		# Memaparkan data yang ditemui baris demi baris.
		echo "<tr>
        <td class='w3-center'>".++$i."</td>
		<td class='w3-center'>".$data['nama_murid']."</td>
		<td class='w3-center'>".$data['nokp_murid']."</td>
        <td class='w3-center'>".$data['katalaluan_murid']."</td>";
       echo" </tr>";
	}
}
?>
</table></div><br><br>
<?PHP include('footer_guru.php'); ?>
	