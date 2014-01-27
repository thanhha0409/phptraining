<?php

class Lake
{
    static protected $lakeCnf = array(
        'example' => array('path' => '' ,'domain' => 'example.dev'),
    );

    static $lakeId = null;

    /*
     * lake_idを返す
     */
    static public function lakeId()
    {
        if (self::$lakeId) {
            return self::$lakeId;
        }

        switch (true) {
        default:
            self::$lakeId = 'example';
            break;
        }
        return self::$lakeId;
    }

    static public function lakePaths()
    {
        $lake_id = self::lakeId();
        $path = self::$lakeCnf[$lake_id]['path'];
        $paths = array();
        if ($path) {
            $paths[] = '/lake/'.$path;
        }
        $paths[] = '';
        return $paths;
    }

    static public function imgPath()
    {
        return '/img/';//TODO
        $lakeId = self::lakeId();
        if ($lakeId !== 'example') {
            return '/img_'.$lakeId.'/';
        } else {
            return '/img/';
        }
    }

    static public function lakePrefix()
    {

    }

    static public function lakeDomain()
    {
        $lakeId = self::lakeId();
        $domain = DEV_DOMAIN;
        if ($lakeId) {
            $arr = self::$lakeCnf[$lakeId];
            $domain = $arr['domain'];
        }
        return $domain;
    }

    static public function informationPath()
    {
        $lakeId = self::lakeId();
        if ($lakeId !== 'example') {
            return '/information_'.$lakeId.'/';
        } else {
            return '/information/';
        }
    }

}
