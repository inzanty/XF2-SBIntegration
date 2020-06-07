<?php

namespace RT\SBIntegration\Pub\Controller;

use XF\Pub\Controller\AbstractController;

class LastBans extends AbstractController
{
    public static function getActivityDetails(array $activities)
    {
        return \XF::phrase('rt_sbintegration_viewing_lastbans');
    }

    public function actionIndex()
    {
        if (!\XF::visitor()->canViewLastBans()) {
            return $this->noPermission();
        }

        /** @var \XF\Mvc\Entity\Finder $result */
        $result = $this->repository('RT\SBIntegration:Data')->findLatestBans()->limit(25)->with(['Administrator', 'Server', 'Server.Mod'])->order('created', 'DESC');

        $page = $this->filterPage();
        $perPage = $this->options()->sbIntegrationBansPerPage;

        $total = $result->total();
        $this->assertValidPage($page, $perPage, $total, 'sblastbans');
        $result = $result->limitByPage($page, $perPage)->fetch();

        $viewParams = [
            'result' => $result,
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total
        ];

        return $this->view('RT\SBIntegration:LastBans', 'rt_sbintegration_lastbans', $viewParams);
    }

}