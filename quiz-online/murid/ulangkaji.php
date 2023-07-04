<?PHP
# memanggil fail header.php dan fail connection.php dari folder utama
include ('../header.php');
include ('../connection.php');

    # Menguji kewujudan data GET dan session[nama_murid]
    if(empty($_GET) or empty($_SESSION['nama_murid']))
    {
        # jika tidak wujud. aturcara akan dihentikan
        die("<script>alert('Akses tanpa kebenaran');
        window.location.href='pilih_latihan.php';</script>");
    }

    # memecahkan data GET
    $pecahkanbaris = explode("|",$_GET['kumpul']);

    # mengumpukkan data yang dipecahkan kepada pembolehubah
    list($bil_betul,$bil_soalan,$peratus,$bil_jawapan) = $pecahkanbaris;

    # arahan untuk mencari jawapan pelajar berdasarkan nokp_murid dan no_set soalan
    $arahan_carian="select*
    from set_soalan, soalan, jawapan_murid, murid
    where
        set_soalan.no_set			=		soalan.no_set
    and soalan.no_soalan			=		jawapan_murid.no_soalan
    and murid.nokp_murid			=		jawapan_murid.nokp_murid
    and murid.nokp_murid			=		'".$_SESSION['nokp_murid']."'
    and soalan.no_set				=		'".$_GET['no_set']."'
    ";

    # melaksanakan arahan mencari jawapan pelajar
    $laksana_carian=mysqli_query($condb,$arahan_carian);


    # memaparkan tajuk ulang kaji, skor dan markah
    echo"
    <div class='w3-container' style='background-image: url('images/b1.jpg');'>
    
    <p class='w3-panel w3-margin-top w3-leftbar w3-large w3-border-teal w3-pale-green w3-padding-16'><b>Taniah!</b> Anda telah selesai menjawab soalan dalam latihan/kuiz ini.<br>Anda boleh membuat ulangkaji merujuk kepada skema di bawah.</p>
    
        <div class='w3-container w3-margin w3-text-indigo'>
        <h2 class='w3-center w3-margin-top w3-margin-bottom'><b>Bahagian Ulangkaji</b></h2>
        </div>";


    echo"
    <div class='w3-row'>
    
        <div class='w3-col w3-container' style='width:22.5%'>

        </div>
        
        
        <div class='w3-col w3-container w3-card-4 w3-metro-light-blue' style='width:55%'>";

            echo"
            <table class='w3-margin-top w3-margin-left w3-margin-right'>
                        <tr>
                            <td class='w3-right-align'><b>Topik : </b></td>
                            <td><b>".$_GET['topik']."</b></td>
                        </tr>

                        <tr>
                            <td class='w3-right-align'><b>Skor : </b></td>
                            <td><b>".$bil_betul." / ".$bil_soalan."</b></td>
                        </tr>

                        <tr>
                            <td class='w3-right-align'><b>Peratus : </b></td>
                            <td><b>".$peratus."</b></td>
                        </tr>

                    </table>
                    <hr style='border:solid 1px'>
                ";


        $bil=0;

        # mengambil data jawapan pelajar yang ditemui
        while($rekod=mysqli_fetch_array($laksana_carian))
        {
            # menguji soalan yang tidak dijawab
            if($rekod['jawapan']!="tidak jawap")
            {
                $nilai_jawapan=$rekod[$rekod['jawapan']];
            }
            else
            {
                $nilai_jawapan='Tidak Jawab';
            }

            # memaparkan soalan dan jawapan bagi soalan
            echo "
                <u><b class='w3-large'>Soalan ".++$bil."</b></u>
                <b>
                <p class='w3-panel w3-sand w3-center w3-border w3-white w3-padding-24 w3-large'>".$rekod['soalan']."
                </b>
                <img src='".$rekod['gambar']."'></p>
                
                <ul class='w3-ul w3-hoverable w3-border w3-white'>
                
                    <li class='w3-large'><p class='w3-badge w3-white w3-padding-8 w3-margin' style='border:solid 2.5px black'>A</p> ".$rekod['jawapan_a']."

                    <li class='w3-large'><p class='w3-badge w3-white w3-padding-8 w3-margin' style='border:solid 2.5px black'>B</p> ".$rekod['jawapan_b']."

                    <li class='w3-large'><p class='w3-badge w3-white w3-padding-8 w3-margin' style='border:solid 2.5px black'>C</p> ".$rekod['jawapan_c']."

                    <li class='w3-large'><p class='w3-badge w3-white w3-padding-8 w3-margin' style='border:solid 2.5px black'>D</p> ".$rekod['jawapan_d']."
                    
               </ul>
               <br>
                <b>
                
                Jawapan Sebenar : ".$rekod['jawapan_a']."<br>

                Jawapan anda : ".$nilai_jawapan."<br>

                Status : ".$rekod['catatan']."

                </b>
                <hr style='border:solid 1px'>
            ";
        }




echo "
 <button class='w3-margin-top  w3-block w3-margin-right w3-button w3-border w3-round w3-blue w3-center w3-margin-bottom' type='submit' value='cetak' onClick='window.print()'><i class='fa fa-print' aria-hidden='true'></i> Cetak</button>
 
 
 <a class='w3-margin-top w3-button w3-border w3-round w3-block w3-blue w3-left w3-margin-bottom' href='pilih_latihan.php'><i class='fas fa-angle-double-left'></i> Kembali</a>

        </div>
    
        <div class='w3-col w3-container' style='width:22.5%'>

        </div>
        
    </div>

    ";

mysqli_close($condb);
?>

<?PHP include ('../footer.php'); ?>
