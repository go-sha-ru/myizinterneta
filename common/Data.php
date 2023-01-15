<?php
require_once('DB.php');
require_once('Helper.php');

class Data
{
    public $id;
    public $parent_id;
    public $title;
    public $description;

    public function __construct($id=null, $parent_id=null, $title, $description='')
    {        
        $this->id = $id;
        $this->parent_id = $parent_id;
        $this->title = $title;
        $this->description = $description;
    }

    public function toData()
    {
        $data = [
            'parent_id' => $this->parent_id,
            'title' => $this->title,
            'description' => $this->description,
        ];
        if ($this->id !== null) $data['id'] = $this->id;
        return $data;
    }

    public static function getAll()
    {
        $pdo = new DB;
        $sth = $pdo->db->prepare('select id, parent_id, title, description from data');
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);        
        return $data;
    }

    public static function get($id)
    {
        $pdo = new DB;
        $sth = $pdo->db->prepare('select * from data where id=:id');
        $sth->execute(['id' => $id]);
        $data = $sth->fetch(PDO::FETCH_ASSOC);
        return new Data($data);
    }

    public function save()
    {
        $pdo = new DB;
        if ($this->id === null) {
            $data = $pdo->db->prepare('insert into data (id, parent_id, title, description) values (NULL, :parent_id, :title, :description)');
            $data->execute($this->toData());
        } else {
            $data = $pdo->db->prepare('update data set parent_id=:parent_id, title=:title, description=:description where id=:id');
            $data->execute($this->toData());
        }        
    }

    public static function delete($id)
    {
        $pdo = new DB;
        $sth = $pdo->db->prepare('delete from data where id=:id');
        $sth->execute(['id' => $id]);
    }
}