<?php
/**
* Plugin: jQuery AJAX-ZOOM, zoomVisulConf.inc.php
* Copyright: Copyright (c) 2010-2017 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Version: 5.0.1
* Date: 2017-07-04
* Review: 2017-07-04
* URL: http://www.ajax-zoom.com
* Documentation: http://www.ajax-zoom.com/index.php?cid=docs
*/

if (!isset($axZmH)) {
    exit;
}

if (!session_id()) {
    session_start();
}

// Set some dynamic settings
if (isset($_GET['submitO'])) {
    if ($_GET['demoO']=='gd') {
        unset($_SESSION['imageZoomConf']['im']);
    } else {
        $_SESSION['imageZoomConf']['im'] = 1;
    }

    if (isset($_GET['demoQ'])) {
        $_SESSION['imageZoomConf']['qual'] = (int)$_GET['demoQ'];
    }

    if ($_GET['demoW']) {
        $_SESSION['imageZoomConf']['watermark'] = 1;
    } else {
        unset($_SESSION['imageZoomConf']['watermark']);
    }

    if ($_GET['demoT']) {
        $_SESSION['imageZoomConf']['text'] = 1;
    } else {
        unset($_SESSION['imageZoomConf']['text']);
    }

    if ($_GET['demoP'] && ($_GET['demoP'] == 1 || $_GET['demoP'] == 2 || $_GET['demoP'] == 3)) {
        $_SESSION['imageZoomConf']['pyramid'] = $_GET['demoP'];
    } else {
        unset($_SESSION['imageZoomConf']['pyramid']);
    }
    exit;
}

////////////////////////////////////////////////////////////
/////////// Get dynamic settings for the Demo //////////////
////////////////////////////////////////////////////////////

// Doctype
$zoom['config']['doctype'] = 7;

if (isset($_GET['demoDoctype']) && $_GET['demoDoctype'] <= 10 && $_GET['demoDoctype'] >= 1) {
    $_SESSION['imageZoomConf']['doctype'] = $_GET['demoDoctype'];
}

if (isset($_SESSION['imageZoomConf']['doctype'])) {
    $zoom['config']['doctype'] = $_SESSION['imageZoomConf']['doctype'];
}

if ($zoom['config']['doctype'] == 10) {
    $zoom['config']['quirks'] = true;
}

// Resolution
$zoom['config']['posRes'] = array(1 => '420x280', '420x630', '480x360', '480x320', '480x480', '480x720', '600x400', '600x600', '780x520', '800x600');
if (isset($_GET['demoRes']) && array_key_exists($_GET['demoRes'], $zoom['config']['posRes'])) {
    $zoom['config']['picDim'] = $zoom['config']['posRes'][$_GET['demoRes']];
    $_SESSION['imageZoomConf']['picDim']=$zoom['config']['picDim'];
}

if (isset($_SESSION['imageZoomConf']['picDim']) && in_array($_SESSION['imageZoomConf']['picDim'], $zoom['config']['posRes'])) {
    $zoom['config']['picDim'] = $_SESSION['imageZoomConf']['picDim'];
}

// Gallery Vertical switch off / on
if (isset($_GET['demoGal'])) {
    if ($_GET['demoGal']=='yes') {
        $_SESSION['imageZoomConf']['useGallery'] = true;
    } else {
        $_SESSION['imageZoomConf']['useGallery'] = false;
    }
}

if (isset($_SESSION['imageZoomConf']['useGallery'])) {
    if ($_SESSION['imageZoomConf']['useGallery']) {
        $zoom['config']['useGallery'] = true;
    } else {
        $zoom['config']['useGallery'] = false;
    }
}

// Numer lines vertical gallery
$zoom['config']['posColumns'] = array(1, 2, 3, 4, 5, 6, 7, 8);
if (isset($_GET['demoGalCol']) && in_array($_GET['demoGalCol'], $zoom['config']['posColumns'])) {
    $zoom['config']['galleryLines'] = $_GET['demoGalCol'];
    $_SESSION['imageZoomConf']['galleryLines'] = $_GET['demoGalCol'];
}

if (isset($_SESSION['imageZoomConf']['galleryLines']) && in_array($_SESSION['imageZoomConf']['galleryLines'], $zoom['config']['posColumns'])) {
    $zoom['config']['galleryLines'] = $_SESSION['imageZoomConf']['galleryLines'];
}

// Vertical gal position
if (isset($_GET['demoGalPos'])) {
    $zoom['config']['galleryPos'] = $_GET['demoGalPos'];
    $_SESSION['imageZoomConf']['galleryPos'] = $_GET['demoGalPos'];
}

if (isset($_SESSION['imageZoomConf']['galleryPos'])) {
    $zoom['config']['galleryPos'] = $_SESSION['imageZoomConf']['galleryPos'];
}

