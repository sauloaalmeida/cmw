<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cl_menulink
 *
 * @author UP23
 */
class MenuLink {

    var $dbconn;
    var $menu_link_pk;
    var $menu_link_nome;
    var $menu_link_descricao;
    var $menu_link_path;
    var $menu_link_url;
    var $menu_link_target;
    var $menu_link_ordem;
    var $menu_link_pai_fk;

    function MenuLink(){
        $this->dbconn = new Dbconn;
        $this->menu_link_pk = NULL;
        $this->menu_link_nome = NULL;
        $this->menu_link_descricao = NULL;
        $this->menu_link_path = NULL;
        $this->menu_link_url = NULL;
        $this->menu_link_target = NULL;
        $this->menu_link_ordem = NULL;
        $this->menu_link_pai_fk = NULL;
    }

	
	
    function getMenu($menu_link_pk){

        settype($menu_link_pk, 'integer');
        $l_str_sql = " select menu_link_pk, ";
	$l_str_sql.= "        menu_link_nome, ";
        $l_str_sql.= "        menu_link_target, ";
        $l_str_sql.= "        menu_link_url, ";
        $l_str_sql.= "        menu_link_descricao, ";
        $l_str_sql.= "        menu_link_path, ";
        $l_str_sql.= "        menu_link_ordem, ";
        $l_str_sql.= "        menu_link_pai_fk ";
	$l_str_sql.= " from menu_link ";
        $l_str_sql.= " where menu_link_pk = ".$menu_link_pk;
		
	$this->dbconn->conectar();

	//monta o recordset
	$rsTemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));
	
	$this->menu_link_pk = $rsTemp['menu_link_pk'];
        $this->menu_link_nome = $rsTemp['menu_link_nome'];
        $this->menu_link_descricao = $rsTemp['menu_link_descricao'];
        $this->menu_link_path = $rsTemp['menu_link_path'];
        $this->menu_link_url = $rsTemp['menu_link_url'];
        $this->menu_link_target = $rsTemp['menu_link_target'];
        $this->menu_link_ordem = $rsTemp['menu_link_ordem'];
        $this->menu_link_pai_fk = $rsTemp['menu_link_pai_fk'];

    }	
	
	
	

    function GetMenusPais($menu_link_pk){

        settype($menu_link_pk, 'integer');
        $l_str_sql = " call getMenusPai(".$menu_link_pk.")";

	//monta o recordset
	return $this->dbconn->getRecordset($l_str_sql);

    }

    function GetMenusFilhos($menu_link_pk){

        settype($menu_link_pk, 'integer');
        $l_str_sql = " select menu_link_pk, ";
	$l_str_sql.= "        menu_link_nome, ";
        $l_str_sql.= "        menu_link_url, ";
        $l_str_sql.= "        menu_link_target, ";
        $l_str_sql.= "        menu_link_descricao, ";
        $l_str_sql.= "        menu_link_path, ";
        $l_str_sql.= "        menu_link_ordem, ";
        $l_str_sql.= "        menu_link_pai_fk ";
	$l_str_sql.= " from menu_link";
        $l_str_sql.= " where menu_link_pai_fk IS NOT NULL ";
        $l_str_sql.= "   and menu_link_pai_fk = ".$menu_link_pk;
	$l_str_sql.= " order by menu_link_ordem, ";
        $l_str_sql.= "          menu_link_nome ";

        //echo $l_str_sql;
        //exit;
        $this->dbconn->conectar();

	//monta o recordset
	return $this->dbconn->getRecordset($l_str_sql);

    }

    function incluir(){


        settype($this->menu_link_pai_fk, 'integer');
        settype($this->menu_link_ordem, 'integer');
        $l_str_sql = " INSERT INTO menu_link ( ";
        $l_str_sql.= "        menu_link_nome, ";
        $l_str_sql.= "        menu_link_url, ";
        $l_str_sql.= "        menu_link_target, ";
        $l_str_sql.= "        menu_link_descricao, ";
        $l_str_sql.= "        menu_link_path, ";
        $l_str_sql.= "        menu_link_ordem, ";
        $l_str_sql.= "        menu_link_pai_fk) ";
	$l_str_sql.= " VALUES (";
        $l_str_sql.= "        '".$this->dbconn->anti_sql_injection($this->menu_link_nome)."', ";
        $l_str_sql.= "        ".(($this->menu_link_url==NULL)?"NULL, ":"'".$this->dbconn->anti_sql_injection($this->menu_link_url)."', ");
        $l_str_sql.= "        ".(($this->menu_link_target==NULL)?"NULL, ":"'".$this->dbconn->anti_sql_injection($this->menu_link_target)."', ");
        $l_str_sql.= "        ".(($this->menu_link_descricao==NULL)?"NULL, ":"'".$this->dbconn->anti_sql_injection($this->menu_link_descricao)."', ");
        $l_str_sql.= "        ".(($this->menu_link_path==NULL)?"NULL, ":"'".$this->dbconn->anti_sql_injection($this->menu_link_path)."', ");
        $l_str_sql.= "         ".$this->menu_link_ordem.", ";
        $l_str_sql.= "         ".$this->menu_link_pai_fk;
        $l_str_sql.= "        ) ";

        //echo $l_str_sql;
        //exit;

	//monta o recordset
	return $this->dbconn->getRecordset($l_str_sql);

    }

   	function alterar(){

                settype($this->menu_link_pk, 'integer');
                settype($this->menu_link_pai_fk, 'integer');
                settype($this->menu_link_ordem, 'integer');
		$l_str_sql = " UPDATE menu_link SET  ";
                $l_str_sql.= "        menu_link_nome = '".$this->dbconn->anti_sql_injection($this->menu_link_nome)."', ";
                $l_str_sql.= "        menu_link_url = ".( ($this->menu_link_url==NULL) ? "NULL, " : "'".$this->dbconn->anti_sql_injection($this->menu_link_url)."', ");
                $l_str_sql.= "        menu_link_target = ".( ($this->menu_link_target==NULL) ? "NULL, " : "'".$this->dbconn->anti_sql_injection($this->menu_link_target)."', ");
                $l_str_sql.= "        menu_link_descricao = ".( ($this->menu_link_descricao==NULL) ? "NULL, " : "'".$this->dbconn->anti_sql_injection($this->menu_link_descricao)."', ");
                $l_str_sql.= "        menu_link_path = ".( ($this->menu_link_path==NULL) ? "NULL, " : "'".$this->dbconn->anti_sql_injection($this->menu_link_path)."', ");
		$l_str_sql.= "        menu_link_ordem = ".$this->menu_link_ordem." ";
                $l_str_sql.= " where  menu_link_pk = ".$this->menu_link_pk;

		//echo $l_str_sql;
		//exit;
		return $this->dbconn->execSql($l_str_sql);
	}
	
   	function excluir(){

                settype($this->menu_link_pk, 'integer');
		$l_str_sql = " DELETE FROM menu_link ";
                $l_str_sql.= " where  menu_link_pk = ".$this->menu_link_pk;

	//	echo $l_str_sql;
	//	exit;
		return $this->dbconn->execSql($l_str_sql);
	}

        function getDescricaoTarget($target){
             switch ($target) {
                case "_self":
                    echo "Mesmo frame";
                    break;
                case "_top":
                    echo "Mesma p&aacute;gina";
                    break;
                case "_blank":
                    echo "Nova p&aacute;gina";
                    break;
                case "":
                    echo "N&atilde;o definido";
                    break;
                default:
                    echo "Target desconhecido";
            }
        }

}
?>
