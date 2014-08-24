<?php

function cdn( $filepath )
{
    if (Config::get('app.url_static'))
    {
        return Config::get('app.url_static') . '/' . $filepath;
    }
    else
    {
        return Config::get('app.url') . '/' . $filepath;
    }

}
