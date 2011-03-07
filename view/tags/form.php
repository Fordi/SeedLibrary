<form 
	action="<?=$_action?>" 
	method="<?=empty($_method)?'post':$_method?>" 
	<?if (isset($_class)):?>class="<?=$_class?>"<?endIf?>
	<?if (isset($_id)):?>id="<?=$_id?>"<?endIf?>
>
	<?forEach($__LOCALS as $name=>$value): ?>
		<?if (substr($name,0,1)=='_' || $name == 'content') continue;?>
		<input type="hidden" name="<?=$name?>" value="<?=$value?>" />
	<?endForEach?>
	<fieldset>
		<?if (isset($_caption)):?>
			<caption><?=$_caption?></caption>
		<?endIf?>
		<?=$content?>
	</fieldset>
</form>