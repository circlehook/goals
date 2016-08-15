<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Goals;

/**
 * GoalsSearch represents the model behind the search form about `app\models\Goals`.
 */
class GoalsSearch extends Goals
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_pull', 'id_user', 'priority', 'progress'], 'integer'],
            [['title', 'type', 'repeat', 'begin', 'image'], 'safe'],
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
        $id_user = Yii::$app->user->id;
        $query = Goals::find();

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
            'id_pull' => $this->id_pull,
            'id_user' => $id_user,
            //'priority' => $this->priorityLabel($this->priority),
            'priority' => $this->priority,
            //'progress' => $this->progress,

        ]);

        $query->andFilterWhere(['between', 'progress',  0, 99]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'repeat', $this->repeat])
            ->andFilterWhere(['like', 'begin', $this->begin])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }


    public function searchComplete($params)
    {
        $id_user = Yii::$app->user->id;
        $query = Goals::find()->where(['id_user'=>$id_user]);

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
            'id_pull' => $this->id_pull,
            'id_user' => $id_user,
            'priority' =>$this->priority,
            'progress' => 100,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'repeat', $this->repeat])
            ->andFilterWhere(['like', 'begin', $this->begin])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }

    public function priorityLabel($value)
    {
        switch ($value) {
            case '1':
                $label = 'низкий';
                break;
            case '2':
                $label = 'средний';
                break;
            case '3':
                $label = 'высокий';
                break;
            
            default:
                $label = 'низкий';
                break;
        }
        return $label;
    }

    
}
