<?php

namespace app\controller;

use hikari\cms\controller\Base as ControllerBase;

class Index extends ControllerBase {

    function index() {
        return ['title' => 'hello!', 'content' => []];
    }
}
