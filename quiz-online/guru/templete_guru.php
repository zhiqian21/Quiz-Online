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

<div class="w3-sidebar w3-bar-block w3-black w3-card" style="width:200px;">
    <a href="#" class="w3-bar-item w3-button">Laman Utama</a>
    
  <div class="w3-bar-item w3-button" onclick="myFunction('Demo1')">
  Pengurusan Guru <i class="fa fa-caret-down"></i></div>
  <div id="Demo1" class="w3-hide w3-white w3-card-4">
    <a href="guru_senarai.php" class="w3-bar-item w3-button">Tambah</a>
    <a href="guru_senarai.php" class="w3-bar-item w3-button">Kemaskini</a>
    <a href="guru_senarai.php" class="w3-bar-item w3-button">Padam</a>
  </div>
    
<div class="w3-bar-item w3-button" onclick="myFunction('Demo2')">
  Pengurusan Murid <i class="fa fa-caret-down"></i></div>
  <div id="Demo2" class="w3-hide w3-white w3-card-4">
    <a href="#" class="w3-bar-item w3-button">Link</a>
    <a href="#" class="w3-bar-item w3-button">Link</a>
  </div>
    
<div class="w3-bar-item  w3-button" onclick="myFunction('Demo3')">
  Pengurusan Kelas <i class="fa fa-caret-down"></i></div>
  <div id="Demo3" class="w3-hide w3-white w3-card-4">
    <a href="#" class="w3-bar-item w3-button">Link</a>
    <a href="#" class="w3-bar-item w3-button">Link</a>
  </div>
    
<div class="w3-bar-item w3-button" onclick="myFunction('Demo4')">
  Pengurusan Soalan <i class="fa fa-caret-down"></i></div>
  <div id="Demo4" class="w3-hide w3-white w3-card-4">
    <a href="#" class="w3-bar-item w3-button">Link</a>
    <a href="#" class="w3-bar-item w3-button">Link</a>
  </div>

<a href="#" class="w3-bar-item w3-button">Analisis Prestasi</a>

<a href="#" class="w3-bar-item w3-button">Log Keluar</a>
    
 <script>
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace("w3-black", "w3-red");
  } else { 
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace("w3-red", "w3-black");
  }
}
</script>   
    
</div>

<!--isi kandungan-->    
    
    
    
    
<!--footer-->    
    
    
    

</body>
</html>