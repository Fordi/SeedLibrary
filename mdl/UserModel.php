<?php
class UserModel extends Model {
	static private $table='userseedreg';
	static private $db;
	static private $columns = array(	
		'DateReg', 'NameFirst', 'NameLast', 'OrgName', 
		'Address', 'City', 'PhoneNum', 'Email', 
		'ContactYN', 'SeedExpLvl', 'GardenExpLvl', 'Volunteer', 
		'admin'
	);
	static private $sessionState='sl_User';
	
	static function initialize() {
		if (isset(self::$db)) return;
		$columns = '`'.join('`, `', self::$columns).'`';
		$table = '`'.self::$table.'`';
		self::$db = (object)array(
			'ByEmail'=>DB()->prepare(
				'SELECT  '.$columns.' FROM '.$table.' WHERE Email=:Email'
			),
			'Auth'=>DB()->prepare(
				'SELECT 1 FROM '.$table.' WHERE Email=:Email AND Password=:Password'
			),
			'List'=>DB()->prepare(
				'SELECT '.$columns.' FROM '.$table.' ORDER BY Email ASC'
			)
		);
	}
	
	public static function loggedInUser() {
		if (empty($_SESSION[self::$sessionState])) return null;	
		return self::fromEmailAddress($_SESSION[self::$sessionState]);
	}
	public static function fromEmailAddress($email) {
		$q = self::$db->ByEmail;
		$q->bindValue(':Email', $email);
		$q->execute();
		if ($q->rowCount() == 0) {
			$q->closeCursor();
			return null;
		}
		return new self($q->fetch(PDO::FETCH_ASSOC));
	}
	
	public static function fromLogin($email, $password) {
		$q = self::$db->Auth;
		$q->bindValue(':Email', $email);
		$q->bindValue(':Password', md5($password));
		$q->execute();
		$ct = $q->rowCount();
		$q->closeCursor();
		if ($ct===0) return null;
		$_SESSION[self::$sessionState]=$email;
		return self::loggedInUser();
	}
		
	public static function Logout() {
		unset($_SESSION[self::$sessionState]);
	}
	
	private static function index() {
		$q = self::$db->List;
		$q->execute();
		$ret = array();
		forEach ($q->fetchAll(PDO::FETCH_ASSOC) as $data) {
			$ret[]=new self($data);
		}
		return $ret;
	}
}
UserModel::initialize();