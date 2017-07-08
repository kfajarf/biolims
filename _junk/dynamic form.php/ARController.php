<?php

public function actionCreate()
    {
        $this->checkPrivilege();
        $model = new AnalysisRequest();
        $modelsSampel = [new Sampel];
        $pemohon = new PemohonAnalisis();


        if ($model->load(Yii::$app->request->post()) && $pemohon->load(Yii::$app->request->post())) 
        {
            $modelsSampel = Model::createMultiple(Sampel::classname());
            Model::loadMultiple($modelsSampel, Yii::$app->request->post());
            
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsSampel),
                    ActiveForm::validate($model) 
                );
            }
            
            // $model->tanggal_diterima = date('Y-m-d');
            $model->sisa = $model->total_biaya - $model->dp;
            $model->save();
            $pemohon->request_id = $model->id;
            $pemohon->save();

            // validate all models
            
            $valid = $model->validate();
            // print_r($model->getErrors());
            // var_dump($valid);
            // die();
            $valid = Model::validateMultiple($modelsSampel) && $valid;
            // var_dump($valid);die();
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsSampel as $modelSampel) {
                            $modelSampel->request_id = $model->id;
                            if (! ($flag = $modelSampel->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelsSampel' => (empty($modelsSampel)) ? [new Sampel] : $modelsSampel,
                'pemohon' => $pemohon,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $this->checkPrivilege();
        $modelCustomer = $this->findModel($id);
        $modelsAddress = $modelCustomer->addresses;

        if ($modelCustomer->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsAddress, 'id', 'id');
            $modelsAddress = Model::createMultiple(Address::classname(), $modelsAddress);
            Model::loadMultiple($modelsAddress, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsAddress, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsAddress),
                    ActiveForm::validate($modelCustomer)
                );
            }

            // validate all models
            $valid = $modelCustomer->validate();
            $valid = Model::validateMultiple($modelsAddress) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelCustomer->save(false)) {
                        if (! empty($deletedIDs)) {
                            Address::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsAddress as $modelAddress) {
                            $modelAddress->customer_id = $modelCustomer->id;
                            if (! ($flag = $modelAddress->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelCustomer->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'modelCustomer' => $modelCustomer,
            'modelsAddress' => (empty($modelsAddress)) ? [new Address] : $modelsAddress
        ]);
    }