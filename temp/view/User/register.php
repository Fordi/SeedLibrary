<?/* TODO: preexisting values are not yet populated.  Must develop User model before this can be done. */?>
<?=tag('form', array(
	'_action'=>'Login.php',
	'_caption'=>String('User.Register.Title'),
	'_id'=>'newUser',
	'do'=>'login'
))?>
	<p><?=String('User.Register.Instructions')?></p>
	<?=tag('input.text', array(
		'_name'=>'NameFirst',
		'_label'=>String('User.Register.NameFirst'),
		'_required'=>true
	)).tag()?>
	<?=tag('input.text', array(
		'_name'=>'NameLast',
		'_label'=>String('User.Register.NameLast'),
		'_required'=>true
	)).tag()?>
	<?=tag('input.text', array(
		'_name'=>'OrgName',
		'_label'=>String('User.Register.OrgName')
	)).tag()?>
	<?=tag('input.text', array(
		'_name'=>'Address',
		'_label'=>String('User.Register.Address'),
		'_required'=>true
	)).tag()?>
	<?=tag('input.text', array(
		'_name'=>'City',
		'_label'=>String('User.Register.City'),
		'_required'=>true
	)).tag()?>
	<?=tag('input.text', array(
		'_name'=>'NameLast',
		'_label'=>String('User.Register.NameLast'),
		'_required'=>true
	)).tag()?>
	<?=tag('input.text', array(
		'_name'=>'PhoneNum',
		'_label'=>String('User.Register.PhoneNum')
	)).tag()?>
	<?=tag('input.text', array(
		'_name'=>'Email',
		'_label'=>String('User.Register.Email'),
		'_required'=>true
	)).tag()?>
	<?=tag('input.password', array(
		'_name'=>'Password',
		'_label'=>String('User.Register.Password'),
		'_required'=>true
	)).tag()?>
	<?=tag('input.password', array(
		'_name'=>'ConfirmPassword',
		'_label'=>String('User.Register.ConfirmPassword'),
		'_required'=>true
	)).tag()?>
	<?=tag('input.radio', array(
		'_name'=>'ContactYN',
		'_label'=>String('User.Register.ContactYN'),
		'_options'=>array(
			'yes'=>String('User.Register.ContactYN-Yes'),
			'no'=>String('User.Register.ContactYN-No')
		)
	)).tag()?>
	<?=tag('input.radio', array(
		'_name'=>'SeedExpLvl',
		'_label'=>String('User.Register.SeedExpLvl'),
		'_options'=>array(
			'easy'=>String('User.Register.SeedExpLvl-Easy'),
			'advanced'=>String('User.Register.SeedExpLvl-Advanced')
		)
	)).tag()?>
	<?=tag('input.radio', array(
		'_name'=>'GardenExpLvl',
		'_label'=>String('User.Register.GardenExpLvl'),
		'_options'=>array(
			'easy'=>String('User.Register.GardenExpLvl-Easy'),
			'advanced'=>String('User.Register.GardenExpLvl-Advanced')
		)
	)).tag()?>
	<?=tag('input.multiselect', array(
		'_name'=>'Volunteer',
		'_label'=>String('User.Register.Volunteer'),
		'_options'=>array(
			'library'=>String('User.Register.Volunteer-Library'),
			'data'=>String('User.Register.Volunteer-Data'),
			'teach'=>String('User.Register.Volunteer-Teach'),
			'mentor'=>String('User.Register.Volunteer-Mentor'),
			'fundraise'=>String('User.Register.Volunteer-Fundraise'),
			'outreach'=>String('User.Register.Volunteer-Outreach'),
			'other'=>String('User.Register.Volunteer-Other')
		)
	)).tag()?>
	<?=tag('input.submit', array(
		'_name'=>'Submit',
		'_label'=>String('User.Register.Submit')
	)).tag()?>
<?=tag()?>