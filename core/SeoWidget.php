<?php
namespace widgets\seo;

use yii\base\Widget;
use yii\helpers\Url;
use yii\helpers\Html;
use Yii;

class SeoWidget extends Widget
{

    public $modelClass;

    public function run() {
        parent::run();

        $seo = $this->getSeo();
        $view = \Yii::$app->getView();
        if (is_null($seo)) {
            echo Html::tag('title', $view->title) . PHP_EOL;
        } else {
            echo Html::tag('title', $seo->title) . PHP_EOL;
            $this->registerMetaTag('keywords', $seo->keywords);
            $this->registerMetaTag('description', $seo->description);
            $this->registerLinkTag('image_src', $seo->image_src);
        }
    }

    public function registerMetaTag($name, $content) {
        if(!empty($content)) {
            $view = \Yii::$app->getView();
            $view->registerMetaTag([
                'name' => $name,
                'content' => $content,
            ]);
        }
    }

    public function registerLinkTag($rel, $href) {
        if(!empty($href)) {
            $view = \Yii::$app->getView();
            $view->registerLinkTag([
                'rel'=>$rel,
                'href'=>$href,
            ]);
        }
    }

    public function getSeo() {
        $request = Yii::$app->request;
        $host = $request->hostInfo;
        $currentUrl = strtr(Url::canonical(), [$host => '']);
        $class = $this->modelClass;
        return $class::findOne(['url' => $currentUrl]);
    }


}