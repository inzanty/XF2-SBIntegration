<?php

namespace RT\SBIntegration\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

class Server extends Entity
{
    public static function getStructure(Structure $structure)
    {
        $structure->table = 'sb_servers';
        $structure->shortName = 'RT\SBIntegration:Server';
        $structure->primaryKey = 'sid';
        $structure->columns = [
            'sid' => ['type' => self::UINT, 'autoIncrement' => true],
            'ip' => ['type' => self::UINT, 'required' => true],
            'port' => ['type' => self::UINT, 'required' => true],
            'modid' => ['type' => self::UINT, 'required' => true]
        ];
        $structure->relations = [
            'Mod'   => [
                'entity'        => 'RT\SBIntegration:Mod',
                'type'          => self::TO_ONE,
                'conditions'    => [['mid', '=', '$modid']]
            ]
        ];

        return $structure;
    }
}