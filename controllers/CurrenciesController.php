<?php

namespace app\controllers;

use Yii;
use app\models\Currencies;
use app\models\CurrenciesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

/**
 * CurrenciesController implements the CRUD actions for Currencies model.
 */
class CurrenciesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                HttpBasicAuth::className(),
                HttpBearerAuth::className(),
                QueryParamAuth::className(),
            ],
            'only' => ['index', 'currency'],
        ];
        return $behaviors;
    }

    /**
     * Lists all Currencies models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CurrenciesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*обновления данных*/
    public function actionSetCourse()
    {
        $languages = simplexml_load_file("http://www.cbr.ru/scripts/XML_daily.asp");
        //валюты
        foreach ($languages->Valute as $lang) 
        {
            $currency = Currencies::find()->where(['letter_code' => $lang->CharCode])->one();
            if($currency !== null)
            {
                $currency->unit = $lang->Nominal;
                $currency->rate = $lang->Value;
                $currency->save();
            }
            else
            {
                $currency = new Currencies();
                $currency->code = $lang->NumCode;
                $currency->letter_code = (string)$lang->CharCode;
                $currency->unit = $lang->Nominal;
                $currency->name = (string)$lang->Name;
                $currency->rate = (float)$lang->Value;
                $currency->save();
            }
        }

        //Yii::$app->session->setFlash('success', "Успешно выполнено!");
        //return ['message' => 'Успешно выполнено!'];
        return json_encode(['message' => 'Успешно выполнено!', ],256);
    }
    /**
     * Displays a single Currencies model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCurrency($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Currencies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Currencies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Currencies::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
