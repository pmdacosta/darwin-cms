<?php

class PageController extends Controller
{
    public function defaultAction()
    {
        $dbh = DB::getInstance();
        $dbc = $dbh->getConnection();

        $page = new Page($dbc);
        $page->findBy('id', $this->entityId);

        $variables['page'] = $page;

        $template = new Template('default');
        $template->view('page/views/static-page', $variables);
    }
}