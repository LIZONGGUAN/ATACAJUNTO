<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:89:"/www/wwwroot/tb.youanfutang.cn/public/../application/admin/view/admin/page/newsclass.html";i:1715741474;s:65:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/layout.html";i:1658590062;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/header.html";i:1658677912;s:70:"/www/wwwroot/tb.youanfutang.cn/application/admin/view/base/footer.html";i:1658590072;}*/ ?>

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
  .laytable-cell-1-0-5 {
    text-align: center;
  }
  td[data-field='sort'] {
    text-align: center;
  }
</style>

<div class="layuimini-container">
  <div class="layuimini-main">
    <!--   <fieldset class="table-search-fieldset">
            <legend>搜索信息</legend>
            <div style="margin: 10px 10px 10px 10px">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">分类标题</label>
                            <div class="layui-input-inline">
                                <input type="text" name="username" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                    
                        <div class="layui-inline">
                            <button type="submit" class="layui-btn layui-btn-primary"  lay-submit lay-filter="data-search-btn"><i class="layui-icon"></i> 搜 索</button>
                        </div>
                    </div>
                </form>
            </div>
        </fieldset> -->

    <script type="text/html" id="toolbarDemo">
      <div class="layui-btn-container">
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
        <?php if($language == 'zh'): ?>
        <button
          class="layui-btn layui-btn-sm layui-btn-danger data-delete-btn layui-bg-black"
        >
          提示：分类只能一级+二级+三级
        </button>
        <?php endif; ?>
        <button
          class="layui-btn layui-btn-sm layui-btn-danger data-delete-btn"
          lay-event="piliang"
        >
          <?php echo $languageObj['一键转移']['name_' . $language]; ?>
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
        class="layui-btn layui-btn-normal layui-btn-xs layui-bg-orange"
        lay-event="tuij"
        ><?php echo $languageObj['推荐']['name_' . $language]; ?></a
      >
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
    </script>
  </div>
</div>

