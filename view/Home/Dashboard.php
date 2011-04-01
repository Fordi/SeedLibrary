<a href="<?=Controller::URL("User", "Logout")?>">Log Out</a>
<div class="dashboard-block">
	<?=Controller::dispatch('User', 'Profile')?>
</div>