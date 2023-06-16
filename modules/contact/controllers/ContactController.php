<?php

class ContactController extends Controller
{
    protected function runBeforeAction()
    {
        if ($_SESSION['has_submitted_the_form'] ?? 0 == 1) {
            $dbh = DB::getInstance();
            $dbc = $dbh->getConnection();

            $page = new Page($dbc);
            $page->findBy('id', $this->entityId);

            $variables['page'] = $page;

            $template = new Template('default');
            $template->view('page/views/static-page', $variables);
            return false;
        }
        return true;
    }

    public function defaultAction()
    {
        $dbh = DB::getInstance();
        $dbc = $dbh->getConnection();

        $page = new Page($dbc);
        $page->findBy('id', $this->entityId);

        $variables['page'] = $page;

        $template = new Template('default');
        $template->view('contact/views/contact-us', $variables);
    }

    public function submitContactFormAction()
    {
        $_SESSION['has_submitted_the_form'] = 1;

        $dbh = DB::getInstance();
        $dbc = $dbh->getConnection();

        $page = new Page($dbc);
        $page->findBy('id', $this->entityId);

        $variables['page'] = $page;

        $template = new Template('default');
        $template->view('page/views/static-page', $variables);
    }
}