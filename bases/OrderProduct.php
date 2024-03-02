<?php
    class OrderProduct extends DatabaseWrapper
    {
        public function __construct(Object $bd)
        {
            $this->bd = $bd;
            parent::__construct($bd, __CLASS__);
            $this->createTable("_product VARCHAR(20), _order VARCHAR(20), price VARCHAR(20)");
        }
    }