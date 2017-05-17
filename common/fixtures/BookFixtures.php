<?php
/**
 * Created by PhpStorm.
 * User: grigo
 * Date: 16.05.17
 * Time: 16:48
 */

namespace common\fixtures;

use yii\test\ActiveFixture;


class BookFixtures extends ActiveFixture
{
    public $modelClass = 'frontend\models\Book';
    public $depends = ['common\fixtures\BookTypeFixture'];
  /*  public function beforeLoad() {
        parent::beforeLoad();
        $this->db->createCommand()->setSql('SET id_book_type = 2')->execute();
    }

    public function afterLoad() {
        parent::afterLoad();
        $this->db->createCommand()->setSql('SET id_book_type = 3')->execute();
    }*/

}