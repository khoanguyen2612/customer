<?php


	define("DOMAIN_NAME_RENEW", "domainNameRenew");
	define('DEFAULT_SS_CLOUD','OrderCloud');

	Configure::write(
		'CloudMonths', array(
		  "1" => "1 tháng",
		  "3" => "3 tháng",
		  "6" => "6 tháng",
		  "12" => "1 năm",
		  "24" => "2 năm",
		  "36" => "3 năm",
		  "48" => "4 năm",
		  "60" => "5 năm",
		  //  "120" => "10 năm",
		)
	);

	Configure::write(
		'SSLtime', array(
		  "1" => "1 năm",
		  "2" => "2 năm",
		  "3" => "3 năm",
		)
	);

	Configure::write(
		'interDomainhome', array('us', 'asia', 'eu', 'me', 'mobi', 'xxx', 'ws', 'jp', 'co', 'com.co', 'net.co', 'nom.co','bike'));

	Configure::write(
		'commonDomain', array('vn','com.vn','com','net','org','info','biz')
		);

	Configure::write(
		'vietnamDomainUtf8', array('com','net')
		);

	Configure::write(
		'vietnamDomain', array('net.vn','info.vn','org.vn','gov.vn','edu.vn','biz.vn','name.vn','pro.vn','health.vn','ac.vn')
		);

	Configure::write(
		'internationalDomain', array('us','cc','asia','eu','me','ws','name','tv','mobi','bz','mn','in','co.uk','me.uk',
									 'org.uk','jp','co','com.co','nom.co','net.co','tw','com.tw','org.tw','vc','sc','be','la','hn','so','xxx'
		)
	);

	Configure::write(
		'policyDomainInter', array('com','org','net','cc','asia','eu','me','ws','name','tv','mobi','bz','mn','in',
								   'jp','co','vc','sc','be','la','hn','so','xxx',
								   'tw','com.tw','org.tw','us','co.uk','me.uk','org.uk','biz','info'
		)
		);
	//Domain_type
	define("INTERNATIONAL_DOMAIN","0");
	define("VIETNAM_DOMAIN","1");
	//Domain_common)
	define("COMMON_DOMAIN","1");

	define("TRIAL_CLOUD_TIME", "9");
	define("FREE_CLOUD_TIME", "9");

	//Account types
	define('ACCOUNT_TYPE_ADMIN', 0);
	define('ACCOUNT_TYPE_REGISTER', 1);
	define('ACCOUNT_TYPE_DOMAIN', 2);
	define('ACCOUNT_TYPE_HOSTING', 3);
	define('ACCOUNT_TYPE_RESELLER', 4);
	define('ACCOUNT_TYPE_STAFF', 5);
	define('ACCOUNT_TYPE_ACCOUNTANT', 8);

	//Contact types
	define("CONTACT_TYPE_CONTACT", 0);
	define("CONTACT_TYPE_REGISTER", 1);
	define("CONTACT_TYPE_ADMIN", 2);
	define("CONTACT_TYPE_TECH", 3);
	define("CONTACT_TYPE_BILL", 4);
	define("CONTACT_TYPE_OTHER", 5);

	Configure::write(
			'contactType', array(
					CONTACT_TYPE_CONTACT => 'Contact',
					CONTACT_TYPE_REGISTER => 'Register',
					CONTACT_TYPE_ADMIN => 'Admin',
					CONTACT_TYPE_TECH => 'Tech',
					CONTACT_TYPE_BILL => 'Bill',
					CONTACT_TYPE_OTHER => 'Other'
			)
	);

	Configure::write(
		'DomainNameMore', array('com','net','biz','info','org','vn','com.vn','net.vn')
		);

	define("PAYMENT_METHOD_AT_VTC", "1");
	define("PAYMENT_METHOD_OFFICE", "2");
	define("PAYMENT_METHOD_ATM", "4");
	define("PAYMENT_METHOD_BANK", "5");
	define("PAYMENT_METHOD_CREDITCARD", "6");
	define("PAYMENT_METHOD_VTCPAY", "101");

	Configure::write(
			'payment_method', array(
					PAYMENT_METHOD_AT_VTC => "Thanh toán trực tiếp tại văn phòng của VTC Digicom",
					PAYMENT_METHOD_OFFICE => "Thu phí tận nơi",
					PAYMENT_METHOD_ATM => "Chuyển khoản qua ATM",
					PAYMENT_METHOD_BANK => "Chuyển khoản qua ngân hàng",
					PAYMENT_METHOD_CREDITCARD => "Thanh toán qua thẻ tín dụng",
					PAYMENT_METHOD_VTCPAY => "Thanh toán qua cổng thanh toán VTCPay",
			)
	);


	//VTC Payment integration information
	define("PAYMENT_VTCPAY_WEBSITE","http://alpha1.vtcpay.vn/wallet");
	define("PAYMENT_VTCPAY_PAY_URL","http://alpha1.vtcpay.vn/portalgateway/checkout.html");
	define("PAYMENT_VTCPAY_MERCHANT_ACCOUNT","0963465816");
	define("PAYMENT_VTCPAY_MERCHANT_PWD","Abcd1234");
	define("PAYMENT_VTCPAY_WALLET_ACCOUNT","01657758300");
	define("PAYMENT_VTCPAY_WALLET_PWD","Abcd1234");

	//define iNET API Integration information
	define("INET_API_ENABLE", TRUE);
	define('INET_API_USERNAME', 'tonvantruongbk@gmail.com');
	define('INET_API_PASSWORD', 'vtc12345');

	Configure::write(
		'country', array(
				'JP' => 'JAPAN',
				'US' => 'UNITED STATES',
				'AR' => 'ARGENTINA',
				'AU' => 'AUSTRALIA',
				'AT' => 'AUSTRIA',
				'BE' => 'BELGIUM',
				'BZ' => 'Belize',
				'BR' => 'BRAZIL',
				'BN' => 'BRUNEI',
				'KH' => 'CAMBODIA',
				'CA' => 'CANADA',
				'KY' => 'CAYMAN ISLANDS',
				'CN' => 'CHINA',
				'HR' => 'CROATIA',
				'CY' => 'CYPRUS',
				'CZ' => 'CZECH',
				'DK' => 'DENMARK',
				'EG' => 'EGYPT',
				'FI' => 'FINLAND',
				'FR' => 'FRANCE',
				'DE' => 'GERMANY',
				'GR' => 'GREECE',
				'HK' => 'HONG KONG',
				'IN' => 'INDIA',
				'ID' => 'INDONESIA',
				'IR' => 'IRAN',
				'IE' => 'IRELAND',
				'IL' => 'ISRAEL',
				'IT' => 'ITALY',
				'JE' => 'JERSEY',
				'JO' => 'JORDAN',
				'KE' => 'KENYA',
				'KR' => 'KOREA',
				'LB' => 'LEBANON',
				'LI' => 'LIECHTENSTEIN',
				'LU' => 'LUXEMBOURG',
				'MY' => 'MALAYSIA',
				'MX' => 'MEXICO',
				'MC' => 'MONACO',
				'MZ' => 'MOZAMBIQUE',
				'NL' => 'NETHERLANDS',
				'NZ' => 'NEW ZEALAND',
				'NO' => 'NORWAY',
				'PK' => 'PAKISTAN',
				'PG' => 'PAPUA NEW GUINEA',
				'PE' => 'PERU',
				'PH' => 'PHILIPPINES',
				'PL' => 'POLAND',
				'PT' => 'PORTUGAL',
				'RU' => 'RUSSIA',
				'VC' => 'SAINT VINCENT AND THE GRENADINES',
				'SM' => 'SAN MARINO',
				'SG' => 'SINGAPORE',
				'ZA' => 'SOUTH AFRICA',
				'ES' => 'SPAIN',
				'LK' => 'SRILANKA',
				'SE' => 'SWEDEN',
				'CH' => 'SWITZERLAND',
				'TW' => 'TAIWAN',
				'TH' => 'THAILAND',
				'TN' => 'TUNISIA',
				'TR' => 'TURKEY',
				'AE' => 'UAE',
				'GB' => 'UNITED KINGDOM',
				'VN' => 'VIET NAM'));


	Configure::write(
		'province', array(
				'008476' => 'An Giang',
				'008464' => 'Bà Rịa Vũng Tàu',
				'0084781' => 'Bạc Liêu',
				'0084281' => 'Bắc Cạn',
				'0084240' => 'Bắc Giang',
				'0084241' => 'Bắc Ninh',
				'008475' => 'Bến Tre',
				'0084650' => 'Bình Dương',
				'008456' => 'Bình Định',
				'0084651' => 'Bình Phước',
				'008462' => 'Bình Thuận',
				'0084780' => 'Cà Mau',
				'008426' => 'Cao Bằng',
				'0084710' => 'Cần Thơ',
				'0084511' => 'Đà Nẵng',
				'0084500' => 'Đắc Lắc',
				'0084501' => 'Đắc Nông',
				'0084230' => 'Điện Biên',
				'008461' => 'Đồng Nai',
				'008467' => 'Đồng Tháp',
				'008459' => 'Gia Lai',
				'008419' => 'Hà Giang',
				'0084351' => 'Hà Nam',
				'00844' => 'Hà Nội',
				'008439' => 'Hà Tĩnh',
				'0084320' => 'Hải Dương',
				'008431' => 'Hải Phòng',
				'0084711' => 'Hậu Giang',
				'008418' => 'Hòa Bình',
				'0084321' => 'Hưng Yên',
				'008458' => 'Khánh Hòa',
				'008477' => 'Kiên Giang',
				'008460' => 'Kon Tum',
				'0084231' => 'Lai Châu',
				'008425' => 'Lạng Sơn',
				'008420' => 'Lào Cai',
				'008463' => 'Lâm Đồng',
				'008472' => 'Long An',
				'0084350' => 'Nam Định',
				'008438' => 'Nghệ An',
				'008430' => 'Ninh Bình',
				'008468' => 'Ninh Thuận',
				'0084210' => 'Phú Thọ',
				'008457' => 'Phú Yên',
				'008452' => 'Quảng Bình',
				'0084510' => 'Quảng Nam',
				'008455' => 'Quảng Ngãi',
				'008433' => 'Quảng Ninh',
				'008453' => 'Quảng Trị',
				'008479' => 'Sóc Trăng',
				'008422' => 'Sơn La',
				'008466' => 'Tây Ninh',
				'008436' => 'Thái Bình',
				'0084280' => 'Thái Nguyên',
				'008437' => 'Thanh Hóa',
				'008454' => 'Thừa Thiên Huế',
				'008473' => 'Tiền Giang',
				'00848' => 'TPHCM',
				'008474' => 'Trà Vinh',
				'008427' => 'Tuyên Quang',
				'008470' => 'Vĩnh Long',
				'0084211' => 'Vĩnh Phúc',
				'008429' => 'Yên Bái'
		));

	$config['option_language'] = array("deu" => __("Deutsch"),
										"fre" => __("French"),
										"jap" => __("Japanese"),
										"chi" => __("Chinese")
	);

	Configure::write(
	 'ProductType', array(
	   '1' => 'Domain',
	   '2' => 'Window Cloud Server',
	   '3' => 'Linux Cloud Server',
	   '4' => 'Cloud Storage',
	   '5' => 'SSL',
	   '6' => 'Co-Location',
	   '7' => 'Value Added Service')
	 );

	Configure::write(
		'DomainName8', array('com', 'net', 'org', 'info', 'biz', 'vn', 'com.vn', 'net.vn')
		);

	Configure::write(
		'DomainName20', array(	'com', 'net', 'org', 'vn',
								'info', 'biz', 'com.vn', 'net.vn',
								'org.vn', 'info.vn', 'gov.vn', 'edu.vn',
								'biz.vn', 'pro.vn', 'health.vn', 'ac.vn',
								'us', 'jp', 'asia', 'xxx')
		);

	Configure::write(
		'DomainProvince', array(
				"angiang",
				"bacgiang", "backan", "baclieu", "bacninh", "baria-vungtau", "bentre", "binhdinh", "binhduong", "binhphuoc", "binhthuan",
				"camau", "cantho", "caobang",
				"daklac", "daknong", "danang", "dienbien", "dongnai", "dongthap",
				"gialai",
				"hagiang", "haiduong", "haiphong", "hanam", "hanoi", "hatinh", "haugiang", "hoabinh", "hungyen",
				"khanhhoa", "kiengiang", "kontum",
				"laichau", "lamdong", "langson", "laocai", "longan",
				"namdinh", "nghean", "ninhbinh", "ninhthuan",
				"phutho", "phuyen",
				"quangbinh", "quangnam", "quangngai", "quangninh", "quangtri",
				"soctrang", "sonla",
				"tayninh", "thaibinh", "thainguyen", "thanhhoa", "thanhphohochiminh", "thuathienhue", "tiengiang", "travinh", "tuyenquang",
				"vinhlong", "vinhphuc",
				"yenbai"
			)
		);

	// View derectory
	define('VIEW', "/app/View/");

	define ("MAX_PER_PAGE", 5);
	define ("MAX_PAGE", 10);

	//setting pager
	Configure::write(
		'Pager.rpp', array(
				'5' => '5',
				'10' => '10',
				'20' => '20',
				'50' => '50',
				'100' => '100',
		)
	);

	define("DEFAULT_ZIP_CODE","1508512");
	define("DEFAULT_COUNTRY_CODE","VN");
	define("DEFAULT_POSTAL_CODE","00");
	define("DEFAULT_ORG_NAME", "VTC DIGICOM");
	define("DEFAULT_ORG_TYPE", 3);

	// setting calculate bandwith server Linux
	Configure::write(
		'bandwidth_linux_month', array(
			"Jan" => "01",
			"Feb" => "02",
			"Mar" => "03",
			"Apr" => "04",
			"May" => "05",
			"Jun" => "06",
			"Jul" => "07",
			"Aug" => "08",
			"Sep" => "09",
			"Oct" => "10",
			"Nov" => "11",
			"Dec" => "12"
		)
	);

	// Define for search Full
	define("LINK_WHOIS", "http://www.whois.net/whois/");

	//url for get status Yahoo and Skype
	define("STATUS_SKYPE", "http://mystatus.skype.com/mediumicon/");
	define("STATUS_SKYPE2", "http://mystatus.skype.com/bigclassic/");

	define("SKYPE_IMAGE_ONLINE", "s.png");
	define("SKYPE_IMAGE_OFFLINE", "s_off.png");

	Configure::write(
		"skype_image", array(
			"on" 	=> "s.png",
			"off" 	=> "s_off.png",
		)
	);

	Configure::write(
		"skype_image_support", array(
			"on" 	=> "icon_skype_online.png",
			"off" 	=> "icon_skype_offline.png",
		)
	);

	define('VTC_MAIN_URL','http://cloud.vtc.vn/');
	define('CLOUD_URL','https://vtc.cloud/');
	define('CUSTOMER_URL','https://user.cloud.vtc.vn/');
	define('DOMAINNAME_URL','https://dns.vtc.vn/');

?>
