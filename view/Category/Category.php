<div class="category-view">
	<h1 class="category-title"><?=$Category->Name?></h1>
	<ul class="subcategory-list">
		<?forEach($Category->children() as $subCat):?>
			<li><?=template('Category/Subcategory', array('Category'=>$subCat, 'Parent'=>$Category))?></li>
		<?endForEach?>
	</ul>

</div>