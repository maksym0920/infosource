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

    private function recaptchaValidate($recaptchaResponse)
    {
        $answer = false;
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
        try {
            $context = stream_context_create($options);
            $verify = file_get_contents($url, false, $context);
            $captcha_success = json_decode($verify);
            $answer = $captcha_success->success;
        } catch (\Exception $e) {
        }

        return $answer;
    }

    private function getRandomGift()
    {
        $answer = [
            'url' => '',
            'width' => '0',
            'height' => '0',
        ];
        $url = 'http://api.giphy.com/v1/gifs/random';
        $data = array(
            'api_key' => 'PMSvP7vneMd16Prs1PA1h2QU5a91uyxG',
            'limit' => '1'
        );
        $options = array(
            'http' => array(
                'method' => 'GET',
                'content' => http_build_query($data)
            )
        );
        try {
            $context = stream_context_create($options);
            $image = file_get_contents($url, false, $context);
            $image = json_decode($image, true);
            if (!empty($image['data'])) {
                $answer['url'] = $image['data']['image_url'];
                $answer['height'] = $image['data']['image_height'];
                $answer['width'] = $image['data']['image_width'];
            }
        } catch (\Exception $e) {
        }
        return $answer;
    }

    public function actionGetImage()
    {
        $json = [
            'success' => false,
            'errorMsg' => '',
            'image' => '',
        ];

        $recaptcha = Yii::$app->request->post('g-recaptcha-response');

        if ($this->recaptchaValidate($recaptcha)) {
            $json['success'] = true;
            $json['image'] = $this->getRandomGift();
        } else {
            $json['errorMsg'] = 'Введите капчу';
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $json;
    }
}
