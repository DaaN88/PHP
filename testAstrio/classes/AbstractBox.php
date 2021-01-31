<?php

abstract class AbstractBox
{

    private $internalKey;

    private $internalValue;

    public function setData($transferredKeyFromBox, $transferredValueFromBox)
    {
        $this->internalKey = $transferredKeyFromBox;
        $this->internalValue = $transferredValueFromBox;
    }

    public function getData()
    {
        return [$this->internalKey => $this->internalValue];
    }

}