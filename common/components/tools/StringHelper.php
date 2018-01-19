<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-19
 * Time: 下午12:36
 */

namespace common\components\tools;


class StringHelper extends \yii\helpers\StringHelper {

    public function pre_dump($data) {
        echo "<pre>" . print_r($data, true) . "</pre>";
    }

    /**
     * get last path name
     * example: $str = "path/to/folder/name";
     * echo StringHelper::getLastPath($str); // name
     *
     * @param String $text
     * @param String $delimenter
     * @return String
     */
    public static function getLastPath($text, $delimenter = "\\") {
        $cc = explode($delimenter, $text);
        return $cc[count($cc)-1];
    }

    /**
     * Convert HTML ID menjadi variable name javascript
     * @param string $id
     * @return string
     */
    public static function idToJsVarName($id) {
        return StringHelper::url_title(str_replace("-", "_", $id), "_");
    }

    /**
     * Konversi dari angka menjadi string
     * <pre>
     * echo StringHelper::currToWord(12356.78);
     * // twelve thousand three hundred fifty-six koma seventy-eight
     *
     * echo StringHelper::currToWord(12356.78, 'id');
     * // dua belas ribu tiga ratus lima puluh enam koma tujuh puluh delapan
     *
     * echo StringHelper::currToWord(12356.78, 'en_US', 'point');
     * // twelve thousand three hundred fifty-six point seventy-eight
     * </pre>
     *
     * @param float $num angka yang ingin di konversi
     * @param String $locale bahasa yang ingin digunakan
     * @param String $koma kata 'koma' atau 'coma' apabila terdapat angka di belakang koma
     * @return String
     */
    public static function currToWord($num, $locale = 'en_US', $koma = "koma") {
        require_once('Numbers/Words.php');

        $fnum = explode('.', $num);
        $fract = count($fnum);
        $ret = Numbers_Words::toWords($fnum[0], $locale);

        if($fract == 1) return $ret;

        $ret .=  " $koma "; // point in english
        $ret .= Numbers_Words::toWords($fnum[1], $locale);

        return $ret;
    }

    /**
     * Membuat URL title. Fungsi ini akan mengganti spasi atau simbol yang ada didalam sebuah string dengan
     * tanda - atau _.
     * <pre>
     * echo StringHelper::url_title("Ini adalah URL", "dash", true);
     * // ini-adalah-url
     * </pre>
     *
     * @param String $str String yang ingin di ubah
     * @param String $separator Separator penganti spasi atau simbol
     * @param Boolean $lowercase apakah hasilnya di ubah menjadi lowercase
     * @return String
     */
    public static function url_title($str, $lowercase = true, $separator = 'dash')
    {
        if ($separator == 'dash')
        {
            $search	= '_';
            $replace	= '-';
        }
        else
        {
            $search	= '-';
            $replace	= '_';
        }

        $trans = array(
            '&\#\d+?;'          => '',
            '&\S+?;'            => '',
            '\s+'               => $replace,
            '[^a-z0-9\-\._]'    => '',
            $replace.'+'        => $replace,
            $replace.'$'        => $replace,
            '^'.$replace        => $replace,
            '\.+$'              => ''
        );

        $str = strip_tags($str);

        foreach ($trans as $key => $val)
        {
            $str = preg_replace("#".$key."#i", $val, $str);
        }

        if ($lowercase === TRUE)
        {
            $str = strtolower($str);
        }

        return trim(stripslashes($str));
    }

    /**
     * Konversi byte menjadi KB atau MB
     * <pre>
     * echo StringHelper::format_bytes(1024*1024); // 1 MiB
     * echo StringHelper::format_bytes(1024*13); // 13 KiB
     * </pre>
     *
     * @param long $a_bytes angka yang ingin di ubah
     * @return String
     */
    public static function format_bytes($a_bytes)
    {
        if ($a_bytes < 1024) {
            return $a_bytes .' B';
        } elseif ($a_bytes < 1048576) {
            return round($a_bytes / 1024, 2) .' KiB';
        } elseif ($a_bytes < 1073741824) {
            return round($a_bytes / 1048576, 2) . ' MiB';
        } elseif ($a_bytes < 1099511627776) {
            return round($a_bytes / 1073741824, 2) . ' GiB';
        } elseif ($a_bytes < 1125899906842624) {
            return round($a_bytes / 1099511627776, 2) .' TiB';
        } elseif ($a_bytes < 1152921504606846976) {
            return round($a_bytes / 1125899906842624, 2) .' PiB';
        } elseif ($a_bytes < 1180591620717411303424) {
            return round($a_bytes / 1152921504606846976, 2) .' EiB';
        } elseif ($a_bytes < 1208925819614629174706176) {
            return round($a_bytes / 1180591620717411303424, 2) .' ZiB';
        } else {
            return round($a_bytes / 1208925819614629174706176, 2) .' YiB';
        }
    }

