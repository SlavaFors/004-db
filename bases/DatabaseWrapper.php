<?php
    class DatabaseWrapper
    {
        public function __construct(Object $bd, string $class)
        {
            $this->bd = $bd;
            $this->class = strtolower($class);
        }

        public function createTable($poles)
        {
            $this->bd->query("CREATE TABLE `".$this->class."` ( ID INT NOT NULL AUTO_INCREMENT, ".$poles.", PRIMARY KEY (ID) )");
        }

        public function insert($poles, $data)
        {
            $this->bd->query("INSERT INTO `".$this->class."` ( ".$poles." ) VALUES ( \"".implode('", "', explode(', ', $data))."\" )");
        }

        public function find(int $id)
        {
            return $this->bd->query("SELECT * FROM `".$this->class."` WHERE ID = $id")->fetch();
        }

        public function update(int $id, array $data)
        {
            $this->bd->query("UPDATE `".$this->class."` SET ".implode(', ', $data)." WHERE ID = ".$id);
        }

        public function delete(int $id)
        {
            $this->bd->query("DELETE FROM `".$this->class."` WHERE `ID`=".$id);
        }

        public function drop()
        {
            $this->bd->query("DROP TABLE `".$this->class."`");
        }
    }