<?php

/* Simple configuration file for Laravel Sitemap package */
return array(
    'use_cache' => true,
    'cache_key' => 'Laravel.Sitemap.'.\Request::getHttpHost(),
    'cache_duration' => 3600, //minutes
    'escaping' => true,
);
