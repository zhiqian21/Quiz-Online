<?PHP
    include('header_guru.php');
    include('connection.php');

    $nokp_guru=$_POST["nokp_guru"];
    $sql="delete from guru where nokp_guru='$nokp_guru'";
    $result=mysqli_query($connection,$sql);
?>

<div id="berjaya" style="display: none;">
    <h3>MESEJ</h3>
    <h2>Data berjaya dipadam!</h2>
</div>
<div id="tidak" style="display: none;">
    <h3>MESEJ</h3>
    <h2>Data gagal dipadam.</h2>
</div>

<?PHP
    if(mysqli_affected_rows($connection)>0)
        echo"<script>document.getElementById('berjaya').style.display='block';</script>";
    else
        echo"<script>document.getElementById('tidak').style.display='block';</script>";
?>


    <h3>PADAM GURU</h3>
    <form action="guru_padam.php" method="post">
    <table>
        <tr>
            <td>No K/P Guru</td>
            <td><input type="text" name="nokp_guru"></td>
        </tr>
    </table>
    <button type="submit">Padam</button>
    </form>
</div>