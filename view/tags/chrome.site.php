<div id="page">
	<div id="page-header">
		<h1>Jenkintown Library Community Seed Exchange</h1>
		<div class="controls">
			<ul>
				<li><a href="/Login">Sign In</a></li>
				<li><a href="/Contact">Contact Us</a></li>
				<li><a href="/Donate">Donate</a></li>
		</div>
		<form class="search" action="/Search">
			<label>Search</label>
			<input type="text" class="text" name="q" />
			<input type="submit" class="submit" value="&#x03D9;"/>
		</form>
		<div class="nav">
			<ul>
				<?forEach($catalog as $item):?>
					<li><a <?=($item->active?'class="active" ':'')?>href="<?=Controller::URL('Category', $item->Slug)?>"><?=$item->Name?></a></li>
				<?endForEach?>
			</ul>
		</div>
	</div>
	<div id="page-body">
		<?=$content?>
	</div>
	<div id="page-footer">
		<div class="content">
			<address class="vcard">
				<span class="org"><?=$location->name?></span>,
				<span class="street-address"><?=join(' / ', $location->address)?></span>,
				<span class="locality"><?=$location->locality?></span>,
				<span class="postal-code"><?=$location->postal?></span> &middot;
				<span class="tel"><?=$location->tel?></span>
			</address>
			<ul class="partner-links">
				<?forEach ($links as $link):?>
					<li><a href="<?=$link->url?>"><?=$link->display?></a></li>
				<?endForEach?>
			</ul>
			<ul class="site-links">
				<li>dev: <a href="http://fordi.org/contact/bbx">ook&#xFF20;codemonkeybryan&#x2E;com</a></li>
				<li><a href="/help"><?=String('Site.Link.Help')?></a></li>
			</ul>
		</div>
	</div>
</div>