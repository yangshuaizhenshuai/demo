<?php
return [
		//应用ID,您的APPID。
		'app_id' => "2016092500595998",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEpAIBAAKCAQEAtQRyLsyk2Q2TuE59oBb6trUEkJBa0cCOBI9c/+D+y9sJpae6a+MpCX35q2KYnLH0WN6Wcn2IX+pw9XGeKZ4Rzo7C8hrXhXR16+6E3b5wrjLaejQ+PysbItx3ftH7f9YX1dkkMLI8GHhdJzTMIwQDH1Si3ZjeCJGQ6L4v98h4NwSFPrUFjythPZBIN9bYshz1YwOEZFaLi5pLJfC5Gp9S+rOrJE1gp6wH6q11Y5W00zenleQpSBsqcmX/8XcNYm8yoLxeZft/E259T636mD+aPjnzPrMoH0HKKVPJ4tuu6cVzw3YZPJLiuOMJ5jvTZTFDePZebwil3/9WEptX0ivRHQIDAQABAoIBAQCXcDzGglZ3cDBhROk8gX0GVbKX7uzMBjfKANZhC66ehYUwnX4MvGKcmlPB2h6rGQW/Q5jB99ubwtr1vDQBxUhIco8NVP9xmtj8pPNrP+OtGMZG7mYVGs78/0zJQIsTi90s/xiT1MkJ/8iPAFC4CqdCEuCeW0GGEaIV1Ob0eTZ5b1pl6nzeKuHBDEnE9ofHpH2sxsPwEIGuiXr+KXbhPnQjrbdIZNd95YRArvB1Hn4Sx+Yivr/bewzv1RF9AMSD0dBNNSE4KgRpfoui+bfYThXoyArqBmKd2I2aQTMaWk8Q0xtebR/izlkx8etw4Bsd8FrgS1YL0eqA31sro6HNMPEBAoGBAN1M8Ld0j/CNizRiaPb4GEhcsnbYIkePYUIbYFdRyoJU1Chmycg7VcxpPF1rIOYByVx+d+xs4DyA8IO7vGkvAjW7XXqnYxYwzeYuXTmxq6altRyzxDkBqxLpzkUUzY/cOC+HSkEC+NEXGiEAD4M/QgAe2mYHBm2yj5OsxJJuWMJNAoGBANFmh1my9ArTZwXlJ0yonESBK03gFCI48b1Ywr90IHLhqreCrqU9wLKYkTGAS8d45QQgdUihgYZnyNBgJtiysiDHPRekBapBbz3UjF/sInGOVL9MpA59vVw5WF8BbYiK18kEt9oq7iafgqkfyuCaH8fz5pAjilxlpPgBGl+i05IRAoGAFfjssZpeLEkxeBsJRvQtHQovIgOlq6s9wd2L/D9/tt8LTZOfF0Vk6G3Oc4wOcSfeQVPBPnU08mzu9HVwaJUlSAZ5apMyEGL6Ho+d6/uLCnnLeLUUl4Bl5vPV6h/9pPn9jiKFqdzMrZ34lyw1Xheqyu5FSvoJllyzSrtNrShNocUCgYBlDZCmBgllrA2ct7CWewwmtxs50riEp2xpzwr0r8r1BdiIBOXZUorK5Xu0ItDvK3WB31QaP+6s+Src/Hniu6Hg1aWy4fHl7vwLH6a6p88bc++L/iVx5NZcSkROXPcKHM7z8HX1MCCLvRCmI3SZnWdW7GpJBw2/d0H8eTPMEVz+sQKBgQCpSFPbbdNLnVtdFo0XeZwBFcKFThhq9F74S0feFzgbZ3yxEebcb5eUGaplTKALex0gP5Rz5ZPz7HFkH+HQsKGs9y5qXjeAT+9vuhqi0/47u4PoYuMXny2HyNOLsAQwlWNS4xcL23+S+/0vL9MNs42jbnxUVJ7BUjCAnOaMxVi5qg==",
		
		//异步通知地址
		'notify_url' => "http://www.wshop.com/alipay/notify",
		
		//同步跳转
		'return_url' => "http://www.wshop.com/alipay/return",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAulbGunInI8mg6innbFUM/BydraXMWs0TRquWFdfUEKX6AJXEhmkHEe2ZEZZfqoP1K8zUMjR1zPRjSHQ/KeqQeHduchXbwe/SwRYa89r8KmGNZSeUIhMuQkUtyT0Sdz/vZhStNg3RQTCJ+xtOmQPoUAxgrECD7MVNyM1k1oruyf13pJspdIOMl90Qz2Vz2F2a5/lJWt3+e/3gR/Zmbq3frALNRV49KIyRo0R9LiReMsNEAnHBObC4yte9yYqq76oJ7cT/Nq/mn7Xc7uUQgWM1oN9J7oa3cogZBZKqPaLYjCmG4fQW3cr4vPSOqcxdgxnHenBjuEvUsIXnJucnDq5yPQIDAQAB",
		
		//标识沙箱
		"mode"=>"dev"
	];