<script>
  let html = `<option value="0"><?php echo $languageObj['顶级分类']['name_' . $language]; ?></option>`
  let classname
  let pldata
  layui.use(['table', 'form'], function () {
    var table = layui.table,
      form = layui.form
    table.render({
      elem: '#currentTableId',
      url: '/login.php/newsad/newsTree',
      page: {
        //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
        layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'], //自定义分页布局
        limit: 500,
        limits: [500, 1000, 1500],
        curr: 1, //设定初始在第 1 页
        groups: 2, //只显示 1 个连续页码
        first: false, //不显示首页
        last: false //不显示尾页
      },
      where: { formname: '<?php echo $formname; ?>' }, //如果无需传递额外参数，可不加该参数
      method: 'POST', //如果无需自定义HTTP类型，可不加该参数
      toolbar: '#toolbarDemo', //开启头部工具栏，并为其绑定左侧模板
      defaultToolbar: [
        'filter',
        'exports',
        'print',
        {
          //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
          title: `<?php echo $languageObj['提示']['name_' . $language]; ?>`,
          layEvent: 'LAYTABLE_TIPS',
          icon: 'layui-icon-tips'
        }
      ],

      even: true,
      title: `<?php echo $languageObj['顶级分类']['name_' . $language]; ?>`,
      height: 'full-150',

			parseData: function (res) {
				res.data.forEach(d => {
					if (d.zhu == '否') {
						d.zhu2 = `<?php echo $languageObj['否']['name_' . $language]; ?>`
					} else if (d.zhu == '是') {
						d.zhu2 = `<?php echo $languageObj['是']['name_' . $language]; ?>`
					}
				})

				return res
      },
			
      cols: [
        [
          { type: 'checkbox' },
          { field: 'Id', title: 'ID', width: 80, unresize: true, sort: true },
          {
            field: 'name',
            title: `<?php echo $languageObj['分类名称']['name_' . $language]; ?>`,
            width: 300
          },

          {
            field: 'sort',
            title: `<?php echo $languageObj['排序']['name_' . $language]; ?>`,
            width: 60
          },

          {
            field: 'create_time',
            title: `<?php echo $languageObj['加入时间']['name_' . $language]; ?>`,
            width: 200,
            sort: true
          },
          {
            field: 'beizhu',
            title: `<?php echo $languageObj['分类备注']['name_' . $language]; ?>`,
            width: 300
          },
          {
            field: 'zhu2',
            title: `<?php echo $languageObj['是否推荐']['name_' . $language]; ?>`,
            width: 130
          },
          {
            field: 'wealth',
            title: `<?php echo $languageObj['操作']['name_' . $language]; ?>`,
            toolbar: '#currentTableBar',
            width: 200
          }
        ]
      ],
      //动态表格 添加下面的代码
      done: function (res, curr, count) {
        //赋值到添加分类
        if (res.data) {
          res.data.forEach(x => {
            console.log(x.Id)
            html +=
              '<option value="' +
              x.Id +
              '" level="' +
              x.level +
              '">' +
              x.name +
              '</option>'
          })
        }

        $("select[name='top-class']").html(html)
        $("select[name='top-class2']").html(html)
        //赋值到添加分类
        var data = res.data
        $('th').css({ color: 'black' })

        for (var i in data) {
          $("tr[data-index='" + i + "']").attr('cate-id', data[i].Id)
          $("tr[data-index='" + i + "']").attr('parent_id', data[i].parent_id)
          $("tr[data-index='" + i + "']").attr('data-name', data[i].name)
          //$("tr[data-index='" + i+ "']").attr('onclick',"showTree(this)");
          $("td[data-field='name']").attr('onclick', 'showTree(this)')
          $("tr[data-index='" + i + "']").attr('status', 'true')
          $("tr[data-index='" + i + "']").attr('level', data[i].level)
          if (data[i].parent_id == 0) {
            $("tr[data-index='" + i + "']")
              .find("td[data-field='name']")
              .children()
              .html('<i class="layui-icon x-show">&#xe623;</i>' + data[i].name)
          }
        }
        $("tbody tr[parent_id!='0']").hide()
      }
    })

    /**
     * toolbar监听事件
     */
    table.on('toolbar(currentTableFilter)', function (obj) {
      var data = obj.data //获得当前行数据
      var layEvent = obj.event //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）

      if (obj.event === 'add') {
        // 监听添加操作
        layer.open({
          title: `<?php echo $languageObj['添加分类']['name_' . $language]; ?>`,
          type: 1,
          shade: 0.2,
          maxmin: true,
          anim: 1,
          shadeClose: true,
          area: ['35%', '47%'],
          content: $('.add-class')
        })

        // $(window).on("resize", function () {
        //     layer.full(index);
        // });
      } else if (obj.event === 'piliang') {
        var checkStatus = table.checkStatus('currentTableId')
        pldata = checkStatus.data
        if (pldata == '') {
          layer.msg(`<?php echo $languageObj['请选择分类']['name_' . $language]; ?>`)
          return false
        }

        layer.open({
          title: `<?php echo $languageObj['批量编辑分类至']['name_' . $language]; ?>`,
          type: 1,
          shade: 0.2,
          maxmin: true,
          anim: 1,
          shadeClose: true,
          area: ['35%', '47%'],
          content: $('.pl-class')
        })
      } else if (obj.event === 'delete') {
        // 监听删除操作
        var checkStatus = table.checkStatus('currentTableId'),
          data = checkStatus.data

        console.log(data)
        if (data == '') {
          layer.msg(`<?php echo $languageObj['请选择数据']['name_' . $language]; ?>`)
        } else {
          layer.confirm(
            `<?php echo $languageObj['删除选中的数据吗']['name_' . $language]; ?>`,
            function (index) {
              layer.close(index)
              $.ajax({
                type: 'post', // 规定请求的类型（GET 或 POST）
                url: '/login.php/newsad/delclass', // 请求的url地址
                cache: false, // 否在缓存中读取数据的读取
                dataType: 'json', //预期的服务器响应的数据类型
                data: {
                  data: data,
                  formname: '<?php echo $formname; ?>'
                }, //规定要发送到服务器的数据
                success: function (res) {
                  if (res.code == 1) {
                    //执行表格重载
                    table.reload('currentTableId')
                  }
                }
              }) //ajax
            }
          )
        }
      }
    })

    //监听表格复选框选择
    table.on('checkbox(currentTableFilter)', function (obj) {
      console.log(obj)
    })

    table.on('tool(currentTableFilter)', function (obj) {
      $("select[name='top-class']").html(html) //编辑时重新赋值option
      $("select[name='top-class2']").html(html)
      var data = obj.data
      var tr = obj.tr //获得当前行 tr 的 DOM 对象（如果有的话）
      var trid = $($(tr).find('td')[1]).text()
      classname = $($(tr).find('td')[2]).text() //获取当前行类名
      sort = $($(tr).find('td')[3]).text() //获取当前行排序
      beizhu = $($(tr).find('td')[5]).text() //获取当前行排序
      edilevel = $(tr).attr('level') //当前等级
      img = data.ico
      if (obj.event === 'edit') {
        var index = layer.open({
          title: `<?php echo $languageObj['编辑分类']['name_' . $language]; ?>`,
          type: 1,
          shade: 0.2,
          maxmin: true,
          anim: 1,
          shadeClose: true,
          area: ['45%', '70%'],
          content: $('.editclass')
        })
        $(window).on('resize', function () {
          layer.full(index)
        })

        classname = classname.replace(/(^\s*)|(\s*$)/g, '')
        classname = classname.replace('|--', '')
        classname = classname.replace('', '')
        classname = classname.replace('', '')
        $('.now-class').text(classname)
        $("input[name='ediname']").attr('value', classname) //编辑时赋值名字
        $("input[name='sort']").attr('value', sort) //编辑时赋值排序
        $("input[name='beizhu']").attr('value', beizhu) //编辑时赋值备注
        $('.now-class').attr('dataid', trid)

        if (img == null) {
          $('#editimg').attr('src', '/static/img/admin/news_slt.jpg')
        } else {
          $('#editimg').attr('src', img)
        }

        let result = true
        let rt = true
        let num = 0
        $('.edi-top-class option').each(function () {
          var res = $(this).text()
          level = $(this).attr('level')

          if (res == classname) {
            $(this).remove()
            rt = false //记录为已经入当前类
            num = 0
          }
          if (edilevel == 0) {
            if (level == 0) {
              num++
            }

            if (rt == false && level == 0 && num > 1) {
              result = false
              return false
            } else {
              if (rt == false && edilevel < level && num == 1) {
                $(this).remove()
              }
            } //跳出循环
          } else {
            if (rt == false && level == 0) {
              result = false
              return false
            } //跳出循环

            if (rt == false && edilevel < level) {
              $(this).remove()
            }
          }
        }) //通过一系列循环操作，删除自己的子类，因为上级分类不能为子类

        if (!result) {
          return false
        } //跳出each循环

        return false
      } else if (obj.event === 'delete') {
        layer.confirm(
          `<?php echo $languageObj['确定删除数据吗']['name_' . $language]; ?>`,
          function (index) {
            obj.del()
            layer.close(index)
            $.ajax({
              type: 'post', // 规定请求的类型（GET 或 POST）
              url: '/login.php/newsad/delclass', // 请求的url地址
              cache: false, // 否在缓存中读取数据的读取
              dataType: 'json', //预期的服务器响应的数据类型
              data: {
                trid: trid,
                formname: '<?php echo $formname; ?>'
              } //规定要发送到服务器的数据
            }) //ajax
          }
        )
      } else if (obj.event === 'tuij') {
        $.ajax({
          type: 'post', // 规定请求的类型（GET 或 POST）
          url: '/login.php/newsad/tuij', // 请求的url地址
          cache: false, // 否在缓存中读取数据的读取
          dataType: 'json', //预期的服务器响应的数据类型
          data: {
            id: trid,
            formname: 'productc'
          }, //规定要发送到服务器的数据
          success: function (s) {
            if (s.code == 1) {
              layer.msg(`<?php echo $languageObj['设置成功']['name_' . $language]; ?>`)
              //执行表格重载
              //table.reload('currentTableId');
            } else {
              layer.msg(`<?php echo $languageObj['设置失败']['name_' . $language]; ?>`)
            }
          }
        }) //ajax
      }
    })
  }) //layui use

  function showTree(e) {
    if ($(e).parents('tr:first').attr('status') == 'true') {
      $(e).parents('tr:first').find('.x-show').html('&#xe625;')
      $(e).parents('tr:first').attr('status', 'false')
      cateId = $(e).parents('tr:first').attr('cate-id')
      $arr = []
      $('tbody tr[parent_id=' + cateId + ']').each(function (index, el) {
        id = $(el).attr('cate-id')
        console.log('id' + id)
        if ($arr[0] == id) {
          return false
        }
        $arr.push(id)
        var child_cateId = $('tbody tr[parent_id=' + id + ']').attr('cate-id')

        var level = $('tbody tr[cate-id=' + id + ']').attr('level')
        var space = printSpace(level)

        if (typeof child_cateId != 'undefined') {
          $('tbody tr[cate-id=' + id + ']')
            .find("td[data-field='name']")
            .children()
            .html(
              space +
                '<i class="layui-icon x-show">&#xe623;</i>' +
                $('tbody tr[cate-id=' + id + ']').attr('data-name')
            )
        } else {
          $('tbody tr[cate-id=' + id + ']')
            .find("td[data-field='name']")
            .children()
            .html(
              space +
                '<i class="layui-icon x-show"> |--</i>' +
                $('tbody tr[cate-id=' + id + ']').attr('data-name')
            )
          $('tbody tr[cate-id=' + id + ']').attr('onclick', '')
        }
      })

      $('tbody tr[parent_id=' + cateId + ']').show()
    } else {
      cateIds = []
      $(e).parents('tr:first').find('.x-show').html('&#xe623;')
      $(e).parents('tr:first').attr('status', 'true')

      cateId = $(e).parents('tr:first').attr('cate-id')
      getCateId(cateId)
      for (var i in cateIds) {
        $('tbody tr[cate-id=' + cateIds[i] + ']')
          .hide()
          .find('.x-show')
          .html('&#xe623;')
          .attr('status', 'true')
      }
    }
  }

  var cateIds = []
  function getCateId(cateId) {
    $('tbody tr[parent_id=' + cateId + ']').each(function (index, el) {
      id = $(el).attr('cate-id')
      if (cateIds[0] == id) {
        return false
      }
      cateIds.push(id)
      getCateId(id)
    })
  }
  // 打印空格
  function printSpace(level) {
    var str = '&nbsp;'
    if (level > 0) {
      for (var i = 0; i < level * 6; i++) {
        str = str + '&nbsp;'
      }
    }
    return str
  }
