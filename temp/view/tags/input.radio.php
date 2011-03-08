<?MinHtml::Start(true)?>
<?$_required = !empty($_required)?>
<section id="Section-<?=$_name?>-<?=$__ID?>"<?=$_required?' class="required"':''?>>
	<?if ($_required): ?><span class="required">*</span><?endIf?>
	<?if (!empty($_label)): ?>
		<label for="<?=$_name?>-<?=$__ID?>"><?=$_label?></label>
	<?endIf?>
	<ul class="radiolist">
		<?forEach($_options as $key=>$value):?>
			<?$optId = $name.'-'.substr(0,4, md5($_name.':'.$key))?>
			<li>				
				<input type="radio" class="radio" name="<?=$_name?>" value="<?=$key?>" id="<?=$optId?>" />
				<label for="<?=$optId?>"><?=$value?></label>
			</li>
		<?endForEach?>
	</ul>
</section>
<?MinHtml::End()?>