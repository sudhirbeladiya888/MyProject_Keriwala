<?php

require_once '_HELPER.php';
global $DEBUG, $db, $gh;

class MysqliDB
{
    protected $_mysqli;

    public function __construct($host, $username, $password, $db, $port = NULL){
        if($port == NULL)
            $port = ini_get('mysqli.default_port');
        
        $this->_mysqli = new mysqli($host, $username, $password, $db, $port)
            or die('There was a problem connecting to the database');

        $this->_mysqli->set_charset('utf8');
    }

    public function __destruct() { 
        $this->_mysqli->close();
    }

    public function execute($query){
   
        global $DEBUG, $db, $gh, $outputjson;
        $gh->debug("EXECUTE: ".$query);

        $debug= isset($_REQUEST['debug']) && $_REQUEST['debug'] == '1';
        if($debug)
        {
            $query_info = array();
            $query = str_replace("\r\n", " ",$query);
            $query = str_replace("\t", " ",$query);
            $query = str_replace("\n", " ",$query);
            $query_info["query"] = $query;
            $query_start=microtime(true);
        }

        $result = array();
        $stmt = $this->_mysqli->prepare($query);
        if ($stmt) {
            $stmt->execute();
        /*
            Vidioo Server: http://54.186.107.171/web_services/  
            Fatal error: Call to undefined method mysqli_stmt::get_result() in /var/www/web_services/_DB.php on line 26
            //$result = $stmt->get_result();
        */

            $meta = $stmt->result_metadata(); 
            while ($field = $meta->fetch_field()) 
            { 
                $params[] = &$row[$field->name]; 
            } 

            call_user_func_array(array($stmt, 'bind_result'), $params); 

            while ($stmt->fetch()) { 
                foreach($row as $key => $val) 
                { 
                    $c[$key] = $val; 
                } 
                $result[] = $c; 
            } 
        
            $stmt->close();
        }
        else{
            trigger_error("Problem preparing query ($query) " 
                . $this->_mysqli->error , E_USER_ERROR);
        }
        if($debug)
        {
            $query_stop=microtime(true);
            $query_time_diff = ($query_stop-$query_start).' seconds';
            $query_info["time"] = $query_time_diff;
            $outputjson["query_info"][] = $query_info;
        }
        return $result;
    }

    public function execute_scalar($query) {
        global $DEBUG, $db, $gh;
        $gh->debug($query);

        $result = $this->execute($query);
        $arr = $result ;
        // $row = $result->fetch_assoc();
        //  $arr = array_values($row);
        $obj = array();
        if(isset($arr) && count($arr) > 0)
           $obj = $arr[0];
        return $obj;
    }

    public function execute_update($query) {

        global $DEBUG, $db, $gh, $outputjson;

        $gh->debug($query);
        //echo $query;
        $debug= isset($_REQUEST['debug']) && $_REQUEST['debug'] == '1';
        if($debug)
        {
            $query_info = array();
            $query = str_replace("\r\n", " ",$query);
            $query = str_replace("\t", " ",$query);
            $query = str_replace("\n", " ",$query);
            $query_info["query"] = $query;
            $query_start=microtime(true);
        }

        $cnt = -1;
        $result = $this->_mysqli->query($query);
        $pos = strpos(strtolower($query), 'insert');
        if($pos > -1){
            $cnt = $this->_mysqli->insert_id;
        }
        else{
            $pos = strpos(strtolower($query), 'delete');
            if($pos > -1){
                if ( $result === FALSE ) {
                    $cnt = 0;
                }
                else if ( $result === TRUE ) {
                    $cnt = 0;
                }
                else if ($result && $result->num_rows){
                    //$cnt =  $result->num_rows;
                    // getting error
                }
            }
            else{
                $cnt = $result;    
            }
        }
        if($debug)
        {
            $query_stop=microtime(true);
            $query_time_diff = ($query_stop-$query_start).' seconds';
            $query_info["time"] = $query_time_diff;
            $outputjson["query_info"][] = $query_info;
        }
        return $cnt;
    }

    public function getRowCount($table, $whereData) {
        global $DEBUG, $db, $gh;
        if(is_array($whereData)){
            $where = "1=1";
            foreach ($whereData as $column => $value) {
                $where .= " AND `$column`='".$this->_mysqli->real_escape_string($value)."'";
            }
        }else{
            $where = $whereData;
        }

        $sql = "SELECT count(*) as cnt FROM ".$table." WHERE ".$where;
        $gh->debug($sql);

        $result = $this->execute_scalar($sql);

        if(is_array($result)){
            $result = $result["cnt"];
        }

        return $result;
    }

