<?php

class EloquentRunner
{
    // 배열 인덱스.
    // code_stack, sql_stack의 동일 인덱스에는 코드와 해당 sql이 저장된다.
    private $idx = 0;

    // eloquent 문장 배열
    private $code_stack = [];

    // sql 배열
    private $sql_stack = [];

    // result 배열
    private $data_stack = [];

    public function evalCode($code)
    {
        $this->code_stack[$this->idx++] = $code;

        $cur_idx = $this->idx - 1;

        ob_start();
        $result = @eval('return ' . $code);
        if (error_get_last()){
            $this->sql_stack[$cur_idx] = '<span class="label label-danger">' . error_get_last()['message'] . '</span>';
        }

        $classes = $this->inspect($result);

        $this->data_stack[$cur_idx] = $classes;
        ob_end_clean();
    }

    public function inspect($data)
    {
        if (is_object($data)) {
            if ($data instanceof Illuminate\Database\Eloquent\Collection) {
                $objects = [];
                foreach ($data as $object) {
                    $objects[] = $this->inspect($object);
                }

                $property['type'] = 'Collection';
                $property['items'] = $objects;
            } elseif ($data instanceof Illuminate\Database\Eloquent\Model) {
                $class = get_class($data);
                $attributes = $data->attributesToArray();
                $relations = $data->getRelations();

                foreach ($relations as $key => $value) {
                    if ($value instanceof Illuminate\Database\Eloquent\Collection)
                        $relations[$key] = $this->inspect($value);
                }

                /*
                $relations = $result->relationsToArray();
                */

                $property['type'] = 'Model';
                $property['name'] = $class;
                $property['attributes'] = $attributes;

                if (count($relations) > 0) {
                    $property['relations'] = $relations;
                }
            } else {
                $property['type'] = 'Object';
                $property['name'] = get_class($data);
            }
        } else {
            $property['type'] = gettype($data);
            $property['value'] = $data;
        }

        return $property;
    }

    public function addSql($sql)
    {
        $cur_idx = $this->idx - 1;

        if (isset($this->sql_stack[$cur_idx])) {
            $values = $this->sql_stack[$cur_idx];
        }
        $values[] = $sql;

        $this->sql_stack[$cur_idx] = $values;
    }

    public function getResult()
    {
        $results = [];

        for ($i = 0; $i < count($this->code_stack); $i++) {
            $result['code']	= $this->code_stack[$i];
            $result['sql'] = get_if_set($this->sql_stack[$i], ['<span class="label label-danger">empty result</span>']);
            $result['data'] = isset($this->sql_stack[$i]) ? $this->data_stack[$i] : '';
            $results[] = $result;
        }

        return $results;
    }
}
