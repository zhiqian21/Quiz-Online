<?PHP
# memanggil fail header_guru.php
include ('header_guru.php');

# Memaparkan nama guru dan tahap
echo "
<div class='w3-panel w3-card w3-metro-light-blue'>
<p><b>
<i class='fas fa-id-badge w3-large'></i> Nama Guru : ".$_SESSION['nama_guru']." (".$_SESSION['tahap'].")
</b></p>
</div>
";
?>

<?PHP include('../butang_saiz.php');?>

<hr>

<!-- Memaparkan senarai latihan terkini -->
<div class="w3-container w3-panel w3-center w3-card w3-border-bottom w3-round-xxlarge w3-metro-light-blue">
    <p><b class="w3-xlarge w3-center">Senarai Latihan Terkini</b>
    </p>
</div>
<div class="w3-responsive w3-margin-top">
<table border='1' id='besar' class='w3-table-all w3-hoverable w3-centered'>
		<tr class="w3-indigo">
            <td style='width:40%'><b>Topik</b></td>
            <td style='width:20%'><b>Kelas</b></td>
    <td style='width:40%'><b>Nama Guru</b></td>
		</tr>
		<?PHP
		# Arahan untuk mencari data guru, kelas dan set_soalan
		$arahan_latihan="SELECT* FROM set_soalan, guru, kelas
		WHERE
					set_soalan.nokp_guru		=		guru.nokp_guru
		AND			kelas.nokp_guru				=		guru.nokp_guru
		ORDER BY	set_soalan.tarikh ASC ";
		
		# Melaksanakan arahan carian di atas
		$laksana_latihan=mysqli_query($condb,$arahan_latihan);
		
		#mengambil data dan memaparkan semula data tersebut
		while($rekod=mysqli_fetch_array($laksana_latihan))
		{
			echo "
						<tr>
							<td>".$rekod['topik']."</td>
							<td>".$rekod['tingkatan']." ".$rekod['nama_kelas']."</td>
							<td>".$rekod['nama_guru']."</td>
						</tr>";
		}
		
		?>
		</table>
</div>
<?PHP include('footer_guru.php'); ?>