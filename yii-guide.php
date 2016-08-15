 <?php 
1. консольные комманды создавать в папке commands в виде расширения класса  console\Controller
	вызов yii example/index  	

	class ExampleController extends \yii\console\Controller
	{
	    // Команда "yii example/create test" вызовет "actionCreate('test')"
	    public function actionCreate($name) { 
	    	
	    	if (/* возникла проблема */) {
	        	echo "Возникла проблема!\n";
	        	return 1;
	    	}
	    	// делаем что-нибудь
	    	return 0;				// код ошибки для консоли
	    }

	    // Команда "yii example/index city" вызовет "actionIndex('city', 'name')"
	    // Команда "yii example/index city id" вызовет "actionIndex('city', 'id')"
	    public function actionIndex($category, $order = 'name') { ... }

	    // Команда "yii example/add test" вызовет "actionAdd(['test'])"
	    // Команда "yii example/add test1,test2" вызовет "actionAdd(['test1', 'test2'])"
	    public function actionAdd(array $name) { ... }
	}

2. Если объект EntryForm заполнен пользовательскими данными, то для их проверки вы можете вызвать метод [[yii\base\Model::validate()|validate()]] 
if ($model->load(Yii::$app->request->post()) && $model->validate())


3. данные из БД с постраничной разбивкой https://github.com/yiisoft/yii2/blob/master/docs/guide-ru/start-databases.md
4. @app/runtime указывает на времененную директорию runtime. А @app  на корень директории
5. псевдонимы в "web.php"

	'aliases' => [
	        '@name1' => 'path/to/path1',
	        '@name2' => 'path/to/path2',
	    ],

@yii указывает на директорию, в которую был установлен Yii framework, а @web можно использовать для получения базового URL текущего приложения.



6. controllerMap  можете переопределить  соответствие между ID контроллера и его классом
	https://github.com/yiisoft/yii2/blob/master/docs/guide-ru/structure-applications.md

	'controllerMap' => [
	        [
	            'account' => 'app\controllers\UserController',
	            'article' => [
	                'class' => 'app\controllers\PostController',
	                'enableCsrfValidation' => false,
	            ],
	        ],
	    ],


7.  namespace 	app\controllers;   пространство имен, в котором должны находится названия классов контроллеров
				//app\controllers\PostController
				//app\controllers\admin\PostController

8.	 params 

	[
	    'params' => [
	        'thumbnail.size' => [128, 128],
	    ],
	]

	//вызов 

	$size = \Yii::$app->params['thumbnail.size'];
	$width = \Yii::$app->params['thumbnail.size'][0];


9.  контроллер по-умолчанию  в web.php 
 	'defaultRoute' => 'start',   

 10.  runtimePath
		Свойство указывает путь, по которому хранятся временные файлы.  
		По-умолчанию значение равно папке, которая представлена псевдонимом пути @app/runtime

11.  viewPath   базовую папку,где содержаться все файлы представлений. 
 		Значение по умолчанию представляет собой псевдоним @app/views



12. Обработчики событий в конфигурации приложения
	Например, обработчик события, может динамически подставлять язык приложения [[yii\base\Application::language]] в зависимости от некоторых параметров

	beforeRequest - возникает до того как приложение начинает обрабатывать входящий запрос
	'on beforeRequest' => function ($event) {
	        // ...
	    },
	//Или запуск события сразу после того как приложение будет создано
	\Yii::$app->on(\yii\base\Application::EVENT_BEFORE_REQUEST, function ($event) {
	    // ...
	});

	afterRequest - возникает после того как приложение заканчивает обработку запроса, но до того как произойдет отправка ответа
	На момент возникновения данного события, обработка запроса завершена и вы можете воспользоваться этим для произведения постобработки запроса, с целью настройки ответа.


	beforeAction - возникает до того как будет выполнено действие контроллера. Событие является объектом [[yii\base\ActionEvent]] 
	'on beforeAction' => function ($event) {
	        if (некоторое условие) {
	            $event->isValid = false;   //для предотвращения выполнения действия
	        } else {
	        }
	    },

	afterAction - возникает после выполнения действия контроллера. Событие является объектом [[yii\base\ActionEvent]].
	Через свойство [[yii\base\ActionEvent::result]] обработчик события может получить доступ и изменить значение выполнения действия контроллера.
	'on afterAction' => function ($event) {
	        if (некоторое условие) {
	            // modify $event->result
	        } else {
	        }
	    },

