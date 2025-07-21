<?php
/**
 * @author Bradley Weston <admin@webod.co.uk>
 * @author Darren Seare <support@webod.co.uk>
 * @package WebOD Framework
 * @version 0.2.6
 * @copyright Copyright 2011 - You are not allowed to edit source code.
 */



class Html_Table {
    
    private $rows = array();
    private $tableStr = '';
    
    function __construct($Caption = NULL, $id = NULL, $klass = 'full', $border = 0, $cellspacing = 2, $cellpadding = 0, $attr_ar = array() ) {
        $this->tableStr = "\n<table" . ( !empty($id)? " id=\"$id\"": '' ) . 
            ( !empty($klass)? " class=\"$klass\"": '' ) . $this->addAttribs( $attr_ar ) . 
             " border=\"$border\" cellspacing=\"$cellspacing\" cellpadding=\"$cellpadding\">\n";
        if($Caption !== NULL)
            $this->tableStr .= sprintf('<caption>%s</caption>', $Caption);
    }
    
    private function addAttribs( $attr_ar ) {
        $str = '';
        foreach( $attr_ar as $key=>$val ) {
            $str .= " $key=\"$val\"";
        }
        return $str;
    }
    
    public function addRow($klass = NULL, $attr_ar = array() ) {
        $row = new HTML_TableRow( $klass, $attr_ar );
        array_push( $this->rows, $row );
    }
    
    public function addCell($data = '', $klass = NULL, $type = 'data', $attr_ar = array() ) {
        $cell = new HTML_TableCell( $data, $klass, $type, $attr_ar );
        // add new cell to current row's list of cells
        $curRow = &$this->rows[ count( $this->rows ) - 1 ]; // copy by reference
        array_push( $curRow->cells, $cell );
    }
    
    public function display() {
        foreach( $this->rows as $row ) {
            $this->tableStr .= !empty($row->klass) ? "  <tr class=\"$row->klass\"": "  <tr";
            $this->tableStr .= $this->addAttribs( $row->attr_ar ) . ">\n";
            $this->tableStr .= $this->getRowCells( $row->cells );
            $this->tableStr .= "  </tr>\n";
        }
        $this->tableStr .= "</table>\n";
        return $this->tableStr;
    }
    
    function getRowCells($cells) {
        $str = '';
        foreach( $cells as $cell ) {
            $tag = ($cell->type == 'data')? 'td': 'th';
            $str .= !empty($cell->klass) ? "    <$tag class=\"$cell->klass\"": "    <$tag";
            $str .= $this->addAttribs( $cell->attr_ar ) . ">";
            $str .= $cell->data;
            $str .= "</$tag>\n";
        }
        return $str;
    }
    
    function generate (){
        return $this->display();
    }
    
    function __toString (){
        return $this->display();
    }
    
}

if(!class_exists('HTML_TableRow')){
    class HTML_TableRow {
        function __construct($klass = NULL, $attr_ar = array()) {
            $this->klass = $klass;
            $this->attr_ar = $attr_ar;
            $this->cells = array();
        }
    }
    
    class HTML_TableCell {
        function __construct( $data, $klass, $type, $attr_ar ) {
            $this->data = $data;
            $this->klass = $klass;
            $this->type = $type;
            $this->attr_ar = $attr_ar;
        }
    }
}



