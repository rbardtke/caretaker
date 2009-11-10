<?php 
/**
 * This is a file of the caretaker project.
 * Copyright 2008 by n@work Internet Informationssystem GmbH (www.work.de)
 * 
 * @Author	Thomas Hempel 		<thomas@work.de>
 * @Author	Martin Ficzel		<martin@work.de>
 * @Author	Patrick Kollodzik	<patrick@work.de> 
 * @Author	Tobias Liebig   	<mail_typo3.org@etobi.de>
 * @Author	Christopher Hlubek	<hlubek@networkteam.com>
 * 
 * $Id$
 */

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2008 Martin Ficzel <ficzel@work.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

class tx_caretaker_RootNode extends tx_caretaker_AggregatorNode {

	public function __construct( $hidden=false) {
		parent::__construct(0, 'Caretaker Root', false, 'Root', $hidden);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see caretaker/trunk/classes/nodes/tx_caretaker_AggregatorNode#findChildren()
	 */#
	protected function findChildren ($show_hidden=false){
		$node_repository = tx_caretaker_NodeRepository::getInstance();
		
		$root_instancegroups = $node_repository->getInstancegroupsByParentGroupUid(0, $this, $show_hidden );
		$root_instances = $node_repository->getInstancesByInstancegroupUid(0, $this, $show_hidden );
		$children = array_merge($root_instancegroups, $root_instances);
				
		return $children;
	}
	
	/**
	 * Find Parent Node
	 * @return tx_caretaker_AbstractNode
	 */
	protected function findParent (){
		return false;
	}
	
	public function getTestConfigurationOverlayForTestUid($testUid) {
		return false;
	}
	
}

?>