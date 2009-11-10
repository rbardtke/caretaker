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

class tx_caretaker_MemoryLogger implements tx_caretaker_LoggerInterface {


	var $log_messages = '';

	/**
	 * Silent Mode
	 * 
	 * @var boolean
	 */	
	private $silentMode = false;
	
	/**
	 * Set the SilentMode
	 * 
	 * @param $silent
	 */
    private function setSilentMode($silent){
    	$this->silentMode = $silent;
    }

    /**
     * (non-PHPdoc)
     * @see caretaker/trunk/interfaces/tx_caretaker_LoggerInterface#log()
     */
    public function log($msg){
    	if ($this->silentMode == false){
	    	$this->log_messages .= $msg.chr(10);
    	}
    }

	/**
	 * Get the aggregated Log Messages
	 * @return string
	 */
	public function getLog(){
		return $this->log_messages;
	}


}
?>