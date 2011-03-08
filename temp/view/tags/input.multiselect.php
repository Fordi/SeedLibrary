<?MinHtml::Start(true)?>
<?$_required = !empty($_required)?>
<section id="Section-<?=$_name?>-<?=$__ID?>"<?=$_required?' class="required"':''?>>
	<?if ($_required): ?><span class="required">*</span><?endIf?>
	<?if (!empty($_label)): ?>
		<label for="<?=$_name?>-<?=$__ID?>"><?=$_label?></label>
	<?endIf?>
	<select 
		multiple
		class="multiselect" 
		name="<?=$_name?>" 
		id="<?=$_name?>-<?=$__ID?>" 
		<?forEach ($__LOCALS as $name=>$value):?>
			<?if (substr($name,0,1)=='_' || $name == 'content') continue;?>
			<?=$name?>="<?=$value?>"
		<?endForEach?>
	>
		<?forEach($_options as $key=>$value):?>
			<?$optId = $name.'-'.substr(0,4, md5($_name.':'.$key))?>
			<option value="<?=$key?>"><?=$value?></option>
		<?endForEach?>
	</select>
</section>
<?MinHtml::End()?>