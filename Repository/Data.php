<?php

namespace RT\SBIntegration\Repository;

use XF\Mvc\Entity\Repository;

class Data extends Repository
{
    public function getDb()
    {
        $config = $this->app()->get('config');
        return new \XF\Db\Mysqli\Adapter($config['sbintegration'], $config['fullUnicode']);
    }

    public function getEm($db = null)
    {
        if ($db == null)
        {
            $db = $this->getDb();
        }

        $app = $this->app();
        return new \XF\Mvc\Entity\Manager($db, $app->get('em.valueFormatter'), $app->get('extension'));
    }

    public function findLatestBans()
    {
        $bans = $this->getEm()->getFinder('RT\SBIntegration:Ban');

        return $bans;
    }

    public function findLatestMutes()
    {
        $mutes = $this->getEm()->getFinder('RT\SBIntegration:Mute');

        return $mutes;
    }

    public function findServers()
    {
        $servers = $this->getEm()->getFinder('RT\SBIntegration:Server');

        return $servers;
    }
}
