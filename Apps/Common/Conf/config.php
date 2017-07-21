<?php
 return array(
		'URL_MODEL' => 0,
	    'URL_CASE_INSENSITIVE'  =>  false,
	    'VAR_PAGE'=>'p',
	    'PAGE_SIZE'=>15,
		'DB_TYPE'=>'mysql',
	    'DB_HOST'=>'localhost',
	    'DB_NAME'=>'sente',
	    'DB_USER'=>'root',
	    'DB_PWD'=>'aa',
	    'DB_PREFIX'=>'sente_',
	    'DEFAULT_C_LAYER' =>  'Controller',
	    'DEFAULT_CITY' => '440100',
	    'DATA_CACHE_SUBDIR'=>true,
        'DATA_PATH_LEVEL'=>2, 
//	    'SESSION_PREFIX' => 'WSTMALL',
//        'COOKIE_PREFIX'  => 'WSTMALL',
		'LOAD_EXT_CONFIG' => 'wst_config',

      //增加系统常量
     "TMPL_PARSE_STRING" =>array(
        "__UPLOAD__" => __ROOT__ . "/Public/Uploads/",
),
	);
?>