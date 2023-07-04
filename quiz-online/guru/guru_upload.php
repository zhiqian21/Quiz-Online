<?PHP 
# memanggil fail header_guru.php
include('header_guru.php'); 
?>
<!-- borang untuk memuat naik fail data -->
<?PHP include ('../butang_saiz.php'); ?>
<br>
<div class="w3-container w3-panel w3-leftbar w3-card w3-margin-bottom w3-border-black w3-metro-light-blue">
    <h3><b><i class="fas fa-file-import"></i> Import Data Guru</b></h3>
</div>
<div class="w3-container w3-card w3-margin w3-white">
<form class='w3-margin-left' action='' method='POST' action='upload.php' enctype='multipart/form-data'> 
    <h4 class="w3-margin-top"><b>Pilih Fail CSV untuk di import :</b></h4><br>
  <input type='file' name='file' required/>
  <button type='submit' name='btn-upload'><i class="fas fa-upload"></i> Upload</button>
</form>
<br><br>
<!-- Jadual penerangan data-->
<div class="w3-responsive">
<table width='100%'>
	<tr>
			<td class="w3-left w3-margin-left"><i class="far fa-comment-dots w3-xlarge"></i> Untuk proses mengimport data murid, pastikan anda menggunakan template yang telah disediakan.
                Muat turun <a href='importdata.csv'><b>di sini. </b></a><br><br>
			</td>
	</tr>
</table></div>
</div>
<?PHP 
# Menyemak kewujudan data
if (isset($_POST['btn-upload'])){
  $namafailsementara=$_FILES["file"]["tmp_name"];
  
  # mengambil nama fail
  $namafail = $_FILES['file']['name'];

  #mengambil jenis fail
  $jenisfail = pathinfo($namafail,PATHINFO_EXTENSION);

  # menguji jenis fail dan saiz fail
  if($_FILES["file"]["size"] > 0 AND $jenisfail=="csv")
  {
    # membuka fail yang diambil
    $failyangdataingindiupload = fopen($namafailsementara, "r");
    # Umpuk nilai awal pembilang
    $counter=1;
    $bil_berjaya=0;
    $jum_data=0;
    # mendapatkan data dari fail fail
    while (($data = fgetcsv($failyangdataingindiupload, 10000, ",")) !== FALSE)
    {
      # Mengambil data dari setiap cell pada fail csv
      $nama           =   mysqli_real_escape_string($condb,$data[0]);
      $nokp           =   mysqli_real_escape_string($condb,$data[1]);
      $katalaluan     =   mysqli_real_escape_string($condb,$data[2]);
      $tahap          =   mysqli_real_escape_string($condb,$data[3]);

      if ($counter>1)
      {
        # arahan untuk menyimpan data guru
        $arahan_simpan = "INSERT into guru 
        (nama_guru, nokp_guru,katalaluan_guru,tahap) 
        values 
        ('$nama','$nokp','$katalaluan','$tahap')";

        # Melaksanakan arahan untuk menyimpan data
        if(mysqli_query($condb,$arahan_simpan))
        {
          # mengira bilangan data yang berjaya disimpan
          $bil_berjaya++;
        }   
      }

      $jum_data++;
    $counter++;
    }
  fclose($failyangdataingindiupload);  
}
else
echo"<script>alert('Hanya fail berformat CSV sahaja dibenarkan'); </script>";

# Memaparkan popup bilangan data yang berjaya dikemaskini
if($bil_berjaya>0)
{
echo "<script>alert('Import fail data selesai. $bil_berjaya data berjaya disimpan');
window.location.href = 'guru_senarai.php';</script>";
}
else
{
echo "<script>alert('Import fail GAGAL disimpan');
window.location.href = 'guru_upload.php';</script>";
}
} 
?>
<?PHP include('footer_guru.php'); ?>