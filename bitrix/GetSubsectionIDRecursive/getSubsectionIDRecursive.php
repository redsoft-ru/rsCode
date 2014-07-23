<?php
/**
 * Created by PhpStorm.
 * User: mitrich
 * Date: 23.07.14
 * Time: 13:44
 */

function getSubsectionRecursive($iblock_id, $section_id)
{
    $cs = CIblockSection::GetList(
        array(),
        array(
            "IBLOCK_ID" => $iblock_id,
            "SECTION_ID" => $section_id
        ),
        false,
        array(
            "ID"
        )
    );

    if(!$cs->AffectedRowsCount())
    {
        return $section_id;
    } else {
        $ret = array();
        while($sec = $cs->Fetch())
        {
            $ret[] = $sec['ID'];
        }
        return getSubsectionRecursive($iblock_id, $ret);
    }
}