    /**
     * Memotong sebuah kalimat sesuai dengan panjang yang telah di tentukan. Biasa-nya digunakan untuk
     * menampilkan keterangan singkat dari sebuah content
     * <pre>
     * echo StringHelper::wordTruncate("Lorem ipsum dolor sit amet, consectetur adipiscing elit.", 13);
     * // Lorem ipsum...
     * </pre>
     * perbedaan dengan yii\helpers\StringHelper::truncateWords() adalah yii\helpers\StringHelper::truncateWords()
     * memotong kalimat berdasarkan kata, sedangkan fungsi wordTruncate memotong berdasarkan huruf
     *
     * @param String $string kalimat yang ingin di potong
     * @param Integer $max panjang huruf yang ingin ditampilkan
     * @return String
     */
    public static function wordTruncate($string, $max) {
        return current(explode("\n", wordwrap($string, $max, "...\n")));
    }

    /**
     * Create a Random String
     *
     * Useful for generating passwords or hashes.
     *
     * @param	string	type of random string.  basic, alpha, alnum, numeric, nozero, unique, md5, encrypt and sha1
     * @param	int	number of characters
     * @return	string
     */
    public static function random_string($type = 'alnum', $len = 8)
    {
        switch ($type)
        {
            case 'basic': return mt_rand();
            case 'alnum':
            case 'numeric':
            case 'nozero':
            case 'alpha':
                switch ($type)
                {
                    case 'alpha':
                        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'alnum':
                        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'numeric':
                        $pool = '0123456789';
                        break;
                    case 'nozero':
                        $pool = '123456789';
                        break;
                }
                return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
            case 'unique': // todo: remove in 3.1+
            case 'md5': return md5(uniqid(mt_rand()));
            case 'encrypt': // todo: remove in 3.1+
            case 'sha1': return sha1(uniqid(mt_rand(), TRUE));
        }
    }

    /**
     * Strip Slashes
     *
     * Removes slashes contained in a string or in an array
     *
     * @param	mixed	string or array
     * @return	mixed	string or array
     */
    public static function strip_slashes($str)
    {
        if ( ! is_array($str))
        {
            return stripslashes($str);
        }
        foreach ($str as $key => $val)
        {
            $str[$key] = strip_slashes($val);
        }
        return $str;
    }

    /**
     * Strip Quotes
     *
     * Removes single and double quotes from a string
     *
     * @param	string
     * @return	string
     */
    public static function strip_quotes($str)
    {
        return str_replace(array('"', "'"), '', $str);
    }

    /**
     * Quotes to Entities
     *
     * Converts single and double quotes to entities
     *
     * @param	string
     * @return	string
     */
    public static function quotes_to_entities($str)
    {
        return str_replace(array("\'","\"","'",'"'), array("&#39;","&quot;","&#39;","&quot;"), $str);
    }

    /**
     * Reduce Double Slashes
     *
     * Converts double slashes in a string to a single slash,
     * except those found in http://
     *
     * http://www.some-site.com//index.php
     *
     * becomes:
     *
     * http://www.some-site.com/index.php
     *
     * @param	string
     * @return	string
     */
    public static function reduce_double_slashes($str)
    {
        return preg_replace('#(^|[^:])//+#', '\\1/', $str);
    }

    /**
     * Reduce Multiples
     *
     * Reduces multiple instances of a particular character.  Example:
     *
     * Fred, Bill,, Joe, Jimmy
     *
     * becomes:
     *
     * Fred, Bill, Joe, Jimmy
     *
     * @param	string
     * @param	string	the character you wish to reduce
     * @param	bool	TRUE/FALSE - whether to trim the character from the beginning/end
     * @return	string
     */
    public static function reduce_multiples($str, $character = ',', $trim = FALSE)
    {
        $str = preg_replace('#'.preg_quote($character, '#').'{2,}#', $character, $str);
        return ($trim === TRUE) ? trim($str, $character) : $str;
    }

    /**
     * Add's _1 to a string or increment the ending number to allow _2, _3, etc
     *
     * @param	string	required
     * @param	string	What should the duplicate number be appended with
     * @param	string	Which number should be used for the first dupe increment
     * @return	string
     */
    public static function increment_string($str, $separator = '_', $first = 1)
    {
        preg_match('/(.+)'.$separator.'([0-9]+)$/', $str, $match);
        return isset($match[2]) ? $match[1].$separator.($match[2] + 1) : $str.$separator.$first;
    }

    /**
     * Reverse of nl2br.
     *
     * @param   string  $source    String to filter
     *
     * @return  string  Returns a string with <br>'s converted to newlines
     */
    public static function br2nl($source)
    {
        return preg_replace("=<br */?>=i", "\n", preg_replace("/(\r\n|\n|\r)/", "", $source));
    }

    /**
     * This function cleans HTML from a String. Example:
     * $text = "<p><strong>Lorem</strong> ipsum</p>";
     * print cleanHTML($text);
     * //Prints: Lorem ipsum
     *
     * @param String $HTML
     * @return String
     */
    public static function cleanHTML($HTML)
    {
        $search = array(
            '@<script[^>]*?>.*?</script>@si', '@<[\/\!]*?[^<>]*?>@si', '@([\r\n])[\s]+@', '@&(quot|#34);@i', '@&(amp|#38);@i',
            '@&(lt|#60);@i', '@&(gt|#62);@i', '@&(nbsp|#160);@i', '@&(iexcl|#161);@i', '@&(cent|#162);@i', '@&(pound|#163);@i',
            '@&(copy|#169);@i', '@&#(\d+);@e'
        );

        $replace = array('', '', '\1', '"', '&', '<', '>', ' ', chr(161), chr(162), chr(163), chr(169), 'chr(\1)');

        return preg_replace($search, $replace, $HTML);
    }

