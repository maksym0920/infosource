<?php

namespace app\controllers;

use Yii;

class SiteController extends BaseController
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $data = [];
        $currentNumber = 1;
        $data['menu'] = $this->generateElement(5, $currentNumber);
        return $this->render('index', $data);
    }

    private function generateElement($depth, &$currentNumber)
    {
        $answer = [];
        for ($i = 1; $i <= rand(1, 5); $i++) {
            $answer[] = [
                'name' => 'element ' . $currentNumber,
                'number' => $currentNumber++,
            ];
        }
        if ($depth > 0) {
            foreach ($answer as &$item) {
                $item['child'] = $this->generateElement($depth - 1, $currentNumber);
            }
        }

        return $answer;
    }


}
