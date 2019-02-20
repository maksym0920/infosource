<?php

namespace app\controllers;

use Yii;
use yii\db\Exception;

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

    private function recapchaValidate($recaptchaResponse)
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => '6Le1rJIUAAAAACalVBDOiU9nssTlnXbipcRhjMsy',
            'response' => $recaptchaResponse
        );
        $options = array(
            'http' => array(
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captcha_success = json_decode($verify);
        return $captcha_success->success;
    }

    public function actionGetImage()
    {
        $json = [
            'success' => false,
            'errorMsg' => '',
            'image' => '',
        ];

        $recaptcha = Yii::$app->request->post('g-recaptcha-response');

        try {
            if(!$this->recapchaValidate($recaptcha)) {
                throw new Exception('введите капчу');
            }
            $json['success'] = true;
        } catch (\Exception $e) {
            $json['errorMsg'] = $e->getMessage();
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $json;
        //var_dump(Yii::$app->request->post());
    }
}
