<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-19
 * Time: 下午12:34
 */

namespace common\components\tools;


define('STRING_TODAY', "today");
define('STRING_YESTERDAY', "yesterday");
define('STRING_DAYS', "%d days ago");
define('STRING_WEEK', "1 week ago");
define('STRING_WEEKS', "%d weeks ago");
define('DATE_FORMAT', "m-d-Y");

class DateHelper {
    /**
     * Number of days in a month
     *
     * Takes a month/year as input and returns the number of days
     * for the given month/year. Takes leap years into consideration.
     *
     * @param	int	a numeric month
     * @param	int	a numeric year
     * @return	int
     */
    public static function days_in_month($month = 0, $year = '')
    {
        if ($month < 1 OR $month > 12)
        {
            return 0;
        }
        elseif ( ! is_numeric($year) OR strlen($year) !== 4)
        {
            $year = date('Y');
        }
        if (defined('CAL_GREGORIAN'))
        {
            return cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }
        if ($year >= 1970)
        {
            return (int) date('t', mktime(12, 0, 0, $month, 1, $year));
        }
        if ($month == 2)
        {
            if ($year % 400 === 0 OR ($year % 4 === 0 && $year % 100 !== 0))
            {
                return 29;
            }
        }
        $days_in_month	= array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        return $days_in_month[$month - 1];
    }

    /**
     * Untuk mendapatkan array bulan yang bisa di gunakan untuk dropdown
     *
     * @return Array
     */
    public static function monthsArray() {
        return array(
            "01" => 'January',
            "02" => 'February',
            "03" => 'Maret',
            "04" => 'April',
            "05" => 'May',
            "06" => 'Juni',
            "07" => 'July',
            "08" => 'August',
            "09" => 'September',
            "10" => 'October',
            "11" => 'November',
            "12" => 'December',
        );
    }

    /**
     * Untuk mendapatkan array hari yang bisa di gunakan untuk dropdown
     *
     * @return Array
     */
    public static function daysArray() {
        return array(
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu'
        );
    }

    /**
     * The functions takes the date as a timestamp
     *
     * @param Date $time
     * @return String
     */
    public static function toWords($date)
    {

        $_word = "";
        $time = strtotime($date);
        /* Get the difference between the current time
           and the time given in days */
        $days = intval((time() - $time) / 86400);

        /* If some forward time is given return error */
        if($days < 0) {
            return -1;
        }

        switch($days) {
            case 0: $_word = STRING_TODAY;
                break;
            case 1: $_word = STRING_YESTERDAY;
                break;
            case ($days >= 2 && $days <= 6):
                $_word =  sprintf(STRING_DAYS, $days);
                break;
            case ($days >= 7 && $days < 14):
                $_word= STRING_WEEK;
                break;
            case ($days >= 14 && $days <= 365):
                $_word =  sprintf(STRING_WEEKS, intval($days / 7));
                break;
            default : return date(DATE_FORMAT, $time);

        }

        return $_word;
    }

    public static function relativeDate($date) {
        $secs = DateHelper::datediff('s', $date, date('Y-m-d H:i:s'));
        $second = 1;
        $minute = 60;
        $hour = 60*60;
        $day = 60*60*24;
        $week = 60*60*24*7;
        $month = 60*60*24*7*30;
        $year = 60*60*24*7*30*365;

        if ($secs <= 0) { $output = "now";
        }elseif ($secs > $second && $secs < $minute) { $output = round($secs/$second)." second";
        }elseif ($secs >= $minute && $secs < $hour) { $output = round($secs/$minute)." minute";
        }elseif ($secs >= $hour && $secs < $day) { $output = round($secs/$hour)." hour";
        }elseif ($secs >= $day && $secs < $week) { $output = round($secs/$day)." day";
        }elseif ($secs >= $week && $secs < $month) { $output = round($secs/$week)." week";
        }elseif ($secs >= $month && $secs < $year) { $output = round($secs/$month)." month";
        }elseif ($secs >= $year && $secs < $year*10) { $output = round($secs/$year)." year";
        }else{ $output = " more than a decade ago"; }

        if ($output <> "now"){
            $output = ((substr($output,0,2)<>"1 ") ? $output."s" : $output).' ago';
        }
        return $output;
    }

    public static function datediff($interval, $datefrom, $dateto, $using_timestamps = false)
    {

        /*
        $interval can be:
        yyyy - Number of full years
        q - Number of full quarters
        m - Number of full months
        y - Difference between day numbers
        (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33".
                 The datediff is "-32".)
        d - Number of full days
        w - Number of full weekdays
        ww - Number of full weeks
        h - Number of full hours
        n - Number of full minutes
        s - Number of full seconds (default)
        */

        if (!$using_timestamps) {
            $datefrom = strtotime($datefrom, 0);
            $dateto = strtotime($dateto, 0);
        }
        $difference = $dateto - $datefrom; // Difference in seconds

        switch($interval) {
            case 'yyyy': // Number of full years
                $years_difference = floor($difference / 31536000);
                if (mktime(date("H", $datefrom),
                        date("i", $datefrom),
                        date("s", $datefrom),
                        date("n", $datefrom),
                        date("j", $datefrom),
                        date("Y", $datefrom)+$years_difference) > $dateto) {

                    $years_difference--;
                }
                if (mktime(date("H", $dateto),
                        date("i", $dateto),
                        date("s", $dateto),
                        date("n", $dateto),
                        date("j", $dateto),
                        date("Y", $dateto)-($years_difference+1)) > $datefrom) {

                    $years_difference++;
                }
                $datediff = $years_difference;
                break;

            case "q": // Number of full quarters
                $quarters_difference = floor($difference / 8035200);
                while (mktime(date("H", $datefrom),
                        date("i", $datefrom),
                        date("s", $datefrom),
                        date("n", $datefrom)+($quarters_difference*3),
                        date("j", $dateto),
                        date("Y", $datefrom)) < $dateto) {

                    $months_difference++;
                }
                $quarters_difference--;
                $datediff = $quarters_difference;
                break;

            case "m": // Number of full months
                $months_difference = floor($difference / 2678400);
                while (mktime(date("H", $datefrom),
                    date("i", $datefrom),
                    date("s", $datefrom),
                    date("n", $datefrom)+($months_difference),
                    date("j", $dateto), date("Y", $datefrom)))
                { // Sunday
                    $days_remainder--;
                }
                if ($odd_days > 6) { // Saturday
                    $days_remainder--;
                }
                $datediff = ($weeks_difference * 5) + $days_remainder;
                break;

            case "ww": // Number of full weeks
                $datediff = floor($difference / 604800);
                break;

            case "h": // Number of full hours
                $datediff = floor($difference / 3600);
                break;

            case "n": // Number of full minutes
                $datediff = floor($difference / 60);
                break;

            default: // Number of full seconds (default)
                $datediff = $difference;
                break;
        }

        return $datediff;
    }
}