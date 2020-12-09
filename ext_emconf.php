<?php

/*
 * This file is part of the web-tp3/tp3openhours.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

$EM_CONF[$_EXTKEY] = [
  'title' => 'tt_address OpenHours',
  'description' => 'Öffnungszeiten für tt_address &amp; businessview',
  'category' => 'misc',
  'author' => 'Thomas Ruta',
  'author_email' => 'email@thomasruta.de',
  'state' => 'beta',
  'uploadfolder' => false,
  'createDirs' => '',
  'clearCacheOnLoad' => 0,
  'version' => '1.0.0',
  'constraints' =>
  [
'depends' =>
    [
        'typo3' => '8.7.0-10.9.99',
        'tt_address' => '*',
    ],
    'conflicts' =>
    [
    ],
    'suggests' =>
    [
    ],
  ],
  'clearcacheonload' => false,
  'author_company' => 'tp3',
];
