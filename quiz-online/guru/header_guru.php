
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

<div class="w3-sidebar w3-bar-block w3-card w3-black w3-animate-left" style="display:none" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large"
  onclick="w3_close()">Close &times;</button>
    <div class="w3-margin">
  <h2>Profile Guru</h2>
    
      <div>
      <img src='../images/avatar.png' style='width:100%'>
      </div>
    
    <div>
      <?PHP
        echo"<p><b>
        Nama : ".$_SESSION['nama_guru']." <br> Tahap : (".$_SESSION['tahap'].")
        </b></p>
        </div>
      <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
    </div>
</div>
";
?>

<div id="main">

<div class="w3-bar w3-black">
  <button id="openNav" class="w3-button w3-left" onclick="w3_open()">&#9776;</button>


    <a href="index.php" class="w3-bar-item w3-button"><i class="fas fa-home"></i> Laman Utama</a>
    
    <a href="../logout.php" class="w3-bar-item w3-button w3-right"><i class="fas fa-sign-out-alt"></i> Logout</a>
    
    <?PHP if($_SESSION['tahap']=='ADMIN'){ ?>
    <a href="guru_senarai.php" class="w3-bar-item w3-button">Maklumat Guru</a>
      
    <a href="murid_senarai.php" class="w3-bar-item w3-button">Pengurusan Murid</a>
    
    <a href="senarai_kelas.php" class="w3-bar-item w3-button">Pengurusan Kelas</a>
   <?PHP } ?>
    <div class="w3-dropdown-hover">
        
      <button class="w3-button">Pengurusan Soalan <i class="fas fa-caret-down"></i></button>
        
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
          
        <a href="soalan_set.php" class="w3-bar-item w3-button">Set Soalan</a>
          
        <a href="analisis.php" class="w3-bar-item w3-button">Analisis Prestasi</a>

</div>

    
    
          
      </div>
        
    </div>
    



<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "15%";
  document.getElementById("mySidebar").style.width = "15%";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
</script>

<!-- isi kandungan -->
<div class="w3-container">
    

