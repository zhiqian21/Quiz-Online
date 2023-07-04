<?PHP
# memanggil fail header.php, guard_murid.php dan fail connection.php
include('../header.php');
include('guard_murid.php');
include('../connection.php');
include('../butang_saiz.php');

# fungsi untuk mengira skor berdasarkan no_set soalan 
function skor($no_set,$bil_soalan)
{
	# memanggil fail connection.php dari folder utama
	include ('../connection.php');
	
	# arahan untuk mendapatlan data jawapan murid
	$arahan_skor="select*
	from set_soalan, soalan, jawapan_murid
	where
		set_soalan.no_set			=		soalan.no_set
	and soalan.no_soalan			=		jawapan_murid.no_soalan
	and set_soalan.no_set			=		'$no_set'
	and jawapan_murid.nokp_murid	=		'".$_SESSION['nokp_murid']."' ";
	
	# melaksanakan arahan untuk mendapatkan data jawapan 
	$laksana_skor=mysqli_query($condb,$arahan_skor);
	
	# mengira bilangan jawapan
	$bil_jawapan=mysqli_num_rows($laksana_skor);
	$bil_betul=0;
	
	# pembolehubah rekod mengambil data yang ditemui semasa laksanakan arahan
	while($rekod=mysqli_fetch_array($laksana_skor))
	{
		# mengira jawapan yang betul
		switch($rekod['catatan'])
		{
			case 'BETUL' : $bil_betul++; break;
			default: break;
		}
	}
	
	# mengira peratus jawapan betul
	$peratus=$bil_betul/$bil_soalan*100;
	
	# memaparkan skor dan markah dalam %
	echo"	<td class='w3-center w3-padding-16'>$bil_betul/$bil_soalan</td>
			<td class='w3-center w3-padding-16'>".number_format($peratus,0)."%</td>";
			$kumpul=$bil_betul."|".$bil_soalan."|".$peratus."|".$bil_jawapan;
	# memulangkan nilai bil betul, bil soalan, bil peratus dan bilangan jawapan
	return $kumpul;
}
?>

<!-- memanggil fail butang saiz dari folder luaran utk membesarkan saiz tulisan -->
<h2 class="w3-center"><b>Senarai Latihan</b></h2>

<!-- bahagian memaparkan maklumat set soalan -->
<table border='5px black'  id='besar' class='w3-table-all'>
<tr class="w3-indigo">
    <td class="w3-center w3-padding-16" style="width:50px"><b>Bil</b></td>
    <td class="w3-center w3-padding-16"><b>Topik</b></td>
    <td class="w3-center w3-padding-16"><b>Jenis Latihan</b></td>
    <td class="w3-center w3-padding-16"><b>Bil Soalan</b></td>
    <td class="w3-center w3-padding-16"><b>Skor</b></td>
    <td class="w3-center w3-padding-16"><b>Peratus</b></td>
    <td class="w3-center w3-padding-16"><b>Status</b></td>
</tr>

<?PHP
# Arahan untuk mendapatkan maklumat murid berdasarkan data session[nokp_murid]
$arahan_cari="select* from murid
where
nokp_murid='".$_SESSION['nokp_murid']."' ";

# Laksanakan arahan di atas
$laksana_cari=mysqli_query($condb,$arahan_cari);

# Mengambil data yang ditemui
$data_murid=mysqli_fetch_array($laksana_cari);

# Arahan untuk mencari data set soalan
$arahan_pilih_latihan="select
set_soalan.no_set,
count(soalan.no_soalan) AS bil_soalan,
topik, jenis 
from set_soalan, soalan, guru, kelas
where
			set_soalan.no_set			=		soalan.no_set
and			set_soalan.nokp_guru		=		guru.nokp_guru
and			kelas.nokp_guru				=		guru.nokp_guru
and			kelas.id_kelas				=		'".$data_murid['id_kelas']."'
group by	topik";

# Melaksanakan arahan untuk mencari data set soalan
$laksana=mysqli_query($condb,$arahan_pilih_latihan);
$i=0;

# pembolehubah data mengambil setiap data yang ditemui
while ($data=mysqli_fetch_array($laksana))
{
	# memaparkan data set soalan yang ditemui 
	echo"<tr>
	<td class='w3-center w3-padding-16'>".++$i."</td>
	<td class='w3-center w3-padding-16'>".$data['topik']."</td>
	<td class='w3-center w3-padding-16'>".$data['jenis']."</td>
	<td class='w3-center w3-padding-16'>".$data['bil_soalan']."</td> ";
	
		# Memanggil fungsi skor dengan menghantar no set soalan dan bilangan soalan
		$kumpul=skor($data['no_set'],$data['bil_soalan']);
		
		# menerima dan memecahkan data yang diterima kembali dari fungsi skor
		$pecahkanbaris = explode("|",$kumpul);
		
		# umpukkan kepada pembolehubah dibawah
		list($bil_betul,$bil_soalan,$peratus,$bil_jawapan) = $pecahkanbaris;
		
		# menguji bilangan jawapan yang ditemui
		if ($bil_jawapan<=0)
		{
			# jika bil jawapan <=0 bermaksud murid belum menjawab soalan
			echo "<td class='w3-center'><a class='w3-button w3-sand w3-border w3-block w3-round' href='arahan_latihan.php?no_set=".$data['no_set']."'><i class='fas fa-pencil-alt w3-large'></i> <b>Jawab</b></a></td>";
		}
		else
		{
			# jika tidak, murid hanya boleh mengulangkaji semula soalan yang telah dijawab
			echo"<td class='w3-center'><a class='w3-button w3-sand w3-block w3-border w3-round' href='ulangkaji.php?no_set=".$data['no_set']."&topik=".$data['topik']."&kumpul=".$kumpul."'><i class='fas fa-hourglass-start w3-large'></i> <b>Ulangkaji</b></a></td>";
		}
		
	echo "</tr>";
}
?>
</table>

<?PHP include ('../footer.php'); ?>