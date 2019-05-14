<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model {

    public $fname;
    public $lname;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // name, email, subject and body are required
            [['fname', 'lname', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
                // verifyCode needs to be entered correctly
//            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'fname' => 'Primeiro Nome',
            'lname' => 'Apelido',
            'email' => 'Email',
            'subject' => 'Assunto',
            'body' => 'Mensagem',
//            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email) {
        return Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->fname])
                ->setReplyTo([$this->email => $this->fname])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();
    }

}
