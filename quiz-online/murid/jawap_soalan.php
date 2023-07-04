<?PHP
# memanggil fail header.php dan fail connection.php dari folder utama
include ('../header.php');
include ('../connection.php');
# Menguji kewujudan data GET
if(empty($_GET))
{
	# Menghenti aturcara jika data get tidak wujud
	die("<script>alert('Akses tanpa kebenaran');
	window.location.href='pilih_latihan.php';</script>");
}
?>



<!-- Memaparkan latihan untuk dijawab oleh pelajar-->
<h2 class="w3-center w3-margin-top"><b>Bahagian Soalan</b></h2>
<p class="w3-panel w3-padding-large w3-leftbar w3-border-blue w3-pale-blue">Murid-murid mestilah menjawab soalan dengan teliti.
<?PHP
# Menguji data get[jenis]==kuiz
if($_GET['jenis']=="Kuiz")
{
	# memanggil fail timer2.php
	include('timer2.php');
	# memanggil fungsi timer_kuiz
	timer_kuiz($_GET['masa']);
}
?>
</p>

<?PHP include ('../butang_saiz.php'); ?>
<div class='w3-row'>
<div class='w3-col w3-container' style='width:7.5%'></div>
    
<div class='w3-col w3-container' style='width:85%'>

<form class='w3-card-4' name='soalan_kuiz' action='jawap_semak.php?no_set=<?PHP echo $_GET['no_set']; ?>'
method='POST'>
<div class="w3-responsive">
<table border='1' id='besar' class="w3-table-all">
<tr class='w3-indigo w3-large'>
    <td class="w3-center w3-padding-large" style="width:100px"><b>Bil</b></td>
    <td class="w3-center w3-padding-large"><b>Soalan</b></td>
</tr>

<?PHP
# Arahan untuk memilih soalan berdasarkan no set dan menyusunnya secara rawak (rand)
$arahan_pilih_soalan="select* from soalan where no_set='".$_GET['no_set']."'
order by rand()";

# melaksanakan arahan untuk memilih soalan
$laksana=mysqli_query($condb,$arahan_pilih_soalan);
$i=0;

# pembolehubah data mengambil data yang ditemui 
while ($data=mysqli_fetch_array($laksana))
{
	# memaparkan soalan dan jawapan
	echo"<tr>
	<td class='w3-padding-large w3-center'><b>".++$i."</b></td>
	<td class='w3-large w3-margin-top w3-padding'>";
	
	# mengumpukkan nama medan kepada tatasusunan
	$a=array("jawapan_a","jawapan_b","jawapan_c","jawapan_d");
	
	# menjadikan susunan jawapan secara rawak
	shuffle($a);
	$xjawap='TIDAK MENJAWAB';
	
	# jika soalan mempunyai gambar, umpukan nama gambar
	if($data['gambar']!=" ")
	{
		$gambar=$data['gambar'];
	}
	else
	{
		$gambar=" ";
	}
	
    
	# memaparkan jawapan yang telah disusun secara rawak
	echo $soalan=str_replace("'"," ",$data['soalan']);
	
	# susunan value yang dihantar.
	# medan, jawapan, jawapan1, jawapan2, jawapan3, jawapan4, soalan, nilai jawapan_a, gambar
	echo"
	<br><img src='$gambar'><br><br>
	
	<input class='w3-radio' type='radio' name='s".$data['no_soalan']."' value='".$a[0]."|".$data[$a[0]]."|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['jawapan_a']."|".$gambar."'> <label>".$data[$a[0]]."</lable><br>
	
	<input class='w3-radio' type='radio'	name='s".$data['no_soalan']."'	value='".$a[1]."|".$data[$a[1]]."|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['jawapan_a']."|".$gambar."'> <label>".$data[$a[1]]."</lable><br>
	
	<input class='w3-radio' type='radio'	name='s".$data['no_soalan']."'	value='".$a[2]."|".$data[$a[2]]."|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['jawapan_a']."|".$gambar."'> <label>".$data[$a[2]]."</lable><br>
	
	<input class='w3-radio' type='radio'	name='s".$data['no_soalan']."'	value='".$a[3]."|".$data[$a[3]]."|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['jawapan_a']."|".$gambar."'> <label>".$data[$a[3]]."</lable><br>
	
	<input class='w3-radio' type='radio'	name='s".$data['no_soalan']."'	value='tidak jawab|tidak jawab|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['jawapan_a']."|".$gambar."'	checked style='visibility: hidden'>
	
	<br>";
	
	echo"</td>
	</tr>";
}
?>

</table>
    <div class="w3-center"><b>
        <button class='w3-margin w3-button w3-border w3-card w3-round w3-blue w3-center' type='submit' value='Hantar'><i class="fas fa-check-circle"></i> Hantar</button></b>
    </div>
    </div>
</form>
    </div>
<div class='w3-col w3-container' style='width:7.5%'></div>
<?PHP include ('../footer.php'); ?>