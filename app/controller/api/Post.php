<?php

namespace app\controller\api;

use hikari\controller\Rest;

class Post extends Rest {
    static function modelClassName() {
        return '\hikari\cms\model\Post';
    }
}
