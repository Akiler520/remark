##wechat upload image

 > GET /material

description: 

as the API 'uploadimg' will not return the 'media_id', so I used API 'add_material', then we can get both the 'media_id' and the url of the image; 
   
return:

	{
		"status":1,
		"msg":"success",
		"data":
			{
			"media_id":"rbfy2TYcVc5Zx8G-vSsyLN-RPCeBFLE1D8VAeB3tMMI",
			"url":"http://mmbiz.qpic.cn/mmbiz_jpg/6McPlqgiaxLP0ibh75lXDfJ3a35Nn1n8icNnQ3YRUFYnH7dDykL6HicdS0eB41uqHXicWjqv4C1AA2B43DzVloL61IA/0?wx_fmt=jpeg"}
	}

## add hyperlink to a string

 > GET /hyperlink/addHyperlink

return:

<a href='Chinese'>Chinese</a>是中国人的意思，<a href='Chinese companies'>Chinese companies</a>是什么意思? <a href='Chinese'>Chinese</a> 与 <a href='Chinese companies'>Chinese companies</a> 是什么关系？<a href='Chinese companies'>Chinese companies</a>不能代替<a href='Chinese'>Chinese</a>. <a href='United States'>United States</a>是美国，<a href='United States of America'>United States of America</a>也是美国，但<a href='United States'>United States</a>也不能代替<a href='United States of America'>United States of America</a>

## test

run command:

1. phpunit TestMaterial

2. phpunit TestHyperlink

