# abracadabra
效果展示：http://lab.malic.xyz/bullshitGenerator/

语料库在store/

想添加语料直接新增一行加入即可。
（其中谚语proverbs是json格式，其它的是纯文本）

gen.php用get方法获取了事件EVENT、最小长度length、计数方法是单字还是句数addChar、是否开启手写writtenFont

首页index.html用ajax获取gen.php返回的内容
