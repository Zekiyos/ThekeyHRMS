<?php

class calender {

    const JD_EPOCH_OFFSET_AMETE_ALEM = -285019;
    const JD_EPOCH_OFFSET_AMETE_MIHRET = 1723856;
    const JD_EPOCH_OFFSET_COPTIC = 1824665;
    const JD_EPOCH_OFFSET_GREGORIAN = 1721426;
    const JD_EPOCH_OFFSET_UNSET = -1;

    static $monthDays = array(0,
        31, 28, 31, 30, 31, 30,
        31, 31, 30, 31, 30, 31);
    static $nMonths = 12;

    public function ethiopicToGregorian($ethioDate) {

        $date = preg_split('/[\/-]/', $ethioDate);
        $year = $date[0];
        $month = $date[1];
        $day = $date[2];
        $jdn = $this->ethCopticToJDN($year, $month, $day);
        $result = $this->jdnToGregorian($jdn);
        return $result[0] . "-" . $result[1] . "-" . $result[2];
    }

    public function GeregorianToEthiopic($geregorianDate) {

        $date = preg_split('/[\/-]/', $geregorianDate);

        $year = $date[0];
        $month = $date[1];
        $day = $date[2];
        $jdn = $this->gregorianToJDN($year, $month, $day);
        $result = $this->jdnToEthiopic($jdn);
        return $result[0] . "-" . $result[1] . "-" . $result[2];
    }

    private function ethCopticToJDN($year, $month, $day) {
        $jdn =
                (self::JD_EPOCH_OFFSET_AMETE_MIHRET + 365) + 365 * ($year - 1) + $this->quotient($year, 4) + 30 * $month + $day - 31;
        return $jdn;
    }

    private function gregorianToJDN($year, $month, $day) {
        $s = $this->quotient($year, 4)
                - $this->quotient($year - 1, 4)
                - $this->quotient($year, 100)
                + $this->quotient($year - 1, 100)
                + $this->quotient($year, 400)
                - $this->quotient($year - 1, 400);

        $t = $this->quotient(14 - $month, 12);

        $n = 31 * $t * ($month - 1)
                + (1 - $t) * (59 + $s + 30 * ($month - 3) + $this->quotient((3 * $month - 7), 5))
                + $day - 1;

        $j = 1721426
                + 365 * ($year - 1)
                + $this->quotient($year - 1, 4)
                - $this->quotient($year - 1, 100)
                + $this->quotient($year - 1, 400)
                + $n
        ;

        return $j;
    }

    private function guessEraFromJDN($jdn) {
        return
                ($jdn >= (self::JD_EPOCH_OFFSET_AMETE_MIHRET + 365)) ?
                self::JD_EPOCH_OFFSET_AMETE_MIHRET :
                self::JD_EPOCH_OFFSET_AMETE_ALEM;
    }

    private function isGregorianLeap($year) {
        return ($year % 4 == 0) && (($year % 100 != 0) || ($year % 400 == 0));
    }

    private function jdnToEthiopic($jdn) {
        $era = $this->guessEraFromJDN($jdn);
        $r = (($jdn - $era) % 1461);
        $n = ($r % 365) + 365 * $this->quotient($r, 1460);

        $year = 4 * $this->quotient(($jdn - $era), 1461)
                + $this->quotient($r, 365)
                - $this->quotient($r, 1460)
        ;
        $month = $this->quotient($n, 30) + 1;
        $day = (int) ($n % 30) + 1;

        return array($year, $month, $day);
    }

    private function jdnToGregorian($j) {
        $r2000 = (($j - self::JD_EPOCH_OFFSET_GREGORIAN) % 730485);
        $r400 = (($j - self::JD_EPOCH_OFFSET_GREGORIAN) % 146097);
        $r100 = ($r400 % 36524);
        $r4 = ($r100 % 1461);

        $n = ($r4 % 365) + 365 * $this->quotient($r4, 1460);
        $s = $this->quotient($r4, 1095);

        $aprime = 400 * $this->quotient(($j - self::JD_EPOCH_OFFSET_GREGORIAN), 146097)
                + 100 * $this->quotient($r400, 36524)
                + 4 * $this->quotient($r100, 1461)
                + $this->quotient($r4, 365)
                - $this->quotient($r4, 1460)
                - $this->quotient($r2000, 730484)
        ;
        $year = $aprime + 1;
        $t = $this->quotient((364 + $s - $n), 306);
        $month = $t * ($this->quotient($n, 31) + 1) + (1 - $t) * ($this->quotient((5 * ($n - $s) + 13), 153) + 1);

        $n += 1 - $this->quotient($r2000, 730484);
        $day = $n;

        if (($r100 == 0) && ($n == 0) && ($r400 != 0)) {
            $month = 12;
            $day = 31;
        } else {
            $monthDays[2] = ($this->isGregorianLeap($year)) ? 29 : 28;
            for ($i = 1; $i <= self::$nMonths; ++$i) {
                if ($n <= self::$monthDays[$i]) {
                    $day = $n;
                    break;
                }
                $n -= self::$monthDays[$i];
                $day = $n;
            }
        }

        $output = array($year, $month, $day);

        return $output;
    }

    private function quotient($i, $j) {
        return Floor($i / $j);
    }

}

$my_cal = new calender();

echo "Today '2012-09-30 in Ethiopian Calandur is " . ($my_cal->GeregorianToEthiopic('2012-09-30'));
echo '<hr>';
echo "Today '2005-01-20 in Gregorian Calandur is " . ($my_cal->ethiopicToGregorian('2005-01-20'));

?>
