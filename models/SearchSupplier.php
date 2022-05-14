<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Supplier;

/**
 * SearchSupplier represents the model behind the search form of `app\models\Supplier`.
 */
class SearchSupplier extends Supplier
{
    const PATTERN = [
        '<',
        '>',
        '>=',
        '<=',
        '='
    ];

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
    public function search($params)
    {
        $query = Supplier::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->id) {
            if (!is_numeric($this->id)) {
                // 如果是范围查询
                preg_match('/^(<=?|>=?|<?|>?|=?)(\d*)$/', $this->id, $pattern);
                if (isset($pattern[1]) && in_array($pattern[1], self::PATTERN)) {
                    $query->andWhere([$pattern[1], 'id', $pattern[2]]);
                } else {
                    $this->addError('id', '搜索条件有误，请重新输入！');
                }
            } else {
                $query->andWhere(['id' => $this->id]);
            }
        }

        // grid filtering conditions
        if ($this->t_status) {
            $query->andWhere(['t_status' => $this->t_status]);
        }
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }

    public static function statusMap()
    {
        return ['ok' => Supplier::T_STATUS_OK, 'hold' => Supplier::T_STATUS_HOLD];
    }
}
