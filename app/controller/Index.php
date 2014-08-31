<?php

namespace app\controller;

class Index extends \hikari\cms\controller\Index {

    function index() {
    	$page = new \hikari\cms\model\Page;
    	$page->title = 'Testing';
    	$page->save();
        $page = \hikari\cms\model\Page::one([
            'name' => $this->request->request('page', 'index'),
        ], ['hydrator' => true]);
        return ['title' => 'hello!', 'page' => $page];
    }
}