</script>

<style type="text/css">
  .pl-class {
    width: 100%;
    display: none;
  }
</style>
<div class="pl-class layui-form">
  <div style="display: flex; margin-top: 30px; margin-left: 15px">
    <span style="line-height: 40px"
      ><?php echo $languageObj['请选择上级分类']['name_' . $language]; ?>：</span
    >
    <select name="top-class2" style="width: 30%"></select>
    &nbsp; &nbsp;<input
      class="layui-input"
      style="width: 20%; height: 35px"
      type="text"
      name="selname2"
      placeholder="<?php echo $languageObj['关键词']['name_' . $language]; ?>"
    />
    &nbsp; &nbsp;<button class="layui-btn layui-bg-cyan selbtn3" type="button">
      <?php echo $languageObj['搜索']['name_' . $language]; ?>
    </button>
  </div>
  <br /><br />
  <div class="add-cliass-button" style="margin-right: 50px">
    <button
      type="button"
      class="layui-btn layui-btn-primary layui-layer-close layui-layer-close1"
      style="position: relative"
    >
      <?php echo $languageObj['取消']['name_' . $language]; ?>
    </button>
    <button type="button" class="layui-btn pl-class-submit">
      <?php echo $languageObj['确定']['name_' . $language]; ?>
    </button>
  </div>
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

    //搜索
    $('.selbtn3').click(function () {
      var selname2 = $("input[name='selname2']").val()
      $.post(
        '/login.php/newsad/selclass?formnam=productc&selname=' + selname2,
        function (str) {
          htmlsel2 = `<option value="0"><?php echo $languageObj['顶级分类']['name_' . $language]; ?></option>`
          str.forEach(x => {
            console.log(x)
            htmlsel2 +=
              '<option value="' +
              x.Id +
              '" level="' +
              x.level +
              '">' +
              x.name +
              '</option>'
          })
          $("select[name='top-class2']").html(htmlsel2)
          layer.msg(`<?php echo $languageObj['搜索成功']['name_' . $language]; ?>`)
          form.render() //刷新select选择框渲染
        }
      )
    })
    $('.pl-class-submit').click(function () {
      topid2 = $("select[name='top-class2']").val()

      if (!topid2) {
        layer.msg(`<?php echo $languageObj['请选择顶级分类']['name_' . $language]; ?>`)
      } else {
        $.ajax({
          type: 'POST', // 规定请求的类型（GET 或 POST）
          url: '/login.php/newsad/pledi_class', // 请求的url地址
          cache: true, // 否在缓存中读取数据的读取
          dataType: 'json', //预期的服务器响应的数据类型
          data: {
            data: JSON.stringify(pldata),
            topid: topid2,
            formname: '<?php echo $formname; ?>'
          }, //规定要发送到服务器的数据

          success: function (res) {
            // 当请求成功时运行的函数
            if (res.code == 1) {
              layer.msg(
                `<?php echo $languageObj['操作成功']['name_' . $language]; ?>`,
                {
                  icon: 1,
                  shade: 0.05,
                  time: 800
                },
                function () {
                  window.location.href =
                    '/login.php/admin/loadright?page=newsclass&formname=<?php echo $formname; ?>'
                }
              )
            } else if (res.code == 3) {
              layer.msg(
                `<?php echo $languageObj['不能选择自己为顶级分类']['name_' . $language]; ?>`,
                {
                  icon: 2,
                  shade: 0.05,
                  time: 800
                }
              )
            } else {
              layer.msg(`<?php echo $languageObj['操作失败']['name_' . $language]; ?>`, {
                icon: 2,
                shade: 0.05,
                time: 800
              })
            }
          },
          error: function (result) {
            //失败的函数
            layer.msg('服务器故障！', {
              icon: 2,
              shade: 0.05,
              time: 800
            })
          }
        }) //ajax-end
      }
    })
  }) //formend
