<?php

class DbBox extends AbstractBox implements interfaceModifyData
{

    public function save()
    {
        foreach (parent::getData() as $id => $data) {
            echo "The following data are saved in database:<br/>"." id: ".$id."; <br/> data: ".$data;
        }
    }

    public function load()
    {
        echo "loaded data from database";
    }

}