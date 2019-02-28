<?php
class opmysqli{
	private $host='';			//服务器地址
	private $name='' ;					//登录账号
	private $pwd ='';					//登录密码
	private $dBase='';			//数据库名称
	private $conn ;						//数据库链接资源
	private $result ;					//结果集
	private $msg ;						//返回结果
	private $fields;						//返回字段
	private $fieldsNum;					//返回字段数
	private $rowsNum;					//返回结果数
	private $rowsRst ;					//返回单条记录的字段数组
	private $filesArray = array();			//返回字段数组
	private $rowsArray = array();			//返回结果数组
	//初始化类
	function __construct($host='localhost',$name='root',$pwd='root',$dBase='db_reglog'){	
			$this->host = $host;	
			$this->name = $name;	
			$this->pwd = $pwd;		
			$this->dBase = $dBase;
		$this->init_conn();
	}
	//链接数据库
	function init_conn(){
		$this->conn=mysqli_connect($this->host,$this->name,$this->pwd);
		mysqli_select_db($this->conn,$this->dBase);
		mysqli_query($this->conn,"set names utf8");
	}
	//查询结果
	function mysqli_query_rst($sql){
		if($this->conn == ''){
			$this->init_conn();
		}
		$this->result = mysqli_query($this->conn,$sql);
	}
	//取得字段数 
	function getFieldsNum($sql){
		$this->mysqli_query_rst($sql);
		$this->fieldsNum = mysqli_num_fields($this->result);
	}
	//取得查询结果数
	function getRowsNum($sql){
		$this->mysqli_query_rst($sql);
		if(mysqli_errno() == 0){
			return mysqli_num_rows($this->result);
		}else{
			return '';
		}	
	}
	//取得记录数组（单条记录）
	function getRowsRst($sql){
		$this->mysqli_query_rst($sql);
		if(mysqli_error() == 0){
			$this->rowsRst = mysqli_fetch_array($this->result,MYSQL_ASSOC);
			return $this->rowsRst;
		}else{
			return '';
		}
	}
	//取得记录数组（多条记录）
	function getRowsArray($sql){
		$this->mysqli_query_rst($sql);
		if(mysqli_errno() == 0){
			while($row = mysqli_fetch_array($this->result,MYSQL_ASSOC)) {
				$this->rowsArray[] = $row;
			}
			return $this->rowsArray;
		}else{
			return '';
		}
	}
	//更新、删除、添加记录数
	function uidRst($sql){
		if($this->conn == ''){
			$this->init_conn();
		}
		mysqli_query($sql);
		$this->rowsNum = mysqli_affected_rows();
		if(mysqli_errno() == 0){
			return $this->rowsNum;
		}else{
			return '';
		}
	}
	//获取对应的字段值
	function getFields($sql,$fields){
		$this->mysqli_query_rst($sql);
		if(mysqli_errno() == 0){
			if(mysqli_num_rows($this->result) > 0){
				$tmpfld = mysqli_fetch_row($this->result);
				$this->fields = $tmpfld[$fields];
				
			}
			return $this->fields;
		}else{
			return '';
		}
	}
	
	//错误信息
	function msg_error(){
		if(mysqli_errno() != 0) {
			$this->msg = mysqli_error();
		}
		return $this->msg;
	}
	//释放结果集
	function close_rst(){
		mysqli_free_result($this->result);
		$this->msg = '';
		$this->fieldsNum = 0;
		$this->rowsNum = 0;
		$this->filesArray = '';
		$this->rowsArray = '';
	}
	//关闭数据库
	function close_conn(){
		$this->close_rst();
		mysqli_close($this->conn);
		$this->conn = '';
	}
}
$conne = new opmysqli();
