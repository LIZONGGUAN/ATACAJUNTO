<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:88:"/www/wwwroot/tb.youanfutang.cn/public/../application/admin/view/admin/table/product.html";i:1715417403;s:65:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/layout.html";i:1658590062;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/header.html";i:1658677912;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/footer.html";i:1658590072;}*/ ?>

<!DOCTYPE html>  
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="" http-equiv="refresh" content=""/>
		<title><?php echo $webname; ?>-管理后台</title>
	
	  <!-- mini后台 -->
	  <meta name="renderer" content="webkit">
	     <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	     <meta http-equiv="Access-Control-Allow-Origin" content="*">
<!-- 	     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> -->
	     <meta name="apple-mobile-web-app-status-bar-style" content="black">
	     <meta name="apple-mobile-web-app-capable" content="yes">
	     <meta name="format-detection" content="telephone=no">
		 
	  <link rel="stylesheet" href="/static/layui/css/layui.css">
	     <link rel="stylesheet" href="/static/layui/admin/layuimini/css/layuimini.css?v=2.0.4.2" media="all">
	     <link rel="stylesheet" href="/static/layui/admin/layuimini/css/themes/default.css" media="all">
	     <link rel="stylesheet" href="/static/layui/admin/layuimini/lib/font-awesome-4.7.0/css/font-awesome.min.css" media="all">
	       <link rel="stylesheet" href="/static/layui/admin/layuimini/css/public.css" media="all">
	  
	  	<!-- mini后台 -->
		
    <script src="/static/JS/jquery.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="/static/ueditor/ueditor.config.js"></script>
	<!-- <script type="text/javascript" charset="utf-8" src="../static/ueditor/ueditor.all.min.js"> </script> -->
	<script type="text/javascript" charset="utf-8" src="/static/ueditor/ueditor.all.js"> </script>
	<script type="text/javascript" charset="utf-8" src="/static/ueditor/lang/zh-cn/zh-cn.js"></script>

	<script src="/static/JS/jquery.cookie.min.js"></script>

	<script type="text/javascript" src="/static/JS/jquery.qrcode.min.js"></script>  <!-- JQ二维码生成 -->
 <script src="/static/layui/layui.all.js"></script>
	
	</head>


<style>
  .layui-table tbody tr:hover,
  .layui-table thead tr,
  .layui-table-click,
  .layui-table-header,
  .layui-table-hover,
  .layui-table-mend,
  .layui-table-patch,
  .layui-table-tool,
  .layui-table-total,
  .layui-table-total tr,
  .layui-table[lay-even] tr:nth-child(even) {
    background-color: #ffffff;
  }

  .layui-table-main .layui-table-cell,
  .layui-table-main img {
    line-height: 90px;
    height: 90px !important;
  } /* layui内容区域设置 */

  *[data-field|='news_tit'] > div,
  *[data-field|='ejclass'] > div {
    overflow: auto !important;

    text-overflow: inherit !important;
    line-height: 20px !important;
    white-space: pre-wrap !important;
  }
  .slted {
    background-color: orange;
    color: white;
  }
