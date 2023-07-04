<?PHP
$nokp_murid=$_GET['nokp_murid'];
include('connection.php');
$sqlhapus=mysqli_query($condb,"delete from murid where nokp_murid='".$nokp_murid."'");
echo"<script>alert('rekod telah dihapuskan');
window.location.href='murid_senarai.php';
</script>";
?>