</script>

<style type="text/css">
  .add-class {
    display: none;
    margin: 30px auto;
  }
  .add-class > div {
    width: 90%;
    margin: 5% 20px 5% 20px;
    display: flex;
  }
  .add-class > div > span {
    width: 130px;
    color: #666;
  }
  .add-class > div > input {
    width: 320px;
    height: 30px;
    padding-left: 6px;
    display: inline;
  }
  .add-class > div > select,
  .layui-form-select {
    width: 35%;
    height: 35px;
  }
  .add-cliass-button {
    text-align: right;
    justify-content: center;
  }
  select {
    cursor: pointer;
  }
</style>
<div class="add-class layui-form">
  <div>
    <span style="line-height: 30px"
      ><?php echo $languageObj['请输入分类名称']['name_' . $language]; ?>：</span
    >
    <input class="layui-input" name="name" type="text" class="text" />
  </div>
  <div>
    <span style="line-height: 40px"
      ><?php echo $languageObj['请选择分类语言']['name_' . $language]; ?>：</span
    >
    <select name="laug" lay-filter="aihao">
      <option value="简体中文">简体中文</option>
    </select>
  </div>
  <div>
    <span style="line-height: 40px"
      ><?php echo $languageObj['请选择上级分类']['name_' . $language]; ?></span
    >
    <select name="top-class"></select>
    &nbsp; &nbsp;<input
      class="layui-input"
      style="width: 20%; height: 35px"
      type="text"
      name="selname"
      placeholder="<?php echo $languageObj['关键词']['name_' . $language]; ?>"
    />
    &nbsp; &nbsp;<button class="layui-btn layui-bg-cyan selbtn" type="button">
      <?php echo $languageObj['搜索']['name_' . $language]; ?>
    </button>
  </div>
  <div class="add-cliass-button">
    <button
      type="button"
      class="layui-btn layui-btn-primary layui-layer-close layui-layer-close1"
      style="position: relative"
    >
      <?php echo $languageObj['取消']['name_' . $language]; ?>
    </button>
    <button type="button" class="layui-btn add-class-submit">
      <?php echo $languageObj['确定']['name_' . $language]; ?>
    </button>
  </div>
