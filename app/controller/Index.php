<?php

namespace app\controller;

class Index extends \hikari\cms\controller\Index {

    function index() {
        $page = \hikari\cms\model\Page::find([
            'name' => $this->request->request('page', 'index'),
        ], ['hydrator' => true]);
        return ['title' => 'hello!', 'page' => $page];
    }
}
