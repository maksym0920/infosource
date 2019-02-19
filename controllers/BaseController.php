<?php

namespace app\controllers;

use yii\web\Controller;

class BaseController extends Controller
{
    /**
     * Displays error page.
     *
     * @return string
     */
    public function actionError()
    {
        return $this->render('error');
    }
}