</div>

<script type="text/javascript">
  $(function () {
    $('.add-class-submit').click(function () {
      name = $("input[name='name']").val()
      laug = $("select[name='laug']").val()
      topid = $("select[name='top-class']").val()

      if (!name || !topid) {
        layer.msg(`<?php echo $languageObj['请填写完整分类信息']['name_' . $language]; ?>`)
      } else {
        $.ajax({
          type: 'POST', // 规定请求的类型（GET 或 POST）
          url: '/login.php/newsad/addclass', // 请求的url地址
          cache: true, // 否在缓存中读取数据的读取
          dataType: 'json', //预期的服务器响应的数据类型
          data: {
            name: name,
            laug: laug,
            topid: topid,
            formname: '<?php echo $formname; ?>'
          }, //规定要发送到服务器的数据

          success: function (res) {
            // 当请求成功时运行的函数
            if (res.code == 1) {
              layer.msg(
                `<?php echo $languageObj['添加成功']['name_' . $language]; ?>`,
                {
                  icon: 1,
                  shade: 0.05,
                  time: 800
                },
                function () {
                  window.location.href =
                    '/login.php/admin/loadright?page=newsclass&formname=<?php echo $formname; ?>'
                }
              )
            } else {
              layer.msg(`<?php echo $languageObj['保存失败']['name_' . $language]; ?>`, {
                icon: 2,
                shade: 0.05,
                time: 800
              })
            }
          },
          error: function (result) {
            //失败的函数
            layer.msg('服务器故障！', {
              icon: 2,
              shade: 0.05,
              time: 800
            })
          }
        }) //ajax-end
      }
    })
  })
