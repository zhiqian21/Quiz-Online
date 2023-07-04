<?PHP
include('header_guru.php');
include('connection.php');
?>

<h2>IMPORT DATA</h2>
<form action="" method="post" enctype="multipart/form-data">
Pilih Fail TXT untuk di import
<input type="file" name="file" accept=".txt" required/>
<button type='submit' name='btn-upload'>upload</button>
</form>

<table width='40%'>
	<tr>
			<td>Untuk proses mengimport data murid, pastikan anda menggunakan template yang telah disediakan.
			Muat turun <a href='importdata.csv'>di sini. </a>
			</td>
	</tr>
</table>

$namafail   =   $_FILES['file']['name'];

    $counter=1;
    $bil_berjaya=0;
    $jum_data=0;
    
$fail       =   fopen($namafail,"r");
while(!feof($fail)){
    $medan = explode(",",fgets($fail));
    $nama_murid                 =     $medan[0];
    $nokp_murid                 =     $medan[1];
    $katalaluan_murid           =     $medan[2];
    $id_kelas                   =     $medan[3];
    
    $sql="insert into murid values('$nama_murid','$nokp_murid','$katalaluan_murid','$id_kelas')";
    }
    if(mysqli_query($condb,$sql))
        {
          # mengira bilangan data yang berjaya disimpan
          $bil_berjaya++;
        }   

      $jum_data++;
    $counter++;
  fclose($failyangdataingindiupload);  
  
?>

<?PHP
if(mysqli_affected_rows($condb)>0)
echo "<script>alert('Import fail data selesai. $bil_berjaya data berjaya disimpan');
window.location.href = 'murid_senarai.php';</script>";

else
{
echo "<script>alert('Import fail GAGAL disimpan');
window.location.href = 'murid_upload.php';</script>";
}
?>
<?PHP include('footer_guru.php'); ?>