<?php

class CommonController extends ControllerBase
{
    public function initialize(){
        Phalcon\Tag::setTitle('Menu');
        parent::initialize();
    }

    /**
     * Load left's menu
     * @param $menuFlag
     */
    public function menuAction( $menuFlag = ''){
    }
}
