<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title>跳转提示 - eStudy</title>
	<style type="text/css">
/* CSS Document */
/* 清除内外边距 */
body,
h1,
h2,
h3,
h4,
h5,
h6,
hr,
p,
blockquote,
dl,
dt,
dd,
ul,
ol,
li,
pre,
fieldset,
lengend,
button,
input,
textarea,
th,
td {
  /* table elements 表格元素 */
  margin: 0;
  padding: 0;
}
/* 设置默认字体 */
body,
button,
input,
select,
textarea {
  /* for ie */
  font: 12px/1 "微软雅黑", Arial, Tahoma, Helvetica, "\5b8b\4f53", sans-serif;
  /* 用 ascii 字符表示，使得在任何编码下都无问题 */
}
body {
  position: relative;
}
address,
cite,
dfn,
em,
var,
i {
  font-style: normal;
}
/* 将斜体扶正 */
/* 重置列表元素 */
ul,
ol {
  list-style: none;
}
/* 重置文本格式元素 */
a {
  text-decoration: none;
}
a:hover {
  text-decoration: underline;
  transition: all 0.5s ease 0s;
  color: #0B7DF2;
}
/* 去除a标签点击后的虚线框 */
a:focus {
  outline: none;
  text-decoration: none;
  -moz-outline: none;
}
/* 重置表单元素 */
button,
input,
select,
textarea {
  font-size: 100%;
  /* 使得表单元素在 ie 下能继承字体大小 */
}
input {
  outline: none;
}
/* 重置表格元素 */
table {
  border-collapse: collapse;
  border-spacing: 0;
}
/* 重置 hr */
hr {
  border: none;
  height: 1px;
}
/*设置textarea固定大小*/
textarea {
  resize: none;
}
img {
  vertical-align: middle;
}
* {
  box-sizing: border-box;
}
    	.xb-h-100 {
  width: 100%;
  height: 100px;
}
.xb-out {
  display: table;
  width: 100%;
}
.bjy-public-jump {
  margin: 0 auto;
  padding: 50px 100px;
  width: 455px;
  height: 195px;
  border: 2px solid #00CCC0;
  border-radius: 4px;
  text-align: center;
}
.bjy-public-jump .bjy-pj-word {
  width: 100%;
  height: 30px;
  line-height: 30px;
  font-size: 16px;
}
.bjy-public-jump .bjy-pj-word b {
  color: #00CCC0;
}

    </style>
	<bootstrapcss />
</head>
<body>

	<div class="xb-h-100"></div>
	<div class="xb-out">
		<ul class="bjy-public-jump">
			<li class="bjy-pj-word"> <b>{$message}{$error}</b>
			</li>
			<li class="bjy-pj-word">
				页面将在 <b id="wait">{$waitSecond}</b>
				秒后
				<a id="href" href="{$jumpUrl}">跳转</a>
			</li>
		</ul>
	</div>

	<bootstrapjs />
	<script type="text/javascript">
(function(){
    var wait = document.getElementById('wait'),href = document.getElementById('href').href;
    var interval = setInterval(function(){
        var time = --wait.innerHTML;
        if(time <= 0) {
            location.href = href;
            clearInterval(interval);
        };
    }, 1000);
})();
</script></body>
</html>
