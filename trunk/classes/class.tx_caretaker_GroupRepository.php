<?php

require_once (t3lib_extMgm::extPath('caretaker').'/classes/class.tx_caretaker_Group.php');

class tx_caretaker_GroupRepository {
	
	private static $instance = null;

	private function __construct (){}	
	
	public function getInstance(){
		if (!self::$instance) {
			self::$instance = new tx_caretaker_GroupRepository();
		}
		return self::$instance;
	}
	
	public function getByInstanceId($instanceId, $parent = false){
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid_foreign', 'tx_caretaker_instance_group_mm', 'uid_local='.(int)$instanceId);
		$instance_group_ids = array();
		while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res) ){
			$instance_group_ids[] = $row['uid_foreign'];
		}

		$result = array();
		foreach ($instance_group_ids as $id){
			$result[] = $this->getByUid($id, $parent);
		}
				
		return $result;
	} 
	
	public function getByUid($uid, $parent = false){
		$instanceId = (int)$instanceId;
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_caretaker_group', 'hidden=0 AND deleted=0 AND uid='.(int)$uid);
		$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
		if ($row){
			return $this->dbrow2instance($row, $parent);
		} else {
			return false;
		}
		
	}
	
	public function getByParentGroupId($parent_group_uid, $parent){
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_caretaker_group', 'hidden=0 AND deleted=0 AND parent_group='.(int)$parent_group_uid);
		$result = array();
		while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res) ){
			$result[] = $this->dbrow2instance($row, $parent);
		} 
		return $result;
	}

	
	function dbrow2instance($row, $parent){
		$instance = new tx_caretaker_Group($row['uid'], $row['title'], $parent);
		return $instance; 
	}
	
}
?>