13. Service Locator  является объектом, предоставляющим всевозможные сервисы (или компоненты) 
Предоставляемые им службы, такие, как компоненты request, response, urlManager, называют компонентами приложения.
https://github.com/yiisoft/yii2/blob/master/docs/guide-ru/concept-service-locator.md

14. Встроенные компоненты приложения:   !!!
https://github.com/yiisoft/yii2/blob/master/docs/guide-ru/structure-application-components.md

[[yii\web\AssetManager|						assetManager]]:		используется для управления и опубликования ресурсов приложения. 
[[yii\db\Connection|						db]]: 				представляет собой соединение с базой данных 
[[yii\base\Application::errorHandler|		errorHandler]]: 	осуществляет обработку PHP ошибок и исключений.
[[yii\i18n\Formatter|						formatter]]: 		форматирует данные для отображения их конечному пользователю
[[yii\i18n\I18N|							i18n]]: 			используется для перевода сообщений и форматирования.  Интернационализация;
[[yii\log\Dispatcher|						log]]: 				обработка и маршрутизация логов. 
[[yii\swiftmailer\Mailer|					mail]]: 			предоставляет возможности для составления и рассылки писем.
[[yii\base\Application::response|			response]]: 		представляет собой данные от сервера, которые будет направлены пользователю.
[[yii\base\Application::request|			request]]: 			представляет собой запрос, полученный от конечных пользователей
[[yii\web\Session|							session]]: 			информация о сессии. 
[[yii\web\UrlManager|						urlManager]]: 		используется для разбора и создания URL.
[[yii\web\User|								user]]: 			представляет собой информацию аутентифицированного пользователя.
[[yii\web\View|								view]]: 			используется для отображения представлений. 


15. Правила наименования классов контроллеров
		article соответствует app\controllers\ArticleController;
		post-comment соответствует app\controllers\PostCommentController;
		admin/post-comment соответствует app\controllers\admin\PostCommentController;
		adminPanels/post-comment соответствует app\controllers\adminPanels\PostCommentController.

 
16. Именование действий
		index соответствует actionIndex, а hello-world соответствует actionHelloWorld.


17. Отдельные действия!
	Возможно использовать как встроенные действия внутри контроллера, так и Отдельные действия,
	они определяются в качестве классов, унаследованных от [[yii\base\Action]] или его потомков. 
	Для использования отдельного действия, вы должны указать его в карте действий, 
	с помощью переопределения метода [[yii\base\Controller::actions()]] в вашем классе контроллера:
		public function actions()
		{
		    return [
		        // объявляет "error" действие с помощью названия класса
		        'error' => 'yii\web\ErrorAction',

		        // объявляет "view" действие с помощью конфигурационного массива
		        'view' => [
		            'class' => 'yii\web\ViewAction',
		            'viewPrefix' => '',
		        ],
		    ];
		}
https://github.com/yiisoft/yii2/blob/master/docs/guide-ru/structure-controllers.md

18. Redirect в действии
	public function actionForward()
	{
	    // перенаправляем браузер пользователя на http://example.com
	    return $this->redirect('http://example.com');
	}

19. Переопределение действия по-умолчанию для контроллера с помощью свойства $defaultAction.  С  index на home 
	namespace app\controllers;
	use yii\web\Controller;
	class SiteController extends Controller
	{
	    public $defaultAction = 'home';
	    public function actionHome()
	    {
	        return $this->render('home');
	    }
	}