    /**
     * This function cleans a string. Example:
     * $text = "<scrip> alert('Message'); </scrip>";
     * print filter($text, TRUE);
     *
     * //Prints: alert(Message);
     *
     * @param String $text
     * @param boolean $filter
     * @return String
     */
    public static function filter($text, $filter = false)
    {
        if (is_null($text)) {
            return false;
        }

        if ($text === true) {
            return true;
        } elseif ($filter === true) {
            $text = cleanHTML($text);
        } elseif ($filter === "remove") {
            $text = str_replace("\'", "", $text);
            $text = str_replace('\"', "", $text);
            $text = str_replace("'", "", $text);
            $text = str_replace('"', "", $text);
        }

        $text = str_replace("<", "", $text);
        $text = str_replace(">", "", $text);
        $text = str_replace("%27", "", $text);
        $text = str_replace("%22", "", $text);
        $text = str_replace("%20", "", $text);
        $text = str_replace("indexphp", "index.php", $text);
        return $text;
    }

    /**
     * This function removes blank spaces from a string. Example:
     * $text = "Lorem     ipsum";
     * //Gets: "Lorem     ipsum";
     *
     * removeSpaces($text, FALSE);
     * //Gets: "Lorem ipsum";
     *
     * @param String $text
     * @param boolean $trim
     * @return String
     */
    public static function removeSpaces($text, $trim = false)
    {
        $text = preg_replace("/\s+/", " ", $text);
        return ($trim) ? trim($text) : $text;
    }

    /**
     * Highlights a given phrase in a text. You can specify any expression in highlighter that
     * may include the \1 expression to include the $phrase found.
     *
     * ### Options:
     *
     * - `format` The piece of html with that the phrase will be highlighted
     * - `html` If true, will ignore any HTML tags, ensuring that only the correct text is highlighted
     * - `regex` a custom regex rule that is used to match words, default is '|$tag|iu'
     *
     * @param string $text Text to search the phrase in.
     * @param string|array $phrase The phrase or phrases that will be searched.
     * @param array $options An array of html attributes and options.
     * @return string The highlighted text
     * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/text.html#TextHelper::highlight
     */
    public static function highlight($text, $phrase, $options = array()) {
        if (empty($phrase)) {
            return $text;
        }
        $defaults = array(
            'format' => '<span class="highlight">\1</span>',
            'html' => false,
            'regex' => "|%s|iu"
        );
        $options += $defaults;
        extract($options);
        if (is_array($phrase)) {
            $replace = array();
            $with = array();
            foreach ($phrase as $key => $segment) {
                $segment = '(' . preg_quote($segment, '|') . ')';
                if ($html) {
                    $segment = "(?![^<]+>)$segment(?![^<]+>)";
                }
                $with[] = (is_array($format)) ? $format[$key] : $format;
                $replace[] = sprintf($options['regex'], $segment);
            }
            return preg_replace($replace, $with, $text);
        }
        $phrase = '(' . preg_quote($phrase, '|') . ')';
        if ($html) {
            $phrase = "(?![^<]+>)$phrase(?![^<]+>)";
        }
        return preg_replace(sprintf($options['regex'], $phrase), $format, $text);
    }

    /**
     * Creates a comma separated list where the last two items are joined with 'and', forming natural English
     *
     * @param array $list The list to be joined
     * @param string $and The word used to join the last and second last items together with. Defaults to 'and'
     * @param string $separator The separator used to join all the other items together. Defaults to ', '
     * @return string The glued together string.
     * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/text.html#TextHelper::toList
     */
    public static function toList($list, $and = 'and', $separator = ', ') {
        if (count($list) > 1) {
            return implode($separator, array_slice($list, null, -1)) . ' ' . $and . ' ' . array_pop($list);
        }
        return array_pop($list);
    }

    /**
     * Determine if a given string is json encoded
     *
     * @param string $string
     * @return bool
     */
    public static function is_json($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * Determine if a given string is a valid XML
     *
     * @param string $string
     * @return bool
     */
    public static function is_xml($string)
    {
        if ( ! defined('LIBXML_COMPACT'))
        {
            throw new \BadFunctionCallException('libxml is required to use is_xml()');
        }

        $entityLoader = libxml_disable_entity_loader(true);
        $internalErrors = libxml_use_internal_errors();
        libxml_use_internal_errors(true);

        $result = simplexml_load_string($string) !== false;

        libxml_use_internal_errors($internalErrors);
        libxml_disable_entity_loader($entityLoader);

        return $result;
    }

    /**
     * Determine if a given string is json encoded
     *
     * @param string $string
     * @return bool
     */
    function is_html($string)
    {
        return strlen(strip_tags($string)) < strlen($string);
    }
}