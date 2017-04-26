<div class='border border-down container-fluid' style='text-align: center;'>
	<h3>Голосование:</h3> 
	<p>{DATABASE;TABLE='Interview';FIELD='Question';ID='{RANDOMID}'}</p> 
	<form method="post">
		<ul style="list-style-type: none;"> 
			{ANSWERS;ID='{RANDOMID}'}
		</ul> 
		<input type="hidden" name="ID" value="{RANDOMID}">
		<input class="form-control" type="submit" name="inter" style="margin: 0 auto !important;">
	</form>
</div>