<?php
namespace app\components;

use yii\base\Widget;
use app\models\Category;
use Yii;

class MenuWidget extends Widget
{
    public $tpl;
    public $data;
    public $tree;
    public $menuHtml;
    public $model;

    public function init(){
        parent::init();

        if($this->tpl === null){
            $this->tpl = 'menu';
        }
        $this->tpl .= '.php';
    }

    public function run(){
        //get cache
       /* if($this->tpl == 'menu.php'){
            $menu = Yii::$app->cache->get('menu');
            if ($menu) return $menu;
        }*/

        $this->data = Category::find()->asArray()->indexBy('id')->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);

        //set cache
        if($this->tpl == 'menu.php') {
            Yii::$app->cache->set('menu', $this->menuHtml, 60);
        }

        return $this->menuHtml;
    }

    protected function getTree(){
        $tree = [];
        foreach($this->data as $id=>&$node) {
            if(!$node['parent_id']){
                $tree[$id]= &$node;
            }else{
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
            }
        }
        return $tree;
    }

    public static function createLinkPath($cat, &$tree, $res = ''){
        $cats = Category::find()->asArray()->indexBy('id')->all();
        $cat = $cats[$cat];
        if($cat['parent_id'] == 0){
            $temp = "/".$cat['alias'];
            $res = $temp."/".$res;
            return substr($res,0,-1);
        }else{
            //$temp = $res;
            $temp = $cat['alias'];
            $res = $temp."/".$res;
            return MenuWidget::createLinkPath($cat['parent_id'], $tree, $res);
        }
    }

    protected function getMenuHtml($tree, $tab = ''){
        $str = '';
        foreach ($tree as $category) {
            $path = $this->createLinkPath($category['id'] , $tree);
            $str .= $this->catToTemplate($category, $tab, $path);
        }
        return $str;
    }

    protected function catToTemplate($category, $tab, $path){
        ob_start();
        include(__DIR__ . '/menu_tpl/'.$this->tpl);
        return ob_get_clean();
    }
}