</style>
<div class="layuimini-container">
  <div class="layuimini-main">
    <fieldset class="table-search-fieldset">
      <legend><?php echo $languageObj['搜索信息']['name_' . $language]; ?></legend>
      <div style="margin: 10px 10px 10px 10px">
        <form class="layui-form layui-form-pane" action="">
          <div class="layui-form-item">
            <div class="layui-inline">
              <label class="layui-form-label"><?php echo $languageObj['产品名称']['name_' . $language]; ?></label>
              <div class="layui-input-inline">
                <input
                  type="text"
                  name="username"
                  autocomplete="off"
                  class="layui-input"
                />
              </div>
            </div>
            <div class="layui-inline">
              <label class="layui-form-label"><?php echo $languageObj['产品分类']['name_' . $language]; ?></label>
              <div class="layui-input-inline">
                <select name="top-class" style="width: 30%">
                  <option value=""><?php echo $languageObj['请选择分类']['name_' . $language]; ?></option>
                  <?php if(is_array($productc) || $productc instanceof \think\Collection || $productc instanceof \think\Paginator): $i = 0; $__LIST__ = $productc;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?>
                  <option value="<?php echo $m['name']; ?>"><?php echo $m['name']; ?></option>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>
            </div>

            <div class="layui-inline">
              <button
                type="submit"
                class="layui-btn layui-btn-primary"
                lay-submit
                lay-filter="data-search-btn"
              >
                <i class="layui-icon"></i> <?php echo $languageObj['搜索']['name_' . $language]; ?>
              </button>
            </div>
          </div>
        </form>
      </div>
      <script>
        layui.use('form', function () {
          var form = layui.form
          form.on('select(filter)', function (data) {
            console.log(data.elem) //得到select原始DOM对象
            console.log(data.value) //得到被选中的值
            console.log(data.othis) //得到美化后的DOM对象
          })

          setTimeout(function () {
            form.render() // layui重新渲染
          }, 1000)
          //各种基于事件的操作，下面会有进一步介绍
        })
      </script>
      <input
        type="text"
        class="layui-input delpwd"
        placeholder="<?php echo $languageObj['请输入后台登录密码']['name_' . $language]; ?>"
        style="width: 30%; display: none"
      />
    </fieldset>
    <script type="text/html" id="ID-table-demo-templet-switch">
      <!-- 这里的 checked 的状态值判断仅作为演示 -->
      <input type="checkbox" name="status" value="{{ d.Id }}" title="热|"
      lay-skin="switch" lay-filter="demo-templet-status" {{ d.status ==
      "checked" ? "checked" : "" }} >
    </script>
    <script type="text/html" id="toolbarDemo">
      <div class="layui-btn-container">
        <button
          class="layui-btn layui-btn-sm layui-btn-primary "
          lay-event="allp"
        >
				<?php echo $languageObj['全部']['name_' . $language]; ?>
        </button>
        <button
          class="layui-btn layui-btn-sm layui-btn-primary "
          lay-event="zais"
        >
				<?php echo $languageObj['在售']['name_' . $language]; ?>
        </button>
        <button
          class="layui-btn layui-btn-sm layui-btn-primary"
          lay-event="yxj"
        >
				<?php echo $languageObj['已下架']['name_' . $language]; ?>
        </button>

        <button
          class="layui-btn layui-btn-sm layui-btn-primary"
          lay-event="plsj"
        >
				<?php echo $languageObj['批量上架']['name_' . $language]; ?>
        </button>
        <button
          class="layui-btn layui-btn-sm layui-btn-primary"
          lay-event="plxj"
        >
				<?php echo $languageObj['批量下架']['name_' . $language]; ?>
        </button>
        <!-- 	<button class="layui-btn layui-btn-sm layui-btn-primary" lay-event="addc">添加产品分类</button> -->
        <button
          class="layui-btn layui-btn-normal layui-btn-sm data-add-btn"
          lay-event="add"
        >
				<?php echo $languageObj['添加']['name_' . $language]; ?>
        </button>
        <button
          class="layui-btn layui-btn-sm layui-btn-danger data-delete-btn"
          lay-event="delete"
        >
				<?php echo $languageObj['删除']['name_' . $language]; ?>
        </button>
      </div>
    </script>

    <table
      class="layui-hide"
      id="currentTableId"
      lay-filter="currentTableFilter"
    ></table>

    <script type="text/html" id="currentTableBar">
      <a
        class="layui-btn layui-btn-normal layui-btn-xs data-count-edit"
        lay-event="edit"
        ><?php echo $languageObj['编辑']['name_' . $language]; ?></a
      >
      <a
        class="layui-btn layui-btn-xs layui-btn-danger data-count-delete"
        lay-event="delete"
        ><?php echo $languageObj['删除']['name_' . $language]; ?></a
      >
      <a
        class="layui-btn layui-btn-normal layui-btn-xs data-count-copy layui-bg-black"
        lay-event="copy"
        ><?php echo $languageObj['复制产品']['name_' . $language]; ?></a
      >
    </script>
  </div>
