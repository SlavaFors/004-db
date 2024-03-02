<?php
    class Shop extends DatabaseWrapper
    {
        public function __construct(Object $bd)
        {
            $this->bd = $bd;
            parent::__construct($bd, __CLASS__);
            $this->createTable("name VARCHAR(20), address VARCHAR(20)");
        }
    }