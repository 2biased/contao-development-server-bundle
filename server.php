<?php

declare(strict_types=1);

/*
 * This file is part of Contao Development Server Bundle.
 *
 * @author 2biased <2biased@proton.me>
 *
 * @license LGPL-3.0-or-later
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if ('/' !== $uri && file_exists($_SERVER['DOCUMENT_ROOT'].$uri)) {
    return false;
}

$_SERVER['QUERY_STRING'] ??= '';

require_once $_SERVER['DOCUMENT_ROOT'].'/index.php';
