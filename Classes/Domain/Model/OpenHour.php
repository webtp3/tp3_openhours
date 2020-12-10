<?php

/*
 * This file is part of the web-tp3/tp3openhours.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Tp3\Tp3Openhours\Domain\Model;

use phpDocumentor\Reflection\Types\Integer;

/***
 *
 * This file is part of the "tt_address OpenHours" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Thomas Ruta &lt;email@thomasruta.de>, tp3
 *
 ***/
use DateTime;
use DateTimeZone;
/**
 * OpenHour
 */
class OpenHour extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject
{
    /**
     * UTC Offset
     *
     * @var Integer
     */
    public $offset = 0;

    /**
     * DateTime Object
     *
     * @var DateTime
     */
    public $dateTime = null;

    /**
     * DayArray
     *
     * @var array
     */
    public $DayArray =  ['', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa', 'So', 'Mo-Fr', 'Sa-So', '24x7'];
    /*
        ['Mo'=> 1],
        ['Di'=> 2],
        ['Mi'=> 3],
        ['Do'=> 4],
        ['Fr'=> 5],
        ['Sa'=> 6],
        ['So'=> 7],
        ['Mo-Fr'=> 8],
        ['Sa-So'=> 9],*/

    /**
     * Day of OpenHours
     *
     * @var int
     *
     */
    protected $day = 0;

    /**
     * openTime
     *
     * @var int
     *
     */
    protected $openTime = 0;

    /**
     * closeTime
     *
     * @var int
     */
    protected $closeTime = 0;



    public function getOffset(){
        $this_tz_str = date_default_timezone_get();
        $this_tz = new DateTimeZone($this_tz_str);
        $now = new DateTime("now", $this_tz);
        $this->offset = $this_tz->getOffset($now);

    }



    /**
     * Returns the day
     *
     * @return int $day
     */
    public function getDayNames()
    {
        $timestamp = strtotime('next Sunday');
        $days = [];
        for ($i = 0; $i < 7; $i++) {
            $days[] = strftime('%A', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }
        $this->DayArray = array_merge($this->DayArray, $days);
    }

    /**
     * Returns the day
     *
     * @return int $day
     */
    public function getDay()
    {
        return $this->day;
    }
    /**
     * Returns the dayname
     *
     * @return string
     */
    public function getDayName()
    {
        return $this->DayArray[$this->day];
    }

    /**
     * Sets the day
     *
     * @param int $day
     * @return void
     */
    public function setDay($day)
    {
        $this->day = $day;
    }

    /**
     * Returns the openTime
     *
     * @return int $openTime
     */
    public function getOpenTime()
    {
        $this->getOffset();
        return ($this->openTime - $this->offset);
    }

    /**
     * Sets the openTime
     *
     * @param int $openTime
     * @return void
     */
    public function setOpenTime(int $openTime)
    {
        $this->openTime = $openTime;
    }

    /**
     * Returns the closeTime
     *
     * @return int $closeTime
     */
    public function getCloseTime()
    {
        $this->getOffset();
        return ($this->closeTime - $this->offset);
    }

    /**
     * Sets the closeTime
     *
     * @param int $closeTime
     * @return void
     */
    public function setCloseTime(int $closeTime)
    {
        $this->closeTime = $closeTime;
    }
}
