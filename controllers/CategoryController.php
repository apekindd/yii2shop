<?php


namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;

class CategoryController extends AppController
{
    public function actionIndex(){
        $hits = Product::find()->where(['hit'=>'1'])->limit(6)->all();
        $this->setMeta('E-SHOPPER');
        return $this->render('index', compact('hits'));
    }
    
    /*public function actionView($id){
//        $id = Yii::$app->request->get('id');

        $category = Category::findOne($id);
        if(empty($category)){
            throw new \yii\web\HttpException(404, 'Такой категории не существует');
        }

//        $products = Product::find()->where(['category_id'=>$id])->all();
        $query = Product::find()->where(['category_id'=>$id]);
        $pages = new Pagination(['totalCount'=>$query->count(), 'pageSize'=>3,'forcePageParam' => false, 'pageSizeParam'=>false]);

        $products = $query->offset($pages->offset)->limit($pages->limit)->all();



        //meta
        $this->setMeta('E-SHOPPER | '.$category->name, $category->keywords, $category->description);

        return $this->render('view',compact('products', 'pages','category'));
    }*/

    /*public function findByPath($path){
        explode();
    }*/

    public function actionProduct($id)
    {
        print("product#{$id} detail");
    }

    public function findByPath($path){
        $ex = explode('/',$path);
        return end($ex);
    }

    public function actionView($alias){
//        $id = Yii::$app->request->get('id');
        $cat_name = $this->findByPath($alias);
        var_dump($cat_name);
        $category = Category::findOne(['alias'=>$cat_name]);
        if(empty($category)){
            throw new \yii\web\HttpException(404, 'Такой категории не существует');
        }
        $id = $category->id;

//        $products = Product::find()->where(['category_id'=>$id])->all();
        $query = Product::find()->where(['category_id'=>$id]);
        $pages = new Pagination(['totalCount'=>$query->count(), 'pageSize'=>3,'forcePageParam' => false, 'pageSizeParam'=>false]);

        $products = $query->offset($pages->offset)->limit($pages->limit)->all();



        //meta
        $this->setMeta('E-SHOPPER | '.$category->name, $category->keywords, $category->description);

        return $this->render('view',compact('products', 'pages','category'));
    }

    public function actionSearch(){
        $q = trim(Yii::$app->request->get('q'));
        $this->setMeta('E-SHOPPER | '.$q);
        if(!$q){
            return $this->render('search');
        }
        $query = Product::find()->where(['like','name',$q]);
        $pages = new Pagination(['totalCount'=>$query->count(), 'pageSize'=>3,'forcePageParam' => false, 'pageSizeParam'=>false]);

        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('search', compact('products','pages','q'));
    }
}