// Full Gallery switch off / on
if (isset($_GET['demoFullGal'])) {
    if ($_GET['demoFullGal'] == 'yes') {
        $_SESSION['imageZoomConf']['useFullGallery'] = true;
    } else {
        $_SESSION['imageZoomConf']['useFullGallery'] = false;
    }
}

if (isset($_SESSION['imageZoomConf']['useFullGallery'])) {
    if ($_SESSION['imageZoomConf']['useFullGallery']) {
        $zoom['config']['useFullGallery'] = true;
    } else {
        $zoom['config']['useFullGallery'] = false;
    }
}

// Full Gallery switch off / on
if (isset($_GET['demoFullGalAuto'])) {
    if ($_GET['demoFullGalAuto']=='yes') {
        $_SESSION['imageZoomConf']['galFullAutoStart'] = true;
    } else {
        $_SESSION['imageZoomConf']['galFullAutoStart'] = false;
    }
}

if (isset($_SESSION['imageZoomConf']['galFullAutoStart'])) {
    if ($_SESSION['imageZoomConf']['galFullAutoStart']) {
        $zoom['config']['galFullAutoStart'] = true;
    } else {
        $zoom['config']['galFullAutoStart'] = false;
    }
}

// Horizontal gallery
if (isset($_GET['demoHorGal'])) {
    if ($_GET['demoHorGal']=='yes') {
        $_SESSION['imageZoomConf']['useHorGallery'] = true;
    } else {
        $_SESSION['imageZoomConf']['useHorGallery'] = false;
    }
}

if (isset($_SESSION['imageZoomConf']['useHorGallery'])) {
    if ($_SESSION['imageZoomConf']['useHorGallery']) {
        $zoom['config']['useHorGallery'] = true;
    } else {
        $zoom['config']['useHorGallery'] = false;
    }
}

// Horizontal gallery position
if (isset($_GET['demoGalHorPos'])) {
    $zoom['config']['galHorPosition'] = $_GET['demoGalHorPos'];
    $_SESSION['imageZoomConf']['galHorPosition'] = $_GET['demoGalHorPos'];
}

if (isset($_SESSION['imageZoomConf']['galHorPosition'])) {
    $zoom['config']['galHorPosition'] = $_SESSION['imageZoomConf']['galHorPosition'];
}

// Gallery Navi
if (isset($_GET['demoGalNavi'])) {
    if ($_GET['demoGalNavi'] == 'yes') {
        $_SESSION['imageZoomConf']['galleryNavi'] = true;
    } else {
        $_SESSION['imageZoomConf']['galleryNavi'] = false;
    }
}

if (isset($_SESSION['imageZoomConf']['galleryNavi'])) {
    if ($_SESSION['imageZoomConf']['galleryNavi']) {
        $zoom['config']['galleryNavi'] = true;
    } else {
        $zoom['config']['galleryNavi'] = false;
    }
}

// Right Gallery resolution
$zoom['config']['galRes'] = array(1 => '50x50', '60x60', '70x70', '80x80', '100x100', '120x120', '150x150', '180x180');
if (isset($_GET['demoGalRes']) && array_key_exists($_GET['demoGalRes'], $zoom['config']['galRes'])) {
    $_SESSION['imageZoomConf']['galleryPicDim'] = $zoom['config']['galRes'][$_GET['demoGalRes']];
}

if (isset($_SESSION['imageZoomConf']['galleryPicDim'])) {
    $dRR = explode('x', $_SESSION['imageZoomConf']['galleryPicDim']);
    if ($dRR[0] <= 70) {
        $zoom['config']['galleryCssPadding'] = 4;
        $zoom['config']['galleryCssDescrHeight'] = 0;
        $zoom['config']['galleryCssMargin'] = 4;
    }
}

if (isset($_SESSION['imageZoomConf']['galleryPicDim']) && in_array($_SESSION['imageZoomConf']['galleryPicDim'], $zoom['config']['galRes'])) {
    $zoom['config']['galleryPicDim'] = $_SESSION['imageZoomConf']['galleryPicDim'];
}

// Full Gallery resolution
if (isset($_GET['demoFullGalRes']) && array_key_exists($_GET['demoFullGalRes'], $zoom['config']['galRes'])) {
    $_SESSION['imageZoomConf']['galleryFullPicDim'] = $zoom['config']['galRes'][$_GET['demoFullGalRes']];
}

if (isset($_SESSION['imageZoomConf']['galleryFullPicDim']) && in_array($_SESSION['imageZoomConf']['galleryFullPicDim'], $zoom['config']['galRes'])) {
    $zoom['config']['galleryFullPicDim'] = $_SESSION['imageZoomConf']['galleryFullPicDim'];
}

