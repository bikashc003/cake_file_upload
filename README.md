# CakePHP Fileupload Component 

It can be used to upload a file, create thumbnails, remove file, create a file from image base64 data

## Requirements

The `master` branch has the following requirements:

* CakePHP 3.6.0 or greater.
* PHP 5.4.16 or greater.


## Installation

* Install the plugin with [Composer](https://getcomposer.org/) from your CakePHP Project's ROOT directory (where the **composer.json** file is located)
```sh
composer require bikash/cake_file_upload
```

* [Load the plugin](http://book.cakephp.org/3.0/en/plugins.html#loading-a-plugin)
```php
Plugin::load('FileUpload');
```


## How to use

1. Load plugin in controller's initialise function

```php
namespace App\Controller;

use Cake\Event\Event;

/**
 * My Users Controller 
 */
class UsersController extends AppController {

        public function initialize(){
        parent::initialize();
        $this->loadComponent('FileUpload.FileUpload',[
            'defaultThumb'=>[
                'small'=>[30,30],
                'medium' => [90,90 ]
            ],
            'uploadDir' =>WWW_ROOT.'uploads'.DS.'profile_pic'.DS,
            'maintainAspectRation'=>true
        ]);
    }

}
```

2. call a function to upload image

```php
 public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['profile_pic'] = $this->FileUpload->doFileUpload($this->request->data['profile_pic']);
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['controller' => 'Users','action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
```