</script>

<style type="text/css">
  .layui-layer-page .layui-layer-content {
    overflow: initial;
  }

  .editclass {
    display: none;
    margin: 0px auto 30px auto;
  }
  .editclass p {
    color: #999 !important;
    font-size: 12px;
    margin: 3% 20px 2% 20px;
  }
  .editclass > div {
    width: 90%;
    margin: 2% 20px 2% 20px;
  }
  .editclass > div > span {
    color: #666;
  }
  .editclass > div > input {
    width: 48.5%;
    border: 0.1rem solid gainsboro;
    height: 30px;
    padding-left: 6px;
  }
  .editclass > div > select {
    width: 329.2px;
    border: 0.1rem solid gainsboro;
    height: 35px;
  }
  .edi-cliass-button {
    text-align: right;
  }
  #editimg {
    width: 100px;
    height: 100px;
  }
  .layui-form-select {
    margin-left: 4px;
  }
</style>
<div class="editclass layui-form">
  <p>
    <?php echo $languageObj['修改文章分类, 支持无限级分类, 当前分类：']['name_' .
    $language]; ?><span class="now-class"></span>
  </p>
  <div>
    <span><?php echo $languageObj['分类图片']['name_' . $language]; ?>：</span
    ><img src="/static/img/admin/news_slt.jpg" id="editimg" />
  </div>
  <div style="display: flex">
    <span style="line-height: 40px"
      ><?php echo $languageObj['上级分类']['name_' . $language]; ?>：</span
    >
    <select name="top-class" class="edi-top-class"></select>
    &nbsp; &nbsp;<input
      class="layui-input"
      style="width: 20%; height: 35px"
      type="text"
      name="selname2"
      placeholder="<?php echo $languageObj['关键词']['name_' . $language]; ?>"
    />
    &nbsp; &nbsp;<button class="layui-btn layui-bg-cyan selbtn2" type="button">
      <?php echo $languageObj['搜索']['name_' . $language]; ?>
    </button>
  </div>
  <div>
    <span style="line-height: 10px"
      ><?php echo $languageObj['类别标题']['name_' . $language]; ?>：</span
    >
    <input name="ediname" type="text" class="text" />
  </div>
  <div style="display: flex">
    <span style="line-height: 40px"
      ><?php echo $languageObj['所属语言']['name_' . $language]; ?>：</span
    >
    <select name="edilaug">
      <option value="简体中文">简体中文</option>
    </select>
  </div>
  <div>
    <span style="line-height: 10px"
      ><?php echo $languageObj['排序字段']['name_' . $language]; ?>：</span
    >
    <input name="sort" type="text" class="text" />
  </div>
  <div>
    <span style="line-height: 10px"
      ><?php echo $languageObj['备注信息']['name_' . $language]; ?>：</span
    >
    <input name="beizhu" type="text" class="text" />
  </div>
  <div class="edi-cliass-button">
    <button
      type="button"
      class="layui-btn layui-btn-primary layui-layer-close layui-layer-close1 edit-close"
      style="position: relative"
    >
      <?php echo $languageObj['取消']['name_' . $language]; ?>
    </button>
    <button type="button" class="layui-btn edi-class-submit">
      <?php echo $languageObj['确定']['name_' . $language]; ?>
    </button>
  </div>
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

    //搜索

    $('.selbtn').click(function () {
      var selname = $("input[name='selname']").val()
      $.post(
        '/login.php/newsad/selclass?formnam=productc&selname=' + selname,
        function (str) {
          htmlsel = `<option value="0"><?php echo $languageObj['顶级分类']['name_' . $language]; ?></option>`
          str.forEach(x => {
            console.log(x)
            htmlsel +=
              '<option value="' +
              x.Id +
              '" level="' +
              x.level +
              '">' +
              x.name +
              '</option>'
          })
          $("select[name='top-class']").html(htmlsel)
          form.render() //刷新select选择框渲染
        }
      )
    })

    $('.selbtn2').click(function () {
      var selname2 = $("input[name='selname2']").val()
      $.post(
        '/login.php/newsad/selclass?formnam=productc&selname=' + selname2,
        function (str) {
          htmlsel2 = `<option value="0"><?php echo $languageObj['顶级分类']['name_' . $language]; ?></option>`
          str.forEach(x => {
            console.log(x)
            htmlsel2 +=
              '<option value="' +
              x.Id +
              '" level="' +
              x.level +
              '">' +
              x.name +
              '</option>'
          })
          $('.edi-top-class').html(htmlsel2)

          let result = true
          let rt = true
          let num = 0
          $('.edi-top-class option').each(function () {
            var res = $(this).text()
            level = $(this).attr('level')

            if (res == classname) {
              $(this).remove()
              rt = false //记录为已经入当前类
              num = 0
            }
            if (edilevel == 0) {
              if (level == 0) {
                num++
              }

              if (rt == false && level == 0 && num > 1) {
                result = false
                return false
              } else {
                if (rt == false && edilevel < level && num == 1) {
                  $(this).remove()
                }
              } //跳出循环
            } else {
              if (rt == false && level == 0) {
                result = false
                return false
              } //跳出循环

              if (rt == false && edilevel < level) {
                $(this).remove()
              }
            }
          }) //通过一系列循环操作，删除自己的子类，因为上级分类不能为子类

          if (!result) {
            return false
          } //跳出each循环
          form.render() //刷新select选择框渲染
        }
      )
    })
    //搜索
  })