</div>
<script src="/static/layui/layui.all.js"></script>
<script>
  layui.use(['form', 'table'], function () {
    var $ = layui.jquery,
      form = layui.form,
      table = layui.table

    table.render({
      elem: '#currentTableId',
      url: '/login.php/newsad/prolist',
      toolbar: '#toolbarDemo',
      defaultToolbar: [
        'filter',
        'exports',
        'print',
        {
          title: `<?php echo $languageObj['提示']['name_' . $language]; ?>`,
          layEvent: 'LAYTABLE_TIPS',
          icon: 'layui-icon-tips'
        }
      ],
      cols: [
        [
          { type: 'checkbox', width: 50 },
          { field: 'Id', width: 80, title: 'ID', sort: true },
          {
            field: 'news_slt',
            width: 150,
            title: `<?php echo $languageObj['缩略图']['name_' . $language]; ?>`,
            templet: function (d) {
              return (
                '<div  style="cursor: pointer" onclick="show_img(this)" ><img src="' +
                d.news_slt +
                '" ' +
                'alt="" width="95%" height="95px"  ></a></div>'
              )
            }
          },
          { field: 'news_tit', width: 180, title: `<?php echo $languageObj['产品名称']['name_' . $language]; ?>` },
          { field: 'newsclass', width: 130, title: `<?php echo $languageObj['产品大类']['name_' . $language]; ?>`, sort: true },
          { field: 'ejclass', title: `<?php echo $languageObj['多级分类']['name_' . $language]; ?>`, width: 300 },
          { field: 'newstime', width: 120, title: `<?php echo $languageObj['发布时间']['name_' . $language]; ?>` },
          { field: 'jiage', title: `<?php echo $languageObj['价格']['name_' . $language]; ?>`, width: 130 },
          { field: 'zhlx', width: 100, title: `<?php echo $languageObj['常用搜索词']['name_' . $language]; ?>`, edit: true },
          {
            field: 'status',
            title: `<?php echo $languageObj['售卖状态']['name_' . $language]; ?>`,
            width: 150,
            templet: '#ID-table-demo-templet-switch'
          },
          { title: `<?php echo $languageObj['操作']['name_' . $language]; ?>`, toolbar: '#currentTableBar', align: 'center' }
        ]
      ],
      limits: [10, 15, 20, 25, 50, 100],
      limit: 15,
      page: true,
      skin: 'line',
      height: 'full-170'
    })
    //监听单元格编辑
    table.on('edit(currentTableFilter)', function (obj) {
      //注：edit是固定事件名，test是table原始容器的属性 lay-filter="对应的值"
      console.log(obj.value) //得到修改后的值
      console.log(obj.field) //当前编辑的字段名
      // console.log(obj.data); //所在行的所有相关数据
      tdfield = obj.field
      console.log(obj.field)

      $.post(
        '/login.php/admin/ediselpro?id=' + obj.data.Id + '&data=' + obj.value,
        function (s) {
          if (s.code == 1) {
            layer.msg(
              `<?php echo $languageObj['修改成功']['name_' . $language]; ?>`,
              {
                icon: 1,
                shade: 0.05,
                time: 800
              },
              function () {
                //window.location.reload();
              }
            )
            return false
          } else {
            layer.msg(`<?php echo $languageObj['修改失败']['name_' . $language]; ?>`, {
              icon: 2,
              shade: 0.05,
              time: 800
            })
            return false
          }
        }
      )
    })

    // 状态 - 开关操作
    form.on('switch(demo-templet-status)', function (obj) {
      var id = this.value
      var name = this.name

      $.post(
        '/login.php/newsad/prolist?sign=状态开关&trid=' + id,
        function (s) {
          if (s.code == 1) {
            layer.msg(
              `<?php echo $languageObj['修改成功']['name_' . $language]; ?>`,
              {
                icon: 1,
                shade: 0.05,
                time: 800
              },
              function () {
                //window.location.reload();
              }
            )
            return false
          } else {
            layer.msg(`<?php echo $languageObj['修改失败']['name_' . $language]; ?>`, {
              icon: 2,
              shade: 0.05,
              time: 800
            })
            return false
          }
        }
      )
    })
    // 监听搜索操作
    form.on('submit(data-search-btn)', function (data) {
      var result = JSON.stringify(data.field)

      console.log(result)
      //执行搜索重载
      table.reload(
        'currentTableId',
        {
          page: {
            curr: 1
          },
          where: {
            searchParams: result
          }
        },
        'data'
      )

      return false
    })

    /**
     * toolbar监听事件
     */
    table.on('toolbar(currentTableFilter)', function (obj) {
      var data = obj.data //获得当前行数据
      var layEvent = obj.event //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）

      if (obj.event === 'add') {
        // 监听添加操作

        window.location.href =
          '/login.php/admin/loadright?page=upproduct&formname=product'
      } else if (obj.event === 'allp') {
        //执行搜索重载
        table.reload(
          'currentTableId',
          {
            page: {
              curr: 1
            },
            where: {
              searchParams: 'result',
              sign: `<?php echo $languageObj['全部']['name_' . $language]; ?>`
            }
          },
          'data'
        )

        $("button[lay-event='allp'")
          .addClass('slted')
          .siblings()
          .removeClass('slted')
      } else if (obj.event === 'zais') {
        //执行搜索重载
        table.reload(
          'currentTableId',
          {
            page: {
              curr: 1
            },
            where: {
              searchParams: '',
              sign: 'checked' //在售的
            }
          },
          'data'
        )

        $("button[lay-event='zais'")
          .addClass('slted')
          .siblings()
          .removeClass('slted')
      } else if (obj.event === 'yxj') {
        //执行搜索重载
        table.reload(
          'currentTableId',
          {
            page: {
              curr: 1
            },
            where: {
              searchParams: '',
              sign: 'no' //下架的
            }
          },
          'data'
        )

        $("button[lay-event='yxj'")
          .addClass('slted')
          .siblings()
          .removeClass('slted')
      } else if (obj.event === 'plsj') {
        var checkStatus = table.checkStatus('currentTableId'),
          data = checkStatus.data

        if (data == '') {
          layer.msg(`<?php echo $languageObj['请先勾选要操作的商品！']['name_' . $language]; ?>`)
        } else {
          layer.confirm(`<?php echo $languageObj['批量上架选中的数据吗？']['name_' . $language]; ?>`, function (index) {
            layer.close(index)
            $.ajax({
              type: 'post', // 规定请求的类型（GET 或 POST）
              url: '/login.php/newsad/prolist', // 请求的url地址
              cache: false, // 否在缓存中读取数据的读取
              dataType: 'json', //预期的服务器响应的数据类型
              data: {
                data: JSON.stringify(data),
                formname: 'product',
                sign: `<?php echo $languageObj['批量上架']['name_' . $language]; ?>`
              }, //规定要发送到服务器的数据
              success: function (s) {
                if (s.code == 1) {
                  //执行表格重载
                  layer.msg(
                    `<?php echo $languageObj['上架成功！']['name_' . $language]; ?>`,
                    {
                      icon: 1,
                      shade: 0.05,
                      time: 800
                    },
                    function () {
                      if ($('.slted').text() == `<?php echo $languageObj['在售']['name_' . $language]; ?>`) {
                        table.reload('currentTableId')
                        $("button[lay-event='zais'")
                          .addClass('slted')
                          .siblings()
                          .removeClass('slted')
                      } else if ($('.slted').text() == `<?php echo $languageObj['已下架']['name_' . $language]; ?>`) {
                        table.reload('currentTableId')
                        $("button[lay-event='yxj'")
                          .addClass('slted')
                          .siblings()
                          .removeClass('slted')
                      } else if ($('.slted').text() == `<?php echo $languageObj['全部']['name_' . $language]; ?>`) {
                        table.reload('currentTableId')
                        $("button[lay-event='allp'")
                          .addClass('slted')
                          .siblings()
                          .removeClass('slted')
                      } else {
                        table.reload('currentTableId')
                      }
                    }
                  )
                } else {
                  layer.msg(`<?php echo $languageObj['上架失败！']['name_' . $language]; ?>`)
                  return false
                }
              }
            }) //ajax
          })
        }
      } else if (obj.event === 'plxj') {
        var checkStatus = table.checkStatus('currentTableId'),
          data = checkStatus.data

        if (data == '') {
          layer.msg(`<?php echo $languageObj['请先勾选要操作的商品！']['name_' . $language]; ?>`)
        } else {
          layer.confirm(`<?php echo $languageObj['批量下架选中的数据吗？']['name_' . $language]; ?>`, function (index) {
            layer.close(index)
            $.ajax({
              type: 'post', // 规定请求的类型（GET 或 POST）
              url: '/login.php/newsad/prolist', // 请求的url地址
              cache: false, // 否在缓存中读取数据的读取
              dataType: 'json', //预期的服务器响应的数据类型
              data: {
                data: JSON.stringify(data),
                formname: 'product',
                sign: `<?php echo $languageObj['批量下架']['name_' . $language]; ?>`
              }, //规定要发送到服务器的数据
              success: function (s) {
                if (s.code == 1) {
                  //执行表格重载
                  layer.msg(
                    `<?php echo $languageObj['下架成功！']['name_' . $language]; ?>`,
                    {
                      icon: 1,
                      shade: 0.05,
                      time: 800
                    },
                    function () {
                      if ($('.slted').text() == `<?php echo $languageObj['在售']['name_' . $language]; ?>`) {
                        table.reload('currentTableId')
                        $("button[lay-event='zais'")
                          .addClass('slted')
                          .siblings()
                          .removeClass('slted')
                      } else if ($('.slted').text() == `<?php echo $languageObj['已下架']['name_' . $language]; ?>`) {
                        table.reload('currentTableId')
                        $("button[lay-event='yxj'")
                          .addClass('slted')
                          .siblings()
                          .removeClass('slted')
                      } else if ($('.slted').text() == `<?php echo $languageObj['全部']['name_' . $language]; ?>`) {
                        table.reload('currentTableId')
                        $("button[lay-event='allp'")
                          .addClass('slted')
                          .siblings()
                          .removeClass('slted')
                      } else {
                        table.reload('currentTableId')
                      }
                    }
                  )
                } else {
                  layer.msg(`<?php echo $languageObj['下架失败！']['name_' . $language]; ?>`)
                  return false
                }
              }
            }) //ajax
          })
        }
      } else if (obj.event === 'delete') {
        // 监听删除操作
        var checkStatus = table.checkStatus('currentTableId'),
          data = checkStatus.data

        console.log(data)
        var delpwd = $('.delpwd').val()
        $('.delpwd').show(300)
        if (data == '') {
          layer.msg(`<?php echo $languageObj['请先勾选要操作的商品！']['name_' . $language]; ?>`)
        } else if (delpwd == '') {
          layer.msg(`<?php echo $languageObj['请输入后台登录密码']['name_' . $language]; ?>`)
          return false
        } else {
          layer.confirm(`<?php echo $languageObj['删除选中的数据吗']['name_' . $language]; ?>`, function (index) {
            layer.close(index)
            $.ajax({
              type: 'post', // 规定请求的类型（GET 或 POST）
              url: '/login.php/newsad/newslist_del', // 请求的url地址
              cache: false, // 否在缓存中读取数据的读取
              dataType: 'json', //预期的服务器响应的数据类型
              data: {
                data: JSON.stringify(data),
                formname: 'product',
                delpwd: delpwd
              }, //规定要发送到服务器的数据
              success: function (s) {
                if (s.code == 1) {
                  //执行表格重载
                  table.reload('currentTableId')
                } else if (s.code == 5) {
                  layer.msg(`<?php echo $languageObj['密码错误']['name_' . $language]; ?>`, {
                    icon: 2,
                    shade: 0.05,
                    time: 800
                  })
                  return false
                } else {
                  layer.msg(`<?php echo $languageObj['删除失败']['name_' . $language]; ?>`)
                }
              }
            }) //ajax
          })
        }
      }
    })

    //监听表格复选框选择
    table.on('checkbox(currentTableFilter)', function (obj) {
      console.log(obj)
    })

    table.on('tool(currentTableFilter)', function (obj) {
      var data = obj.data
      var tr = obj.tr //获得当前行 tr 的 DOM 对象（如果有的话）
      var trid = $($(tr).find('td')[1]).text()
      var kcname = $($(tr).find('td')[2]).text()
      if (obj.event === 'edit') {
        window.location.href =
          '/login.php/newsad/newslist_detail?trid=' +
          trid +
          '&ifeditor=editor&formname=product'
      } else if (obj.event === 'delete') {
        layer.confirm(`<?php echo $languageObj['确定删除数据吗']['name_' . $language]; ?>`, function (index) {
          var delpwd = $('.delpwd').val()
          $('.delpwd').show(300)
          if (delpwd == '') {
            layer.msg(`<?php echo $languageObj['请输入后台登录密码']['name_' . $language]; ?>`)
            return false
          }

          $.ajax({
            type: 'post', // 规定请求的类型（GET 或 POST）
            url: '/login.php/newsad/newslist_del', // 请求的url地址
            cache: false, // 否在缓存中读取数据的读取
            dataType: 'json', //预期的服务器响应的数据类型
            data: {
              trid: trid,
              formname: 'product',
              delpwd: delpwd
            }, //规定要发送到服务器的数据
            success: function (s) {
              if (s.code == 1) {
                //执行表格重载
                layer.msg(
                  `<?php echo $languageObj['删除成功']['name_' . $language]; ?>`,
                  {
                    icon: 1,
                    shade: 0.05,
                    time: 800
                  },
                  function () {
                    table.reload('currentTableId')
                  }
                )
              } else if (s.code == 5) {
                layer.msg(`<?php echo $languageObj['密码错误']['name_' . $language]; ?>`, {
                  icon: 2,
                  shade: 0.05,
                  time: 800
                })
                return false
              } else {
                layer.msg(`<?php echo $languageObj['删除失败']['name_' . $language]; ?>`)
              }
            }
          }) //ajax
        })
      } else if (obj.event === 'copy') {
        layer.confirm('COPY【 ' + kcname + '】 ？', function (index) {
          $.ajax({
            type: 'post', // 规定请求的类型（GET 或 POST）
            url: '/login.php/newsad/copynews', // 请求的url地址
            cache: false, // 否在缓存中读取数据的读取
            dataType: 'json', //预期的服务器响应的数据类型
            data: {
              id: trid,
              formname: 'product'
            }, //规定要发送到服务器的数据
            success: function (res) {
              // 当请求成功时运行的函数
              console.log(res)
              // news_slt=null;
              if (res.code == 1) {
                layer.msg(
                  'copy...',
                  {
                    icon: 16,
                    shade: 0.05,
                    time: 1000
                  },
                  function () {
                    window.location.reload()
                  }
                )
              } else {
                layer.msg('fail', {
                  icon: 2,
                  shade: 0.05,
                  time: 800
                })
              }
            }
          }) //ajax
        })
      } //copy
    })
  })
</script>



</body>
</html>

<div class="wxfxanli-con" style="display: none;text-align: center;">
	             <b style="font-size: 22px;margin: 10px 0px;display: block;">案例1</b>
				 
				<img width="90%" style="display: block;margin: auto;" src="/static/img/admin/wxfx.png" >
				   <b style="font-size: 22px;margin: 10px 0px;display: block;">案例2</b>
				<img width="90%" style="display: block;margin: auto;" src="/static/img/admin/pyqfx.png" >
</div>
		