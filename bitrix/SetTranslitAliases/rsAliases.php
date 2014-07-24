<?php
/**
 * Created in RedSoft.
 * ===================
 *
 * Класс для простановки/удаления алиасов
 *
 * @authors - Mitrich, Skvor
 *
 */

class rsAliases {

    /**
     * Установить алиасы для элементов
     *
     * @param int $iblock_id - id инфоблока
     * @param string $append_suffix - "добавка" если найден повтор
     *
     * @return null
     */
    public static function makeAlias($iblock_id, $append_suffix = '-1')
    {
        if(!intval($iblock_id)) {
            die('Не гони, ID инфоблока надо передать');
        }

        //Добудем все без альясов
        $cib = CIBlockElement::GetList(
            array(),
            array(
                "IBLOCK_ID" => intval($iblock_id),
                "CODE" => false
            ),
            false,
            false,
            array(
                "ID",
                "NAME"
            )
        );

        while ($ob = $cib->Fetch()) {
            //добываем альяс
            $alias = rsFixer::transliterate($iblock_id, $append_suffix, $ob['NAME']);

            //обновимся
            $el = new CIBlockElement();
            $ar = array(
                'CODE' => $alias
            );

            $res = $el->Update($ob['ID'],$ar);
            if (!$res) {
                echo('ELEMENT - ' . $ob['NAME'] . '<br />');
            }
        }
    }

    /**
     * Установить алиасы для разделов
     *
     * @param int $iblock_id - id инфоблока
     * @param string $append_suffix - "добавка" если найден повтор
     *
     * @return null
     */
    public static function makeSectionAlias($iblock_id,$append_suffix = '-1')
    {
        if (!intval($iblock_id)) {
            die('Не гони, ID инфоблока надо передать');
        }

        //Добудем все без альясов
        $cib = CIBlockSection::GetList(
            array(),
            array(
                "IBLOCK_ID" => intval($iblock_id),
                "CODE" => false
            ),
            false,
            array(
                "ID",
                "NAME"
            )
        );

        while ($ob = $cib->Fetch()) {
            //добываем альяс
            $alias = rsFixer::transliterate($iblock_id, $append_suffix, $ob['NAME'], true);

            //обновимся
            $el = new CIBlockSection();
            $ar = array(
                'CODE' => $alias
            );

            $res = $el->Update($ob['ID'],$ar);

            if (!$res) {
                echo('ELEMENT - ' . $ob['NAME'] . '<br />');
            }
        }
    }

    /**
     * Проверка алиасов для елементов
     *
     * @param int $iblock_id - id инфоблока
     * @param string $alias - алиас для проверки
     * @param string $append_suffix - "добавка" если найден повтор
     *
     * @return string
     */
    public static function checkAlias($iblock_id, $alias, $append_suffix = '-1')
    {
        $cib = CIBlockElement::GetList(
            array(),
            array(
                "IBLOCK_ID" => $iblock_id,
                "CODE" => $alias
            ),
            false,
            false,
            array()
        );

        if ($cib->AffectedRowsCount()) {

            echo 'duplication find - ' . $alias . "<br />";

            $new_alias = $alias.$append_suffix;
            return rsFixer::checkAlias($iblock_id, $new_alias, $append_suffix);
        }
        else {
            return $alias;
        }
    }

    /**
     * Проверка алиасов для разделов
     *
     * @param int $iblock_id - id инфоблока
     * @param string $alias - алиас для проверки
     * @param string $append_suffix - "добавка" если найден повтор
     *
     * @return string
     */
    public static function checkSectionAlias($iblock_id, $alias, $append_suffix = '-1')
    {
        $cib = CIBlockSection::GetList(
            array(),
            array(
                "IBLOCK_ID" => $iblock_id,
                "CODE" => $alias
            )
        );

        if ($cib->AffectedRowsCount()) {

            echo 'duplication find - ' . $alias . "<br />";

            $new_alias = $alias . $append_suffix;

            return rsFixer::checkSectionAlias($iblock_id, $new_alias, $append_suffix);
        }
        else {
            return $alias;
        }
    }