    public function selectQuery($query){

        global $DEBUG, $db, $gh;
        $gh->debug($query);

        $array = array();
        $result = $this->execute($query);
        $array = $result;
        // if($result){
        //     while ($row = $result->fetch_assoc()) {
        //         $array[] = $row;
        //     }
        // }
       
        return $array;    
    }

    public function select($columns, $table, $where) {
        $query = " SELECT ".$columns." FROM ".$table." WHERE ".$where."";
        return $this->selectQuery($query);
    }

    public function insert($table, $tableData){
        
        global $DEBUG, $db, $gh, $outputjson;

        $columns = "";
        $values = "";

        $gh->debug($tableData);

        foreach ($tableData as $column => $value) {
        
            $columns .= ($columns == "") ? "" : ", ";
            $columns .= $column;
            $values .= ($values == "") ? "" : ", ";
            $values .= "'".$this->_mysqli->real_escape_string($value)."'";
        }

        $query = "insert IGNORE into $table ($columns) values ($values)";

        $gh->debug($query);

        $debug= isset($_REQUEST['debug']) && $_REQUEST['debug'] == '1';
        if($debug)
        {
            $query_info = array();
            $query = str_replace("\r\n", " ",$query);
            $query = str_replace("\t", " ",$query);
            $query = str_replace("\n", " ",$query);
            $query_info["query"] = $query;
            $query_start=microtime(true);
        }

        $result = $this->_mysqli->query($query);
        $cnt = $this->_mysqli->insert_id;
        if($debug)
        {
            $query_stop=microtime(true);
            $query_time_diff = ($query_stop-$query_start).' seconds';
            $query_info["time"] = $query_time_diff;
            $outputjson["query_info"][] = $query_info;
        }
        return $cnt;
    }

    public function update($table, $tableData, $whereData){

        global $DEBUG, $db, $gh, $outputjson;

        $columns_values = "";

        foreach ($tableData as $column => $value) {
            $columns_values .= ($columns_values == "") ? "" : ", ";
            if($this->isMySqlFunction($value)) {
                 $columns_values .= "`$column`=$value";
            }
            else {
                $columns_values .= "`$column`='".$this->_mysqli->real_escape_string($value)."'";
            }
        }

        $where = "";
        if(is_array($whereData)){
            $where = "1=1";
            foreach ($whereData as $column => $value) {
                $where .= " AND `$column`='".$this->_mysqli->real_escape_string($value)."'";
            }
        }else{
            $where = $whereData;
        }

        $query = "UPDATE $table SET ".$columns_values." WHERE ".$where;
        $gh->debug($query);

        $debug= isset($_REQUEST['debug']) && $_REQUEST['debug'] == '1';
        if($debug)
        {
            $query_info = array();
            $query = str_replace("\r\n", " ",$query);
            $query = str_replace("\t", " ",$query);
            $query = str_replace("\n", " ",$query);
            $query_info["query"] = $query;
            $query_start=microtime(true);
        }

        $result = $this->_mysqli->query($query);
        $cnt = -1;
        if($result == true || $result > 0){
            $cnt = $this->_mysqli->affected_rows;  
        }
        if($debug)
        {
            $query_stop=microtime(true);
            $query_time_diff = ($query_stop-$query_start).' seconds';
            $query_info["time"] = $query_time_diff;
            $outputjson["query_info"][] = $query_info;
        }
        
        return $cnt;
    }

    public function isMySqlFunction($value){
        $pos = strpos($value, "TIMESTAMPDIFF(");
        return isset($pos) && $pos > -1;
    }

    public function delete($table, $whereData){

        global $DEBUG, $db, $gh, $outputjson;

        if(is_array($whereData)){
            $where = "1=1";
            foreach ($whereData as $column => $value) {
                $where .= " AND `$column`='".$this->_mysqli->real_escape_string($value)."'";
            }
        }else{
            $where = $whereData;
        }
        
        $query = "DELETE FROM ".$table." WHERE ".$where;
        $gh->debug($query);

        $debug= isset($_REQUEST['debug']) && $_REQUEST['debug'] == '1';
        if($debug)
        {
            $query_info = array();
            $query = str_replace("\r\n", " ",$query);
            $query = str_replace("\t", " ",$query);
            $query = str_replace("\n", " ",$query);
            $query_info["query"] = $query;
            $query_start=microtime(true);
        }

        $result = $this->_mysqli->query($query);

        if($debug)
        {
            $query_stop=microtime(true);
            $query_time_diff = ($query_stop-$query_start).' seconds';
            $query_info["time"] = $query_time_diff;
            $outputjson["query_info"][] = $query_info;
        }

        return $result;
    }

