<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Supplier;

/**
 * SupplierSearch represents the model behind the search form of `app\models\Supplier`.
 */
class SupplierSearch extends Supplier
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'string'],
            [['name', 'code', 't_status'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function search($params, $pagination=['pageSize' => 20,])
    {
        $query = Supplier::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pagination,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query = $this->compareId($query, $this->id);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 't_status', $this->t_status]);

        return $dataProvider;
    }

    /**
     * filter id with comparison operators
     *
     * @param $id
     */
    private function compareId($query, $id=null) {

        if (empty($id)) {
            return $query;
        }

        $comparisons = array(
            '>=' => 2,
            '>' => 1,
            '<=' => 2,
            '<' => 1,
        );
        $id = trim($id);

        foreach ($comparisons as $comparison => $length) {
            if (strstr($id, $comparison)) {
                $id = substr($id, $length);
                $query->andFilterWhere([
                    $comparison, 'id', trim($id),
                ]);
                return $query;
            }
        }

        $query->andFilterWhere([
            'id' => $id,
        ]);
        return $query;

    }

    /**
     * export
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function export($params)
    {
        if ($params['selectAll'] == 'true') {

            $dataProvider = $this->search($params, false);

        } else {

            $id = empty($params['id']) ? [0]:$params['id'];

            $query = Supplier::find();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => false,
            ]);

            $query->andFilterWhere(['in', 'id', $id]);

        }

        return $dataProvider;

    }

}
