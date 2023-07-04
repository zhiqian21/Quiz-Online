<br>
<!-- fungsi mengubah saiz tulisan bagi kepelbagaian pengguna-->
<script>
function resizeText(multipler){
	var elem = document.getElementById("besar");
	var currentSize = elem.style.fontSize ||1 ;
	if (multipler==2)
	{
		elem.style.fontSize = "1em";
	}
	else
	{
		elem.style.fontSize = (parseFloat(currentSize) + (multipler * 0.2)) + "em";
	}
}
</script>

<!DOCTYPE html>
<html>

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.btn {
  background-color: black;
  color: white;
  padding: 2px 8px;
  font-size: 14px;
  cursor: pointer;
}

/* Darker background on mouse-over */
.btn:hover {
  background-color: darkgray;
}
</style>

<body>

<!-- Kod untuk butang mengubah saiz tulisan -->
<div class="w3-right">
<button class="btn w3-margin-bottom w3-border w3-right-align" name='reSize' type='button' value='&nbsp;+&nbsp;' onclick="resizeText(1)"><i class="fas fa-font"></i>+</button>

<input class="btn w3-border w3-margin-bottom w3-right-align" name='reSize1' type='button' value='reset' onclick="resizeText(2)" />

<button class="btn w3-border w3-margin-bottom w3-right-align"  name='reSize2' type='button' value='&nbsp;-&nbsp;' onclick="resizeText(-1)"><i class="fas fa-font"></i>-</button>
    
</div>

</body>
</html>