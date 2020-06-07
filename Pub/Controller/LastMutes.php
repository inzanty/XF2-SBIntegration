<?php

namespace RT\SBIntegration\Pub\Controller;

use XF\Pub\Controller\AbstractController;

class LastMutes extends AbstractController
{
    public static function getActivityDetails(array $activities)
    {
        return \XF::phrase('rt_sbintegration_viewing_lastmutes');
    }

    public function actionIndex()
    {
        if (!\XF::visitor()->canViewLastMutes()) {
            return $this->noPermission();
        }

        /** @var \XF\Mvc\Entity\Finder $result */
        $result = $this->repository('RT\SBIntegration:Data')->findLatestMutes()->limit(25)->with(['Administrator', 'Server', 'Server.Mod'])->order('created', 'DESC');

        $page = $this->filterPage();
        $perPage = $this->options()->sbIntegrationMutesPerPage;

        $total = $result->total();
        $this->assertValidPage($page, $perPage, $total, 'sblastmutes');
        $result = $result->limitByPage($page, $perPage)->fetch();

        $viewParams = [
            'result' => $result,
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total
        ];

        return $this->view('RT\SBIntegration:LastMutes', 'rt_sbintegration_lastmutes', $viewParams);
    }
}