// Demo Map Fraction
if (isset($_GET['demoMapSize']) && ($_GET['demoMapSize'] >= 10 || $_GET['demoMapSize'] <= 100)) {
    $_SESSION['imageZoomConf']['mapFract'] = $_GET['demoMapSize'];
}

if (isset($_SESSION['imageZoomConf']['mapFract'])) {
    $zoom['config']['mapFract'] = $_SESSION['imageZoomConf']['mapFract']/100;
}

// Demo Map Switch off / on
if (isset($_GET['demoMap'])) {
    if ($_GET['demoMap'] == 'yes') {
        $_SESSION['imageZoomConf']['useMap'] = true;
    } else {
        $_SESSION['imageZoomConf']['useMap'] = false;
    }
}

if (isset($_SESSION['imageZoomConf']['useMap'])) {
    if ($_SESSION['imageZoomConf']['useMap']) {
        $zoom['config']['useMap'] = true;
    } else {
        $zoom['config']['useMap'] = false;
    }
}

// Demo Map Draggable
if (isset($_GET['demoMapDrag'])) {
    if ($_GET['demoMapDrag'] == 'yes') {
        $_SESSION['imageZoomConf']['dragMap'] = true;
    } else {
        $_SESSION['imageZoomConf']['dragMap'] = false;
    }
}

if (isset($_SESSION['imageZoomConf']['dragMap'])) {
    if ($_SESSION['imageZoomConf']['dragMap']) {
        $zoom['config']['dragMap'] = true;
    } else {
        $zoom['config']['dragMap'] = false;
    }
}

// Demo Map Autohide
if (isset($_GET['demoMapVis'])) {
    if ($_GET['demoMapVis'] == 'yes') {
        $_SESSION['imageZoomConf']['zoomMapVis'] = true;
    } else {
        $_SESSION['imageZoomConf']['zoomMapVis'] = false;
    }
}

if (isset($_SESSION['imageZoomConf']['zoomMapVis'])) {
    if ($_SESSION['imageZoomConf']['zoomMapVis']) {
        $zoom['config']['zoomMapVis'] = true;
    } else {
        $zoom['config']['zoomMapVis'] = false;
    }
}

// Demo Map Animate
if (isset($_GET['demoMapAnim'])) {
    if ($_GET['demoMapAnim'] == 'yes') {
        $_SESSION['imageZoomConf']['zoomMapAnimate'] = true;
    } else {
        $_SESSION['imageZoomConf']['zoomMapAnimate'] = false;
    }
}

if (isset($_SESSION['imageZoomConf']['zoomMapAnimate'])) {
    if ($_SESSION['imageZoomConf']['zoomMapAnimate']) {
        $zoom['config']['zoomMapAnimate'] = true;
    } else {
        $zoom['config']['zoomMapAnimate'] = false;
    }
}

if (isset($_GET['demoNavPos'])) {
    $zoom['config']['naviPos'] = $_GET['demoNavPos'];
    $_SESSION['imageZoomConf']['naviPos'] = $_GET['demoNavPos'];
}

if (isset($_SESSION['imageZoomConf']['naviPos'])) {
    $zoom['config']['naviPos'] = $_SESSION['imageZoomConf']['naviPos'];
}

// nachfolgende aus $.axZm['zoomLoadSess']
if (isset($_SESSION['imageZoomConf']['pyramid'])) {
    if ($_SESSION['imageZoomConf']['pyramid'] == 1) {
        $zoom['config']['gPyramid'] = false;
        $zoom['config']['pyrTiles'] = false;
    } elseif ($_SESSION['imageZoomConf']['pyramid'] == 2) {
        $zoom['config']['gPyramid'] = true;
        $zoom['config']['pyrTiles'] = false;
    } elseif ($_SESSION['imageZoomConf']['pyramid'] == 3) {
        $zoom['config']['gPyramid'] = false;
        $zoom['config']['pyrTiles'] = true;
    }

    if (isset($_GET['zoomDir']) && ($_GET['zoomDir'] == 7 || $_GET['zoomDir'] == 'high_res')) {
        $zoom['config']['gPyramid'] = false;
        $zoom['config']['pyrTiles'] = true;
    }
}

// General im assembler
if (isset($_SESSION['imageZoomConf']['im'])) {
    $zoom['config']['im'] = true;
}

// Watermark
if (isset($_SESSION['imageZoomConf']['watermark'])) {
    $zoom['config']['watermark'] = true; // true/false
}

// Text watermark
if (isset($_SESSION['imageZoomConf']['text'])) {
    $zoom['config']['text'] = true; // true/false
}

// Demo output quality
if (isset($_SESSION['imageZoomConf']['qual'])) {
    $zoom['config']['qual'] = $_SESSION['imageZoomConf']['qual'];
    settype($zoom['config']['qual'], 'int');
}
