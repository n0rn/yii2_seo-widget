yii2 seo widget

Create table for Meta tags(Seo) 
``` php
    public function up() {
        $this->createTable('meta', [
            'id' => 'pk',
            'url' => 'string',
            'title' => 'string',
            'keywords' => 'text',
            'description' => 'text',
            'image_src' => 'string',
        ]);
    }

    public function down() {
        $this->dropTable('meta');
    }
```


use

``` php
echo SeoWidget::widget('modelClass' => MetaModel::classname());
```