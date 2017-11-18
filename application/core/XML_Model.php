<?php

/**
 * XML-persisted collection.
 *
 * ------------------------------------------------------------------------
 */
class XML_Model extends Memory_Model
{
//---------------------------------------------------------------------------
//  Housekeeping methods
//---------------------------------------------------------------------------

    /**
     * Constructor.
     * @param string $origin Filename of the XML file
     * @param string $keyfield  Name of the primary key field
     * @param string $entity    Entity name meaningful to the persistence
     */
    function __construct($origin = null, $keyfield = 'id', $entity = null)
    {
        parent::__construct();

        // guess at persistent name if not specified
        if ($origin == null)
            $this->_origin = get_class($this);
        else
            $this->_origin = $origin;

        // remember the other constructor fields
        $this->_keyfield = $keyfield;
        $this->_entity = $entity;

        // start with an empty collection
        $this->_data = array(); // an array of objects
        $this->_fields = array(); // an array of strings
        // and populate the collection
        $this->load();
    }

    /**
     * Load the collection state appropriately, depending on persistence choice.
     * OVER-RIDE THIS METHOD in persistence choice implementations
     */
    protected function load()
    {
        //---------------------
        if (($data = simplexml_load_file($this->_origin)) !== FALSE)
        {
            $temp = new stdClass();
            $this->loadChild($data, $temp);
        }
        // --------------------
        // rebuild the keys table
        $this->reindex();
    }

    private function loadChild($xml, &$record)
    {
        $child_count = 0;
        foreach($xml as $key => $value)
        {
            $temp = new stdClass();
            $child_count++;
            if($this->loadChild($value, $temp) == 0)  // no childern, aka "leaf node"
            {
                if (!in_array($key, $this->_fields)) {
                    array_push($this->_fields, $key);
                }

                $record->$key = ((string)$value);
            } else {
                $recordKey = $temp->{$this->_keyfield};
                $this->_data[$recordKey] = $temp;
            }
        }
        return $child_count;
    }

    /**
     * Store the collection state appropriately, depending on persistence choice.
     * OVER-RIDE THIS METHOD in persistence choice implementations
     */
    protected function store()
    {
        // rebuild the keys table
        $this->reindex();
        //---------------------
        // --------------------
        if (($data = simplexml_load_file($this->_origin)) !== FALSE)
        {
            $updated_data = new SimpleXMLElement('<tasks></tasks>');

            foreach($this->_data as $key => $record)
            {
                $task = $updated_data->addChild('task');

                foreach($record as $field => $value)
                {
                    $task->addChild($field, htmlspecialchars($value));
                }
            }
        }

        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = true;
        $dom->formatOutput = true;

        $dom->loadXml($updated_data->asXML());
        $dom->save($this->_origin);
    }

}
