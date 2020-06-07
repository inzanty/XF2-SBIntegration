<?php

namespace RT\SBIntegration\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

class Mod extends Entity
{
    public static function getStructure(Structure $structure)
    {
        $structure->table = 'sb_mods';
        $structure->shortName = 'RT\SBIntegration:Mod';
        $structure->primaryKey = 'mid';
        $structure->columns = [
            'mid' => ['type' => self::UINT, 'autoIncrement' => true],
            'name' => ['type' => self::STR, 'required' => true],
            'icon' => ['type' => self::STR, 'required' => true],
            'modfolder' => ['type' => self::STR, 'required' => true]
        ];

        return $structure;
    }
}