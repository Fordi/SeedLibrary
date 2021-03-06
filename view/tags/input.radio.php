<?MinHtml::Start(true)?>
<?$_required = !empty($_required)?>
<section id="Section-<?=$_name?>-<?=$__ID?>"<?=$_required?' class="required"':''?>>
	<?if ($_required): ?><span class="required">*</span><?endIf?>
	<?if (!empty($_label)): ?>
		<label for="<?=$_name?>-<?=$__ID?>"><?=$_label?></label>
	<?endIf?>
	<ul class="radiolist">
		<?forEach($_options as $key=>$val):?>
			<?$optId = $_name.'-'.substr(md5($_name.':'.$key.'.'.$__ID), 0, 4)?>
			<?$checked = ($key==$value)?' checked="checked"':''?>
			<li>				
				<input type="radio" class="radio" name="<?=$_name?>" value="<?=$key?>" id="<?=$optId?>"<?=$checked?>/>
				<label for="<?=$optId?>"><?=$val?></label>
			</li>
		<?endForEach?>
	</ul>
</section>
<?MinHtml::End()?>