<?PHP
# memulakan fungsi session_start bagi membolehkan pembolehubah super global
# session digunakan
session_start();
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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
        <style>
		.w3-font {
			font-family: "Lobster", serif;
		}
            
		div.sticky {
		position: -webkit-sticky; /* Safari */
		position: sticky;
		top: 0;
		}
		</style>
	</head>

<body class="w3-ios-background">
    
<!-- header -->
<div class="w3-container w3-2021-cerulean">
		<h1 class="w3-xxxlarge font-effect-shadow-multiple w3-font w3-text-black" align='center'>
			<b>
				<i class="fas fa-book-reader"></i>
				Smart Quiz Portal
			</b>
		</h1>	
</div>

<!-- menu -->
<div class="w3-bar w3-black  sticky">
<!-- Menu bahagian Murid -->
	<?PHP if(!empty ($_SESSION) and basename($_SERVER['PHP_SELF']) != 'index.php'){ ?>

	<?PHP echo "<span class='w3-bar-item'>Murid : ". $_SESSION['nama_murid']."</span>"; ?>
	<a class="w3-bar-item w3-button" href='pilih_latihan.php'><i class="fas fa-home"></i> Laman Utama</a>
	<a class="w3-bar-item w3-button" href='../logout.php'><i class="fas fa-sign-out-alt"></i> Logout</a>


	<?PHP } 
	else
		echo"<span class='w3-bar-item'>Selamat Datang!  Sila Log Masuk.</span>";
	?>

</div>

    
	
<!-- isi kandungan -->
<div class='w3-container '>
    
