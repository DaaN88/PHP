<?php

class FileBox extends AbstractBox implements interfaceModifyData
{

    protected function openFile()
    {

    }

    protected function closeFile()
    {

    }

    public function save()
    {
        foreach (parent::getData() as $id => $data) {
            echo "The following data are saved in file:<br/>"." id: ".$id."; <br/> data: ".$data;
        }
    }

    public function load()
    {
        echo "loaded data from file";
    }

}