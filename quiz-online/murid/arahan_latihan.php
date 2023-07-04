<?PHP
# memanggil fail header.php dan fail connection.php dari folder luaran
include ('../header.php');
include ('../connection.php');

# Menguji kewujudan data GET
if(empty($_GET))
{
	# Menghenti aturcara jika data get tidak wujud
	die("<script>alert('Akses tanpa kebenaran');
	window.location.href='pilih_latihan.php';</script>");
}

# arahan untuk memilih set_soalan berdasarkan no_set soalan
$arahan_pilih_set	=	"select* from set_soalan where no_set='".$_GET['no_set']."' ";

# melaksanakan  arahan untuk memilih
$laksana			=	mysqli_query($condb,$arahan_pilih_set);

# pembolehubah data mengambil data yang ditemui
$data				=	mysqli_fetch_array($laksana)
?>

<div class="w3-row">
<div class="w3-quarter w3-container">

</div>

<div class="w3-half w3-container w3-card-4 w3-margin-top w3-metro-light-blue ">
    <!-- Memaparkan arahan untuk menjawab soalan-->
        <table class="w3-medium w3-margin-top w3-margin-left w3-margin-right">
            <tr>
                <td class="w3-right-align"><b>Topik : </b></td>
                <td><?PHP echo $data['topik']; ?></td>
            </tr>

            <tr>
                <td class="w3-right-align"><b>Jenis : </b></td>
                <td><?PHP echo $data['jenis']; ?></td>
            </tr>

            <tr>
                <td class="w3-right-align"><b>Tarikh : </b></td>
                <td><?PHP echo $data['tarikh']; ?></td>
            </tr>

            <tr>
                <td class="w3-right-align"><b>Masa : </b></td>
                <td><?PHP echo $data['masa']; ?></td>
            </tr>
        </table>
<hr style="border:solid 1px">
    
    <div class="w3-center">
        <p class="w3-center w3-xlarge"><b>Arahan</b></p>
        <?PHP echo $data['arahan']; ?><br>
    <br>
    <br>
    <br>
        
    <a class="w3-margin-top w3-button w3-border w3-block w3-round w3-blue w3-margin-bottom" href='jawap_soalan.php?no_set=<?PHP echo $_GET['no_set']; ?>&masa=<?PHP echo $data['masa']; ?>&jenis=<?PHP echo $data['jenis']; ?>'><i class="fas fa-play"></i> Mula</a>
        
    <a class="w3-margin-top w3-button w3-border w3-round w3-block w3-blue w3-left w3-margin-bottom" href='pilih_latihan.php'><i class="fas fa-times"></i> Cancel</a>
        
    </div>
</div>

<div class="w3-quarter w3-container">

</div>
    
</div>
<?PHP include ('../footer.php'); ?>