<?php

namespace App\Services;

use App\Models\Category;
use App\Contracts\CategoryContract;


class CategoryService implements CategoryContract
{


    public function getAll($Category, $parent_id)
    {
        $html = '';
        $name_default = "--Lưa chọn nhóm cha--";
        $Category = Category::where('parent_id', '=', $parent_id)->get();
        foreach ($Category as $cate) {
            if (count($cate->childs)) {
                $html .= '<li data-expanded="false"><button data-value="' . $cate->name . '"
                onclick="myText(this)" id="' . $cate->id . '"
                 name="' . $name_default . '"
                  value="' . $cate->id . '" data-toggle="modal"
                  data-target="#exampleModal1">' . $cate->name . '</button>';
                $html .= $this->childview($cate);
                $html .= '</li>';
            } else {
                $html .= '<li><button  data-value="' . $cate->name . '" onclick="myText(this)" id="' . $cate->id . '" name="' . $name_default . '" value="' . $cate->id . '" data-toggle="modal" data-target="#exampleModal1">' . $cate->name . '</button></li>';
            }
        }
        return $html;
    }

    public function childview($Category)
    {
        $childs = $Category->childs;
        //$Cate = Category::Where('id','=',$Category->childs[0]->parent_id)->first();
        $htmlS = '<ul>';
        foreach ($childs as $cateChild) {
            if (count($cateChild->childs)) {
                $htmlS .= '<li id="item" data-expanded="false" class="active"><button data-value="' . $cateChild->name . '"  onclick="myText(this)" id="' . $cateChild->id . '" name="' . $Category->name . '" value="' . $cateChild->id . '" data-toggle="modal" data-target="#exampleModal1"  >' . $cateChild->name . '</button>';
                $htmlS .= $this->childview($cateChild);

                $htmlS .= '</li>';
            } else {
                $htmlS .= '<li><button data-value="' . $cateChild->name . '" onclick="myText(this)" id="' . $cateChild->id . '" name="' . $Category->name . '" value="' . $cateChild->id . '" data-toggle="modal" data-target="#exampleModal1" >' . $cateChild->name . '</button></li>';
            }
        }
        $htmlS .= '</ul>';
        return $htmlS;
    }

    public function show($id)
    {


    }
    public function create()
    {
        $space = '';
        $htmlOption = '<option value="0">' . "--Lưa chọn nhóm cha--" . '</option>';

        $category = Category::where('parent_id', '=', 0)->get();
        foreach ($category as $item) {
            $htmlOption .= '<option onclick="formatText()" value="' . $item["id"] . '">' . $space . $item["name"] . '</option>';
            if (count($item->childs)) {
                $htmlOption .= $this->childsOption($item, $space);
            }
        }
        return $htmlOption;
    }

    public function childsOption($category, $space)
    {
        $space = '&nbsp;&nbsp;&nbsp;&nbsp;';

        $htmlOption = '';
        $childs = $category->childs;

        foreach ($childs as $item) {
            $htmlOption .= '<option  value="' . $item->id . '">' . $space . $item->name . '</option>';
            if (count($item->childs)) {
                $space .= $space;
                $htmlOption .= $this->childsOption($item, $space);
            }
        }
        return $htmlOption;
    }

    public function update($request, $id)
    {
        $result = array('error' => 'error', 'success' => 'success');
        $input = $request->all();
        $name = $input['name_update'];
        $parent_id = $input['parent_id_update'];
        $id = $input['idCategory'];
        $categories = Category::findOrFail($id);

        $cate = Category::where('name', '=', $name)->first();

        if ($cate !== null && $name === $categories->name|| $cate === null) {
            $categories->name = $name;
            $categories->parent_id = $parent_id;
            $categories->save();
            return $result['success'];
        } else {
            return $result['error'];
        }

    }

    public function delete($request,$id)
    {
        $ids = $request['idCategory'];
        $result = array('error' => 'error', 'success' => 'success');
        $categories = Category::findOrFail($ids);

        //$check = $categories->genres->exists();
        if (count($categories->childs)) {
            return $result['error'];

        } else {
            Category::destroy($ids);
            return $result['success'];
        }

    }

    public function store($request)
    {
        //['name' => $category['name'], 'parent_id' =>$category['parent_id']]
        $category = $request->all();
        Category::create($category);

    }


}
