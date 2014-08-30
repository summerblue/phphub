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

function lang($text)
{
    return trans('phphub.'.$text);
}
