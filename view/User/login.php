<?=tag('form', array(
	'_action'=>Controller::URL($Controller, $Action),
	'_caption'=>String('User.Login.Title'),
	'_id'=>'userLoginForm'
))?>
	<?if (!empty($badLogin)):?>
		<p class="error"><?=String('User.Login.BadLogin')?></p>
	<?endIf?>
	<?=tag('input.text', array(
		'_name'=>'Email',
		'_label'=>String('User.Login.Email'),
		'value'=>@$form['Email']
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