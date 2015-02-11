<?php

function cdn( $filepath )
{
    if (Config::get('app.url_static'))
    {
        return Config::get('app.url_static') . $filepath;
    }
    else
    {
        return Config::get('app.url') . $filepath;
    }
}

function getCdnDomain()
{
    return Config::get('app.url_static') ?: Config::get('app.url');
}

function getUserStaticDomain()
{
    return Config::get('app.user_static') ?: Config::get('app.url');
}

function lang($text)
{
    return str_replace('phphub.', '', trans('phphub.'.$text));
}

function auto_space($content) {
    // $content = strip_tags($content);
    $content = preg_replace('~(\p{Han})([a-zA-Z0-9\p{Ps}])(?![^<]*>)~u', '\1 \2', $content);
    $content = preg_replace('~([a-zA-Z0-9\p{Pe}])(\p{Han})(?![^<]*>)~u', '\1 \2', $content);
    $content = preg_replace('~([!?‽:;,.])(\p{Han})~u', '\1 \2', $content);
    $content = preg_replace('~(\p{Han})(<[a-zA-Z]+?.*?>)~u', '\1 \2', $content);
    $content = preg_replace('~(\p{Han})(<\/[a-zA-Z]+>)~u', '\1\2 ', $content);
    $content = preg_replace('~(<\/[a-zA-Z]+>)(\p{Han})~u', '\1 \2', $content);
    $content = preg_replace('~(<[a-zA-Z]+?.*?>)(\p{Han})~u', ' \1\2', $content);
    // $content = preg_replace('~\![ ]?(\p{Han})~u', '！\1', $content);
    // $content = preg_replace('~\:[ ]?(\p{Han})~u', '：\1', $content);
    // $content = preg_replace('~\;[ ]?(\p{Han})~u', '；\1', $content);
    // $content = preg_replace('~\?[ ]?(\p{Han})~u', '？\1', $content);
    // $content = preg_replace('~\,[ ]?(\p{Han})~u', '，\1', $content);
    // $content = preg_replace('~\.[ ]?(\p{Han})~u', '。\1', $content);
    // $content = preg_replace('~\+[ ]?(\p{Han})~u', '＋\1', $content);
    // $content = preg_replace('~\=[ ]?(\p{Han})~u', '＝\1', $content);
    // $content = preg_replace('~\&[ ]?(\p{Han})~u', '＆\1', $content);
    $content = preg_replace('~[ ]*([「」『』（）〈〉《》【】〔〕〖〗〘〙〚〛])[ ]*~u', '\1', $content);
    return $content;
}