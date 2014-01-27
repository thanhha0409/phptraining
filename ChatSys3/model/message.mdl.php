<?php
class MessageModel extends MysqlModel{
    protected $tableName = 'messages';
    protected $created = true;
    protected $modified = true;
    public $primaryKey ='id';      
}
?>


