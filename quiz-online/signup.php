<?PHP
# memanggil fail header.php dan connection.php
include('header.php');
include('connection.php');

    
# menguji kewujudan data POST yang dihantar oleh bahagian borang di bawah
if(!empty($_POST))
{
    # mengambil dan menapis data POST
	$nama		=	mysqli_real_escape_string($condb,$_POST['nama']);
	$nokp		=	mysqli_real_escape_string($condb,$_POST['nokp']);
	$katalaluan	=	mysqli_real_escape_string($condb,$_POST['katalaluan']);
	$id_kelas	=	$_POST['id_kelas'];
	
    # menyemak kewujudan data yang dimasukkan.
	if(empty($nama) or empty($nokp) or empty($katalaluan) or empty($id_kelas))
	{
		die("<script>alert('Sila lengkapkan maklumat');
		window.history.back();</script>");
	}
    
    # had atas dan had bawah : sebagai data validation kepada nokp
	if(strlen($nokp)!=12 or !is_numeric($nokp))
	{
		die("<script>alert('Ralat No K/P.');
		window.history.back();</script>");
	}
    
    # arahan untuk menyimpan data murid yang dimasukkan
	$arahan_simpan="insert into murid
	(nama_murid, nokp_murid, katalaluan_murid, id_kelas)
	values
	('$nama', '$nokp', '$katalaluan', '$id_kelas')";
	
    # laksanakan arahan dalam block if
	if(mysqli_query($condb,$arahan_simpan))
	{
		#data berjaya disimpan. papar popup
		echo "<script>alert('Pendaftaran BERJAYA.');
		window.location.href='index.php';</script>";
	}
	else
	{
        # data gagal disimpan papar popup
		echo "<script>alert('Pendaftaran GAGAL.');
		window.history.back();</script>";
	}
}
?>

<div class="w3-row">
    
<div class="w3-half w3-container">
   <img src="images/s6.jpg" class="w3-margin-top w3-image w3-card w3-center">
        <div class="w3-container">
          <div class="w3-panel w3-leftbar w3-margin">
            <p><i class="fa fa-quote-left w3-xxlarge"></i><br>
            <b><i class="w3-serif w3-xlarge">Knowledge is of no value unless you put it into practice.</i></b></p>
            <div class="w3-right">
                <p><i class="w3-large">--Anton Chekhov</i></p>
            </div>
          </div>
        </div>
</div>


  <div class="w3-half w3-container w3-card-4 w3-margin-top w3-metro-light-blue">
      
       <!-- Bahagian borang unmtuk mendaftar murid baru -->             
            <td align='center' width='40%'>
				<form action='' method ='POST' class="w3-container w3-text-black w3-center">
                    
                    <div class="w3-container w3-metro-light-blue">
                        <h3 class='w3-center'><b><i class="w3-xxlarge fas fa-user-edit"></i> Pendaftaran Murid Baru</b></h3>
                    </div>
                    
                    <!--bahagian paparkan image avatar-->
                        <!DOCTYPE html>
                            <html>
                                <head>
                                    <meta name="viewport" content="width=device-width, initial-scale=1">
                                        <style>
                                            .avatar {
                                              vertical-align: middle;
                                              display: block;
                                              margin-left: auto;
                                              margin-right: auto;
                                              width: 300px;
                                              height: 250px;
                                              border: 5px white solid;
                                              border-radius: 50%;
                                            }
                                        </style>
                                </head>
                                
                                <body>
                                    <img src="images/a2.svg" alt="Avatar" class="avatar">
                                </body>
                            </html>
                    <br>
                    <label class="w3-text-black w3-left"><b>Nama Murid</b></label>
                    <input class="w3-input w3-border w3-round-large form-control"  style="font-family: 'Font Awesome 5 Free'; font-weight: 700;" type='text' name='nama' placeholder=' &#xf2bd; Sila gunakan huruf besar' required><br>
                    
                    <label class="w3-text-black w3-left"><b>No K/P</b></label>
                    <input class="w3-input w3-border w3-round-large form-control"  style="font-family: 'Font Awesome 5 Free'; font-weight: 700;" type='text' name='nokp' placeholder=' &#xf2bb; contoh: 040503010203' required><br>
                    
                    <label class="w3-text-black w3-left"><b>Katalaluan</b></label>
                    <input class="w3-input w3-border w3-round-large form-control"  style="font-family: 'Font Awesome 5 Free'; font-weight: 700;" type='password'	name='katalaluan' placeholder=' &#xf023; password' required><br>
                    
                    <label class="w3-text-black w3-left"><b>Kelas </b></label>				
                       <select class="w3-select w3-border" name='id_kelas' required>
                            <option value selected disable>Pilih</option>
 
                        <?PHP
                            # arahan untuk mencari semua data dari jadual kelas
                            $sql="select* from kelas";

                            # melaksanakan arahan mencari data
                            $laksana_arahan_cari = mysqli_query($condb,$sql);

                            # pembolehubah $rekod_bilik mengambil data yang ditemui baris demi baris
                            while($rekod_bilik = mysqli_fetch_array($laksana_arahan_cari))
                            {
                                # memaparkan data yang ditemui dalam element <option></option>
                                echo"<option value=".$rekod_bilik['id_kelas'].">".$rekod_bilik['tingkatan']."
                                ".$rekod_bilik['nama_kelas']."</option>";
                            }
                        ?>

                    </select><br><hr>
                    
                <a class="w3-margin-top w3-button w3-border w3-round w3-blue w3-left w3-margin-bottom" href='index.php'><i class="fas fa-angle-double-left"></i> Kembali</a>
                    
              <button class="w3-margin-top w3-button w3-border w3-round w3-blue w3-right w3-margin-bottom" type="submit">Daftar <i class="fa fa-user-plus" aria-hidden="true"></i></button>
                
            
      </form> 
      
  </div>

</div>   

<?PHP
mysqli_close($condb);
include ('footer.php');
?>