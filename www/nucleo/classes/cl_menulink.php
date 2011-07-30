<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cl_menu
 *
 * @author UP23
 */
class MenuLink {

    var $dbconn;


    function MenuLink(){
        $this->dbconn = new Dbconn;
    }

	function getArvoreMenu(){

		$l_str_sql = " call getArvoreMenu()";

		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);

	}

}
?>