</script>

<script type="text/javascript">
  $(function () {
    // 利用layui来上传图片
    layui.use('upload', function () {
      var upload = layui.upload

      //执行实例
      var uploadInst = upload.render({
        elem: '#editimg', //绑定元素
        url: '/login.php/admin/basicicoapi', //缩略图上传
        exts: 'jpg|png|jpeg',
        multiple: true,
        number: 5,
        drag: true,
        data: {},
        before: function (obj) {
          //预读本地文件示例，不支持ie8
          layer.msg('图片上传中...', {
            icon: 16,
            shade: 0.05,
            time: 500
          })
        },
        done: function (res) {
          //上传完毕回调
          $('#editimg').attr('src', res.filepath)
          //  console.log(res.filepath); //图片文件的路径
          news_slt = res.filepath //赋值给photo 传给ajax丢数据
        },
        error: function (res) {
          //请求异常回调

          console.log(res)
        }
      })
    })

    // 利用layui来上传图片

    $('.edi-class-submit').click(function () {
      ediname = $("input[name='ediname']").val()
      edilaug = $("select[name='edilaug']").val()
      editopid = $('.edi-top-class').val()
      sort = $("input[name='sort']").val()

      beizhu = $("input[name='beizhu']").val()

      dataid = $('.now-class').attr('dataid') //当前编辑的ID
      img = $('#editimg').attr('src')

      if (!ediname || !editopid) {
        layer.msg(
          `<?php echo $languageObj['请填写完整分类信息且分类不能相同！']['name_' . $language]; ?>`
        )
      } else {
        $.ajax({
          type: 'POST', // 规定请求的类型（GET 或 POST）
          url: '/login.php/newsad/ediclass', // 请求的url地址
          cache: true, // 否在缓存中读取数据的读取
          dataType: 'json', //预期的服务器响应的数据类型
          data: {
            Id: dataid,
            name: ediname,
            laug: edilaug,
            topid: editopid,
            formname: '<?php echo $formname; ?>',
            sort: sort,
            img: img,
            beizhu: beizhu
          }, //规定要发送到服务器的数据

          success: function (res) {
            // 当请求成功时运行的函数
            if (res.code == 1) {
              layer.msg(
                `<?php echo $languageObj['编辑成功']['name_' . $language]; ?>`,
                {
                  icon: 1,
                  shade: 0.05,
                  time: 800
                },
                function () {
                  window.location.href =
                    '/login.php/admin/loadright?page=newsclass&formname=<?php echo $formname; ?>'
                }
              )
            } else {
              layer.msg(
                `<?php echo $languageObj['请勿选择当前分类的子类']['name_' . $language]; ?>`,
                {
                  icon: 2,
                  shade: 0.05,
                  time: 800
                }
              )
            }
          },
          error: function (result) {
            //失败的函数
            layer.msg('服务器故障！', {
              icon: 2,
              shade: 0.05,
              time: 800
            })
          }
        }) //ajax-end
      }
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
		