<?php
namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "todo".
 *
 * @property int $id
 * @property string $name
 * @property int|null $category_id
 * @property string|null $timestamp
 *
 * @property Category $category
 */
class Todo extends \yii\db\ActiveRecord
{

    /**
     *
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'todo';
    }

    /**
     *
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'name',
                    'category_id'
                ],
                'required'
            ],
            [
                [
                    'category_id'
                ],
                'integer'
            ],
            [
                [
                    'timestamp'
                ],
                'safe'
            ],
            [
                [
                    'name'
                ],
                'string',
                'max' => 128
            ],
            [
                [
                    'category_id'
                ],
                'exist',
                'skipOnError' => true,
                'targetClass' => Category::className(),
                'targetAttribute' => [
                    'category_id' => 'id'
                ]
            ]
        ];
    }

    /**
     *
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'category_id' => 'Category',
            'timestamp' => 'Timestamp'
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), [
            'id' => 'category_id'
        ]);
    }

    public function getCategoryList()
    {
        return ArrayHelper::map(Category::find()->all(), 'id', 'name');
    }

    public static function getHasOneRelations()
    {
        $relations = [];
        $relations['created_by_id'] = [
            'category',
            'Category',
            'id'
        ];
        return $relations;
    }
}
