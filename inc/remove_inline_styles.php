<?php
add_filter('the_content', function($content) {
    $content = preg_replace('/ style=("|\')(.*?)("|\')/','',$content);
    return $content;
}, 20);
