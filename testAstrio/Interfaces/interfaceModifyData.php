<?php

    interface interfaceModifyData {

        public function setData($key, $value);

        public function getData();

        public function save();

        public function load();
    }