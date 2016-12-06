<?php
 /*
 *    mysql��ṹ������
 *    �������ݱ����ӣ��༭��ɾ�������ֶ�
 *
 */
 class MysqlManage{
    /*
     * �������ݿ⣬����������aid
     * table Ҫ��ѯ�ı���
     */
    function createTable($table){
		$sql="CREATE TABLE IF NOT EXISTS `$table` (`id` INT NOT NULL AUTO_INCREMENT primary key) ENGINE = InnoDB;";
		M()->execute($sql);
        return $this->checkTable($table);
    }
    /*
     * �����Ƿ���ڣ�Ҳ���Ի�ȡ���������ֶε���Ϣ
     * table Ҫ��ѯ�ı���
     * return ���������ֶε���Ϣ
     */
    function checkTable($table){
        $table_arr = M()->query("SHOW TABLES");
        $tables = array();
        foreach ($table_arr as $key => $value) {
            $tables = array_merge_recursive($tables,$value);
        }
        foreach ($tables as $key => $value) {
            $checkTables = $value;
        }
        if(in_array($table, $checkTables)){
            $sql="desc `$table`";
            $info= M()->execute($sql);
            return $info;
        }else{
            return '';
        }
        
    }
    /*
     * ����ֶ��Ƿ���ڣ�Ҳ���Ի�ȡ�ֶ���Ϣ(ֻ����һ���ֶ�)
     * table ����
     * field �ֶ���
     */
    function checkField($table,$field){
        $sql="desc `$table` $field";
        $info=M()->execute($sql);
        return $info;
    }
    /*
     * ����ֶ�
     * table ����
     * info  �ֶ���Ϣ���� array
     * return �ֶ���Ϣ array
     */
    function addField($table,$info){
        $sql="alter table `$table` add column ";
        $sql.=$this->filterFieldInfo($info);
        M()->execute($sql);
        $this->checkField($table,$info['name']);
    }
    /*
     * �޸��ֶ�
     * �����޸��ֶ����ƣ�ֻ���޸�
     */
    function editField($table,$info){
        $sql="alter table `$table` modify ";
        $sql.=$this->filterFieldInfo($info);
        M()->execute($sql);
        $this->checkField($table,$info['name']);
    }
    /*
     * �ֶ���Ϣ���鴦������Ӹ����ֶ�ʱ��ʹ��
     * info[name]   �ֶ�����
     * info[type]   �ֶ�����
     * info[length]  �ֶγ���
     * info[isNull]  �Ƿ�Ϊ��
     * info['default']   �ֶ�Ĭ��ֵ
     * info['comment']   �ֶα�ע
     */
    private function filterFieldInfo($info){
        if(!is_array($info))
            return '';
        $newInfo=array();
        $newInfo['name']=$info['name'];
        $newInfo['type']=$info['type'];
        switch($info['type']){
            case 'varchar':
				$newInfo['length']=empty($info['length'])?100:$info['length'];
                $newInfo['isNull']=$info['isNull']==1?'NULL':'NOT NULL';
                $newInfo['default']=empty($info['default'])?'':'DEFAULT "'.$info['default'].'"';
                $newInfo['comment']=empty($info['comment'])?'':'COMMENT "'.$info['comment'].'"';
               break;
            case 'char':
                $newInfo['length']=empty($info['length'])?100:$info['length'];
                $newInfo['isNull']=$info['isNull']==1?'NULL':'NOT NULL';
                $newInfo['default']=empty($info['default'])?'':'DEFAULT "'.$info['default'].'"';
                $newInfo['comment']=empty($info['comment'])?'':'COMMENT "'.$info['comment'].'"';
                                 break;
            case 'int':
                $newInfo['length']=empty($info['length'])?7:$info['length'];
                $newInfo['isNull']=$info['isNull']==1?'NULL':'NOT NULL';
                $newInfo['default']=empty($info['default'])?'':'DEFAULT "'.$info['default'].'"';
                $newInfo['comment']=empty($info['comment'])?'':'COMMENT "'.$info['comment'].'"';
                                 break;
            case 'text':
                $newInfo['length']='';
                $newInfo['isNull']=$info['isNull']==1?'NULL':'NOT NULL';
                $newInfo['default']='';
                $newInfo['comment']=empty($info['comment'])?'':'COMMENT "'.$info['comment'].'"';
                                break;
			default:
				$newInfo['length']=empty($info['length'])?100:$info['length'];
                $newInfo['isNull']=$info['isNull']==1?'NULL':'NOT NULL';
                $newInfo['default']=empty($info['default'])?'':'DEFAULT "'.$info['default'].'"';
                $newInfo['comment']=empty($info['comment'])?'':'COMMENT "'.$info['comment'].'"';
        }
        $sql=$newInfo['name']." ".$newInfo['type'];
        $sql.=(!empty($newInfo['length']))?'('.$newInfo['length'].')' .' ':' ';
        $sql.=$newInfo['isNull'].' ';
        $sql.=$newInfo['default'];
        $sql.=$newInfo['comment'];
        return $sql;
    }
    /*
     * ɾ���ֶ�
     * ����������ֶ���Ϣ��˵��ɾ��ʧ�ܣ�����false����Ϊɾ���ɹ�
     */
    function dropField($table,$field){
        $sql="alter table `$table` drop column $field";
        M()->execute($sql);
        $this->checkField($table,$filed);
    }
    /*
     * ��ȡָ������ָ���ֶε���Ϣ(���ֶ�)
     */
    function getFieldInfo($table,$field){
        $info=array();
        if(is_string($field)){
            $this->checkField($table,$field);
        }else{
            foreach($field as $v){
                $info[$v]=$this->checkField($table,$v);
            }
        }
        return $info;
    }
 }
