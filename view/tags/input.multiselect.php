<?MinHtml::Start(true)?>
<?$_required = !empty($_required)?>
<?if  (!is_array($value)) $value = array($value); ?>
<section id="Section-<?=$_name?>-<?=$__ID?>"<?=$_required?' class="required"':''?>>
	<?if ($_required): ?><span class="required">*</span><?endIf?>
	<?if (!empty($_label)): ?>
		<label for="<?=$_name?>-<?=$__ID?>"><?=$_label?></label>
	<?endIf?>
	
	<select 
		multiple
		class="multiselect" 
		name="<?=$_name?>[]" 
		id="<?=$_name?>-<?=$__ID?>" 
		<?forEach ($__LOCALS as $name=>$val):?>
			<?if (substr($name,0,1)=='_' || $name == 'content' || $name=='value') continue;?>
			<?=$name?>="<?=$val?>"
		<?endForEach?>
	>
	
		<?forEach($_options as $key=>$val):?>
			<?$optId = $_name.'-'.substr(md5($_name.':'.$key.'.'.$__ID), 0, 4)?>
			<?$selected = in_array($key, $value)?' selected="selected"':''?>
			<option value="<?=$key?>"<?=$selected?>><?=$val?></option>
		<?endForEach?>
	</select>
</section>
<?MinHtml::End()?>