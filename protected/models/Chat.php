<?php

    Class Chat extends CActiveRecord {

        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        public function tableName()
        {
            return 'tbl_chat';
        }

        public function rules()
        {
            return array(
                array('username, message', 'required'),
                array('username','length', 'max' => 20),
                array('message','length', 'max' => 255),
                array('id, username, message, created','safe'),
            );
        }

        public function safeAttributes()
        {
            return array(
                'username',
                'message',
            );
        }

        public function attributeLabels()
        {
            return array(
                'username' => 'Name',
                'message' => 'Message',
            );
        }

    }

?>