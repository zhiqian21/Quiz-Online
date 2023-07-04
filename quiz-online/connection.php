<?PHP
# fail connection.php

# nama host. localhost merupakan default
$nama_host="localhost";

# user name bagi SQL. root merupakan default
$user_sql="root";

# password bagi SQL.
$pass_sql="";

# nama database yang telah dibangunkan untuk sistem ini
$nama_db="kuizonline";

# membukakan hubungan antara pangkalan data dan sistem
$condb=mysqli_connect($nama_host,$user_sql,$pass_sql,$nama_db);

#menguji adakah hubungan berjaya dibuka
if (!$condb)
{
    # jika tidak
	die ("Sambungan Gagal");
}
else
{
    # jika berjaya
	# echo ("Sambungan Berjaya");
}
?>