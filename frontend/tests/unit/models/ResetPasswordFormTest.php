<?php

namespace frontend\tests\unit\models;

use common\fixtures\UserFixture;
use frontend\models\FormResetPassword;

class ResetPasswordFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;


    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ],
        ]);
    }

    public function testResetWrongToken()
    {
        $this->tester->expectException('yii\base\InvalidParamException', function() {
            new FormResetPassword('');
        });

        $this->tester->expectException('yii\base\InvalidParamException', function() {
            new FormResetPassword('notexistingtoken_1391882543');
        });
    }

    public function testResetCorrectToken()
    {
        $user = $this->tester->grabFixture('user', 0);
        $form = new FormResetPassword($user['password_reset_token']);
        expect_that($form->resetPassword());
    }

}
