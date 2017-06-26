function getUE(){
  // 实例化UEditor编辑器
  var ue = UE.getEditor('editor', {
    toolbars: [
        [
          'fullscreen',
          'source',
          '|',
          'undo',
          'redo',
          'removeformat', //清楚格式
          '|',
          'bold',
          'italic',
          'underline',
          'superscript',
          'subscript',
          'blockquote', //引用
          'pasteplain', //纯文本粘贴
          '|',
          'indent', //首行缩进
          'justifyleft', //居左对齐
          'justifyright', //居右对齐
          'justifycenter', //居中对齐
          'justifyjustify', //两端对齐
          'insertorderedlist', //有序列表
          'insertunorderedlist', //无序列表
          '|',
          'forecolor', 
          'backcolor',
          'fontsize', //字号
          'paragraph', //段落格式
        ],
        [
          'inserttable', //插入表格
          'edittable', //表格属性
          'edittd', //单元格属性
          'insertrow', //前插入行
          'insertcol', //前插入列
          'deleterow', //删除行
          'deletecol', //删除列
          'splittorows', //拆分成行
          'splittocols', //拆分成列
          'splittocells', //完全拆分单元格
          'mergecells', //合并多个单元格
          'deletetable', //删除表格
          '|',
          'simpleupload', //单图上传
          'insertimage', //多图上传
          'imagenone', //默认
          'imageleft', //左浮动
          'imageright', //右浮动
          'imagecenter', //居中
          '|',
          'link', //超链接
          'unlink', //取消链接
          '|',
          'cleardoc',
          'horizontal'
        ]
    ],
    autoHeightEnabled: true,
    autoFloatEnabled: true,
    initialFrameWidth: 'auto',
    initialFrameHeight: 350,
    insertorderedlist: {
      //系统自带
      'decimal': '' , //'1,2,3...'
      'lower-alpha': '' , // 'a,b,c...'
      'lower-roman': '' , //'i,ii,iii...'
      'upper-alpha': '' , //'A,B,C'
      'upper-roman': '' //'I,II,III...'
    },
    insertunorderedlist: {
      //系统自带
      'circle': '', // '○ 小圆圈'
      'disc': '', // '● 小圆点'
      'square': '' //'■ 小方块'
    },
    paragraph:{
      'p': '',
      'h2': '',
      'h3': '',
      'h4': '',
      'h5': '',
      'h6': ''
    }
  });
  return ue;
}