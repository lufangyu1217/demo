<?php 
namespace Demo\Service\User\Impl;

use Demo\Service\User\UserService;
use Demo\Service\Common\BaseService;

class UserServiceImpl extends BaseService implements UserService
{
    private $name = array(
        'criss' => '0',
        'lufangyu' => '1',
        'xiaozhu' => '2'
    );

    public function get()
    {
        $datas = $this->getUserDao()->get();
        foreach ($datas as $key => $data) {
            $items = explode(';', $data['items']);
            array_pop($items);
            $arr = array();
            foreach ($items as $data) {
                $array = explode(':', $data);
                $arr[$array[0]] = $array[1];
            }
            $datas[$key]['items'] = $arr;
        }


        return $datas;
    }

    public function update($fields)
    {
        $datas = $this->get();
        $total = $datas[0]['total'] + $datas[1]['total'] + $datas[2]['total'] + $fields['price'];

        $item = $datas[$this->name[$fields['people']]];
        $arr = '';
        $person = 0;
        foreach ($item['items'] as $key => $data) {
            $arr .= $key.':'.$data.';';
            $person += $data;
        }
        $arr .= $fields['remark'].':'.$fields['price'].';';
        $person += $fields['price'];
        $item['items'] = $arr;
        
        $ave = round($total / 3, 2);

        if (($person - $ave) > 0) {
            $redundant = round($person - $ave, 2);
            $less = 0;
        } else {
            $redundant = 0;
            $less = round($person - $ave, 2);
        }

        $this->getUserDao()->update($item, $person, $less, $redundant);

        foreach ($datas as $key => $data) {
            if ($fields['people'] != $data['name']) {
                $person = $data['total'];
                if (($person - $ave) > 0) {
                    $redundant = $person - $ave;
                    $less = 0;
                } else {
                    $redundant = 0;
                    $less = $person - $ave;
                }

                $this->getUserDao()->updateTwo($data['name'], $less, $redundant);
            }
        }   
    }

    protected function getUserDao()
    {
        return $this->createDao('User:UserDao');
    }
}