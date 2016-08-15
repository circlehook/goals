<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pull;

/**
 * PullSearch represents the model behind the search form about `app\models\Pull`.
 */
class PullSearch extends Pull
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_catalog', 'id_language'], 'integer'],
            [['name', 'author', 'description', 'sex', 'language', 'country', 'type', 'repeat', 'discus', 'image1', 'image2', 'image3'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Pull::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_catalog' => $this->id_catalog,
            'id_language' => $this->id_language,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'repeat', $this->repeat])
            ->andFilterWhere(['like', 'discus', $this->discus])
            ->andFilterWhere(['like', 'image1', $this->image1])
            ->andFilterWhere(['like', 'image2', $this->image2])
            ->andFilterWhere(['like', 'image3', $this->image3]);

        return $dataProvider;
    }
}
