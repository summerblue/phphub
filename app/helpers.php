<?php

function cdn($filepath)
{
    if (Config::get('app.url_static')) {
        return Config::get('app.url_static') . $filepath;
    } else {
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
