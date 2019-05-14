<?php
namespace backend\models;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupFormClient extends Model
{
    public $username;
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('app','O Número de Cliente já se encontra em uso')],
            ['username', 'integer', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('app','O e-mail já se encontra em uso')],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signupClient()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $password = $this->generateRandomPassword();
        $user->setPassword($password);
        $user->password = $password;
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
    
    public static function generateRandomPassword(){
        $password = Yii::$app->getSecurity()->generateRandomString(10);
        return $password;
    }
}
