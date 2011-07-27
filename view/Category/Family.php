<div class="category-view">
	<h1 class="category-title"><?=$Category->Name?></h1>
	<ul class="subcategory-list">
		<?forEach($Category->products() as $product):?>
			<li><?=template('Product/ListItem', array('Product'=>$product, 'Category'=>$Category))?></li>
		<?endForEach?>
	</ul>

</div>