20. Чтобы параметр действия принимал массив значений, вы должны использовать type-hint значение array, как показано ниже:
	public function actionView(array $id, $version = null)
	{
	    // ...
	}
если запрос будет содержать URL http://hostname/index.php?r=post/view&id[]=123, то параметр $id примет значение ['123']	

21. Контроллер содержит методы 
		beforeAction()
		afterAction()
	Если один из методов вернул false, то остальные, не вызванные методы beforeAction будут пропущены, а выполнение действия будет отменено
 
22. Приложение, получив результат выполнения действия, присвоит его объекту response.
	https://github.com/yiisoft/yii2/blob/master/docs/guide-ru/runtime-responses.md

23. Контроллеры не должны заниматься обработкой данных, это должно происходить в слое моделей.

24. генерация случайной последовательности
	$this->auth_key = \Yii::$app->security->generateRandomString();

25. Аутентификация. Необходимо: 
	Настроить компонент приложения [[yii\web\User|user]];
	'components' => [
        'user' => [
            'identityClass' => 'app\models\User',
	    ],
	],
	Создать класс, реализующий интерфейс [[yii\web\IdentityInterface]]. 
	class User extends ActiveRecord implements IdentityInterface{}

26. identity текущего пользователя
	Yii::$app->user->identity;
	Оно вернёт экземпляр identity class, представляющий текущего аутентифицированного пользователя, 
	или null, если текущий пользователь не аутентифицирован (например, гость)

	// `identity` текущего пользователя. `Null`, если пользователь не аутентифицирован.
	$identity = Yii::$app->user->identity;
	// ID текущего пользователя. `Null`, если пользователь не аутентифицирован.
	$id = Yii::$app->user->id;
	// проверка на то, что текущий пользователь гость (не аутентифицирован)
	$isGuest = Yii::$app->user->isGuest;

	Для залогинивания пользователя, вы можете использовать следующий код:
	// найти identity с указанным username.
	// замечание: также вы можете проверить и пароль, если это нужно
	$identity = User::findOne(['username' => $username]);
	// логиним пользователя
	Yii::$app->user->login($identity);

27. Для выхода пользователя
	Yii::$app->user->logout();
	Если вы хотите сохранить сессионные данные, вы должны вместо этого вызвать Yii::$app->user->logout(false).

28. События аутентификации
	https://github.com/yiisoft/yii2/blob/master/docs/guide-ru/security-authentication.md

29. регистрация meta тэга в представлении
	$this->registerMetaTag(['name'=>'description', 'content'=>'Some string!']);

30. регистрация  js файла  в представлении в шапке
	$this->registerJsFile('//cnd.. ', ['position'=>$this::POS_HEAD]);
			registerCssFile


31. регистрация, указываем псевдоним до действия create 
	  'urlManager' => [
            //'enablePrettyUrl' => true,
            //'showScriptName'  => false,	
	  		'rules' => [
	  			'register' => 'users/create'
	  		]
       ],

32. ?	
	if(Yii::$app->user>isGuest){
	   Yii::$app->user->loginRequired();
	}

33. скрытое поле формы с пустой надписью
	echo  $form->field($model, 'attribute')->hiddenInput()->label(false, ['style'=>'display:none']);



34. ссылка 
	<?= Html::a('Profile', ['user/view', 'id' => $id], ['class' => 'profile-link']) \?\>
	http://www.yiiframework.com/doc-2.0/guide-helper-html.html

35.  В момент возникновения события пишем сообщение в сессию:
	Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.'); 

	После обновления страницы читаем его и выводим:
	if ($msg = Yii::$app->session->getFlash('success')) { echo $msg; } 

36. создание ссылок
    http://www.yiiframework.com/doc-2.0/guide-runtime-routing.html

37. выдача в модели поиска  в указанном диапазоне
	$query->andFilterWhere(['between', 'progress',  0, 99]);
	или 
	/*... */
    $query->andFilterWhere(['>', 'price', $this->min_price]);
    $query->andFilterWhere(['<', 'price', $this->max_price]);
    /*... */

 ?>
