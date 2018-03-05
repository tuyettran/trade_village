<?php
/**
* Plugin: jQuery AJAX-ZOOM, zoomInc.inc.php
* Copyright: Copyright (c) 2010-2017 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Version: 5.0.9
* Date: 2017-09-18
* Review: 2017-09-18
* URL: http://www.ajax-zoom.com
* Documentation: http://www.ajax-zoom.com/index.php?cid=docs
*/

// Fixes for some servers
function axZmFixes()
{
    $docRootSave = '';

    if (isset($_SERVER['DOCUMENT_ROOT'])) {
        $docRootSave = $_SERVER['DOCUMENT_ROOT'];
    }

    unset($_SERVER['DOCUMENT_ROOT']);

    if (isset($_SERVER['SCRIPT_FILENAME'])) {
        $_SERVER['DOCUMENT_ROOT'] = str_replace('\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0 - strlen(isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : $_SERVER['PHP_SELF'])));
    }

    if (!isset($_SERVER['DOCUMENT_ROOT'])) {
        if (isset($_SERVER['PATH_TRANSLATED'])) {
            $_SERVER['DOCUMENT_ROOT'] = str_replace('\\', '/', substr($_SERVER['PATH_TRANSLATED'], 0, 0 - strlen(isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : $_SERVER['PHP_SELF'])));
        }
    }

    if (!isset($_SERVER['DOCUMENT_ROOT']) && $docRootSave) {
        $_SERVER['DOCUMENT_ROOT'] = $docRootSave;
    }

    if (isset($_SERVER['DOCUMENT_ROOT'])) {
        $_SERVER['DOCUMENT_ROOT'] = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
        if (substr($_SERVER['DOCUMENT_ROOT'], -1) == '/') {
            $_SERVER['DOCUMENT_ROOT'] = substr($_SERVER['DOCUMENT_ROOT'], 0, -1);
        }
    }
}

function getIonCubeVersion()
{
    if (function_exists('ioncube_loader_iversion')) {
        $liv = ioncube_loader_iversion();
        $lv = sprintf("%d.%d.%d", $liv / 10000, ($liv / 100) % 100, $liv % 100);
        return $lv;
    } else {
        return '';
    }
}

axZmFixes();

// Temporal fix, we will bring multibyte support for filenames in the future.
if (!function_exists('mb_strlen')) {
    function mb_strlen($a)
    {
        return strlen($a);
    }
}

require_once dirname(__FILE__).'/classes/axZm.packer.class.php';

if (defined('PHALANGER') || file_exists(dirname(__FILE__).'/axZm.class.php')) {
    // ASP.NET implementation with Phalanger, file axZm.class.php is not physically present!
    require_once dirname(__FILE__).'/axZm.class.php';
} else {
    $aZ_extensions = get_loaded_extensions();
    $aZ_sourceGuardian = false;
    $aZ_ionCube = false;

    foreach ($aZ_extensions as $k => $v) {
        if (stristr($v, 'ioncube')) {
            $aZ_ionCube = true;
        } elseif (stristr($v, 'sourceguardian')) {
            $aZ_sourceGuardian = true;
        }
    }

    if ($aZ_ionCube) {
        $ioncube_version = getIonCubeVersion();
        if (version_compare(PHP_VERSION, '5.6.0') >= 0 && version_compare($ioncube_version, '5.0') >= 0) {
            require_once dirname(__FILE__).'/axZm.class.ioncube.9.php';
        } elseif (version_compare($ioncube_version, '4.4') >= 0) {
            require_once dirname(__FILE__).'/axZm.class.ioncube.8.php';
        } else {
            die('Ioncube loader version ('.$ioncube_version.') installed on this server is too old; you need at least 4.4 to run AJAX-ZOOM.');
        }
    } elseif ($aZ_sourceGuardian || function_exists('sg_load')) {
        $matchesMAC = glob(dirname(__FILE__).'/axZm.class.ixed.*.php');
        if ($matchesMAC[0]) {
            require $matchesMAC[0];
        } else {
            require_once dirname(__FILE__).'/axZm.class.ixed.php';
        }
    } else {
        require_once dirname(__FILE__).'/axZm.class.ioncube.9.php';
    }
}

$axZm = new axZm();
require_once dirname(__FILE__).'/axZmH.class.php';
$axZmH = new axZmH($axZm);
$axzmh = &$axZmH;
$axZm->setAxZmH($axZmH);
require_once dirname(__FILE__).'/zoomConfig.inc.php';

if (!isset($noObjectsInclude)) {
    require_once dirname(__FILE__).'/zoomObjects.inc.php';
}
