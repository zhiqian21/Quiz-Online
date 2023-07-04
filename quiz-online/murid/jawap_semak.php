<?PHP
# memanggil fail header.php dan fail connection.php dari folder utama
include ('../header.php');
include ('../connection.php');

# Menguji kewujudan data POST dan GET
if(empty($_POST) and empty($_GET))
{
	# jika tiada salah satu dari data ini, aturcara akan ditamatkan
	die("<script>alert('Akses tanpa kebenaran');
	window.location.href='pilih_latihan.php';</script>");
}

# arahan untuk mendapatkan bilangan soalan
$arahan_bil="select* from soalan where no_set='".$_GET['no_set']."'";

#laksana arahan untuk mendapatkan bilangan soalan
$laksana_bil=mysqli_query($condb,$arahan_bil);

# pembolehubah bil soalan akan mengambil bilangan soalan yang ditemui 
$bil_soalan=mysqli_num_rows($laksana_bil);

$betul=0;
$salah=0;
$bil=0;

# bahagian untuk memaparkan keputusan kuiz
echo"<h3>Skema dan Keputusan</h3>";
echo"
<div class='w3-responsive'>
<table class='w3-table-all w3-margin-top' border='1' id='besar'>
<tr class='w3-blue-grey'>
	<td class='w3-center w3-padding-large' style='width:100px'><b>Bil</b></td>
	<td class='w3-center w3-padding-large'><b>Soalan</b></td>
</tr>";

# arahan untuk menyimpan jawapan murid
$arahan_simpan="insert into jawapan_murid
(no_soalan,jawapan,catatan,nokp_murid)
values";

# mengambil data POST
foreach ($_POST as $key => $value)
{
	# mendapatkan no soalan
	$no_soalan=ltrim($key,"s");
	
	# memecahkan value jawapan yang dipilih
	$pecahkanbaris = explode("|",$value);
	
	# mengumpukkan pecahan value kepada tatasusunan
	list($medan,$jawapan,$jawapan1,$jawapan2,$jawapan3,$jawapan4,$soalan,$jawapana,$gambar) = $pecahkanbaris;
	
	# menguji adakah soalan mempunyai gambar
	if($gambar!=" ")
	{
		$gambar="<img src='".$gambar."'>";
	}
	
	# menguji adakah soalan tidak dijawab
	if($jawapan!="tidak jawab")
	{
		$nilai_jawapan=$jawapan;
	}
	else
	{
		$nilai_jawapan='Tidak Jawab';
	}
	
	# mengira bilangan jawapan betul dan jawapan yang salah
	switch($medan)
	{
		case 'jawapan_a' : $betul++;break;
		case 'jawapan_b' : $salah++;break;
		case 'jawapan_c' : $salah++;break;
		case 'jawapan_d' : $salah++;break;
		default:$salah++; break;
	}
	
	# umpukan warna
	if($jawapan==$jawapana)
	{
		# jika jawapan betul tiada warna latar belakang
		$warna="";
		$catatan="BETUL";
	}
	else if($jawapan=='tidak jawab')
	{
		# jika soalan tidak dijawab, set warna latar belakang kuning
		$warna="bgcolor='yellow'";
		$catatan="SALAH";
		$medan='tidak jawap';
	}
	else
	{
		# jika jawapan salah, set warna latar belakang pink
		$warna="bgcolor='pink'";
		$catatan="SALAH";
	}
	
	# memaparkan soalan, jawapan, jawapan pilihan murid, dan jawapan sebenar
	echo "<tr>
	<td class='w3-padding-large w3-center'>".++$bil."</td>
	<td $warna>".$soalan."<br>$gambar
    <br>";
	for($k=1;$k<=4;$k++)
	{
		$jawapans="jawapan".$k;
		if($jawapan==$$jawapans)
			$tanda="checked='checked'";
		else
			$tanda="";
		
		echo"<input type='checkbox' name='$no_soalan' disabled='disabled' $tanda>
		<label>".$$jawapans."</label><br>";
	}
	echo"</td>
		</tr>
		<tr>
			<td class='w3-pale-green' colspan='2' align='right'><b>Jawapan Pelajar :</b> $nilai_jawapan | <b>Jawapan Sebenar : </b>$jawapana</td>
			
		</tr>";
		# arahan untuk menyimpan jawapan pelajar
		$arahan_simpan=$arahan_simpan."('$no_soalan','$medan','$catatan',
		'".$_SESSION['nokp_murid']."'),";
}
$arahan_simpan=rtrim($arahan_simpan,",");

# melaksanakan arahan menyimpan jawapan pelajar 
if(mysqli_query($condb,$arahan_simpan))
{
	# jawapan berjaya disimpan, papar popup
	echo"<script>alert('Latihan tamat. data berjaya disimpan');</script>";
}
else
{
	# jika jawapan gagal disimpan
	echo"<script>alert('data gagal disimpan');
	window.history.back();
	</script>";
}

# memaparkan jumlah skor dan jumlah markah
echo "<hr>Jumlah markah : $betul / $bil_soalan";

$peratus=($betul/$bil_soalan)*100;

echo "<br>Peratus : ".number_format($peratus,2)." %<br>";
include('../butang_saiz.php');
?>
</div>