<?php

class SiteController extends Controller
{

	public function actionIndex()
	{
        //with name = 40, without name = 87.
        $model = new Chat();
        $getU = Yii::app()->request->getPost('username');
        $getM = Yii::app()->request->getPost('message');

        if (!isset($getM) || !isset($getU)) {
            $this->render('chat',array('model' => $model));
        }
        elseif (!empty($getU) && !empty($getM)) {
            $_POST['Chat']['created'] = time();
            $_POST['Chat']['username'] = $this->filter($getU);
            $_POST['Chat']['message'] = $this->filter($getM);
            $model->attributes=$_POST['Chat'];
            if(Yii::app()->request->isAjaxRequest && $model->validate()){
                $model->insert();
                $content = $model->findAll();
                for ($i=0;$i < count($content);$i++)  {
                    $data = $content[$i];
                    $rows[$i] = '['.date('d.m.Y  H:i:s',$data['created']).'] '.$data['username'].': '.$data['message'];
                    echo '<tr><td>'.CHtml::encode($rows[$i]).'</td></tr>';
                }
                Yii::app()->end();
            }
            elseif (Yii::app()->request->isAjaxRequest && !$model->validate()) {
                echo '<p style="font-size: 18pt; color: red;">Ошибка ввода!!</p>';
                Yii::app()->end();
            }
        }
    }

    private function filter($var , $sql = 0) {

        $var = strip_tags($var);
        $var=str_replace ("\n"," ", $var);
        $var=str_replace ("\r","", $var);
        $var = htmlentities($var,ENT_QUOTES, "UTF-8");
        $var = htmlspecialchars($var, ENT_QUOTES);
        if ( $sql == 1) {
            $var = mysql_real_escape_string($var);
        }
        return $var;
    }
}
?>