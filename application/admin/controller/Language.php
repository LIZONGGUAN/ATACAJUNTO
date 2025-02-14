<?php

namespace app\admin\controller;

use think\Request;
use think\Db;
use think\Cookie;

class Language
{
  public function setLang(Request $request)
  {
    $lang = $request->param('lang');
    Cookie::set('language', $lang);
    return json(['code' => "0000", 'msg' => ""]);
  }


  public function getList(Request $request)
  {
    $page = $request->param('page');
    $limit = $request->param('limit');
    $start = ($page - 1) * $limit;
    $category = $request->param('category');
    $keyword = $request->param('keyword');

    $count = Db::name('language')
      ->where('category', 'like', '%' . $category . '%')
      ->where('label|name_zh|name_pt', 'like', '%' . $keyword . '%')
      ->where('is_deleted', '=', 0)
      ->Count();
    $list = Db::name('language')
      ->where('category', 'like', '%' . $category . '%')
      ->where('label|name_zh|name_pt', 'like', '%' . $keyword . '%')
      ->where('is_deleted', '=', 0)
      ->order('create_at desc')
      ->limit($start, $limit)
      ->select();

    if ($list) {
      $data = ['code' => "0000", 'msg' => "查询成功~", 'count' => $count, 'list' => $list];
    } else {
      $data = ['code' => "0001", 'msg' => "未查询到数据~"];
    }
    return json($data);
  }

  public function add(Request $request)
  {
    $category = $request->param('category');
    $name_zh = $request->param('name_zh');
    $name_pt = $request->param('name_pt');

    $infoData = Db::name('language')
      ->where('label', '=', $name_zh)
      ->where('is_deleted', '=', 0)
      ->find();
    if ($infoData) {
      $data = ['code' => "0001", 'msg' => "字段标识已存在"];
    } else {
      $sqlres = Db::name('language')->insert([
        'category' => $category,
        'label' => $name_zh,
        'name_zh' => $name_zh,
        'name_pt' => $name_pt,
      ]);
      if ($sqlres) {
        $data = ['code' => "0000", 'msg' => "保存成功~"];
      } else {
        $data = ['code' => "0001", 'msg' => "保存失败~"];
      }
    }
    return json($data);
  }

  public function delete(Request $request)
  {
    $id = $request->param('id');
    $update_at = date("Y-m-d H:i:s", time());

    $sqlres = Db::name('language')->where('id', '=', $id)->update(['is_deleted' => 1, 'update_at' => $update_at]);
    if ($sqlres) {
      $data = ['code' => "0000", 'msg' => "删除成功~"];
    } else {
      $data = ['code' => "0001", 'msg' => "删除异常~"];
    }
    return json($data);
  }

  public function update(Request $request)
  {
    $id = $request->param('id');
    $category = $request->param('category');
    $name_zh = $request->param('name_zh');
    $name_pt = $request->param('name_pt');
    $update_at = date("Y-m-d H:i:s", time());
    
    $infoData = Db::name('language')
      ->where('id', '<>', $id)
      ->where('label', '=', $name_zh)
      ->where('is_deleted', '=', 0)
      ->find();
    if ($infoData) {
      $data = ['code' => "0001", 'msg' => "字段标识已存在"];
    } else {
      $sqlres = Db::name('language')->where('id', '=', $id)->update([
        'category' => $category,
        'label' => $name_zh,
        'name_zh' => $name_zh,
        'name_pt' => $name_pt,
        'update_at' => $update_at,
      ]);
      if ($sqlres) {
        $data = ['code' => "0000", 'msg' => "修改成功~"];
      } else {
        $data = ['code' => "0001", 'msg' => "修改失败~"];
      }
    }
    return json($data);
  }
}
