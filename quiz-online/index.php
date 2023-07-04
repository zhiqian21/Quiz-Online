<?PHP
# memanggil fail header.php
include('header.php');
include('iklan_atas.php');
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<!-- antara muka untuk daftar masuk / login -->
<table width='100%' class='w3-table-all w3-card w3-centered w3-margin-bottom w3-margin-right'>
		<tr>
			<td align='center' width='35%'>
				<form action='login.php' method ='POST' class="w3-container w3-text-black">
                    
                    <div class="w3-container w3-metro-light-blue">
                        <h3 class="w3-center"><b><i class="w3-xlarge fa fa-user" aria-hidden="true"></i> Login Pengguna</b></h3>
                    </div>
                    
                    <h5 class="w3-text-black w3-left"><b>No K/P</b></h5>
                    <input class="w3-input w3-border w3-round-xlarge form-control"  style="font-family: 'Font Awesome 5 Free'; font-weight: 700;" type='text' name='nokp' placeholder=' &#xf2bb; contoh: 040503010203'><br>
                    
                    <h5 class="w3-text-black w3-left"><b>Katalaluan</b></h5>
                    <input class="w3-input w3-border w3-round-xlarge form-control"  style="font-family: 'Font Awesome 5 Free'; font-weight: 700;" type='password'	name='katalaluan' placeholder=' &#xf023; password'/>

					<input class="w3-radio w3-margin   w3-center" type='radio'		name='jenis' 	value='murid' checked><b>Murid</b>
                    
					<input class="w3-radio w3-margin   w3-center" type='radio'		name='jenis' 	value='guru' checked><b>Guru</b><br>
                    
                    <label class=" w3-left">
                        <input type="checkbox" checked="checked" name="remember"> Remember me
                    </label><br>
                    
                    <button class="w3-margin-top  w3-margin-right w3-button w3-border w3-round w3-blue w3-center w3-margin-bottom" type='submit' value='Login'><i class="fas fa-sign-in-alt"></i> Log Masuk</button>
 
                    <!-- pautan untuk mendaftar murid baru -->
                    <a class="w3-margin-top w3-button w3-border w3-round w3-blue w3-center w3-margin-bottom" href='signup.php'><i class="fa fa-user-plus" aria-hidden="true"></i> Daftar Baru</a>
                    
				</form>
			</td>
            
            
         <td width="45%" class="w3-margin">

            <!--Senarai set latihan terkini -->
            
            <table border='1' class='w3-table-all'>
                
                    <div class="w3-container w3-metro-light-blue">
                        <h3 class="w3-center"><b><i class="w3-xlarge fas fa-share-square"></i> Senarai Latihan Terkini</b></h3>
                    </div>
                    <br>
                    <tr class='w3-indigo'>
                        <td width='35%'><b>Topik</b></td>
                        <td width='20%'><b>Kelas</b></td>
                        <td width='35%'><b>Guru Subjek</b></td>
                    </tr>
                

                <?PHP
                # memanggil fail connection.php
                include('connection.php');

                $arahan_latihan="SELECT* FROM set_soalan, guru, kelas
                WHERE
                            set_soalan.nokp_guru	=	guru.nokp_guru
                AND			kelas.nokp_guru			=	guru.nokp_guru
                ORDER BY	set_soalan.tarikh ASC LIMIT 10";

                # melaksanakan arahan SQL di atas
                $laksana_latihan=mysqli_query($condb,$arahan_latihan);

                # mengambil dan memaparkan senarai set soalan, tingkatan yang terlibat dan guru
                while($rekod=mysqli_fetch_array($laksana_latihan))
                {
                    echo " <tr>
                        <td>".$rekod['topik']."</td>
                        <td>".$rekod['tingkatan']." ".$rekod['nama_kelas']."</td>
                        <td>".$rekod['nama_guru']."</td>
                        </tr>";
                }

                mysqli_close($condb);
                ?>
                    
            </table>
            
         </td>
            
    </tr>
    
</table>

<?PHP
# memanggil fail footer.php
include('footer.php');
?>