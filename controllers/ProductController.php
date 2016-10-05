<?php


namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;

class ProductController extends AppController
{
    public function actionView($id){
        $id = Yii::$app->request->get('id');

        //Ленивая
        $product = Product::findOne($id);
        //Жадная
        //$product = Product::find()->with('category')->where(['id'=>$id])->limit(1)->one();

        return $this->render('view', compact('product'));
    }
}