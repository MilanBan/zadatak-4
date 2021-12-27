<?php

namespace app\core;

class Application {
  public string $layout = 'main';
  public string $userClass;
  public static string $ROOT_DIR;
  public Router $router;
  public Request $request;
  public Response $response;
  public Session $session;
  public Database $db;
  public ?DbModel $user;
  public static Application $app;
  public ?Controller $controller = null;

  public function __construct( $routePath, array $config ) {
    $this->userClass = $config['userClass'];
    self::$app = $this;
    self::$ROOT_DIR = $routePath;
    $this->request = new Request();
    $this->response = new Response();
    $this->session = new Session();
    $this->router = new Router( $this->request, $this->response );

    $this->db = new Database( $config['db'] );

    $primaryValue = $this->session->get( 'user' );
    if ( $primaryValue ) {
      $primaryKey = $this->userClass::primaryKey();
      $this->user = $this->userClass::findOne( [$primaryKey => $primaryValue] );
    } else {
      $this->user = null;
    }
  }

  public static function isGuest() {
    return !self::$app->user;
  }

  public function run() {
    try {
      echo $this->router->resolve();
    } catch (\Exception $e) {
      $this->response->setStatusCode($e->getCode());
      echo $this->router->renderView('_error', [
        'exception' => $e
      ]);
    }
  }

  /**
   * Get the value of controller
   */
  public function getController() {
    return $this->controller;
  }

  /**
   * Set the value of controller
   *
   * @return  self
   */
  public function setController( $controller ) {
    $this->controller = $controller;

    return $this;
  }

  public function login( DbModel $user ) {
    $this->user = $user;
    $primaryKey = $user->primaryKey();
    $primaryValue = $user->{$primaryKey};
    $this->session->set( 'user', $primaryValue );

    return true;
  }

  public function logout() {
    $this->user = null;
    $this->session->remove( 'user' );
  }
}