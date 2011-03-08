<?MinHtml::Start(true)?>
<?$_required = !empty($_required)?>
<section id="Section-<?=$_name?>-<?=$__ID?>"<?=$_required?' class="required"':''?>>
	<?if ($_required): ?><span class="required">*</span><?endIf?>
	<?if (!empty($_label)): ?>
		<label for="<?=$_name?>-<?=$__ID?>"><?=$_label?></label>
	<?endIf?>
	<input 
		class="text<?=isset($_type)?(' '.$_type):''?>" 
		type="<?=isset($_type)?$_type:'text'?>" 
		name="<?=$_name?>" 
		id="<?=$_name?>-<?=$__ID?>" 
		<?forEach ($__LOCALS as $name=>$value):?>
			<?if (substr($name,0,1)=='_' || $name == 'content') continue;?>
			<?=$name?>="<?=$value?>"
		<?endForEach?>
	/>
</section>
<?MinHtml::End()?>