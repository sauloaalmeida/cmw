<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cl_template
 *
 * @author UP23
 */
class Template {

    var $dbconn;
    private $nwsl_temp_pk;
    private $nwsl_temp_nome;
    private $nwsl_temp_path;



    public function getNwsl_temp_pk() {
        return $this->nwsl_temp_pk;
    }

    public function setNwsl_temp_pk($nwsl_temp_pk) {
        $this->nwsl_temp_pk = $nwsl_temp_pk;
    }

    public function getNwsl_temp_nome() {
        return $this->nwsl_temp_nome;
    }

    public function setNwsl_temp_nome($nwsl_temp_nome) {
        $this->nwsl_temp_nome = $nwsl_temp_nome;
    }

    public function getNwsl_temp_path() {
        return $this->nwsl_temp_path;
    }

    public function setNwsl_temp_path($nwsl_temp_path) {
        $this->nwsl_temp_path = $nwsl_temp_path;
    }


    function Template(){
        $this->dbconn = new Dbconn;
        $this->nwsl_temp_pk = NULL;
        $this->nwsl_temp_nome = NULL;
        $this->nwsl_temp_path = NULL;

    }

    
   function getTodosTemplates(){

		$l_str_sql = " select nwsl_temp_pk,  ";
		$l_str_sql.= "        nwsl_temp_nome,  ";
		$l_str_sql.= "        nwsl_temp_path ";
		$l_str_sql.= " from nwsl_template ";
		$l_str_sql.= " order by nwsl_temp_nome asc";


		return $this->dbconn->getRecordset($l_str_sql);

	}

    
}
?>