    /**
     * Транслитерация
     *
     * @param int $iblock_id - id инфоблока
     * @param string $append_suffix - "добавка" если найден повтор
     * @param string $string - строка для транслитерации
     * @param bool $isSection - транслитерация для раздела
     *
     * @return string
     */
    public static function transliterate($iblock_id, $append_suffix, $string, $isSection = false)
    {
        $string = trim(mb_strtolower($string));

        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',

            'г' => 'g',   'д' => 'd',   'е' => 'e',

            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',

            'и' => 'i',   'й' => 'y',   'к' => 'k',

            'л' => 'l',   'м' => 'm',   'н' => 'n',

            'о' => 'o',   'п' => 'p',   'р' => 'r',

            'с' => 's',   'т' => 't',   'у' => 'u',

            'ф' => 'f',   'х' => 'h',   'ц' => 'c',

            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',

            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',

            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',



            'А' => 'A',   'Б' => 'B',   'В' => 'V',

            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',

            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',

            'И' => 'I',   'Й' => 'Y',   'К' => 'K',

            'Л' => 'L',   'М' => 'M',   'Н' => 'N',

            'О' => 'O',   'П' => 'P',   'Р' => 'R',

            'С' => 'S',   'Т' => 'T',   'У' => 'U',

            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',

            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',

            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',

            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );

        $pre_out = strtr($string, $converter);

        //$pre_out = substr($pre_out,0,100);

        //удалим спецсимволы HTML
        $pre_out = preg_replace('#(&.*?;)#','',$pre_out);

        //вычистим все кроме символов по RFC
        $pre_out = preg_replace('#[^a-z0-9-]#', '-', $pre_out);

        //вычистим дубли минусов
        $pre_out = preg_replace('#(-)\1+#', '-', $pre_out);

        //уберем финализирующий минус
        $pre_out = preg_replace('#-$#', '', $pre_out);

        $pre_out = preg_replace('#^-#', '', $pre_out);

        if ($isSection) {
            return rsFixer::checkSectionAlias($iblock_id, $pre_out, $append_suffix);
        }
        else {
            return rsFixer::checkAlias($iblock_id, $pre_out, $append_suffix);
        }
    }

    /**
     * Очистка алиасов для елементов
     *
     * @param int $iblock_id - id инфоблока
     *
     * @return null
     */
    public static function cleanAliases($iblock_id)
    {
        if (!intval($iblock_id)) {
            die('Не гони, ID инфоблока надо передать');
        }

        $cib = CIBlockElement::GetList(
            array(),
            array(
                "IBLOCK_ID" => intval($iblock_id)
            ),
            false,
            false,
            array(
                "ID"
            )
        );

        while ($ob = $cib->Fetch()) {
            //обновимся
            $el = new CIBlockElement();
            $ar = array(
                'CODE' => ''
            );

            $res = $el->Update($ob['ID'],$ar);

            if (!$res) {
                echo('ELEMENT - ' . $ob['NAME'] . '<br />');
            }
        }
    }

    /**
     * Очистка алиасов для разделов
     *
     * @param int $iblock_id - id инфоблока
     *
     * @return null
     */
    public static function cleanSectionAliases($iblock_id)
    {
        if (!intval($iblock_id)) {
            die('Не гони, ID инфоблока надо передать');
        }

        $cib = CIBlockSection::GetList(
            array(),
            array(
                "IBLOCK_ID" => intval($iblock_id)
            ),
            false,
            false,
            array(
                "ID"
            )
        );

        while ($ob = $cib->Fetch()) {
            //обновимся
            $el = new CIBlockSection();
            $ar = array(
                'CODE' => ''
            );

            $res = $el->Update($ob['ID'],$ar);

            if (!$res) {
                echo('SECTION - ' . $ob['NAME'] . '<br />');
            }
        }
    }

}