    public function bulk_insert($table, $tableDataList){

        global $DEBUG, $db, $gh;
        
        $columns = "";
        $values = "";
        $bulk_values = "";

        $i=0;
        foreach ($tableDataList as $key => $tableData){
            $values="";
            foreach ($tableData as $column => $value) {
                if($i==0){
                    $columns .= ($columns == "") ? "" : ", ";
                    $columns .= $column;
                }
                $values .= ($values == "") ? "" : ", ";
                $values .= '"'.$this->_mysqli->real_escape_string($value).'"';
            }

            $bulk_values .= ($bulk_values == "") ? "" : ", ";
            $bulk_values .= "(".$values.")";
            $i++;
        }

        $query = "insert IGNORE into $table ($columns) values $bulk_values";

        //$gh->Log("SQL:".$query);

        $debug= isset($_REQUEST['debug']) && $_REQUEST['debug'] == '1';
        if($debug)
        {
            $query_info = array();
            $query = str_replace("\r\n", " ",$query);
            $query = str_replace("\t", " ",$query);
            $query = str_replace("\n", " ",$query);
            $query_info["query"] = $query;
            $query_start=microtime(true);
        }

        $gh->debug($query);

        $result = $this->_mysqli->query($query);
        $cnt = $this->_mysqli->insert_id;
        if($debug)
        {
            $query_stop=microtime(true);
            $query_time_diff = ($query_stop-$query_start).' seconds';
            $query_info["time"] = $query_time_diff;
            $outputjson["query_info"][] = $query_info;
        }
        return $cnt;
    }

    public function prepareQuery($table, $tableData, $whereData)
    {
        global $DEBUG, $db, $gh, $outputjson;

        $columns_values = "";

        foreach ($tableData as $column => $value) {
            $columns_values .= ($columns_values == "") ? "" : ", ";
            if($this->isMySqlFunction($value)) {
                 $columns_values .= "`$column`=$value";
            }
            else {
                $columns_values .= "`$column`='".$this->_mysqli->real_escape_string($value)."'";
            }
        }

        $where = "";
        if(is_array($whereData)){
            $where = "1=1";
            foreach ($whereData as $column => $value) {
                $where .= " AND `$column`='".$this->_mysqli->real_escape_string($value)."'";
            }
        }else{
            $where = $whereData;
        }

        $query = "UPDATE $table SET ".$columns_values." WHERE ".$where;
        $gh->debug($query);
        
        return $query;
    }

    public function prepareInsertQuery($table, $tableData){
        
        global $DEBUG, $db, $gh, $outputjson;

        $columns = "";
        $values = "";

        foreach ($tableData as $column => $value) {
        
            $columns .= ($columns == "") ? "" : ", ";
            $columns .= $column;
            $values .= ($values == "") ? "" : ", ";
            $values .= "'".$this->_mysqli->real_escape_string($value)."'";
        }

        $query = "insert into $table ($columns) values ($values)";
        $gh->debug($query);
        return $query;
    }

    public function prepareUpdateQuery($table, $tableData, $whereData){

        global $DEBUG, $db, $gh, $outputjson;

        $columns_values = "";

        foreach ($tableData as $column => $value) {
            $columns_values .= ($columns_values == "") ? "" : ", ";
            if($this->isMySqlFunction($value)) {
                 $columns_values .= "$column=$value";
            }
            else {
                $columns_values .= "$column='".$this->_mysqli->real_escape_string($value)."'";
            }
        }

        $where = "";
        if(is_array($whereData)){
            $where = "1=1";
            foreach ($whereData as $column => $value) {
                $where .= " AND $column='".$this->_mysqli->real_escape_string($value)."'";
            }
        }else{
            $where = $whereData;
        }

        $query = "UPDATE $table SET ".$columns_values." WHERE ".$where;
        $gh->debug($query);
        return $query;
    }

} 
