<?/* TODO: preexisting values are not yet populated.  Must develop User model before this can be done. */?>
<?=tag('form', array(
	'_action'=>'Login.php',
	'_caption'=>String('User.Login.Title'),
	'_id'=>'userLoginForm',
	'do'=>'login'
))?>
	<?=tag('input.text', array(
		'_name'=>'Email',
		'_label'=>String('User.Login.Email')
	)).tag()?>
	<?=tag('input.password', array(
		'_name'=>'Password',
		'_label'=>String('User.Login.Password')
	)).tag()?>
	<?=tag('input.submit', array(
		'_name'=>'Submit',
		'_label'=>String('User.Login.Submit')
	)).tag()?>
<?=tag()?>