<?PHP
# Memulakan fungsi session
session_start();

# Memanggil fail guard_guru.php
include ('guard_guru.php');

# Memanggil fail connection dari folder utama
include ('../connection.php');

# Menguji pembolehubah session tahap mempunyai nilai atau tidak
if(empty($_SESSION['tahap']))
{
	# proses untuk mendapatkan tahap pengguna yang sedang login samada admin atau guru
	$arahan_semak_tahap="select* from guru where
	nokp_guru	=	'".$_SESSION['nokp_guru']."'
	limit 1";
	$laksana_semak_tahap=mysqli_query($condb,$arahan_semak_tahap);
	$data=mysqli_fetch_array($laksana_semak_tahap);
	$_SESSION['tahap']=$data['tahap'];
}
?>
<!doctype HTML>
<html>
	<head>
		<title>Portal Pembelajaran Online</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-ios.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-win8.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-2019.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-2021.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster&effect=shadow-multiple">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">
		<style>
		.w3-font {
			font-family:"Lobster", Sans-serif;
		}
        </style>
    </head>
    
<body class="w3-ios-background">
    
<!-- header-->
<div class="w3-container w3-2021-cerulean w3-border">
<h1 class="w3-xxxlarge w3-center w3-font font-effect-shadow-multiple w3-text-black">
			<b>
				<i class="fas fa-book-reader w3-wide"></i>
				Bahagian Guru / Administrator
			</b>
		</h1>	
</div>
    
<!--menu-->

<div class="w3-bar w3-black">
    
    <a href="index.php" class="w3-bar-item w3-button">Laman Utama</a>
    
    <a href="../logout.php" class="w3-bar-item w3-button w3-right">Logout</a>
    
    <?PHP if($_SESSION['tahap']=='ADMIN'){ ?>
    <a href="guru_senarai.php" class="w3-bar-item w3-button">Maklumat Guru</a>
      
    <a href="murid_senarai.php" class="w3-bar-item w3-button">Pengurusan Murid</a>
    
    <a href="senarai_kelas.php" class="w3-bar-item w3-button">Pengurusan Kelas</a>
   <?PHP } ?>
    <div class="w3-dropdown-hover">
        
      <button class="w3-button">Pengurusan Soalan</button>
        
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
          
        <a href="soalan_set.php" class="w3-bar-item w3-button">Set Soalan</a>
          
        <a href="analisis.php" class="w3-bar-item w3-button">Analisis Prestasi</a>
          
      </div>
        
    </div>
    
  </div>

<!-- isi kandungan -->
<div class="w3-container">
    
    
  <p>Isi kandungan</p>
    
    
</div>
    
<!-- footer -->
<?PHP include('../iklan_bawah.php');?>
 <div class="w3-container w3-black">
    <p>Hakcipta &copy 2020-2021 : Cargas Solution</p>
    <p>Penafian : Pihak admin tidak bertanggungjawab atas kerugian dan kehilangan akibat penggunaan data yang terkandung dalam sistem ini</p>
</div>

<?PHP mysqli_close($condb); ?>
    
    </body>
</html>
